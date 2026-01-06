<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-categories {--dummy : Add dummy data as well}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync existing string categories to Category model and add dummy data with proper descriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting category synchronization...');

        // 1. Ambil semua buku yang punya kategori (string)
        // Kita gunakan raw query atau temporary access karena di Model Book field 'category' mungkin sudah tidak di fillable
        $books = Book::whereNotNull('category')->get(); // Ambil semua untuk cek/update deskripsi juga

        $count = 0;

        // Mapping deskripsi yang lebih natural dan profesional
        $descriptions = [
            'Novel' => 'Koleksi novel fiksi dari berbagai genre dan penulis ternama.',
            'Sejarah' => 'Buku-buku yang mengulas sejarah peradaban, peristiwa penting, dan tokoh dunia.',
            'Biografi' => 'Kisah hidup dan perjalanan tokoh-tokoh inspiratif.',
            'Fiksi' => 'Karya sastra imajinatif yang menghibur dan mendidik.',
            'Teknologi' => 'Buku tentang perkembangan teknologi terkini, pemrograman, dan digitalisasi.',
            'Bisnis' => 'Panduan bisnis, manajemen, strategi, dan kewirausahaan.',
            'Sains' => 'Ensiklopedia dan buku ilmu pengetahuan alam yang mendalam.',
            'Psikologi' => 'Buku pengembangan diri, kesehatan mental, dan psikologi manusia.',
            'Agama' => 'Literatur keagamaan dan spiritualitas.',
            'Politik' => 'Pembahasan mengenai sistem politik, pemerintahan, dan kebijakan publik.',
            'Sastra' => 'Karya sastra klasik dan kontemporer.',
            'Komik' => 'Cerita bergambar yang menghibur untuk berbagai kalangan.'
        ];

        foreach ($books as $book) {
            $categoryName = $book->category;

            if (empty($categoryName))
                continue;

            // Tentukan deskripsi
            $desc = $descriptions[$categoryName] ?? "Koleksi buku-buku terlengkap untuk kategori {$categoryName}.";

            // Cari atau Buat Kategori
            $category = Category::firstOrCreate(
                ['name' => $categoryName],
                [
                    'slug' => Str::slug($categoryName),
                    'description' => $desc
                ]
            );

            // AUTO-FIX: Update deskripsi jika masih pakai default message lama atau ingin distandardisasi
            // Kita update setiap kali running agar deskripsi di database 'sembuh'
            if (isset($descriptions[$categoryName]) || Str::contains($category->description, 'Kategori otomatis')) {
                if ($category->description !== $desc) {
                    $category->update(['description' => $desc]);
                    $this->line("Updated description for category: {$category->name}");
                }
            }

            // Update Book Relation
            if ($book->category_id !== $category->id) {
                $book->category_id = $category->id;
                $book->save();
                $count++;
            }
        }

        // Update juga deskripsi kategori yang mungkin tidak sedang dipakai di buku tapi ada di DB (misal dummy data sebelumnya)
        foreach ($descriptions as $name => $desc) {
            Category::where('name', $name)->update(['description' => $desc]);
        }

        $this->info("Successfully synced/updated {$count} books.");

        // 2. Tambah Dummy Data jika diminta
        if ($this->option('dummy') || Book::count() < 5) {
            $this->info('Generating dummy data...');
            $this->generateDummyData($descriptions);
        }
    }

    private function generateDummyData($descriptions)
    {
        // Gunakan mapping deskripsi yang sama
        $categories = [
            'Teknologi',
            'Bisnis',
            'Sains',
            'Sejarah',
            'Psikologi'
        ];

        foreach ($categories as $name) {
            $desc = $descriptions[$name] ?? "Koleksi buku {$name}";

            $cat = Category::firstOrCreate(
                ['name' => $name],
                [
                    'slug' => Str::slug($name),
                    'description' => $desc
                ]
            );

            // Update description to ensure it's correct
            $cat->update(['description' => $desc]);

            // Tambah 2-3 buku per kategori
            $titles = [
                'Teknologi' => ['Dasar Pemrograman Python', 'Clean Code', 'The Pragmatic Programmer'],
                'Bisnis' => ['Rich Dad Poor Dad', 'Zero to One', 'Atomic Habits'],
                'Sains' => ['A Brief History of Time', 'Cosmos', 'Sapiens'],
                'Sejarah' => ['Sejarah Dunia yang Disembunyikan', 'Biografi Soekarno'],
                'Psikologi' => ['Thinking, Fast and Slow', 'Psychology of Money']
            ];

            if (isset($titles[$name])) {
                foreach ($titles[$name] as $title) {
                    // Cek duplikasi
                    if (Book::where('title', $title)->exists())
                        continue;

                    Book::create([
                        'title' => $title,
                        'author' => 'Penulis ' . $name,
                        'publisher' => 'Penerbit ' . Str::random(5),
                        'publication_year' => rand(2010, 2025),
                        'isbn' => rand(1000000000000, 9999999999999),
                        'category_id' => $cat->id,
                        'description' => "Sinopsis menarik tentang {$title}. Buku ini membahas topik {$name} secara mendalam.",
                        'stock' => rand(3, 15)
                    ]);

                    $this->line("Created dummy book: {$title}");
                }
            }
        }

        $this->info('Dummy data generation complete!');
    }
}

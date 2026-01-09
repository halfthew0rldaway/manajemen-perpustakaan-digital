<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RealDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Bersihkan data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('loans')->truncate();
        DB::table('books')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Create Users (Admin & Petugas Only)
        $userIds = [];

        // Admin
        $userIds[] = DB::table('users')->insertGetId([
            'name' => 'Administrator',
            'email' => 'admin@perpustakaan.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Petugas (Dummy Users untuk Peminjaman)
        $petugasNames = [
            'Petugas Budi',
            'Petugas Siti',
            'Petugas Rizky',
            'Petugas Dewi',
            'Petugas Andi',
            'Petugas Joko',
            'Petugas Sari',
            'Petugas Doni',
            'Petugas Rina',
            'Petugas Eko'
        ];

        foreach ($petugasNames as $name) {
            $email = Str::slug($name) . '@perpustakaan.test';
            $userIds[] = DB::table('users')->insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'petugas', // Semua role petugas
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Create Categories
        $categories = [
            'Novel & Sastra' => 'Karya fiksi dan sastra',
            'Pengembangan Diri' => 'Motivasi dan psikologi',
            'Bisnis & Manajemen' => 'Ekonomi dan bisnis',
            'Teknologi' => 'Komputer dan sains',
            'Sejarah' => 'Sejarah dan biografi',
            'Komik' => 'Komik dan novel grafis',
        ];

        $catIds = [];
        foreach ($categories as $name => $desc) {
            $catIds[$name] = DB::table('categories')->insertGetId([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $desc,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Create Books (Dummy Data tanpa ISBN)
        $books = [
            ['Harry Potter', 'J.K. Rowling', 'Bloomsbury', 1997, 'Novel & Sastra'],
            ['Lord of the Rings', 'J.R.R. Tolkien', 'Allen & Unwin', 1954, 'Novel & Sastra'],
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang', 2005, 'Novel & Sastra'],
            ['Bumi Manusia', 'Pramoedya A. Toer', 'Hasta Mitra', 1980, 'Novel & Sastra'],
            ['Atomic Habits', 'James Clear', 'Penguin', 2018, 'Pengembangan Diri'],
            ['Psychology of Money', 'Morgan Housel', 'Harriman', 2020, 'Pengembangan Diri'],
            ['Rich Dad Poor Dad', 'Robert Kiyosaki', 'Warner', 1997, 'Bisnis & Manajemen'],
            ['Zero to One', 'Peter Thiel', 'Crown', 2014, 'Bisnis & Manajemen'],
            ['Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, 'Teknologi'],
            ['Steve Jobs', 'Walter Isaacson', 'Simon', 2011, 'Teknologi'],
            ['Sapiens', 'Yuval Noah Harari', 'Harvill', 2011, 'Sejarah'],
            ['Naruto Vol 1', 'Masashi Kishimoto', 'Elex', 1999, 'Komik'],
            ['One Piece Vol 1', 'Eiichiro Oda', 'Elex', 1997, 'Komik'],
            ['Doraemon Vol 1', 'Fujiko F. Fujio', 'Elex', 1970, 'Komik'],
            ['Detectif Conan', 'Gosho Aoyama', 'Elex', 1994, 'Komik'],
            ['Filosofi Teras', 'Henry Manampiring', 'Kompas', 2018, 'Pengembangan Diri'],
            ['Grit', 'Angela Duckworth', 'Scribner', 2016, 'Pengembangan Diri'],
            ['Mindset', 'Carol Dweck', 'Ballantine', 2006, 'Pengembangan Diri'],
            ['Start with Why', 'Simon Sinek', 'Portfolio', 2009, 'Bisnis & Manajemen'],
            ['Good to Great', 'Jim Collins', 'Harper', 2001, 'Bisnis & Manajemen'],
        ];

        $bookIds = [];
        foreach ($books as $b) {
            $bookIds[] = DB::table('books')->insertGetId([
                'title' => $b[0],
                'author' => $b[1],
                'publisher' => $b[2],
                'publication_year' => $b[3],
                'category_id' => $catIds[$b[4]],
                'stock' => rand(3, 8),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 5. Create Loans (Antara User/Petugas dgn Buku)
        // 15 Transaksi Random
        for ($i = 0; $i < 15; $i++) {
            $status = ['active', 'returned'][rand(0, 1)];
            $loanDate = Carbon::now()->subDays(rand(1, 30));
            $dueDate = (clone $loanDate)->addDays(7);

            $returnDate = null;
            if ($status === 'returned') {
                $returnDate = (clone $loanDate)->addDays(rand(3, 10));
            }

            // Create loan
            DB::table('loans')->insert([
                'user_id' => $userIds[rand(0, count($userIds) - 1)],
                'book_id' => $bookIds[rand(0, count($bookIds) - 1)],
                'loan_date' => $loanDate,
                'due_date' => $dueDate,
                'return_date' => $returnDate,
                'status' => $status,
                'fine_amount' => 0,
                'created_at' => $loanDate,
                'updated_at' => $returnDate ?? $loanDate,
            ]);
        }

        // 5 Overdue Loans specific
        for ($i = 0; $i < 5; $i++) {
            $loanDate = Carbon::now()->subDays(rand(10, 20));
            $dueDate = (clone $loanDate)->addDays(7);

            DB::table('loans')->insert([
                'user_id' => $userIds[rand(0, count($userIds) - 1)],
                'book_id' => $bookIds[rand(0, count($bookIds) - 1)],
                'loan_date' => $loanDate,
                'due_date' => $dueDate,
                'return_date' => null,
                'status' => 'active',
                'fine_amount' => 0,
                'created_at' => $loanDate,
                'updated_at' => $loanDate,
            ]);
        }
    }
}

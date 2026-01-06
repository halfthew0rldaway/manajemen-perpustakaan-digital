<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2005,
                'isbn' => '9789793062792',
                'category' => 'Novel',
                'description' => 'Novel tentang kehidupan anak-anak di Belitung yang berjuang untuk mendapatkan pendidikan.',
                'stock' => 5,
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Hasta Mitra',
                'publication_year' => 1980,
                'isbn' => '9789799731234',
                'category' => 'Novel Sejarah',
                'description' => 'Novel pertama dari Tetralogi Buru yang menceritakan kisah Minke di masa kolonial.',
                'stock' => 3,
            ],
            [
                'title' => 'Negeri 5 Menara',
                'author' => 'Ahmad Fuadi',
                'publisher' => 'Gramedia Pustaka Utama',
                'publication_year' => 2009,
                'isbn' => '9789792248074',
                'category' => 'Novel',
                'description' => 'Kisah inspiratif tentang perjuangan santri di Pondok Madani Ponorogo.',
                'stock' => 4,
            ],
            [
                'title' => 'Ronggeng Dukuh Paruk',
                'author' => 'Ahmad Tohari',
                'publisher' => 'Gramedia Pustaka Utama',
                'publication_year' => 1982,
                'isbn' => '9789792202694',
                'category' => 'Novel',
                'description' => 'Trilogi tentang kehidupan seorang ronggeng di sebuah dukuh terpencil.',
                'stock' => 2,
            ],
            [
                'title' => 'Perahu Kertas',
                'author' => 'Dee Lestari',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2009,
                'isbn' => '9789793062938',
                'category' => 'Novel',
                'description' => 'Novel tentang perjalanan dua anak muda mengejar impian mereka.',
                'stock' => 6,
            ],
            [
                'title' => 'Cantik Itu Luka',
                'author' => 'Eka Kurniawan',
                'publisher' => 'Gramedia Pustaka Utama',
                'publication_year' => 2002,
                'isbn' => '9789792248098',
                'category' => 'Novel',
                'description' => 'Novel magis realis tentang keluarga Dewi Ayu di masa kolonial hingga kemerdekaan.',
                'stock' => 3,
            ],
            [
                'title' => 'Sang Pemimpi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'publication_year' => 2006,
                'isbn' => '9789793062853',
                'category' => 'Novel',
                'description' => 'Sekuel Laskar Pelangi yang menceritakan perjuangan tiga sahabat mengejar mimpi.',
                'stock' => 4,
            ],
            [
                'title' => 'Pulang',
                'author' => 'Leila S. Chudori',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'publication_year' => 2012,
                'isbn' => '9786024246945',
                'category' => 'Novel',
                'description' => 'Novel tentang eksil politik Indonesia di Paris pasca peristiwa 1965.',
                'stock' => 2,
            ],
        ];

        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}

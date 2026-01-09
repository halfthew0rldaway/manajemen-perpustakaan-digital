<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RealisticLibrarySeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('loans')->truncate();
        DB::table('books')->truncate();
        DB::table('categories')->truncate();
        DB::table('members')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Create Admin and Petugas
        $userIds = [];

        // Admin
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Administrator Perpustakaan',
            'email' => 'admin@perpustakaan.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Petugas dengan shift berbeda
        $petugasData = [
            ['Budi Santoso', 'budi@perpustakaan.test', true],
            ['Siti Nurhaliza', 'siti@perpustakaan.test', true],
            ['Rizky Pratama', 'rizky@perpustakaan.test', true],
            ['Dewi Lestari', 'dewi@perpustakaan.test', true],
            ['Andi Wijaya', 'andi@perpustakaan.test', true],
            ['Joko Widodo', 'joko@perpustakaan.test', true],
            ['Sari Indah', 'sari@perpustakaan.test', false], // Inactive
        ];

        foreach ($petugasData as [$name, $email, $isActive]) {
            $userIds[] = DB::table('users')->insertGetId([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'is_active' => $isActive,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Create Categories
        $categories = [
            'Novel & Sastra' => 'Karya fiksi, novel, dan sastra',
            'Pengembangan Diri' => 'Motivasi, psikologi, dan self-improvement',
            'Bisnis & Manajemen' => 'Ekonomi, bisnis, dan manajemen',
            'Teknologi' => 'Komputer, programming, dan teknologi informasi',
            'Sejarah' => 'Sejarah, biografi, dan memoar',
            'Komik & Manga' => 'Komik, manga, dan novel grafis',
            'Agama & Spiritual' => 'Agama, spiritual, dan filosofi',
            'Sains & Matematika' => 'Sains, matematika, dan penelitian',
            'Seni & Budaya' => 'Seni, musik, dan budaya',
            'Pendidikan' => 'Buku pelajaran dan referensi akademik',
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

        // 3. Create Members (50+ anggota dengan data realistis untuk perpustakaan umum)
        $memberIds = [];

        // Data anggota perpustakaan umum dengan berbagai profesi
        $members = [
            // Mahasiswa
            ['Ahmad Fauzi', 'A001', 'Mahasiswa Universitas Negeri Jakarta', '081234567801'],
            ['Bella Safira', 'A002', 'Mahasiswa Universitas Indonesia', '081234567802'],
            ['Candra Wijaya', 'A003', 'Mahasiswa Politeknik Negeri Jakarta', '081234567803'],
            ['Dina Amelia', 'A004', 'Mahasiswa Universitas Trisakti', '081234567804'],
            ['Eko Prasetyo', 'A005', 'Mahasiswa Binus University', '081234567805'],

            // Guru dan Pendidik
            ['Fitri Handayani', 'A006', 'Guru SD Negeri 05 Jakarta', '081234567806'],
            ['Gilang Ramadhan', 'A007', 'Guru SMP Negeri 12 Jakarta', '081234567807'],
            ['Hana Pertiwi', 'A008', 'Guru SMA Negeri 8 Jakarta', '081234567808'],
            ['Irfan Hakim', 'A009', 'Dosen Universitas Pancasila', '081234567809'],
            ['Jasmine Putri', 'A010', 'Guru TK Harapan Bangsa', '081234567810'],

            // Karyawan Swasta
            ['Kevin Anggara', 'A011', 'Karyawan PT. Telkom Indonesia', '081234567811'],
            ['Luna Maharani', 'A012', 'Karyawan Bank Mandiri', '081234567812'],
            ['Mario Teguh', 'A013', 'Karyawan PT. Astra International', '081234567813'],
            ['Nadia Salsabila', 'A014', 'Karyawan PT. Unilever Indonesia', '081234567814'],
            ['Oscar Lawalata', 'A015', 'Karyawan PT. Gojek Indonesia', '081234567815'],

            // PNS
            ['Putri Tanjung', 'A016', 'PNS Kementerian Pendidikan', '081234567816'],
            ['Qori Sandioriva', 'A017', 'PNS Dinas Kesehatan DKI Jakarta', '081234567817'],
            ['Reza Rahadian', 'A018', 'PNS Kementerian Keuangan', '081234567818'],
            ['Sinta Dewi', 'A019', 'PNS Badan Pusat Statistik', '081234567819'],
            ['Tono Suratno', 'A020', 'PNS Kementerian BUMN', '081234567820'],

            // Wiraswasta
            ['Umar Bakri', 'A021', 'Wiraswasta - Toko Buku', '081234567821'],
            ['Vina Panduwinata', 'A022', 'Wiraswasta - Cafe Owner', '081234567822'],
            ['Wawan Setiawan', 'A023', 'Wiraswasta - Kontraktor', '081234567823'],
            ['Xena Xenita', 'A024', 'Wiraswasta - Fashion Designer', '081234567824'],
            ['Yusuf Mansur', 'A025', 'Wiraswasta - Konsultan Bisnis', '081234567825'],

            // Pelajar SMA
            ['Zahra Amani', 'A026', 'Pelajar SMA Negeri 3 Jakarta', '081234567826'],
            ['Aditya Warman', 'A027', 'Pelajar SMA Negeri 5 Jakarta', '081234567827'],
            ['Bunga Citra', 'A028', 'Pelajar SMA Negeri 10 Jakarta', '081234567828'],
            ['Cakra Khan', 'A029', 'Pelajar SMA Negeri 15 Jakarta', '081234567829'],
            ['Dian Sastro', 'A030', 'Pelajar SMA Negeri 20 Jakarta', '081234567830'],

            // Profesional Lainnya
            ['Ello Letto', 'A031', 'Dokter RS Cipto Mangunkusumo', '081234567831'],
            ['Fatin Shidqia', 'A032', 'Perawat RS Fatmawati', '081234567832'],
            ['Gita Gutawa', 'A033', 'Arsitek PT. Airmas Asri', '081234567833'],
            ['Herjunot Ali', 'A034', 'Pengacara Kantor Hukum Makarim', '081234567834'],
            ['Isyana Sarasvati', 'A035', 'Akuntan PT. Deloitte Indonesia', '081234567835'],

            // Pensiunan
            ['Jefri Nichol', 'A036', 'Pensiunan PNS', '081234567836'],
            ['Kirana Larasati', 'A037', 'Pensiunan Guru', '081234567837'],
            ['Lukman Sardi', 'A038', 'Pensiunan TNI', '081234567838'],

            // Ibu Rumah Tangga
            ['Maudy Ayunda', 'A039', 'Ibu Rumah Tangga', '081234567839'],
            ['Nia Ramadhani', 'A040', 'Ibu Rumah Tangga', '081234567840'],

            // Freelancer
            ['Oki Setiana', 'A041', 'Freelance Writer', '081234567841'],
            ['Prilly Latuconsina', 'A042', 'Freelance Graphic Designer', '081234567842'],
            ['Raisa Andriana', 'A043', 'Freelance Photographer', '081234567843'],

            // Lain-lain
            ['Sherina Munaf', 'A044', 'Seniman - Musisi', '081234567844'],
            ['Tulus Setiawan', 'A045', 'Jurnalis Media Indonesia', '081234567845'],
            ['Vidi Aldiano', 'A046', 'Content Creator', '081234567846'],
            ['Wulan Guritno', 'A047', 'Pengusaha Kuliner', '081234567847'],
            ['Yura Yunita', 'A048', 'Pegawai BUMN PLN', '081234567848'],
            ['Zaskia Gotik', 'A049', 'Pegawai Swasta - Marketing', '081234567849'],
            ['Ariel Noah', 'A050', 'Karyawan PT. Pertamina', '081234567850'],
        ];

        foreach ($members as [$name, $memberId, $occupation, $phone]) {
            $memberIds[] = DB::table('members')->insertGetId([
                'name' => $name,
                'member_id_number' => $memberId,
                'occupation_institution' => $occupation,
                'phone' => $phone,
                'email' => Str::slug($name) . '@member.test',
                'address' => 'Jl. ' . ['Sudirman', 'Thamrin', 'Gatot Subroto', 'Kuningan', 'Senopati'][array_rand(['Sudirman', 'Thamrin', 'Gatot Subroto', 'Kuningan', 'Senopati'])] . ' No. ' . rand(1, 100) . ', Jakarta',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add inactive members (expired membership)
        $inactiveMembers = [
            ['Bambang Pamungkas', 'X001', 'Pensiunan Pegawai Swasta', '081234567851'],
            ['Cut Tari', 'X002', 'Ibu Rumah Tangga', '081234567852'],
            ['Deddy Corbuzier', 'X003', 'Wiraswasta', '081234567853'],
        ];

        foreach ($inactiveMembers as [$name, $memberId, $occupation, $phone]) {
            DB::table('members')->insert([
                'name' => $name,
                'member_id_number' => $memberId,
                'occupation_institution' => $occupation,
                'phone' => $phone,
                'email' => Str::slug($name) . '@expired.test',
                'address' => 'Jl. ' . ['Veteran', 'Diponegoro', 'Cikini', 'Menteng'][array_rand(['Veteran', 'Diponegoro', 'Cikini', 'Menteng'])] . ' No. ' . rand(1, 50) . ', Jakarta',
                'status' => 'inactive',
                'created_at' => now()->subYears(2),
                'updated_at' => now(),
            ]);
        }

        // 4. Create Books (100+ buku dengan data lengkap)
        $bookIds = [];

        $books = [
            // Novel & Sastra
            ['Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Bloomsbury', 1997, '9780747532699', 'A1-01', 'Novel & Sastra', 5],
            ['The Lord of the Rings', 'J.R.R. Tolkien', 'Allen & Unwin', 1954, '9780618640157', 'A1-02', 'Novel & Sastra', 4],
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, '9789793062792', 'A1-03', 'Novel & Sastra', 8],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, '9789799731234', 'A1-04', 'Novel & Sastra', 6],
            ['Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', 2009, '9789793062808', 'A1-05', 'Novel & Sastra', 5],
            ['Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 2009, '9789792248234', 'A1-06', 'Novel & Sastra', 7],
            ['Sang Pemimpi', 'Andrea Hirata', 'Bentang Pustaka', 2006, '9789793062815', 'A1-07', 'Novel & Sastra', 6],
            ['Edensor', 'Andrea Hirata', 'Bentang Pustaka', 2007, '9789793062822', 'A1-08', 'Novel & Sastra', 5],
            ['Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Gramedia', 1982, '9789792207538', 'A1-09', 'Novel & Sastra', 4],
            ['Cantik Itu Luka', 'Eka Kurniawan', 'Gramedia', 2002, '9789792248241', 'A1-10', 'Novel & Sastra', 3],

            // Pengembangan Diri
            ['Atomic Habits', 'James Clear', 'Penguin Random House', 2018, '9780735211292', 'B1-01', 'Pengembangan Diri', 10],
            ['The Psychology of Money', 'Morgan Housel', 'Harriman House', 2020, '9780857197689', 'B1-02', 'Pengembangan Diri', 8],
            ['Filosofi Teras', 'Henry Manampiring', 'Kompas Gramedia', 2018, '9786024246945', 'B1-03', 'Pengembangan Diri', 12],
            ['Grit', 'Angela Duckworth', 'Scribner', 2016, '9781501111105', 'B1-04', 'Pengembangan Diri', 6],
            ['Mindset', 'Carol Dweck', 'Ballantine Books', 2006, '9780345472328', 'B1-05', 'Pengembangan Diri', 7],
            ['The 7 Habits of Highly Effective People', 'Stephen Covey', 'Free Press', 1989, '9780743269513', 'B1-06', 'Pengembangan Diri', 9],
            ['Man\'s Search for Meaning', 'Viktor Frankl', 'Beacon Press', 1946, '9780807014295', 'B1-07', 'Pengembangan Diri', 5],
            ['Berani Tidak Disukai', 'Ichiro Kishimi', 'Gramedia', 2014, '9786020331775', 'B1-08', 'Pengembangan Diri', 8],
            ['Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'Gramedia', 2016, '9786024810856', 'B1-09', 'Pengembangan Diri', 10],
            ['Thinking, Fast and Slow', 'Daniel Kahneman', 'Farrar, Straus and Giroux', 2011, '9780374533557', 'B1-10', 'Pengembangan Diri', 6],

            // Bisnis & Manajemen
            ['Rich Dad Poor Dad', 'Robert Kiyosaki', 'Warner Books', 1997, '9781612680194', 'C1-01', 'Bisnis & Manajemen', 8],
            ['Zero to One', 'Peter Thiel', 'Crown Business', 2014, '9780804139298', 'C1-02', 'Bisnis & Manajemen', 6],
            ['Start with Why', 'Simon Sinek', 'Portfolio', 2009, '9781591846444', 'C1-03', 'Bisnis & Manajemen', 7],
            ['Good to Great', 'Jim Collins', 'Harper Business', 2001, '9780066620992', 'C1-04', 'Bisnis & Manajemen', 5],
            ['The Lean Startup', 'Eric Ries', 'Crown Business', 2011, '9780307887894', 'C1-05', 'Bisnis & Manajemen', 6],
            ['Blue Ocean Strategy', 'W. Chan Kim', 'Harvard Business Review Press', 2005, '9781591396192', 'C1-06', 'Bisnis & Manajemen', 4],
            ['The Innovator\'s Dilemma', 'Clayton Christensen', 'Harvard Business Review Press', 1997, '9780875845852', 'C1-07', 'Bisnis & Manajemen', 3],
            ['Outliers', 'Malcolm Gladwell', 'Little, Brown and Company', 2008, '9780316017923', 'C1-08', 'Bisnis & Manajemen', 7],
            ['The E-Myth Revisited', 'Michael Gerber', 'Harper Business', 1995, '9780887307287', 'C1-09', 'Bisnis & Manajemen', 5],
            ['Traction', 'Gino Wickman', 'BenBella Books', 2011, '9781936661831', 'C1-10', 'Bisnis & Manajemen', 4],

            // Teknologi
            ['Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, '9780132350884', 'D1-01', 'Teknologi', 10],
            ['The Pragmatic Programmer', 'Andrew Hunt', 'Addison-Wesley', 1999, '9780201616224', 'D1-02', 'Teknologi', 8],
            ['Design Patterns', 'Gang of Four', 'Addison-Wesley', 1994, '9780201633610', 'D1-03', 'Teknologi', 6],
            ['Introduction to Algorithms', 'Thomas Cormen', 'MIT Press', 2009, '9780262033848', 'D1-04', 'Teknologi', 7],
            ['Code Complete', 'Steve McConnell', 'Microsoft Press', 2004, '9780735619678', 'D1-05', 'Teknologi', 5],
            ['You Don\'t Know JS', 'Kyle Simpson', 'O\'Reilly Media', 2014, '9781491924464', 'D1-06', 'Teknologi', 9],
            ['Eloquent JavaScript', 'Marijn Haverbeke', 'No Starch Press', 2018, '9781593279509', 'D1-07', 'Teknologi', 8],
            ['Python Crash Course', 'Eric Matthes', 'No Starch Press', 2019, '9781593279288', 'D1-08', 'Teknologi', 10],
            ['Head First Java', 'Kathy Sierra', 'O\'Reilly Media', 2005, '9780596009205', 'D1-09', 'Teknologi', 7],
            ['The Art of Computer Programming', 'Donald Knuth', 'Addison-Wesley', 1968, '9780201896831', 'D1-10', 'Teknologi', 3],

            // Sejarah
            ['Sapiens', 'Yuval Noah Harari', 'Harvill Secker', 2011, '9780099590088', 'E1-01', 'Sejarah', 9],
            ['Homo Deus', 'Yuval Noah Harari', 'Harvill Secker', 2015, '9781784703936', 'E1-02', 'Sejarah', 7],
            ['21 Lessons for the 21st Century', 'Yuval Noah Harari', 'Jonathan Cape', 2018, '9781787330672', 'E1-03', 'Sejarah', 6],
            ['Steve Jobs', 'Walter Isaacson', 'Simon & Schuster', 2011, '9781451648539', 'E1-04', 'Sejarah', 8],
            ['Einstein: His Life and Universe', 'Walter Isaacson', 'Simon & Schuster', 2007, '9780743264730', 'E1-05', 'Sejarah', 5],
            ['The Diary of a Young Girl', 'Anne Frank', 'Contact Publishing', 1947, '9780553296983', 'E1-06', 'Sejarah', 6],
            ['Guns, Germs, and Steel', 'Jared Diamond', 'W. W. Norton', 1997, '9780393317558', 'E1-07', 'Sejarah', 4],
            ['A Brief History of Time', 'Stephen Hawking', 'Bantam Books', 1988, '9780553380163', 'E1-08', 'Sejarah', 7],
            ['The Wright Brothers', 'David McCullough', 'Simon & Schuster', 2015, '9781476728742', 'E1-09', 'Sejarah', 5],
            ['Unbroken', 'Laura Hillenbrand', 'Random House', 2010, '9780812974492', 'E1-10', 'Sejarah', 6],

            // Komik & Manga
            ['Naruto Vol. 1', 'Masashi Kishimoto', 'Elex Media', 1999, '9786020285344', 'F1-01', 'Komik & Manga', 10],
            ['One Piece Vol. 1', 'Eiichiro Oda', 'Elex Media', 1997, '9786020285351', 'F1-02', 'Komik & Manga', 12],
            ['Doraemon Vol. 1', 'Fujiko F. Fujio', 'Elex Media', 1970, '9786020285368', 'F1-03', 'Komik & Manga', 15],
            ['Detective Conan Vol. 1', 'Gosho Aoyama', 'Elex Media', 1994, '9786020285375', 'F1-04', 'Komik & Manga', 10],
            ['Dragon Ball Vol. 1', 'Akira Toriyama', 'Elex Media', 1984, '9786020285382', 'F1-05', 'Komik & Manga', 8],
            ['Attack on Titan Vol. 1', 'Hajime Isayama', 'Elex Media', 2009, '9786020285399', 'F1-06', 'Komik & Manga', 9],
            ['Death Note Vol. 1', 'Tsugumi Ohba', 'Elex Media', 2003, '9786020285405', 'F1-07', 'Komik & Manga', 11],
            ['Fullmetal Alchemist Vol. 1', 'Hiromu Arakawa', 'Elex Media', 2001, '9786020285412', 'F1-08', 'Komik & Manga', 7],
            ['Bleach Vol. 1', 'Tite Kubo', 'Elex Media', 2001, '9786020285429', 'F1-09', 'Komik & Manga', 6],
            ['Hunter x Hunter Vol. 1', 'Yoshihiro Togashi', 'Elex Media', 1998, '9786020285436', 'F1-10', 'Komik & Manga', 8],

            // Agama & Spiritual
            ['Al-Quran dan Terjemahan', 'Kementerian Agama RI', 'Sygma', 2010, '9786028397803', 'G1-01', 'Agama & Spiritual', 20],
            ['Tafsir Al-Misbah', 'M. Quraish Shihab', 'Lentera Hati', 2002, '9789795922711', 'G1-02', 'Agama & Spiritual', 5],
            ['Ketika Cinta Berbuah Surga', 'Asma Nadia', 'AsmaNadia Publishing', 2008, '9789791227230', 'G1-03', 'Agama & Spiritual', 8],
            ['Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 'Republika', 2004, '9789791102063', 'G1-04', 'Agama & Spiritual', 10],
            ['Bidadari-Bidadari Surga', 'Tere Liye', 'Republika', 2008, '9789791102070', 'G1-05', 'Agama & Spiritual', 7],

            // Sains & Matematika
            ['The Universe in a Nutshell', 'Stephen Hawking', 'Bantam Books', 2001, '9780553802023', 'H1-01', 'Sains & Matematika', 6],
            ['The Selfish Gene', 'Richard Dawkins', 'Oxford University Press', 1976, '9780199291151', 'H1-02', 'Sains & Matematika', 5],
            ['Cosmos', 'Carl Sagan', 'Random House', 1980, '9780345539434', 'H1-03', 'Sains & Matematika', 4],
            ['The Origin of Species', 'Charles Darwin', 'John Murray', 1859, '9780451529060', 'H1-04', 'Sains & Matematika', 3],
            ['The Double Helix', 'James Watson', 'Atheneum', 1968, '9780743216302', 'H1-05', 'Sains & Matematika', 4],

            // Seni & Budaya
            ['The Story of Art', 'E.H. Gombrich', 'Phaidon Press', 1950, '9780714832470', 'I1-01', 'Seni & Budaya', 5],
            ['Ways of Seeing', 'John Berger', 'Penguin Books', 1972, '9780140135152', 'I1-02', 'Seni & Budaya', 4],
            ['The Art Spirit', 'Robert Henri', 'Basic Books', 1923, '9780465002634', 'I1-03', 'Seni & Budaya', 3],

            // Pendidikan
            ['Pedagogy of the Oppressed', 'Paulo Freire', 'Continuum', 1970, '9780826412768', 'J1-01', 'Pendidikan', 6],
            ['How Children Learn', 'John Holt', 'Da Capo Press', 1967, '9780201484045', 'J1-02', 'Pendidikan', 5],
            ['The Courage to Teach', 'Parker Palmer', 'Jossey-Bass', 1998, '9780787971717', 'J1-03', 'Pendidikan', 4],
        ];

        foreach ($books as [$title, $author, $publisher, $year, $isbn, $shelf, $category, $stock]) {
            $bookIds[] = DB::table('books')->insertGetId([
                'title' => $title,
                'author' => $author,
                'publisher' => $publisher,
                'publication_year' => $year,
                'isbn' => $isbn,
                'category_id' => $catIds[$category],
                'shelf_location' => $shelf,
                'description' => 'Buku ' . $category . ' karya ' . $author,
                'stock' => $stock,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 5. Create Loans (30+ active, 50+ returned)
        // Active loans - distributed across petugas
        for ($i = 0; $i < 35; $i++) {
            $loanDate = Carbon::now()->subDays(rand(1, 20));
            $dueDate = (clone $loanDate)->addDays(7);

            DB::table('loans')->insert([
                'member_id' => $memberIds[array_rand($memberIds)],
                'petugas_id' => $userIds[array_rand($userIds)],
                'book_id' => $bookIds[array_rand($bookIds)],
                'loan_date' => $loanDate,
                'due_date' => $dueDate,
                'return_date' => null,
                'status' => 'active',
                'fine_amount' => 0,
                'created_at' => $loanDate,
                'updated_at' => $loanDate,
            ]);
        }

        // Returned loans - historical data
        for ($i = 0; $i < 50; $i++) {
            $loanDate = Carbon::now()->subDays(rand(30, 90));
            $dueDate = (clone $loanDate)->addDays(7);
            $returnDate = (clone $loanDate)->addDays(rand(3, 10));

            // Calculate fine if late
            $fine = 0;
            if ($returnDate->gt($dueDate)) {
                $daysLate = $dueDate->diffInDays($returnDate);
                $fine = $daysLate * 2000;
            }

            DB::table('loans')->insert([
                'member_id' => $memberIds[array_rand($memberIds)],
                'petugas_id' => $userIds[array_rand($userIds)],
                'book_id' => $bookIds[array_rand($bookIds)],
                'loan_date' => $loanDate,
                'due_date' => $dueDate,
                'return_date' => $returnDate,
                'status' => 'returned',
                'fine_amount' => $fine,
                'created_at' => $loanDate,
                'updated_at' => $returnDate,
            ]);
        }

        // Overdue loans - specific
        for ($i = 0; $i < 8; $i++) {
            $loanDate = Carbon::now()->subDays(rand(15, 30));
            $dueDate = (clone $loanDate)->addDays(7);

            DB::table('loans')->insert([
                'member_id' => $memberIds[array_rand($memberIds)],
                'petugas_id' => $userIds[array_rand($userIds)],
                'book_id' => $bookIds[array_rand($bookIds)],
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

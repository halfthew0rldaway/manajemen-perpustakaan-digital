<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Perpustakaan',
                'email' => 'admin@perpustakaan.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Petugas 1',
                'email' => 'petugas1@perpustakaan.test',
                'password' => bcrypt('password'),
                'role' => 'petugas',
            ],
            [
                'name' => 'Petugas 2',
                'email' => 'petugas2@perpustakaan.test',
                'password' => bcrypt('password'),
                'role' => 'petugas',
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}

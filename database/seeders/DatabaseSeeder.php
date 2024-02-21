<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User :: create([
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345'),
            'nama_lengkap' => 'admin_satu',
            'role' => 'administrator',
            'verifikasi' => 'sudah',
        ]);
        
    }




}
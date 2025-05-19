<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_logins')->insert([
            'username' => 'Admin User',
            'useremail' => 'admin@gmail.com',
            'password' => Hash::make('cL9fP!Zk32#rGxNqAvMTyE6@hBd7WoU'),
            'profile' => '',
            'is_admin' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

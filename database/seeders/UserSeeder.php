<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => str()->uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'pastibisa',
            'email' => 'admin@admin.com',
            'phone' => '08123456789',
        ]);
    }
}

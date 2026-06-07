<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ritm.ru'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]
        );
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'fullname' => 'Admin Raja',
                'password' => bcrypt('admin123'),
                'phone' => '081234567890',
                'role' => 'admin',
                'admin_id' => 'ADMIN-001',
            ]
        );
    }
}

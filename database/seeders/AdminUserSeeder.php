<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@holychildparish.com',
            'password' => Hash::make('password123'), // Change password later
            'is_admin' => true,
        ]);

        $this->command->info('✅ Admin user created: admin@holychildparish.com / password123');
    }
}

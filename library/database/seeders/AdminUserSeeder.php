<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin1234'), // ganti password sesuai kebutuhan
                'role' => 'admin',
            ]
        );

        Profile::firstOrCreate(
            ['user_id' => $admin->id],
            ['age' => 25, 'address' => 'Jakarta']
        );
    }
}

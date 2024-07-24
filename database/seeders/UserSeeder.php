<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@gmail.com'),
                'telegram' => '@admin',
                'phone_number' => '1234567890',
                'address' => 'Admin Address',
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('manager@gmail.com'),
                'telegram' => '@manager',
                'phone_number' => '0987654321',
                'address' => 'Manager Address',
                'role' => 'manager',
                'status' => 'active',
            ],
            [
                'name' => 'Staff User',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('staff@gmail.com'),
                'telegram' => '@staff',
                'phone_number' => '1122334455',
                'address' => 'Staff Address',
                'role' => 'staff',
                'status' => 'active',
            ],
        ]);
    }

}


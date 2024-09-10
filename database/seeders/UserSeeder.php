<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $customer = Role::where('name', 'customer')->first();
        $user = [[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => $admin->id,
            'alamat' => ''
        ],
        [
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('customer'),
            'role_id' => $customer->id,
            'alamat' => ''
        ]
        ];
        foreach ($user as $value) {
            User::create($value);
        }
    }
}

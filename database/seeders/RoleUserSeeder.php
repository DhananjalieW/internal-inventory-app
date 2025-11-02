<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name'=>'Admin', 'email'=>'admin@example.com',   'role'=>'Admin'],
            ['name'=>'Manager','email'=>'manager@example.com','role'=>'Inventory Manager'],
            ['name'=>'Clerk',  'email'=>'clerk@example.com',  'role'=>'Clerk'],
            ['name'=>'Viewer', 'email'=>'viewer@example.com', 'role'=>'Viewer'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => Hash::make('password'), 'role' => $u['role']]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'uuid' => (string) Str::uuid(),
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt(ENV('ADMIN_PASSWORD')),
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => env('ADMIN_INIT_EMAIL'),
                'last_name' => 'admin',
                'first_name' => 'admin',
                'patronymic' => 'admin',
                'password' => Hash::make(env('ADMIN_INIT_PASS')),
                'role' => User::ROLE_ADMIN,
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}

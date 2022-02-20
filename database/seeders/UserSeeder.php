<?php

namespace Database\Seeders;

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
                'email' => 'admin@admin.com',
                'last_name' => 'admin',
                'first_name' => 'admin',
                'patronymic' => 'admin',
                'password' => Hash::make('123456'),
                'role_id' => 'Администратор',
                'created_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}

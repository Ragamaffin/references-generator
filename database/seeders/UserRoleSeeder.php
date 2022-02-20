<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            ['role_id' => 'Администратор', 'created_at' => date("Y-m-d H:i:s")],
            ['role_id' => 'Пользователь', 'created_at' => date("Y-m-d H:i:s")]
        ]);
    }
}

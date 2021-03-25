<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role'=> 2
        ]);
        DB::table('users')->insert([
            'name' => 'Operator',
            'email' => 'operator@operator.com',
            'password' => bcrypt('operator123'),
            'role'=> 3
        ]);
        DB::table('users')->insert([
            'name' => 'Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('manager123'),
            'role'=> 4
        ]);
    }
}

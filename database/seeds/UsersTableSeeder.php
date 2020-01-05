<?php

use Illuminate\Database\Seeder;

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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'description' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'description' => 'user'
        ]);
    }
}

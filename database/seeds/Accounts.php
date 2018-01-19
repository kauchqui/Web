<?php

use Illuminate\Database\Seeder;

class Accounts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // this is super dirty db populater for Units
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Admin', //randomly assign to building 1 or 2, can modify for testing
            'email' => 'admin@example.com',
            'user_profile' => 'php5676_e3jf2x',
            'password' => bcrypt('12345678'),
            'permissions' => '1',
            'personalunit' => '0',
            'personalproperty' => '0',
            'remember_token' => '',
            'created_at' => '2017-12-02 00:03:11',
            'updated_at' => '2017-12-02 00:03:11',
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'name' => 'User', //randomly assign to building 1 or 2, can modify for testing
            'email' => 'user@example.com',
            'user_profile' => 'php5676_e3jf2x',
            'password' => bcrypt('12345678'),
            'permissions' => '2',
            'personalunit' => '0',
            'personalproperty' => '0',
            'remember_token' => '',
            'created_at' => '2017-12-02 00:03:11',
            'updated_at' => '2017-12-02 00:03:11',
        ]);
        DB::table('users')->insert([
            'id' => '3',
            'name' => 'Staff', //randomly assign to building 1 or 2, can modify for testing
            'email' => 'staff@example.com',
            'user_profile' => 'php5676_e3jf2x',
            'password' => bcrypt('12345678'),
            'permissions' => '3',
            'personalunit' => '0',
            'personalproperty' => '0',
            'remember_token' => '',
            'created_at' => '2017-12-02 00:03:11',
            'updated_at' => '2017-12-02 00:03:11',
        ]);
    }
}

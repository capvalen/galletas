<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Carlos',
            'lastname'=> 'Pariona',
            'username'=> 'infocat',
            'email'=> 'infocat2.0@gmail.com',
            'password'=> bcrypt('00'),
        ]);
        DB::table('users')->insert([
            'name' => 'Stefano',
            'lastname'=> '',
            'username'=> 'stefano',
            'email'=> 'stefano@gmail.com',
            'password'=> bcrypt(''),
        ]);
        DB::table('users')->insert([
            'name' => 'Bruni',
            'lastname'=> '',
            'username'=> 'bruni',
            'email'=> 'bruni@gmail.com',
            'password'=> bcrypt(''),
        ]);
        DB::table('users')->insert([
            'name' => 'Victor',
            'lastname'=> '',
            'username'=> 'victor',
            'email'=> 'Victor@gmail.com',
            'password'=> bcrypt(''),
        ]);
        DB::table('users')->insert([
            'name' => 'Ricardo',
            'lastname'=> '',
            'username'=> 'ricardo',
            'email'=> 'Ricardo@gmail.com',
            'password'=> bcrypt(''),
        ]);
    }
}

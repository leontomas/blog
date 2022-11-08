<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        // masteradmin
        DB::table('users')->insert([
            'username'=>'masteradmin',
            'password'=> Hash::make('123456'),
            'first_name'=>'Adam',
            'last_name'=>'Warlock',
            'email'=>'masteradmin@mail.com',
            'role'=>'administrator',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        // author
        DB::table('users')->insert([
            'username'=>'pcoelho',
            'password'=> Hash::make('123456'),
            'first_name'=>'Paolo',
            'last_name'=>'Coelho',
            'email'=>'pcoelho@mail.com',
            'role'=>'author',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
        // author
        DB::table('users')->insert([
            'username'=>'malbom',
            'password'=> Hash::make('123456'),
            'first_name'=>'Mitch',
            'last_name'=>'Albom',
            'email'=>'malbom@mail.com',
            'role'=>'author',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()
        ]);
    }
}

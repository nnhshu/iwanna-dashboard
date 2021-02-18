<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Iwanna Tech',
            'username' => 'admin',
            'password' => Hash::make('iwanna2020@')
        ]);
    }
}

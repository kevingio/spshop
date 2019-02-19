<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Robert Downey Jr',
            'email' => 'tony@stark.com',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Chris Evans',
            'email' => 'captain@america.com',
            'password' => bcrypt('secret'),
        ]);
    }
}

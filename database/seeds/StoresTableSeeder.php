<?php

use Illuminate\Database\Seeder;
use App\Models\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name' => 'Tokoku',
            'user_id' => 1
        ]);

        Store::create([
            'name' => 'ChocoAppel',
            'user_id' => 2
        ]);
    }
}

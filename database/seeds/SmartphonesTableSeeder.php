<?php

use Illuminate\Database\Seeder;
use App\Models\Smartphone;

class SmartphonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Smartphone::class, 120)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Samsung',
            'logo' => 'https://cdn.samsung.com/etc/designs/smg/global/imgs/logo-square-letter.png'
        ]);

        Brand::create([
            'name' => 'Apple',
            'logo' => 'data:image/png;base64,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'
        ]);

        Brand::create([
            'name' => 'Xiaomi',
            'logo' => 'http://pluspng.com/img-png/xiaomi-vector-png-mi-logo-2090.png'
        ]);

        Brand::create([
            'name' => 'Oppo',
            'logo' => 'https://pbs.twimg.com/profile_images/519050185859538945/YhFtsJjx.jpeg'
        ]);

        Brand::create([
            'name' => 'LG',
            'logo' => 'https://png2.kisspng.com/20171216/330/5a3555e28b15c5.1941689115134448345697.png'
        ]);

        Brand::create([
            'name' => 'Vivo',
            'logo' => 'http://pic3.16pic.com/00/01/45/16pic_145196_b.jpg'
        ]);

    }
}

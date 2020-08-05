<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Cordoba";
        $province = new App\Models\Province;
        $province->name = $name;
        $province->slug = Str::slug($name);
        $province->code = "1234546,4564684";
        $province->country_id = 1;
        $province->save();

        $name = "Buenos Aires";
        $province = new App\Models\Province;
        $province->name = $name;
        $province->slug = Str::slug($name);
        $province->code = "1234546,4564684";
        $province->country_id = 1;
        $province->save();
    }
}

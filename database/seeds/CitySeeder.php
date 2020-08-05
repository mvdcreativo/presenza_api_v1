<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Cordoba Capital";
        $city = new App\Models\City;
        $city->name = $name;
        $city->slug = Str::slug($name);
        $city->code = "15648,12648";
        $city->province_id = 1;
        $city->save();

        $name = "Buenos Aires";
        $city = new App\Models\City;
        $city->name = $name;
        $city->slug = Str::slug($name);
        $city->code = "15648,12648";
        $city->province_id = 2;
        $city->save();

    }
}

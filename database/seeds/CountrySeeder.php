<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Argentina";
        $country = new App\Models\Country;
        $country->name = $name;
        $country->slug = Str::slug($name);
        $country->code = "ARG";
        $country->save();
    }
}

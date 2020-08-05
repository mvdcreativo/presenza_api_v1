<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Municipalidad de cordoba prueba";
        $municipality = new App\Models\Municipality;
        $municipality->name = $name;
        $municipality->slug = Str::slug($name);
        $municipality->code = "1234546,4564684";
        $municipality->city_id = 1;
        $municipality->save();

        $name = "Municipalidad de BSAS prueba";
        $municipality = new App\Models\Municipality;
        $municipality->name = $name;
        $municipality->slug = Str::slug($name);
        $municipality->code = "1234546,4564684";
        $municipality->city_id = 2;
        $municipality->save();
    }
}

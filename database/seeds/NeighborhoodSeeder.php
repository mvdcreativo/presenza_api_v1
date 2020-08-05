<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Barrio de prueba cordoba";
        $neighborhood = new App\Models\Neighborhood;
        $neighborhood->name = $name;
        $neighborhood->slug = Str::slug($name);
        $neighborhood->code = "1234546,4564684";
        $neighborhood->municipality_id = 1;
        $neighborhood->save();

        $name = "Barrio de prueba BsAs";
        $neighborhood = new App\Models\Neighborhood;
        $neighborhood->name = $name;
        $neighborhood->slug = Str::slug($name);
        $neighborhood->code = "1234546,4564684";
        $neighborhood->municipality_id = 2;
        $neighborhood->save();
    }
}

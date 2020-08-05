<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Casa";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Apartamento";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Duplex";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Terreno";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Local Comercial";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();
    }
}

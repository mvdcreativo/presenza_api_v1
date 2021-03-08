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

        $name = "Departamento";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Duplex/Triplex";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();
        
        $name = "Chalet";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Chalet en PH";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();
        
        $name = "Cabaña";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Casa Quinta";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Hotel";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Local";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Local con Vivienda";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Depósito/Galpón";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Cochera";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Terreno/Lote";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Chacra";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Hectáreas";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();
        
        $name = "Local con Vivienda";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "En Block";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();

        $name = "Fondo de Comercio";
        $property_type = new App\Models\Property_type;
        $property_type->name = $name;
        $property_type->slug = Str::slug($name);
        $property_type->description = "";
        $property_type->status_id = 1;
        $property_type->save();      
    }
}

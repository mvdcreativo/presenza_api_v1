<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $name = "Comodidades";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = null;
        $feature->type = "MULTI";
        $feature->save();
        //2
        $name = "Información Edilicia";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = null;
        $feature->type = "MULTI";
        $feature->save();
        //3
        $name = "Mobiliario";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = null;
        $feature->type = "MULTI";
        $feature->save();

        $name = "Ambientes";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Dormitorios";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Dormitorios en Suite";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Baños";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Toilettes";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Cocina";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Kitchenette";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Patio";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();
        
        $name = "Jardín";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Parrillero";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();


        $name = "Barbacoa";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Cochera / Parking";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Área Total m2";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VAL";
        $feature->save();

        $name = "Área Edificada m2";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VAL";
        $feature->save();

        $name = "Estado de la Propiedad";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VAL";
        $feature->save();

        $name = "Aire Acondicionado";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Totalmente Equipado";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Horno Empotrado";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Anafe";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Placares en Dormitorios";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

    }
}

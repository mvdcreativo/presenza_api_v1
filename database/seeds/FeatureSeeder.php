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
        $feature->type = "GRP";
        $feature->save();
        //2
        $name = "Información Edilicia";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = null;
        $feature->type = "GRP";
        $feature->save();
        //3
        $name = "Mobiliario";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = null;
        $feature->type = "GRP";
        $feature->save();

        //4
        $name = "Datos Básicos";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = null;
        $feature->type = "GRP";
        $feature->save();

        //5
        $name = "Dormitorios";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Dormitorios en Suitte";
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

        $name = "Vestidor";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Living";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Cocina";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Comedor";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Hogar";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Fogón";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Lavadero";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Ascensor";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Balcón";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Terraza";
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

        $name = "Parrilla";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Quincho";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Piscina";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "OPC";
        $feature->save();

        $name = "Espacio para Auto (cap. vehículos)";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Cochera Cubierta (cap. vehículos)";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Estacionamiento (cap. vehículos)";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        $name = "Garage (cap. vehículos)";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 1;
        $feature->type = "VAL";
        $feature->save();

        /////////////////////////////////

        $name = "Estatus";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VALSTR";
        $feature->save();

        $name = "Orientación";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "ORIENT";
        $feature->save();

        $name = "Antiguedad (años)";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VALANO";
        $feature->save();

        $name = "Situación Habitacional";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "SITHAB";
        $feature->save();

        $name = "Dispocisión";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "DISPOS";
        $feature->save();

        $name = "Piso";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VAL";
        $feature->save();

        $name = "UF. Unidad Funcional";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "VAL";
        $feature->save();

        $name = "Amoblado";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 2;
        $feature->type = "OPC";
        $feature->save();

        ///////////////////////////
        $name = "Aire Acondicionado";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Placard";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Calefacción";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Caldera";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Rejas";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Postigones";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Alarma";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Riego";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Portón Eléctrico";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Persianas";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        $name = "Camaras de Seguridad";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 3;
        $feature->type = "OPC";
        $feature->save();

        //////////////////////////

        $name = "Acepta Permuta";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 4;
        $feature->type = "OPC";
        $feature->save();

        $name = "Acepta Pesos";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 4;
        $feature->type = "OPC";
        $feature->save();

        $name = "Valor Expensas";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 4;
        $feature->type = "VAL";
        $feature->save();

        $name = "Apto Crédito";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 4;
        $feature->type = "OPC";
        $feature->save();

        $name = "Total m2";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 4;
        $feature->type = "VAL100";
        $feature->save();

        $name = "Sup. Edificada m2";
        $feature = new App\Models\Feature;
        $feature->name = $name;
        $feature->slug = Str::slug($name);
        $feature->feature_id = 4;
        $feature->type = "VAL100";
        $feature->save();


    }
}

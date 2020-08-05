<?php

use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = new App\Models\Tax;
        $tax->name = "Impuesto al Valor Agregado";
        $tax->value = "22";
        $tax->abbr = "I.V.A.";
        $tax->save();
    }
}

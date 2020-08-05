<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $currency = new App\Models\Currency;
        // $currency->name = "Dolares Americanos";
        // $currency->symbol = "USD";
        // $currency->value = 1;
        // $currency->status = "PRE";
        // $currency->save();

        $currency = new App\Models\Currency;
        $currency->name = "Pesos Argentinos";
        $currency->symbol = "ARG";
        $currency->value = 0.0125;
        $currency->status = "";
        $currency->save();
    }
}

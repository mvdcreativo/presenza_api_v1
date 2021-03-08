<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Venta";
        $transaction_type = new App\Models\Transaction_type;
        $transaction_type->name = $name;
        $transaction_type->slug = Str::slug($name);
        $transaction_type->save();

        $name = "Alquiler Anual";
        $transaction_type = new App\Models\Transaction_type;
        $transaction_type->name = $name;
        $transaction_type->slug = Str::slug($name);
        $transaction_type->save();

        $name = "Alquiler Temporal";
        $transaction_type = new App\Models\Transaction_type;
        $transaction_type->name = $name;
        $transaction_type->slug = Str::slug($name);
        $transaction_type->save();

    }
}

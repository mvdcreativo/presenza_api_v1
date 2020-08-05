<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(ProvinceSeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(MunicipalitySeeder::class);
        // $this->call(NeighborhoodSeeder::class);
        // $this->call(ExpenseSeeder::class);
        // $this->call(FeatureSeeder::class);
        // $this->call(StatusSeeder::class);
        // $this->call(TaxSeeder::class);
        $this->call(CurrencySeeder::class);
        // $this->call(TransactionTypeSeeder::class);
        // $this->call(PropertyTypeSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        factory(App\Models\Publication::class, 100)->create()
        ->each(
            function(App\Models\Publication $publication ) use ($faker){
                
                $transactions_types = $faker->randomElement([   
                    [
                        ["transaction_type_id" => 1, "price"=> rand(6000,250000), "currency_id"=> 1],
                        ["transaction_type_id" => 2, "price"=> rand(6000,60000), "currency_id"=> 2]
                    ],
                    [
                        ["transaction_type_id" => 1, "price"=> rand(6000,250000), "currency_id"=> 1],
                        ["transaction_type_id" => 3, "price"=> rand(30,500), "currency_id"=> 1]
                    ],
                    [
                        ["transaction_type_id" => 2, "price"=> rand(6000,60000), "currency_id"=> 2],
                        ["transaction_type_id" => 3, "price"=> rand(30,500), "currency_id"=> 1]
                    ],
                    [["transaction_type_id" => 1, "price"=> rand(6000,250000), "currency_id"=> 1]], 
                    [["transaction_type_id" => 2, "price"=> rand(6000,60000), "currency_id"=> 2]], 
                    [["transaction_type_id" => 3, "price"=> rand(30,500), "currency_id"=> 1]]
                    
                ]);


                $publication->transaction_types()->attach($transactions_types);
            }
        );
    }
}

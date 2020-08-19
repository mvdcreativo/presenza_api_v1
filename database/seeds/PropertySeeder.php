<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        factory(App\Models\Property::class, 100)->create()
        ->each(
            function(App\Models\Property $property )use ($faker){
                $property->images()->attach(
                    [
                        rand(1,10),
                        rand(11,20),
                        rand(21,30),
                        rand(31,40),
                        rand(41,50),
                        rand(51,60),
                        rand(61,70),
                        rand(71,80),
                    ]
                );

                $features = [
                    ["feature_id"=> 4, "value"=> rand(1,6)],
                    ["feature_id"=> 5, "value"=> rand(1,4)],
                    $faker->randomElement([null, ["feature_id"=> 6, "value"=> rand(1,4) ]]),
                    ["feature_id"=> 7, "value"=> rand(1,4)],
                    
                    $faker->randomElement([null, ["feature_id"=> 8, "value"=> rand(1,2) ]]),
                    $faker->randomElement([null, ["feature_id"=> rand(9,10), "value"=>null ]]),
                    $faker->randomElement([null, ["feature_id"=> rand(11,12), "value"=>null ]]),
                    $faker->randomElement([null, ["feature_id"=> rand(13,14), "value"=>null ]]),
                    $faker->randomElement([null, ["feature_id"=> rand(19,21), "value"=>null ]]),
                    $faker->randomElement([null, ["feature_id"=> rand(22,23), "value"=>null ]]),

                    ["feature_id"=> 16, "value"=> rand(80,1000)],
                    ["feature_id"=> 17, "value"=> rand(30,300)],
                    ["feature_id"=> 18, "value"=> $faker->randomElement(["A Estrenar", "Excelente","Muy Bueno","Regular","Para Reciclar","Para Demoler","Con Mejoras"])]
                ];

                $features = array_filter($features, function($item){
                    return $item !== null;
                }); 

                $property->features()->attach($features);
            }
        );
        
    
    // "features": [{"feature_id": 4, "value":1},{"feature_id": 5, "value":3},{"feature_id": 6, "value":1},{"feature_id": 7, "value":2},{"feature_id": 8, "value":1},{"feature_id": 9},{"feature_id": 10},{"feature_id": 11},{"feature_id": 16, "value":80},{"feature_id": 17, "value":430},{"feature_id": 18, "value":2}],
    }
}

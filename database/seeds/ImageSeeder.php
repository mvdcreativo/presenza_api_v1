<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json= File::get('database/data/images.json');
        $data= json_decode($json);

        foreach ($data->hits as $campo) {
            $image = new App\Models\Image;
           
            $image->url = $campo->largeImageURL;

            $image->save();
        }

    }
}

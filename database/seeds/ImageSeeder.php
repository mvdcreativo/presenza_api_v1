<?php

use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image as AlterImage;


class ImageSeeder extends Seeder
{


    private function transformImage($image, $width, $height, $path)
    {
        $result_image = AlterImage::make($image)->encode('jpg',75);
        $result_image->resize($width, $height, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        } );
        // $larg_image->crop(1280,800);
        $store = Storage::disk('public')->put( $path, $result_image->stream());
        return $store;
        
    }



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
            // $image = new App\Models\Image;
           
            // $image->url = $campo->src->original;

            // $image->save();

            $url = 'images/properties/';
            $imageNewName = rand(1,10).'-'.time().'.jpg';

            $path_larg = $url.'larg/'.$imageNewName;
            $path_medium = $url.'medium/'.$imageNewName;
            $path_small = $url.'small/'.$imageNewName;

            $larg_img = $this->transformImage($campo->largeImageURL, 1280, 900, $path_larg);
            $medium_img = $this->transformImage($campo->largeImageURL, 600, 400, $path_medium);
            $small_img = $this->transformImage($campo->largeImageURL, 150, 100, $path_small);

            // return [$larg_img , $medium_img , $small_img] ;
            if ($larg_img && $medium_img && $small_img) {
                $image = new App\Models\Image;
                $image->fill(
                    [
                        'url' => asset('storage/'.$path_larg),
                        'url_small' => asset('storage/'.$path_small),
                        'url_medium' => asset('storage/'.$path_medium)
                    ])->save();
                // $image->properties()->sync($property->id);
            }else{
                return "error al subir imagenes";
            }

        }

    }
}

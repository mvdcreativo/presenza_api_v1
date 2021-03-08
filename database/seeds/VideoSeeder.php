<?php

use Illuminate\Database\Seeder;
use Intervention\Video\Facades\Video as AlterVideo;


class VideoSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json= File::get('database/data/videos.json');
        $data= json_decode($json);

        foreach ($data->hits as $campo) {
            // $video = new App\Models\Video;
           
            // $video->url = $campo->src->original;

            // $video->save();

            $url = 'videos/properties/';
            $videoNewName = rand(1,10).'-'.time().'.jpg';

            $path_larg = $url.'larg/'.$videoNewName;
            $path_medium = $url.'medium/'.$videoNewName;
            $path_small = $url.'small/'.$videoNewName;

            $larg_img = $this->transformVideo($campo->largeVideoURL, 1280, 900, $path_larg);
            $medium_img = $this->transformVideo($campo->largeVideoURL, 600, 400, $path_medium);
            $small_img = $this->transformVideo($campo->largeVideoURL, 150, 100, $path_small);

            // return [$larg_img , $medium_img , $small_img] ;
            if ($larg_img && $medium_img && $small_img) {
                $video = new App\Models\Video;
                $video->fill(
                    [
                        'url' => asset('storage/'.$path_larg),
                        'url_small' => asset('storage/'.$path_small),
                        'url_medium' => asset('storage/'.$path_medium)
                    ])->save();
                // $video->properties()->sync($property->id);
            }else{
                return "error al subir videones";
            }

        }

    }
}

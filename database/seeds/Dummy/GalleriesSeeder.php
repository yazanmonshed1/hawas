<?php

use App\Models\Gallery;
use App\NadConsole\Models\Media;
use Illuminate\Database\Seeder;

class GalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galleries')->delete();
        $gallery = new Gallery();
        $gallery->save();
        $images = ['dummy/slider-img1.png', 'dummy/slider-img2.png', 'dummy/slider-img3.png', 'dummy/slider-img4.png', 'dummy/slider-img5.png', 'dummy/slider-img6.png'];
        $images_ids = [];
        foreach ($images as $image) {
            $media = Media::firstOrNew(['path' => $image]);
            if (!$media->exists) {
                $media->fill(['path' => $image])->save();
            }
            $images_ids[] = $media->id;
        }
        $gallery->media()->attach($images_ids);
    }
}

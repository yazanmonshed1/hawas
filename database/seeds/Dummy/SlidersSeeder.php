<?php

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->delete();
        for ($i = 0; $i < 3; $i ++) {
            $slider = new Slider();
            $slider->fill([
                'title' => 'مؤسسة تربوية + حواس= قمم تربوية عالية',
                'description' => 'معا ننهض بمؤسستكم نحو قمم المهارات, الصحية والحياتية المجتمعية اكثر من عقد من الزمان ومؤسستنا تساهم بدمج برامج ابداعية وتفاعليه للمؤسسات التربوية وجميعها من خارج الصندوق',
                'image' => 'dummy/slider.png'
            ])->save();
        }
    }
}

<?php

use App\Models\Collapse;
use App\NadConsole\Models\Media;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollapsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collapses')->delete();

        $data = [
            [
                'title' => 'الاغاني والاناشيد في الحذر على الطرق جزء من وسائل تدريسية متعددة',
                'description' => 'اسرة الفية الحواس اسرة متكاتفة من شتى الشرائح المهنية والتخصصات من ممرضات وممرضين, أخصائيين في علم النفس والمجتمع إضافة الى كوادر كبيرة من المرشدين والمرشدات',
            ],
            [
                'title' => 'الرسومات والاسئلة التحليلية جزء من وسائل تدريسية متعددة',
                'description' => 'اسرة الفية الحواس اسرة متكاتفة من شتى الشرائح المهنية والتخصصات من ممرضات وممرضين, أخصائيين في علم النفس والمجتمع إضافة الى كوادر كبيرة من المرشدين والمرشدات',
            ],
            [
                'title' => 'فريقنا (طواقم مهنية)',
                'description' => 'اسرة الفية الحواس اسرة متكاتفة من شتى الشرائح المهنية والتخصصات من ممرضات وممرضين, أخصائيين في علم النفس والمجتمع إضافة الى كوادر كبيرة من المرشدين والمرشدات',
            ]
        ];

        $images = ['dummy/about_collapse1.png', 'dummy/about_collapse2.png', 'dummy/about_collapse3.png'];
        $images_ids = [];
        foreach ($images as $image) {
            $media = Media::firstOrNew(['path' => $image]);
            if (!$media->exists) {
                $media->fill(['path' => $image])->save();
            }
            $images_ids[] = $media->id;
        }

        foreach ($data as $dataItem) {
            $collapse = new Collapse();
            $collapse->fill($dataItem)->save();
            $collapse->media()->attach($images_ids);
        }
    }
}

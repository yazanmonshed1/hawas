<?php

use App\NadConsole\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        $settings = [
            [
                'name' => 'site.about_us_text_home_page',
                'value' => 'مؤسسة تربوية تعمل على ترسيخ القيم الصحية الامنة بمجتمعنا العربي حسب حاجات ومفاهيم تربوية تلائم شتى
            الشرائح المجتمعية. ترافق مؤسستنا العشرات من المؤسسات التربوية منها مدارس ابتدائية, اعدادية او
            وثانوية بالعديد من البرامج التربوية الصحية المختلفة كالكتب المنهجية او اللا منهجية وأخرى في المسرح
            والأفلام الدرامية التربوية وكل ذلك إضافة الى الورشات والفعاليات التربوية المتعددة والغنية .'
            ],
            [
                'name' => 'site.about_us_image_home_page',
                'value' => 'dummy/about_image.png'
            ],
            [
                'name' => 'site.hawas_library_text_home_page',
                'value' => 'مؤسسة تربوية تعمل على ترسيخ القيم الصحية الامنة بمجتمعنا العربي حسب حاجات ومفاهيم تربوية تلائم شتى الشرائح المجتمعية.'
            ],
            [
                'name' => 'admin.success_contact_text',
                'value' => 'تم ارسال الرسالة بنجاح'
            ],
            [
                'name' => 'site.about_us_page_image',
                'value' => 'dummy/about_us_page.png'
            ],
            [
                'name' => 'site.about_us_page_description',
                'value' => 'مؤسسة تربوية تعمل على ترسيخ القيم الصحية الامنة بمجتمعنا العربي حسب حاجات ومفاهيم تربوية تلائم شتى الشرائح المجتمعية. ترافق مؤسستنا العشرات من المؤسسات التربوية منها مدارس ابتدائية, اعدادية او وثانوية بالعديد من البرامج التربوية الصحية المختلفة كالكتب المنهجية او اللا منهجية وأخرى في المسرح والأفلام الدرامية التربوية وكل ذلك إضافة الى الورشات والفعاليات التربوية المتعددة والغنية. اسرة الفية الحواس اسرة متكاتفة من شتى الشرائح المهنية والتخصصات من ممرضات وممرضين, أخصائيين في علم النفس والمجتمع إضافة الى كوادر كبيرة من المرشدين والمرشدات. سنة من الخبرة المهنية المميزة والمتميزة بموضوع صحة وسلامة الجمهور والوقاية من الحوادث والاصابات بتطوير شتى الوسائل والأساليب.'
            ],
            [
                'name' => 'site.our_vision_about_us_page',
                'value' => 'نجحت مؤسسة حواس من خلال الأخصائيين المهنيين بأن تنتج مجموعة كبيرة من الافلام الكرتونية، وإضافة إلى ذلك تلحين وغناء مجموعة من الأشعار التربوية والتعليمية في قضايا المجتمع, جميعها للأطفال سهلة المضامين وقريبة إلى واقع الطف,'
            ],
            [
                'name' => 'site.our_mission_about_us_page',
                'value' => 'نجحت مؤسسة حواس من خلال الأخصائيين المهنيين بأن تنتج مجموعة كبيرة من الافلام الكرتونية، وإضافة إلى ذلك تلحين وغناء مجموعة من الأشعار التربوية والتعليمية في قضايا المجتمع, جميعها للأطفال سهلة المضامين وقريبة إلى واقع الطف,'
            ],
            [
                'name' => 'site.about_us_gallery',
                'value' => "[]"
            ],
            [
                'name' => 'social.facebook_url',
                'value' => 'https://www.facebook.com/'
            ],
            [
                'name' => 'social.instagram_url',
                'value' => 'https://www.instagram.com/'
            ],
            [
                'name' => 'social.youtube_url',
                'value' => 'https://www.youtube.com/'
            ],
            [
                'name' => 'social.youtube_channel_id',
                'value' => 'UC8P5WSWhqDXhphpI7bEZg2A'
            ],
            [
                'name' => 'social.phone1',
                'value' => '046317082'
            ],
            [
                'name' => 'social.phone2',
                'value' => '046317082'
            ],
            [
                'name' => 'social.email',
                'value' => 'milhealth@hotmail.com'
            ],
            [
                'name' => 'site.programs_description',
                'value' => 'مؤسسة تربوية تعمل على ترسيخ القيم الصحية الامنة بمجتمعنا العربي حسب حاجات ومفاهيم تربوية تلائم شتى الشرائح المجتمعية. ترافق مؤسستنا العشرات من المؤسسات التربوية منها مدارس ابتدائية, اعدادية او وثانوية بالعديد من البرامج التربوية الصحية المختلفة'
            ],
            [
                'name' => 'site.plays_description',
                'value' => 'العديد من المسرحيات الكوميدية والغنائية التربوية من انتاج وتأليف واخراج مؤسسة حواس, جميعها تهدف الى
                ترسيخ الوعي الصحي والسلوك الامن'
            ],
            [
                'name' => 'meta.blogs_og_image',
                'value' => 'dummy/blogs_og_image.png'
            ],
            [
                'name' => 'meta.programs_og_image',
                'value' => 'meta.programs_og_image'
            ],
            [
                'name' => 'meta.channel_og_image',
                'value' => 'meta.channel_og_image'
            ],
            [
                'name' => 'meta.library_og_image',
                'value' => 'meta.library_og_image'
            ],
            [
                'name' => 'meta.films_og_image',
                'value' => 'meta.films_og_image'
            ],
            [
                'name' => 'meta.plays_og_image',
                'value' => 'meta.plays_og_image'
            ],
            [
                'name' => 'meta.home_og_image',
                'value' => 'meta.home_og_image'
            ],
            [
                'name' => 'meta.contact_us_page_image',
                'value' => 'meta.contact_us_page_image'
            ],
            [
                'name' => 'channel.description_text_home_page',
                'value' => 'مؤسسة تربوية تعمل على ترسيخ القيم الصحية الامنة بمجتمعنا العربي حسب حاجات ومفاهيم تربوية تلائم شتى
                الشرائح المجتمعية.'
            ],
            [
                'name' => 'channel.description',
                'value' => 'نجحت مؤسسة حواس من خلال الأخصائيين المهنيين بأن تنتج مجموعة كبيرة من الافلام الكرتونية، وإضافة إلى
                ذلك تلحين وغناء مجموعة من الأشعار التربوية والتعليمية في قضايا المجتمع, جميعها للأطفال سهلة المضامين
                وقريبة إلى واقع الطف,'
            ],
            [
                'name' => 'channel.brief_video',
                'value' => 'dummy/video.mp4'
            ]
        ];
        foreach ($settings as $settingData) {
            $setting = Setting::firstOrNew([
                'name' => $settingData['name']
            ]);
            if (!$setting->exists) {
                $setting->fill($settingData)->save();
            }
        }
    }
}

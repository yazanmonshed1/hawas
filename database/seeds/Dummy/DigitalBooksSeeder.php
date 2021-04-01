<?php

use App\Models\DigitalBook;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DigitalBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('digital_books')->delete();
        $data = [
            [
                'title' => 'زعتر الحكيم في الطريق',
                'slug' => 'زعتر-الحكيم-في-الطريق',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'intro' => 'dummy/digital_book.png',
                'cover_image' => 'dummy/digital_book.png',
            ],
            [
                'title' => 'حياتنا الآمنة - الوحدة 1',
                'slug' => 'حياتنا-الآمنة-الوحدة-1',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'intro' => 'dummy/digital_book.png',
                'cover_image' => 'dummy/digital_book.png',
            ],
            [
                'title' => 'حياتنا الآمنة - الوحدة 2',
                'slug' => 'حياتنا-الآمنة-الوحدة-2',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'intro' => 'dummy/digital_book.png',
                'cover_image' => 'dummy/digital_book.png',
            ],
            [
                'title' => 'صحتي بحكمتي',
                'slug' => 'صحتي-بحكمتي',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'intro' => 'dummy/digital_book.png',
                'cover_image' => 'dummy/digital_book.png',
            ]
        ];
        foreach ($data as $dataItem) {
            $textBook = new DigitalBook();
            $textBook->fill($dataItem)->save();
        }
    }
}

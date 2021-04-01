<?php

use App\Models\TextBook;
use App\Models\TextBookPart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('text_books')->delete();
        DB::table('text_book_parts')->delete();
        $data = [
            [
                'title' => 'زعتر الحكيم في الطريق',
                'slug' => 'زعتر-الحكيم-في-الطريق',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'front_cover' => 'dummy/text_book1.png',
                'back_cover' => 'dummy/text_book_back.png',
            ],
            [
                'title' => 'حياتنا الآمنة - الوحدة 1',
                'slug' => 'حياتنا-الآمنة-الوحدة-1',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'front_cover' => 'dummy/text_book2.png',
                'back_cover' => 'dummy/text_book_back.png',
            ],
            [
                'title' => 'حياتنا الآمنة - الوحدة 2',
                'slug' => 'حياتنا-الآمنة-الوحدة-2',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'front_cover' => 'dummy/text_book3.png',
                'back_cover' => 'dummy/text_book_back.png',
            ],
            [
                'title' => 'صحتي بحكمتي',
                'slug' => 'صحتي-بحكمتي',
                'description' => 'سلوك وتصرفات الآباء والأمهات مرآة لتصرفات الأبناء اعداد طائي',
                'front_cover' => 'dummy/text_book4.png',
                'back_cover' => 'dummy/text_book_back.png',
            ]
        ];

        $parts = ['الجزء الأول', 'الجزء الثاني'];

        foreach ($data as $dataItem) {
            $textBook = new TextBook();
            $textBook->fill($dataItem)->save();
            foreach ($parts as $partTitle) {
                $textBookPart = new TextBookPart();
                $textBookPart->fill([
                    'title' => $partTitle,
                    'text_book_id' => $textBook->id
                ])->save();
            }
        }
    }
}

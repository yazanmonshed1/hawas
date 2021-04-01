<?php

use App\Models\Platform\BookContent;
use Illuminate\Database\Seeder;

class RemoveLessonMatchImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookContent::where([
            'table_name' => 'matching_words_to_images',
            'page_type' => 'lesson'
        ])->delete();
    }
}

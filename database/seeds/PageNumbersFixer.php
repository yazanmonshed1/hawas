<?php

use App\Models\Platform\Chapter;
use Illuminate\Database\Seeder;

class PageNumbersFixer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chapters = Chapter::all();
        foreach ($chapters as $chapter) {
            $contents = $chapter->allContents()->orderBy('page_number', 'ASC')->get();
            $page_number = 1;
            foreach ($contents as $content) {
                if ($content->table_name == 'multiple_choices') {
                    $content->page_number = 0;
                    $content->save();
                } else {
                    $content->page_number = $page_number;
                    $content->save();
                    ++$page_number;
                }
            }
        }
    }
}

<?php

use App\Models\DigitalBook;
use App\Models\Platform\Chapter;
use Illuminate\Database\Seeder;

class CreateChapterForeachDigitalBook extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $digitalBooks = DigitalBook::all();
        foreach ($digitalBooks as $book) {
            $chapter = Chapter::firstOrNew([
                'digital_book_id' => $book->id,
            ]);
            if (!$chapter->exists) {
                $chapter->fill([
                    'digital_book_id' => $book->id,
                    'order' => 0,
                    'chapter' => 'الفصل الاول'
                ])->save();
                $chapter->allContents()->saveMany($book->allContents);
            }
        }
    }
}

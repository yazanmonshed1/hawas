<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\WordWallExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WordWallExamsController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'embed' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'wordwall_exam', $id, $chapter_id, true);

        $wordWall = new WordWallExam();
        $wordWall->book_content_id = $bookContent->id;
        $wordWall->embed = $request->embed;
        $wordWall->save();

        return $this->sendCreated($wordWall);
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'embed' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $wordWall = WordWallExam::where('book_content_id', $book_content_id)->get()->first();
        $wordWall->embed = $request->embed;
        $wordWall->save();

        return $this->sendCreated($wordWall);
    }
}

<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Puzzle;
use App\Models\Platform\PuzzleParts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PuzzlesController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required|string|max:255',
            'parts' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'puzzles', $id, $chapter_id, true);

        $puzzle = new Puzzle();
        $puzzle->image = $request->image;
        $puzzle->book_content_id = $bookContent->id;
        $puzzle->save();

        foreach ($request->parts as $number) {
            $part = new PuzzleParts();
            $part->x =  (int)$number['x'];
            $part->y =  (int)$number['y'];
            $part->puzzle_id =  $puzzle->id;
            $part->save();
        }

        return $this->sendCreated($puzzle);
    }

    public function update(Request $request, $book_content_id)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required|string|max:255',
            'parts' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $puzzle = Puzzle::where('book_content_id', $book_content_id)->get()->first();
        $puzzle->image = $request->image;
        $puzzle->save();

        $puzzle->parts()->delete();

        foreach ($request->parts as $number) {
            $part = new PuzzleParts();
            $part->x =  (int)$number['x'];
            $part->y =  (int)$number['y'];
            $part->puzzle_id =  $puzzle->id;
            $part->save();
        }

        return $this->sendCreated($puzzle);
    }
}

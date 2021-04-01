<?php

namespace App\Http\Controllers\Admin\Api\Lessons;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoriesController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'multiple_choices_id' => 'nullable|exists:book_contents,id'
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'story', $id, $chapter_id, false);

        $story = new Story();
        $story->book_content_id = $bookContent->id;
        $story->description = $request->description;
        $story->audio = $request->audio;
        $story->video = $request->video;

        if ($request->has('multiple_choices_id')) {
            $story->multiple_choices_id = $request->multiple_choices_id;
        }

        $story->save();

        return $this->sendCreated($story);
    }

    public function edit(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'multiple_choices_id' => 'exists:book_contents,id'
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $story = Story::where('book_content_id', $book_content_id)->get()->first();
        $story->description = $request->description;
        $story->audio = $request->audio;
        $story->video = $request->video;
        $story->multiple_choices_id = $request->has('multiple_choices_id') ? $request->multiple_choices_id : null;

        $story->save();

        return $this->sendCreated($story);
    }
}

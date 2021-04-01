<?php

namespace App\Http\Controllers\Admin\Api\Lessons;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideosController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video' => ['required', 'regex:/^.*\.(mp4|avi|wmv)$/i'],
            'multiple_choices_id' => 'nullable|exists:book_contents,id'
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'videos', $id, $chapter_id, false);

        $video = new Video();
        $video->book_content_id = $bookContent->id;
        $video->video = $request->video;

        if ($request->has('multiple_choices_id')) {
            $video->multiple_choices_id = $request->multiple_choices_id;
        }

        $video->save();

        return $this->sendCreated($video);
    }

    public function edit(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'video' => ['required', 'regex:/^.*\.(mp4|avi|wmv)$/i'],
            'multiple_choices_id' => 'exists:book_contents,id'
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $video = Video::where('book_content_id', $book_content_id)->get()->first();
        $video->video = $request->video;
        $video->multiple_choices_id = $request->has('multiple_choices_id') ? $request->multiple_choices_id : null;
        $video->save();

        return $this->sendCreated($video);
    }
}

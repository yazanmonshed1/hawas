<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Chapter;
use App\Models\Platform\MemoryGame;
use App\Models\Platform\MultipleChoice;
use App\Models\Platform\PaintImage;
use App\Models\Platform\Puzzle;
use App\Models\Platform\ShapeDrawing;
use App\Models\Platform\Story;
use App\Models\Platform\SuitableWords;
use App\Models\Platform\Video;
use App\Models\Platform\WordWallExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlatformController extends BaseController
{
    public function index($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = auth('admin')->user();
        $token = $admin->createToken('api')->accessToken;
        return view('admin.dashboard.platform.index')->with([
            'token' => $token,
            'bookId' => $id
        ]);
    }

    public function showBook($id)
    {
        $digitalBook = DigitalBook::where('id', $id)->with('chapters')->first();
        return $digitalBook ? $this->sendSuccess($digitalBook) : $this->sendNotFound();
    }

    public function getChapters($id)
    {
        $digitalBook = DigitalBook::fidOrFail($id);
        return $this->sendSuccess($digitalBook->chapters);
    }

    public function addChapter(Request $request, $id)
    {
        $request->validate([
            'chapter' => 'required|string|max:255',
        ]);

        $digitalBook = DigitalBook::findOrFail($id);

        $chapter = new Chapter();
        $chapter->chapter = $request->chapter;
        $chapter->digital_book_id = $digitalBook->id;
        $chapter->order = $digitalBook->chapters()->count();
        $chapter->save();

        return $this->sendCreated($chapter);
    }

    public function removeChapter($chapter_id)
    {
        $chapter = Chapter::findOrFail($chapter_id);
        $chapter->delete();
        return $this->sendSuccess($chapter->digitalBook->chapters);
    }

    public function uploadImage(Request $request)
    {
        $base64_image = $request->image;
        $extension = explode('/', mime_content_type($base64_image))[1];
        $allowed_extensions = ['png', 'jpg', 'jpeg'];
        if (!in_array($extension, $allowed_extensions)) {
            return $this->validationFailed([
                'image' => 'يرجى رفع صورة صالحة, الملفات المسموحة : ' . implode(', ', $allowed_extensions)
            ]);
        }

        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);

            $data = base64_decode($data);
            $fileName = 'platform/images/' . time() .  '.' . $extension;
            Storage::disk('public')->put($fileName, $data);
        } else {
            return $this->validationFailed([
                'image' => 'خطأ في رفع الملف'
            ]);
        }

        return response()->json([
            'path' => $fileName
        ]);
    }

    public function uploadVideo(Request $request)
    {
        $base64_video = $request->video;
        $extension = explode('/', mime_content_type($base64_video))[1];

        $allowed_extensions = ['amv', 'mp4'];
        if (!in_array($extension, $allowed_extensions)) {
            return $this->validationFailed([
                'video' => 'يرجى رفع فيديو صالح, الملفات المسموحة : ' . implode(', ', $allowed_extensions)
            ]);
        }
        if (preg_match('/^data:video\/(\w+);base64,/', $base64_video)) {
            $data = substr($base64_video, strpos($base64_video, ',') + 1);

            $data = base64_decode($data);
            $fileName = 'platform/videos/' . time() .  '.' . $extension;
            Storage::disk('public')->put($fileName, $data);
        } else {
            return $this->validationFailed([
                'video' => 'خطأ في رفع الملف'
            ]);
        }

        return response()->json([
            'path' => $fileName
        ]);
    }

    public function uploadAudio(Request $request)
    {
        $base64_audio = $request->audio;
        $extension = explode('/', mime_content_type($base64_audio))[1];

        $allowed_extensions = ['mp3', 'wma', 'mpeg'];
        if (!in_array($extension, $allowed_extensions)) {
            return $this->validationFailed([
                'video' => 'يرجى ملف صوت صالح, الملفات المسموحة : ' . implode(', ', $allowed_extensions)
            ]);
        }
        if (preg_match('/^data:audio\/(\w+);base64,/', $base64_audio)) {
            $data = substr($base64_audio, strpos($base64_audio, ',') + 1);

            $data = base64_decode($data);
            $fileName = 'platform/videos/' . time() .  '.' . $extension;
            Storage::disk('public')->put($fileName, $data);
        } else {
            return $this->validationFailed([
                'video' => 'خطأ في رفع الملف'
            ]);
        }

        return response()->json([
            'path' => $fileName
        ]);
    }

    public function showBookContents($id, $chapter_id)
    {
        $contents = Chapter::find($chapter_id)->contents()->orderBy('page_number', 'ASC')->get();
        $multiple_choices = Chapter::find($chapter_id)->multipleChoices;
        return $contents ? $this->sendSuccess([
            'contents' => $contents,
            'multiple_choices' => $multiple_choices ? $multiple_choices : [],
        ]) : $this->sendNotFound();
    }

    public function reorderBookContents(Request $request)
    {
        foreach ($request->all() as $index => $id) {
            $bookContent = BookContent::find($id);
            $bookContent->page_number = $index + 1;
            $bookContent->save();
        }
        return $this->sendSuccess([]);
    }

    public function uploadImageCKEditor(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'upload' => 'required|file|mimes:jpeg,png,gif'
        ]);

        $media = $request->upload;

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $path = $media->store('media', ['disk' => 'public']);
        $fullPath = asset('storage/' . $path);
        return response()->json([
            'uploaded' => 1,
            'fileName' => $request->upload->getClientOriginalName(),
            'url' => $fullPath
        ]);
    }

    public function getMultipleChoices(Request $request, $id)
    {
        $digitalBook = DigitalBook::findOrFail($id);
        return $this->sendSuccess($digitalBook->multipleChoices);
    }

    public function deleteBookContents(Request $request)
    {
        $bookContent = BookContent::find($request->content_id);
        $bookContent->delete();
        $allContents = $bookContent->chapter->contents()->orderBy('page_number', 'ASC')->get();
        foreach ($allContents as $index => $content) {
            $content->page_number = $index + 1;
            $content->save();
        }
        return $this->sendSuccess('deleted successfully');
    }

    public function getContent(Request $request, $content_id)
    {
        $bookContent = BookContent::findOrFail($content_id);
        switch ($bookContent->table_name) {
            case 'matching_words_to_sentences':
                $content = $bookContent->matchSentences->first()->items()->select('id', 'word', 'sentence')->get();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'book_content_id' => $bookContent->id,
                ]);
            case 'matching_words_to_images':
                $content = $bookContent->matchImages()->select('id', 'image', 'title')->get();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'book_content_id' => $bookContent->id,
                ]);
            case 'story':
                $content = Story::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                ]);
            case 'videos':
                $content = Video::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                ]);
            case 'puzzles':
                $content = Puzzle::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'parts' => $content->parts()->select('id', 'x', 'y')->get()
                ]);
            case 'drawing':
                $content = ShapeDrawing::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'colors' => $content->colors()->select('color')->get()->pluck('color')
                ]);
            case 'painting_images':
                $content = PaintImage::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'colors' => $content->colors()->select('color')->get()->pluck('color')
                ]);
            case 'suitable_words':
                $content = SuitableWords::where('book_content_id', $bookContent->id)->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content->sentences()->with('choices')->get(),
                    'book_content_id' => $bookContent->id,
                ]);
            case 'multiple_choices':
                $content = MultipleChoice::where('book_content_id', $bookContent->id)->with('choices')->get();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'book_content_id' => $bookContent->id,
                ]);
            case 'memory_game':
                $content = MemoryGame::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                    'images' => $content->images()->select('id', 'path as uploadedFile')->get()
                ]);
            case 'wordwall_exam':
                $content = WordWallExam::where('book_content_id', $bookContent->id)->get()->first();
                return $this->sendSuccess([
                    'title' => $bookContent->title,
                    'contents' => $content,
                ]);
        }
    }
}

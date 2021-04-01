<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\MatchImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchWordsToImagesController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'images_items' => 'required|array|size:4',
            'images_items.*.title' => 'required|string|max:255',
            'images_items.*.image' => ['required', 'regex:/^.*\.(png|jpg|jpeg|gif)$/i'],
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $content = $this->createBookContent($request, $digitalBook, $id, $chapter_id);
        return $this->sendCreated($content);
    }

    private function createBookContent(Request $request, DigitalBook $digitalBook, $id, $chapter_id)
    {
        $bookContent = $this->createContent($digitalBook, $request->title, 'matching_words_to_images', $id, $chapter_id, true);

        $createdMatchWordToImage = [];
        foreach ($request->images_items as $item) {
            $MatchWordToImage = new MatchImage();
            $MatchWordToImage->book_content_id = $bookContent->id;
            $MatchWordToImage->title = $item['title'];
            $MatchWordToImage->image = $item['image'];
            $MatchWordToImage->save();
            $createdMatchWordToImage[] = $MatchWordToImage;
        }

        return $createdMatchWordToImage;
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'images_items' => 'required|array',
            'images_items.*.title' => 'required|string|max:255',
            'images_items.*.image' => ['required', 'regex:/^.*\.(png|jpg|jpeg|gif)$/i'],
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $matchImages = MatchImage::where('book_content_id', $book_content_id)->get();

        $current_ids = $matchImages->pluck('id')->toArray();

        $all = [];
        foreach ($request->images_items as $item) {
            $all[] = $item['id'];
            $imageWord = is_numeric($item['id']) ? MatchImage::find($item['id']) : new MatchImage();
            $imageWord->title =  $item['title'];
            $imageWord->image =  $item['image'];
            $imageWord->book_content_id = $bookContent->id;
            $imageWord->save();
        }

        $deleted = array_diff($current_ids, $all);
        MatchImage::whereIn('id', $deleted)->delete();

        return $this->sendCreated($matchImages);
    }
}

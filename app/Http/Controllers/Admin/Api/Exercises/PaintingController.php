<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\PaintImage;
use App\Models\Platform\PaintImagesColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaintingController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'image' => 'required|string|max:255',
            'title' => 'required',
            'colors' => 'required|array',
            'colors.*' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'painting_images', $id, $chapter_id, true);

        $paintImage = new PaintImage();
        $paintImage->image = $request->image;
        $paintImage->book_content_id = $bookContent->id;
        $paintImage->save();

        foreach ($request->colors as $hex) {
            $color = new PaintImagesColor();
            $color->color =  $hex;
            $color->paint_image_id =  $paintImage->id;
            $color->save();
        }

        return $this->sendCreated($paintImage);
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|string|max:255',
            'title' => 'required',
            'colors' => 'required|array',
            'colors.*' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $paintImage = PaintImage::where('book_content_id', $book_content_id)->get()->first();
        $paintImage->image = $request->image;
        $paintImage->save();

        $paintImage->colors()->delete();

        foreach ($request->colors as $hex) {
            $color = new PaintImagesColor();
            $color->color =  $hex;
            $color->paint_image_id =  $paintImage->id;
            $color->save();
        }

        return $this->sendCreated($paintImage);
    }
}

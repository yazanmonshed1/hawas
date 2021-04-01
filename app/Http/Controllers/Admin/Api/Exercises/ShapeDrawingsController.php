<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\ShapeDrawing;
use App\Models\Platform\ShapeDrawingColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShapeDrawingsController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'colors' => 'required|array',
            'colors.*' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'drawing', $id, $chapter_id, true);

        $shapeDrawing = new ShapeDrawing();
        $shapeDrawing->book_content_id = $bookContent->id;
        $shapeDrawing->save();

        foreach ($request->colors as $color) {
            $drawingColor = new ShapeDrawingColor();
            $drawingColor->color =  $color;
            $drawingColor->shape_drawing_id =  $shapeDrawing->id;
            $drawingColor->save();
        }

        return $this->sendCreated($shapeDrawing);
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'colors' => 'required|array',
            'colors.*' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $shapeDrawing = ShapeDrawing::where('book_content_id', $book_content_id)->get()->first();
        $shapeDrawing->book_content_id = $bookContent->id;
        $shapeDrawing->save();

        $shapeDrawing->colors()->delete();

        foreach ($request->colors as $color) {
            $drawingColor = new ShapeDrawingColor();
            $drawingColor->color =  $color;
            $drawingColor->shape_drawing_id =  $shapeDrawing->id;
            $drawingColor->save();
        }

        return $this->sendCreated($shapeDrawing);
    }
}

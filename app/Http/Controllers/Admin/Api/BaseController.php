<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Chapter;

class BaseController extends Controller
{
    protected function sendSuccess($data, $message = 'success')
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], 200);
    }

    protected function sendNotFound($message = 'not found!', $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    protected function sendError($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    protected function sendCreated($data, $message = 'created successfully')
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], 201);
    }

    protected function validationFailed($errors)
    {
        return response()->json([
            'errors' => $errors
        ], 422);
    }

    protected function createContent(DigitalBook $digitalBook, $title, $type, $id, $chapter_id, $isExercise)
    {
        $targetPageNumber = 0;
        if ($type != 'multiple_choices') {
            $targetPageNumber = Chapter::find($chapter_id)->contents->count() + 1;
        }
        $bookContent = new BookContent();
        $bookContent->title = $title;
        $bookContent->page_number = $targetPageNumber;
        $bookContent->table_name = $type;
        $bookContent->page_type = $isExercise ? 'exercise' : 'lesson';
        $bookContent->book_id = $id;
        $bookContent->chapter_id = $chapter_id;
        $bookContent->save();
        return $bookContent;
    }
}

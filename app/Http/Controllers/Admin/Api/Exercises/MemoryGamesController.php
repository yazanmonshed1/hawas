<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\MemoryGame;
use App\Models\Platform\MemoryGameMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemoryGamesController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'images' => 'required|array',
            'images.*.uploadedFile' => ['required', 'regex:/^.*\.(png|jpg|jpeg)$/i'],
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'memory_game', $id, $chapter_id, true);

        $memoryGame = new MemoryGame();
        $memoryGame->book_content_id = $bookContent->id;
        $memoryGame->save();

        foreach ($request->images as $item) {
            $color = new MemoryGameMedia();
            $color->path =  $item['uploadedFile'];
            $color->memory_games_media_id =  $memoryGame->id;
            $color->save();
        }

        return $this->sendCreated($memoryGame);
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'images' => 'required|array',
            'images.*.uploadedFile' => ['required', 'regex:/^.*\.(png|jpg|jpeg)$/i'],
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $memoryGame = MemoryGame::where('book_content_id', $book_content_id)->get()->first();

        $memoryGame->images()->delete();

        foreach ($request->images as $item) {
            $color = new MemoryGameMedia();
            $color->path =  $item['uploadedFile'];
            $color->memory_games_media_id =  $memoryGame->id;
            $color->save();
        }

        return $this->sendCreated($memoryGame);
    }
}

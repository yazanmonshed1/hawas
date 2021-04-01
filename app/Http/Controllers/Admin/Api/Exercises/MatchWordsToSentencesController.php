<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\MatchWordsToSentencesWord;
use App\Models\Platform\MatchWordToSentence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchWordsToSentencesController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sentences' => 'required|array',
            'sentences.*.word' => 'required',
            'sentences.*.sentence' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'matching_words_to_sentences', $id, $chapter_id, true);

        $MatchWordToSentence = new MatchWordToSentence();
        $MatchWordToSentence->book_content_id = $bookContent->id;
        $MatchWordToSentence->save();

        foreach ($request->sentences as $sentence) {
            $SentenceWord = new MatchWordsToSentencesWord();
            $SentenceWord->sentence =  $sentence['sentence'];
            $SentenceWord->word =  $sentence['word'];
            $SentenceWord->match_word_to_sentence_id =  $MatchWordToSentence->id;
            $SentenceWord->save();
        }

        return $this->sendCreated($MatchWordToSentence);
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sentences' => 'required|array',
            'sentences.*.word' => 'required',
            'sentences.*.sentence' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $MatchWordToSentence = MatchWordToSentence::where('book_content_id', $book_content_id)->get()->first();

        $words_ids = $MatchWordToSentence->items->pluck('id')->toArray();

        $all = [];
        foreach ($request->sentences as $sentence) {
            $all[] = $sentence['id'];
            $SentenceWord = is_numeric($sentence['id']) ? MatchWordsToSentencesWord::find($sentence['id']) : new MatchWordsToSentencesWord();
            $SentenceWord->sentence =  $sentence['sentence'];
            $SentenceWord->word =  $sentence['word'];
            $SentenceWord->match_word_to_sentence_id =  $MatchWordToSentence->id;
            $SentenceWord->save();
        }

        $deleted = array_diff($words_ids, $all);
        MatchWordsToSentencesWord::whereIn('id', $deleted)->delete();

        return $this->sendCreated($MatchWordToSentence);
    }
}

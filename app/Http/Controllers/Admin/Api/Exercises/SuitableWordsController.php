<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\SuitableWords;
use App\Models\Platform\SuitableWordsSentence;
use App\Models\Platform\SuitableWordsSentencesChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuitableWordsController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*' => 'required',
            'questions.*.sentence' => 'required|string|max:255',
            'questions.*.choices' => 'required|array',
            'questions.*.choices.*.is_correct' => 'required|boolean',
            'questions.*.choices.*.choice' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'suitable_words', $id, $chapter_id, true);

        $suitableWord = new SuitableWords();
        $suitableWord->book_content_id = $bookContent->id;
        $suitableWord->save();

        try {
            $createdSuitableWords = [];
            foreach ($request->questions as $item) {
                $suitableWordSentence = new SuitableWordsSentence();
                $suitableWordSentence->sentence = $item['sentence'];
                $suitableWordSentence->suitable_word_id = $suitableWord->id;
                $suitableWordSentence->save();

                $createdSuitableWords[] = $suitableWordSentence;

                foreach ($item['choices'] as $index => $item) {
                    $choice = new SuitableWordsSentencesChoice();
                    $choice->choice =  $item['choice'];
                    $choice->sentence_id = $suitableWordSentence->id;
                    $choice->is_correct = $item['is_correct'];
                    $choice->save();
                }
            }
        } catch (\Throwable $e) {
            $bookContent->delete();
            return $this->validationFailed([
                'default_data' => 'يرجى تعبئة جميع الحقول (الاسئلة والخيارات)'
            ]);
        }

        return $this->sendCreated($createdSuitableWords);
    }

    public function update(Request $request, $book_content_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*' => 'required',
            'questions.*.sentence' => 'required|string|max:255',
            'questions.*.choices' => 'required|array',
            'questions.*.choices.*.is_correct' => 'required|boolean',
            'questions.*.choices.*.choice' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $suitableWord = SuitableWords::where('book_content_id', $book_content_id)->get()->first();
        $suitableWord->sentences()->delete();

        try {
            $createdSuitableWords = [];
            foreach ($request->questions as $item) {
                $suitableWordSentence = new SuitableWordsSentence();
                $suitableWordSentence->sentence = $item['sentence'];
                $suitableWordSentence->suitable_word_id = $suitableWord->id;
                $suitableWordSentence->save();

                $createdSuitableWords[] = $suitableWordSentence;

                foreach ($item['choices'] as $index => $item) {
                    $choice = new SuitableWordsSentencesChoice();
                    $choice->choice =  $item['choice'];
                    $choice->sentence_id = $suitableWordSentence->id;
                    $choice->is_correct = $item['is_correct'];
                    $choice->save();
                }
            }
        } catch (\Throwable $e) {
            $bookContent->delete();
            return $this->validationFailed([
                'default_data' => 'يرجى تعبئة جميع الحقول (الاسئلة والخيارات)'
            ]);
        }

        return $this->sendCreated($createdSuitableWords);
    }
}

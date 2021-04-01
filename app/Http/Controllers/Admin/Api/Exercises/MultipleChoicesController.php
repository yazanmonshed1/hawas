<?php

namespace App\Http\Controllers\Admin\Api\Exercises;

use App\Http\Controllers\Admin\Api\BaseController;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\MultipleChoice;
use App\Models\Platform\MultipleChoiceAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MultipleChoicesController extends BaseController
{
    public function store(Request $request, $id, $chapter_id)
    {
        $digitalBook = DigitalBook::find($id);

        $validateArr = [
            'title' => 'required|string|max:255',
            'multiple_choices' => 'required|array',
            'multiple_choices.*.choices' => 'required|array',
            'multiple_choices.*.question' => 'required|string|max:255',
            'multiple_choices.*.choices.*.choice' => 'required|string|max:255',
            'multiple_choices.*.choices.*.is_correct' => 'required|boolean',
        ];
        $validator = Validator::make($request->all(), $validateArr);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = $this->createContent($digitalBook, $request->title, 'multiple_choices', $id, $chapter_id, true);

        try {
            $createdMultipleCoice = [];
            foreach ($request->multiple_choices as $item) {
                $multipleCoice = new MultipleChoice();
                $multipleCoice->question = $item['question'];
                $multipleCoice->book_content_id = $bookContent->id;
                $multipleCoice->save();
                $createdMultipleCoice[] = $multipleCoice;

                foreach ($item['choices'] as $item) {
                    $color = new MultipleChoiceAnswer();
                    $color->choice =  $item['choice'];
                    $color->multiple_choice_id =  $multipleCoice->id;
                    $color->is_correct =  $item['is_correct'];
                    $color->save();
                }
            }
        } catch (\Throwable $e) {
            $bookContent->delete();
            return $this->validationFailed([
                'default_data' => 'يرجى تعبئة جميع الحقول (الاسئلة والخيارات)'
            ]);
        }

        return $this->sendCreated($createdMultipleCoice);
    }

    public function update(Request $request, $book_content_id)
    {
        $validateArr = [
            'title' => 'required|string|max:255',
            'multiple_choices' => 'required|array',
            'multiple_choices.*.choices' => 'required|array',
            'multiple_choices.*.question' => 'required|string|max:255',
            'multiple_choices.*.choices.*.choice' => 'required|string|max:255',
            'multiple_choices.*.choices.*.is_correct' => 'required|boolean',
        ];
        $validator = Validator::make($request->all(), $validateArr);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        $bookContent = BookContent::findOrFail($book_content_id);
        $bookContent->title = $request->title;
        $bookContent->save();

        $bookContent->multipleChoicesQuestions()->delete();

        try {
            $createdMultipleCoice = [];
            foreach ($request->multiple_choices as $item) {
                $multipleCoice = new MultipleChoice();
                $multipleCoice->question = $item['question'];
                $multipleCoice->book_content_id = $bookContent->id;
                $multipleCoice->save();
                $createdMultipleCoice[] = $multipleCoice;

                foreach ($item['choices'] as $item) {
                    $color = new MultipleChoiceAnswer();
                    $color->choice =  $item['choice'];
                    $color->multiple_choice_id =  $multipleCoice->id;
                    $color->is_correct =  $item['is_correct'];
                    $color->save();
                }
            }
        } catch (\Throwable $e) {
            $bookContent->delete();
            return $this->validationFailed([
                'default_data' => 'يرجى تعبئة جميع الحقول (الاسئلة والخيارات)'
            ]);
        }

        return $this->sendCreated($createdMultipleCoice);
    }
}

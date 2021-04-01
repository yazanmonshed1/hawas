<?php

namespace App\Widgets;

use App\Models\Platform\StudentExam;
use App\Models\Platform\StudentMatchImagesAnswer;
use App\Models\Platform\StudentMatchWordsAnsweres;
use Arrilot\Widgets\AbstractWidget;

class UnsolvedProblems extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $studentExams = StudentExam::where('user_id', auth()->user()->id)->orderBy('updated_at', 'DESC')->limit(3)->get();

        $unsolved = [];
        foreach ($studentExams as $studentExam) {
            $item = $this->getUnsolved($studentExam);
            if ($item !== null) {
                $unsolved[] = $item;
            }
        }

        return view('widgets.unsolved_problems', [
            'config' => $this->config,
            'unsolvedQuestions' => $unsolved
        ]);
    }

    private function getUnsolved(StudentExam $exam)
    {
        switch ($exam->type) {
            case 'matching_words_to_images':
                $all = StudentMatchImagesAnswer::where([
                    'student_exam_id' => $exam->id
                ]);
                $unsolvedCount = $all->where('answer_id', null)->get()->count();
                return $unsolvedCount == 0 ? null : [
                    'page_no' => $exam->bookContent->page_number,
                    'link' => route('book-activity', ['book_id' => $exam->bookContent->book->id, 'activity_id' => $exam->bookContent->id]),
                    'title' => $exam->bookContent->title
                ];
            case 'matching_words_to_sentences':
                $all = StudentMatchWordsAnsweres::where([
                    'student_exam_id' => $exam->id
                ]);
                $unsolvedCount = $all->where('answer_id', null)->get()->count();
                return $unsolvedCount == 0 ? null : [
                    'page_no' => $exam->bookContent->page_number,
                    'link' => route('book-activity', ['book_id' => $exam->bookContent->book->id, 'activity_id' => $exam->bookContent->id]),
                    'title' => $exam->bookContent->title
                ];
            case 'videos':
                $all = $exam->multipleChoiceAnswers();
                $allCount = $all->get()->count();
                $unsolvedCount = $all->where('answer_id', null)->get()->count();
                $question_no = $allCount - $unsolvedCount + 1;
                return $unsolvedCount == 0 ? null : [
                    'q_no' => $question_no,
                    'page_no' => $exam->bookContent->page_number,
                    'link' => route('book-activity', ['book_id' => $exam->bookContent->book->id, 'activity_id' => $exam->bookContent->id]),
                ];
            case 'story':
                $allCount = $exam->multipleChoiceAnswers->count();
                $unsolvedCount = $exam->multipleChoiceAnswers()->where('answer_id', null)->get()->count();
                $question_no = $allCount - $unsolvedCount + 1;
                return $unsolvedCount == 0 ? null : [
                    'q_no' => $question_no,
                    'page_no' => $exam->bookContent->page_number,
                    'link' => route('book-activity', ['book_id' => $exam->bookContent->book->id, 'activity_id' => $exam->bookContent->id]),
                ];
            case 'suitable_words':
                $allCount = $exam->suitableWordsAnswers->count();
                $unsolvedCount = $exam->suitableWordsAnswers()->where('answer_id', null)->get()->count();
                $question_no = $allCount - $unsolvedCount + 1;
                return $unsolvedCount == 0 ? null : [
                    'q_no' => $question_no,
                    'page_no' => $exam->bookContent->page_number,
                    'link' => route('book-activity', ['book_id' => $exam->bookContent->book->id, 'activity_id' => $exam->bookContent->id]),
                ];
        }
        return null;
    }
}

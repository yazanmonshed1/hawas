<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Platform\StudentExam;
use App\Models\Platform\StudentSuitableWordsAnsweres;
use App\Models\Platform\SuitableWordsSentence;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class SuitableExamsController extends Controller
{
    const OPERATORS = [
        'equal' => '=',
        'next' => '>',
        'previous' => '<'
    ];

    public function getQuestion(Request $request, $student_exam_id, $question_id = null, $type = 'equal', $q_no = 1)
    {

        $studentExam = StudentExam::findOrFail($student_exam_id);

        // if ($studentExam->status == 'completed') {
        //     return $this->getExamResult($studentExam->mark . ' / ' . $studentExam->total);
        // }

        if ($type == 'next') {
            $q_no += 1;
        } else if ($type == 'previous') {
            $q_no -= 1;
        }

        $question = $this->getTargetQuestion($studentExam, $question_id, self::OPERATORS[$type]);

        $all = $this->getAllQuestions($studentExam);

        // $finished = $all->where('answer_id', '!=', null)->count() == $all->count() ? true : false;
        $finished = $q_no == $all->count() ? true : false;

        if ($question) {
            $hide = null;
            if ($all->first()->question_id == $question->id) {
                $hide = 'first';
            }
            if ($all->last()->question_id == $question->id) {
                $hide = 'last';
            }
            $one = $all->count() == 1 ? true : false;
            $targetAnswer = $this->getTargetAnswer($studentExam, $question->id);
            $answer_id = $targetAnswer ? $targetAnswer->answer_id : null;
            if (!$answer_id) {
                $finished = false;
            }
            return response()->json([
                'html' => view('student.activity.components.suitable-question')->with(compact('question', 'hide', 'answer_id', 'q_no', 'finished', 'one'))->render()
            ]);
        } else {
            return response()->json([
                'refresh' => true
            ]);
        }
    }

    public function answerQuestion(Request $request, $student_exam_id, $question_id, $answer_id)
    {
        $exam = auth()->user()->exams()->where('id', $student_exam_id)->firstOrFail();

        $targetAnswer = $this->getTargetAnswer($exam, $question_id);
        $targetAnswer->answer_id = $answer_id;
        $targetAnswer->save();

        $all = $this->getAllQuestions($exam);
        $finished = $all->where('answer_id', '!=', null)->count() == $all->count() ? true : false;

        return response()->json([
            'finished' => $finished
        ]);
    }

    /**
     * suitable_words
     * multiple_choices
     * drawing
     * painting_images
     * matching_words_to_images
     * matching_words_to_sentence 
     */
    private function getTargetAnswer($exam, $question_id)
    {
        return StudentSuitableWordsAnsweres::where([
            'student_exam_id' => $exam->id,
            'question_id' => $question_id
        ])->get()->first();
    }

    private function getTargetQuestion(StudentExam $studentExam, $question_id, $operator)
    {
        if ($question_id == null) {
            $targetAnswer = StudentSuitableWordsAnsweres::where([
                'student_exam_id' => $studentExam->id,
            ])->get()->first();
        } else {
            $targetAnswer = StudentSuitableWordsAnsweres::where([
                'student_exam_id' => $studentExam->id,
            ])->where('question_id', $operator, $question_id)->orderBy('id', $operator == '>' ? 'ASC' : 'DESC')->get()->first();
        }

        return $targetAnswer ? SuitableWordsSentence::find($targetAnswer->question_id) : null;
    }

    public function getAllQuestions(StudentExam $studentExam)
    {
        return StudentSuitableWordsAnsweres::where([
            'student_exam_id' => $studentExam->id,
        ])->get();
    }

    private function getExamResult($result)
    {
        return response()->json([
            'html' => view('student.activity.components.result')->with('result', $result)->render()
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Admin\NadConsole\NadsoftBaseCotroller;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Story;
use App\Models\Platform\StudentDrawingAnswer;
use App\Models\Platform\StudentExam;
use App\Models\Platform\StudentMemoryAnswere;
use App\Models\Platform\StudentPaintingAnswer;
use App\Models\Platform\Video;
use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends NadsoftBaseCotroller
{
    public function __construct()
    {
        $this->nameSlug = 'students';
    }

    public function index()
    {
        $dataTableRequest = [
            'nameSlug' => $this->nameSlug,
            'data' => [
                'modelName' => 'Teacher.TeacherStudent',
                'searchCol' => 'name',
                'relationships' => [
                    'books' => 'grade.books,title,multiple,<br>'
                ]
            ],
            'columns' => ['name', 'id_no', 'books'],
            'id' => 'users-datatable',
        ];
        $grid = User::renderGrid($dataTableRequest);
        return view('admin.general.index')->with([
            'nameSlug' => $this->nameSlug,
            'grid' => $grid
        ]);
    }

    public function performance(Request $request, $book_id)
    {
        $digitalBook = DigitalBook::find($book_id);
        $bookContents = BookContent::where([
            'book_id' => $digitalBook->id,
            'page_type' => 'exercise'
        ])->get();
        return view('admin.teachers.performance')->with([
            'contents' => $bookContents
        ]);
    }

    public function bookContentExams(Request $request, $book_content_id)
    {
        $bookContent = BookContent::findOrFail($book_content_id);
        if ($bookContent->table_name == 'multiple_choices') {
            $book_content_id = $this->correctMultipleChoicesId($bookContent);
        }
        $studentsExam = StudentExam::where([
            'book_content_id' => $book_content_id,
            'status' => 'completed'
        ])->whereHas('user', function ($q) {
            $q->where('grade_id', auth('teacher')->user()->grade->id);
        })->get();
        return view('admin.teachers.exams')->with([
            'exams' => $studentsExam,
            'bookContent' => $bookContent,
        ]);
    }

    public function stduentAnswer(Request $request, $book_content_id, $student_id)
    {
        $bookContent = BookContent::findOrFail($book_content_id);
        if ($bookContent->table_name == 'multiple_choices') {
            $book_content_id = $this->correctMultipleChoicesId($bookContent);
        }
        $studentExam = StudentExam::where([
            'book_content_id' => $book_content_id,
            'user_id' => $student_id,
        ])->firstOrFail();
        $result = $this->getStudentAnswer($studentExam);
        return view('admin.teachers.student-answer')->with([
            'examType' => $studentExam->type,
            'bookContent' => $bookContent,
            'result' => $result
        ]);
    }

    private function correctMultipleChoicesId(BookContent $bookContent)
    {
        $is_video = Video::where('multiple_choices_id', $bookContent->id)->get()->first();
        $is_story = Story::where('multiple_choices_id', $bookContent->id)->get()->first();
        if ($is_video) {
            $book_content_id = $is_video->book_content_id;
        }
        if ($is_story) {
            $book_content_id = $is_story->book_content_id;
        }

        return $book_content_id;
    }

    private function getStudentAnswer(StudentExam $studentExam)
    {
        switch ($studentExam->type) {
            case 'puzzles':
                $result = true;
                break;
            case 'matching_words_to_sentences':
                $result = $this->getMatchSentencesAnswer($studentExam->id);
                break;
            case 'matching_words_to_images':
                $result = $this->getMatchImagesAnswer($studentExam->id);
                break;
            case 'memory_game':
                $result = $this->getMemoryGameAnswer($studentExam->id);
                break;
            case 'painting_images':
                $result = $this->getPaintGameAnswer($studentExam->id);
                $type = 'image';
                break;
            case 'drawing':
                $result = $this->getDrawingGameAnswer($studentExam->id);
                $type = 'image';
                break;
            case 'suitable_words':
                $result = $this->getSuitableExamAnswer($studentExam->id);
                break;
            case 'videos':
                $result = $this->getMultipleExamAnswer($studentExam->id);
                break;
            case 'story':
                $result = $this->getMultipleExamAnswer($studentExam->id);
                break;
        }
        return $result;
    }

    private function getPaintGameAnswer($student_exam_id)
    {
        $answer = StudentPaintingAnswer::where('student_exam_id', $student_exam_id)->firstOrFail();
        return $answer->image;
    }

    private function getDrawingGameAnswer($student_exam_id)
    {
        $answer = StudentDrawingAnswer::where('student_exam_id', $student_exam_id)->firstOrFail();
        return $answer->image;
    }

    private function getMemoryGameAnswer($student_exam_id)
    {
        $answer = StudentMemoryAnswere::where('student_exam_id', $student_exam_id)->firstOrFail();
        return [
            'attempts' => $answer->attempts,
            'time' => $answer->time,
        ];
    }

    private function getMatchSentencesAnswer($student_exam_id)
    {
        $studentExam = StudentExam::find($student_exam_id);
        $answers = $studentExam->matchSentencesAnswers;

        return [
            'result' => $studentExam->mark . ' / ' . $studentExam->total,
            'answers' => $answers,
        ];
    }

    private function getMatchImagesAnswer($student_exam_id)
    {
        $studentExam = StudentExam::find($student_exam_id);
        $answers = $studentExam->matchImagesAnswers;

        return [
            'result' => $studentExam->mark . ' / ' . $studentExam->total,
            'answers' => $answers,
        ];
    }

    private function getSuitableExamAnswer($student_exam_id)
    {
        $studentExam = StudentExam::find($student_exam_id);
        $answers = $studentExam->suitableWordsAnswers;

        return [
            'result' => $studentExam->mark . ' / ' . $studentExam->total,
            'answers' => $answers,
        ];
    }

    private function getMultipleExamAnswer($student_exam_id)
    {
        $studentExam = StudentExam::find($student_exam_id);
        $answers = $studentExam->multipleChoiceAnswers;

        return [
            'result' => $studentExam->mark . ' / ' . $studentExam->total,
            'answers' => $answers,
        ];
    }
}

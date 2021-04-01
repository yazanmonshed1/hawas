<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DigitalBook;
use App\Models\Platform\BookContent;
use App\Models\Platform\Chapter;
use App\Models\Platform\LastPageEntered;
use App\Models\Platform\MatchImage;
use App\Models\Platform\MatchWordToSentence;
use App\Models\Platform\MemoryGame;
use App\Models\Platform\PaintImage;
use App\Models\Platform\Puzzle;
use App\Models\Platform\ShapeDrawing;
use App\Models\Platform\Story;
use App\Models\Platform\StudentExam;
use App\Models\Platform\StudentMatchImagesAnswer;
use App\Models\Platform\StudentMatchWordsAnsweres;
use App\Models\Platform\StudentMultipleChoiceAnswer;
use App\Models\Platform\StudentSuitableWordsAnsweres;
use App\Models\Platform\SuitableWords;
use App\Models\Platform\Video;
use App\Models\Platform\WordWallExam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ActivitiesController extends Controller
{
    public function chapterContents(Request $request, $book_id, $chapter_id)
    {
        $digitalBook = auth()->user()->grade->books()->where('digital_books.id', $book_id)->firstOrFail();
        $chapter = $digitalBook->chapters()->where('id', $chapter_id)->firstOrFail();
        return view('student.activity.book-activities')->with(compact('digitalBook', 'chapter'));
    }

    public function index(Request $request, $book_id, $chapter_id = null, $activity_id = null)
    {
        $digitalBook = auth()->user()->grade->books()->where('digital_books.id', $book_id)->firstOrFail();

        $chapter = $chapter_id ? $digitalBook->chapters()->where('id', $chapter_id)->firstOrFail() : $digitalBook->chapters()->first();


        if (!$activity_id) {
            return redirect()->route('chapter-contents', ['book_id' => $book_id, 'chapter_id' => $chapter->id]);
        }

        // Activity
        $activity = $chapter->contents()->where('id', $activity_id)->get()->first();

        $chapter_id = $chapter->id;

        // Return not found if no activity
        if ($activity instanceof RedirectResponse) {
            return $activity;
        }

        // Multiple choices are related to videos, So it will not show
        if ($activity->table_name == 'multiple_choices') {
            throw new NotFoundHttpException();
        }

        // Last activity viewed
        $lastPageEntered = LastPageEntered::where(['user_id' => auth()->user()->id])->first();
        $pageData = null;
        if ($lastPageEntered) {
            $pageData = [
                'title' => $lastPageEntered->book->title,
                'subtitle' => $lastPageEntered->bookContent->title,
                'page_number' => $lastPageEntered->bookContent->page_number,
                'image' => $lastPageEntered->book->cover_image
            ];
        }
        $this->setLastPageEntered($activity);

        // Get activity data
        $activityData = $this->getActivityView($activity);

        // Get next and previous activity id
        $navigations = $this->geActivityNavigations($activity, $chapter, $digitalBook->id);

        // If exam create the exam
        $exam = $this->checkIfExamInit($activity);

        return view('student.activity.index')->with(compact('digitalBook', 'activityData', 'pageData', 'exam', 'navigations', 'chapter_id'));
    }

    public function noContent($book_id, $chapter_id)
    {
        dd($book_id);
        dd($chapter_id);
        $digitalBook = DigitalBook::findOrFail($book_id);
        return view('student.activity.no-content')->with(compact('digitalBook'));
    }

    private function geActivityNavigations($activity, $chapter, $digital_book_id)
    {
        $current_page_number = $activity->page_number;
        $next_page = $current_page_number + 1;
        $previous_page = $current_page_number - 1;

        $nextBookContent = $chapter->contents()->where('page_number', $next_page)->get()->first();
        $previousBookContent = $chapter->contents()->where('page_number', $previous_page)->get()->first();
        return [
            'next' => $nextBookContent ? $this->makeNavigationLink($digital_book_id, $chapter->id, $nextBookContent->id) : null,
            'previous' => $previousBookContent ? $this->makeNavigationLink($digital_book_id, $chapter->id, $previousBookContent->id) : null,
        ];
    }

    private function getFirstActivity(Chapter $chapter, $digital_book_id)
    {
        $activity = $chapter->contents()->orderBy('page_number', 'ASC')->get()->first();
        if (!$activity) {
            return Redirect::route('book.no-content', ['book_id' => $digital_book_id, 'chapter_id' => $chapter->id]);
        }
        return Redirect::route('book-activity', ['book_id' => $digital_book_id, 'chapter_id' => $chapter->id, 'activity_id' => $activity->id]);
    }

    private function makeNavigationLink($digital_book_id, $chapter_id, $activity_id)
    {
        return route('book-activity', ['book_id' => $digital_book_id, 'chapter_id' => $chapter_id, 'activity_id' => $activity_id]);
    }

    private function getActivityView(BookContent $activity)
    {
        switch ($activity->table_name) {
            case 'matching_words_to_images':
                $viewName = 'exercises.match-words-to-images';
                $content = MatchImage::where('book_content_id', $activity->id)->get();
                break;
            case 'matching_words_to_sentences':
                $viewName = 'exercises.match-words-to-sentences';
                $content = MatchWordToSentence::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'memory_game':
                $viewName = 'exercises.memory-game';
                $content = MemoryGame::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'painting_images':
                $viewName = 'exercises.paint-image';
                $content = PaintImage::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'puzzles':
                $viewName = 'exercises.puzzle';
                $content = Puzzle::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'drawing':
                $viewName = 'exercises.shapes-drawing';
                $content = ShapeDrawing::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'suitable_words':
                $viewName = 'exercises.suitable-words';
                $content = SuitableWords::where('book_content_id', $activity->id)->get()->first()->sentences[0];
                break;
            case 'story':
                $viewName = 'lessons.story';
                $content = Story::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'videos':
                $viewName = 'lessons.video';
                $content = Video::where('book_content_id', $activity->id)->get()->first();
                break;
            case 'wordwall_exam':
                $viewName = 'lessons.wordwall-exam';
                $content = WordWallExam::where('book_content_id', $activity->id)->get()->first();
                break;
        }

        return isset($viewName) ? [
            'viewName' => $viewName,
            'activity' => $content,
            'bookContent' => $activity
        ] : null;
    }

    private function setLastPageEntered(BookContent $activity): void
    {
        $lastPageEntered = LastPageEntered::where(['user_id' => auth()->user()->id])->get()->first();
        if ($lastPageEntered) {
            $lastPageEntered->fill([
                'user_id' => auth()->user()->id,
                'book_id' => $activity->book->id,
                'book_content_id' => $activity->id
            ])->save();
        } else {
            $lastPageEntered = new LastPageEntered();
            $lastPageEntered->user_id = auth()->user()->id;
            $lastPageEntered->book_id = $activity->book->id;
            $lastPageEntered->book_content_id = $activity->id;
            $lastPageEntered->save();
        }
    }

    private function checkIfExamInit(BookContent $activity)
    {

        $exam = null;
        if (in_array($activity->table_name, config('enums.exam_types')) && $activity->table_name != 'videos') {
            return $this->initExam($activity);
        }

        if ($activity->table_name == 'videos' || $activity->table_name == 'story') {
            return $this->initStoryOrVideoExam($activity);
        }
        return $exam;
    }

    private function initStoryOrVideoExam(BookContent $activity)
    {
        $model = $activity->table_name == 'videos' ? new Video() : new Story();
        $data = $model->where('book_content_id', $activity->id)->get()->first();
        if ($data->multipleChoices) {
            return $this->initExam($activity);
        }
    }

    private function initExam(BookContent $bookContent)
    {
        $exam = StudentExam::firstOrNew(['user_id' => auth()->user()->id, 'book_content_id' => $bookContent->id]);
        if (!$exam->exists || (!$exam->exists && $bookContent->multiple_choices_id)) {
            $exam = new StudentExam();
            $exam->user_id = auth()->user()->id;
            $exam->book_content_id = $bookContent->id;
            $exam->type = $bookContent->table_name;
            $exam->status = 'initial';
            $exam->save();
            $this->createNullAnswers($exam);
            $exam->status = 'in_progress';
            $exam->save();
        }
        return $exam;
    }

    /**
     * suitable_words
     * multiple_choices
     * drawing
     * painting_images
     * matching_words_to_images
     * matching_words_to_sentence 
     */
    private function createNullAnswers(StudentExam $exam)
    {
        switch ($exam->type) {
            case 'suitable_words':
                $questions = SuitableWords::where('book_content_id', $exam->book_content_id)->get()->first()->sentences;
                foreach ($questions as $question) {
                    $studentSuitableWordsAnswere = new StudentSuitableWordsAnsweres();
                    $studentSuitableWordsAnswere->question_id = $question->id;
                    $studentSuitableWordsAnswere->answer_id = null;
                    $studentSuitableWordsAnswere->student_exam_id = $exam->id;
                    $studentSuitableWordsAnswere->save();
                }
                break;
            case 'matching_words_to_sentences':
                $questions = MatchWordToSentence::where('book_content_id', $exam->book_content_id)->get()->first()->items;
                foreach ($questions as $question) {
                    $studentSuitableWordsAnswere = new StudentMatchWordsAnsweres();
                    $studentSuitableWordsAnswere->question_id = $question->id;
                    $studentSuitableWordsAnswere->answer_id = null;
                    $studentSuitableWordsAnswere->student_exam_id = $exam->id;
                    $studentSuitableWordsAnswere->save();
                }
                break;
            case 'matching_words_to_images':
                $questions = MatchImage::where('book_content_id', $exam->book_content_id)->get();
                foreach ($questions as $question) {
                    $studentSuitableWordsAnswere = new StudentMatchImagesAnswer();
                    $studentSuitableWordsAnswere->question_id = $question->id;
                    $studentSuitableWordsAnswere->answer_id = null;
                    $studentSuitableWordsAnswere->student_exam_id = $exam->id;
                    $studentSuitableWordsAnswere->save();
                }
                break;
            case 'videos':
                $multipleChoices = Video::where('book_content_id', $exam->book_content_id)->get()->first()->multipleChoices;
                if ($multipleChoices) {
                    foreach ($multipleChoices->multipleChoicesQuestions as $question) {
                        $studentSuitableWordsAnswere = new StudentMultipleChoiceAnswer();
                        $studentSuitableWordsAnswere->question_id = $question->id;
                        $studentSuitableWordsAnswere->answer_id = null;
                        $studentSuitableWordsAnswere->student_exam_id = $exam->id;
                        $studentSuitableWordsAnswere->save();
                    }
                }
                break;
            case 'story':
                $multipleChoices = Story::where('book_content_id', $exam->book_content_id)->get()->first()->multipleChoices;
                if ($multipleChoices) {
                    foreach ($multipleChoices->multipleChoicesQuestions as $question) {
                        $studentSuitableWordsAnswere = new StudentMultipleChoiceAnswer();
                        $studentSuitableWordsAnswere->question_id = $question->id;
                        $studentSuitableWordsAnswere->answer_id = null;
                        $studentSuitableWordsAnswere->student_exam_id = $exam->id;
                        $studentSuitableWordsAnswere->save();
                    }
                }
                break;
        }
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Platform\MultipleChoiceAnswer;
use App\Models\Platform\StudentDrawingAnswer;
use App\Models\Platform\StudentExam;
use App\Models\Platform\StudentMatchImagesAnswer;
use App\Models\Platform\StudentMatchWordsAnsweres;
use App\Models\Platform\StudentMemoryAnswere;
use App\Models\Platform\StudentPaintingAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralExamsController extends Controller
{
    public function finishExam(Request $request, $student_exam_id)
    {
        $studentExam = StudentExam::findOrFail($student_exam_id);
        switch ($studentExam->type) {
            case 'puzzles':
                $result = $this->handlePuzzleFinished($studentExam);
                break;
            case 'matching_words_to_sentences':
                $result = $this->handleMatchSentencesFinished($studentExam, $request->data);
                break;
            case 'matching_words_to_images':
                $result = $this->handleMatchImagesFinished($studentExam, $request->data);
                break;
            case 'memory_game':
                $result = $this->handleMemoryGameFinished($studentExam, $request->data);
                break;
            case 'painting_images':
                $result = $this->handlePaintGameFinished($studentExam, $request->data);
                break;
            case 'drawing':
                $result = $this->handleDrawingGameFinished($studentExam, $request->data);
                break;
            case 'suitable_words':
                $result = $this->handleSuitableExamFinished($studentExam);
                break;
            case 'videos':
                $result = $this->handleMultipleExamFinished($studentExam);
                break;
            case 'story':
                $result = $this->handleMultipleExamFinished($studentExam);
                break;
        }

        return $result;
    }

    private function handlePuzzleFinished(StudentExam $studentExam)
    {
        $studentExam->status = 'completed';
        $studentExam->mark = 1;
        $studentExam->total = 1;
        $studentExam->save();
        return response()->json([
            'success' => true
        ]);
    }

    private function handleMatchSentencesFinished(StudentExam $studentExam, $data)
    {
        $total = $studentExam->matchSentencesAnswers->count();
        $correct = 0;
        foreach ($data as $dataItem) {
            $studentAnswer = StudentMatchWordsAnsweres::where(['question_id' => $dataItem['key']])->get()->first();
            $studentAnswer->answer_id = $dataItem['val'];
            $studentAnswer->save();
            if ($dataItem['val'] == $studentAnswer->question_id) {
                $correct += 1;
            }
        }
        $studentExam->mark = $correct;
        $studentExam->total = $total;
        $studentExam->status = 'completed';
        $studentExam->save();
        $result = $studentExam->mark . ' / ' . $studentExam->total;
        return response()->json([
            'html' => view('student.activity.components.result')->with('result', $result)->render()
        ]);
    }

    private function handleMatchImagesFinished(StudentExam $studentExam, $data)
    {
        $total = $studentExam->matchImagesAnswers->count();
        $correct = 0;
        foreach ($data as $dataItem) {
            $studentAnswer = StudentMatchImagesAnswer::where(['question_id' => $dataItem['key']])->get()->first();
            $studentAnswer->answer_id = $dataItem['val'];
            $studentAnswer->save();
            if ($dataItem['val'] == $studentAnswer->question_id) {
                $correct += 1;
            }
        }
        $studentExam->mark = $correct;
        $studentExam->total = $total;
        $studentExam->status = 'completed';
        $studentExam->save();
        $result = $studentExam->mark . ' / ' . $studentExam->total;
        return response()->json([
            'html' => view('student.activity.components.result')->with('result', $result)->render()
        ]);
    }

    private function handleMemoryGameFinished(StudentExam $studentExam, $data)
    {
        $studentAnswer = StudentMemoryAnswere::firstOrNew(['student_exam_id' => $studentExam->id]);
        if (!$studentAnswer->exists) {
            $studentAnswer->attempts = $data['attempts'];
            $studentAnswer->time = $data['time'];
            $studentAnswer->save();
            $studentExam->mark = 1;
            $studentExam->total = 1;
            $studentExam->status = 'completed';
            $studentExam->save();
        }
        return response()->json([
            'success' => true
        ]);
    }

    private function handlePaintGameFinished($studentExam, $data)
    {
        $imagePath = $this->uploadImage($data['image']);
        $studentAnswer = StudentPaintingAnswer::firstOrNew(['student_exam_id' => $studentExam->id]);
        $studentAnswer->image = $imagePath;
        $studentAnswer->save();
        $studentExam->status = 'completed';
        $studentExam->save();
        return response()->json([
            'image' => asset('storage/' . $imagePath)
        ]);
    }

    private function handleDrawingGameFinished($studentExam, $data)
    {
        $imagePath = $this->uploadImage($data['image']);
        $studentAnswer = StudentDrawingAnswer::firstOrNew(['student_exam_id' => $studentExam->id]);
        $studentAnswer->image = $imagePath;
        $studentAnswer->save();
        $studentExam->status = 'completed';
        $studentExam->save();
        return response()->json([
            'image' => asset('storage/' . $imagePath)
        ]);
    }

    private function handleSuitableExamFinished(StudentExam $exam)
    {
        $total = $exam->suitableWordsAnswers->count();
        $mark = 0;
        foreach ($exam->suitableWordsAnswers as $answer) {
            if ($answer->answer->is_correct) {
                $mark += 1;
            }
        }
        $exam->status = 'completed';
        $exam->total = $total;
        $exam->mark = $mark;
        $exam->save();
        $result = $exam->mark . ' / ' . $exam->total;
        return response()->json([
            'html' => view('student.activity.components.result')->with('result', $result)->render()
        ]);
    }

    private function handleMultipleExamFinished(StudentExam $exam)
    {
        $total = $exam->multipleChoiceAnswers->count();
        $mark = 0;
        foreach ($exam->multipleChoiceAnswers as $studentAnswer) {
            $answer = MultipleChoiceAnswer::find($studentAnswer->answer_id);
            if ($answer && $answer->is_correct) {
                $mark += 1;
            }
        }
        $exam->status = 'completed';
        $exam->total = $total;
        $exam->mark = $mark;
        $exam->save();
        $result = $exam->mark . ' / ' . $exam->total;
        return response()->json([
            'html' => view('student.activity.components.result')->with('result', $result)->render()
        ]);
    }

    private function uploadImage($base64_image)
    {
        $extension = explode('/', mime_content_type($base64_image))[1];

        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);

            $data = base64_decode($data);
            $fileName = 'student/answers/' . time() .  '.' . $extension;
            Storage::disk('public')->put($fileName, $data);
        }

        return $fileName;
    }
}

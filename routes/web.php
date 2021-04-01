<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// dd(Hash::make('12345678'));

Auth::routes();


Route::get('/', 'HomeController@index');
Route::get('about', 'HomeController@about')->name('about');
Route::get('library/{type}', 'LibraryController@index')->name('library');
Route::get('library/text/{slug}', 'LibraryController@textBook')->name('library.text.show');
Route::get('channel', 'ChannelController@index')->name('channel.index');
Route::get('search', 'SearchController@index')->name('search');

Route::resource('contact', 'ContactUsController')->only(['index', 'store']);
Route::resource('blogs', 'BlogsController')->only(['index', 'show']);
Route::resource('programs', 'ProgramsController')->only(['index', 'show']);
Route::resource('plays', 'PlaysController')->only(['index', 'show']);
Route::resource('films', 'FilmsController')->only(['index', 'show']);

Route::get('my-books', 'Student\\WelcomeController@index')->name('my-books');
Route::get('my-books/{book_id}/{chapter_id}', 'Student\\ActivitiesController@chapterContents')->name('chapter-contents');
Route::get('my-books/{book_id}/{chapter_id?}/{activity_id?}', 'Student\\ActivitiesController@index')->name('book-activity');
Route::get('my-books/no-content/{book_id}/{chapter_id}', 'Student\\ActivitiesController@noContent')->name('book.no-content');

// Suitable Exams
Route::post('suitable/answer/{student_exam_id}/{question_id}/{answer_id}', 'Student\\SuitableExamsController@answerQuestion')->name('answer-question');
Route::get('suitable/get-question/{student_exam_id}/{question_id?}/{type?}/{q_no?}', 'Student\\SuitableExamsController@getQuestion')->name('next-question');

// Multiple 
Route::post('multiple/answer/{student_exam_id}/{question_id}/{answer_id}/{q_no}', 'Student\\MultipleChoiceExamsController@answerQuestion');
Route::get('multiple/get-question/{student_exam_id}/{question_id?}/{type?}/{q_no?}', 'Student\\MultipleChoiceExamsController@getQuestion');

// Finish Exams
Route::post('finish-exam/{student_exam_id}', 'Student\\GeneralExamsController@finishExam')->name('finish-exam');

Route::get('profile', 'Student\\ProfileController@show')->name('profile');
Route::get('profile/save', 'Student\\ProfileController@save')->name('profile.save');
Route::post('profile/update-image', 'Student\\ProfileController@updateUserImage')->name('profile.update-image');
Route::get('profile/remove-image', 'Student\\ProfileController@removeUserImage')->name('profile.remove-image');

Route::get('activity/questions', function (\Illuminate\Http\Request $request) {
    return view('student.activity.questions')
        ->with('question', $request->question);
})->name('activity.questions');


Route::get('language/{lang}', 'LanguageController@ChangeLanguage')->name('language');

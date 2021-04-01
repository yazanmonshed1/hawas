<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('digital-book/{id}', 'Admin\\Api\\PlatformController@showBook')->middleware('api.superAdmin');
Route::get('digital-book/content/{content_id}', 'Admin\\Api\\PlatformController@getContent')->middleware('api.superAdmin');
Route::get('digital-book/{id}/contents/{chapter_id}', 'Admin\\Api\\PlatformController@showBookContents')->middleware('api.superAdmin');
Route::get('digital-book/{id}/chapters', 'Admin\\Api\\PlatformController@getChapters')->middleware('api.superAdmin');
Route::post('digital-book/chapter/delete/{chapter_id}', 'Admin\\Api\\PlatformController@removeChapter')->middleware('api.superAdmin');
Route::post('digital-book/{id}/add-chapter', 'Admin\\Api\\PlatformController@addChapter')->middleware('api.superAdmin');
Route::post('digital-book/contents/delete', 'Admin\\Api\\PlatformController@deleteBookContents')->middleware('api.superAdmin');
Route::post('digital-book/contents-reorder', 'Admin\\Api\\PlatformController@reorderBookContents')->middleware('api.superAdmin');
Route::get('digital-book/{id}/multiple-choices-items', 'Admin\\Api\\PlatformController@getMultipleChoices')->middleware('api.superAdmin');
Route::post('digital-book/upload/image', 'Admin\\Api\\PlatformController@uploadImage')->middleware('api.superAdmin');
Route::post('digital-book/upload/video', 'Admin\\Api\\PlatformController@uploadVideo')->middleware('api.superAdmin');
Route::post('digital-book/upload/audio', 'Admin\\Api\\PlatformController@uploadAudio')->middleware('api.superAdmin');
Route::post('digital-book/ckeditor/upload', 'Admin\\Api\\PlatformController@uploadImageCKEditor');

// Puzzle
Route::post('digital-book/exercise/{id}/puzzle/create/{chapter_id}', 'Admin\\Api\\Exercises\\PuzzlesController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/puzzle/edit/{book_content_id}', 'Admin\\Api\\Exercises\\PuzzlesController@update')->middleware('api.superAdmin');

// Shape drawing
Route::post('digital-book/exercise/{id}/shape-drawings/create/{chapter_id}', 'Admin\\Api\\Exercises\\ShapeDrawingsController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/shape-drawings/edit/{book_content_id}', 'Admin\\Api\\Exercises\\ShapeDrawingsController@update')->middleware('api.superAdmin');

// Paint images
Route::post('digital-book/exercise/{id}/painting-image/create/{chapter_id}', 'Admin\\Api\\Exercises\\PaintingController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/painting-image/edit/{book_content_id}', 'Admin\\Api\\Exercises\\PaintingController@update')->middleware('api.superAdmin');

// Match words to sentences
Route::post('digital-book/exercise/{id}/match-words-to-sentences/create/{chapter_id}', 'Admin\\Api\\Exercises\\MatchWordsToSentencesController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/match-words-to-sentences/edit/{book_content_id}', 'Admin\\Api\\Exercises\\MatchWordsToSentencesController@update')->middleware('api.superAdmin');

// Match words to images
Route::post('digital-book/exercise/{id}/match-words-to-images/create/{chapter_id}', 'Admin\\Api\\Exercises\\MatchWordsToImagesController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/match-words-to-images/edit/{book_content_id}', 'Admin\\Api\\Exercises\\MatchWordsToImagesController@update')->middleware('api.superAdmin');

// Multiple choices
Route::post('digital-book/exercise/{id}/multiple-choices/create/{chapter_id}', 'Admin\\Api\\Exercises\\MultipleChoicesController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/multiple-choices/edit/{book_content_id}', 'Admin\\Api\\Exercises\\MultipleChoicesController@update')->middleware('api.superAdmin');

Route::post('digital-book/exercise/{id}/memory-game/create/{chapter_id}', 'Admin\\Api\\Exercises\\MemoryGamesController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/memory-game/edit/{book_content_id}', 'Admin\\Api\\Exercises\\MemoryGamesController@update')->middleware('api.superAdmin');

Route::post('digital-book/exercise/{id}/suitable-words/create/{chapter_id}', 'Admin\\Api\\Exercises\\SuitableWordsController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/suitable-words/edit/{book_content_id}', 'Admin\\Api\\Exercises\\SuitableWordsController@update')->middleware('api.superAdmin');

// WordWall Exams
Route::post('digital-book/exercise/{id}/wordwall-exam/create/{chapter_id}', 'Admin\\Api\\Exercises\\WordWallExamsController@store')->middleware('api.superAdmin');
Route::post('digital-book/exercise/wordwall-exam/edit/{book_content_id}', 'Admin\\Api\\Exercises\\WordWallExamsController@update')->middleware('api.superAdmin');

// Lessons
Route::post('digital-book/lesson/{id}/story/create/{chapter_id}', 'Admin\\Api\\Lessons\\StoriesController@store')->middleware('api.superAdmin');
Route::post('digital-book/lesson/story/edit/{book_content_id}', 'Admin\\Api\\Lessons\\StoriesController@edit')->middleware('api.superAdmin');

Route::post('digital-book/lesson/{id}/video/create/{chapter_id}', 'Admin\\Api\\Lessons\\VideosController@store')->middleware('api.superAdmin');
Route::post('digital-book/lesson/video/edit/{book_content_id}', 'Admin\\Api\\Lessons\\VideosController@edit')->middleware('api.superAdmin');

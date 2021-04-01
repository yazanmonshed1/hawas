<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/01/21
 * Time: 04:31 م
 */

use Illuminate\Support\Facades\Route;

return [
    Route::get('messages', 'MessagesController@index')->middleware('auth:admin')->name('messages.index'),
    Route::resource('sliders', 'SlidersController')->middleware('auth:admin'),
    Route::resource('blogs', 'BlogsController')->middleware('auth:admin'),
    Route::resource('about-us-collapses', 'CollapsesController')->middleware('auth:admin'),
    Route::post('about-update', 'CollapsesController@updateAboutUsSettings')->middleware('auth:admin')->name('about.update'),

    // Users
    Route::resource('users', 'UsersController')->middleware('auth:admin'),
    
    Route::post('create-for-part', 'CollapsesController@createForPart')->middleware('auth:admin')->name('collapses.create-for-part'),
    Route::put('update-for-part/{id}', 'CollapsesController@updateForPart')->middleware('auth:admin')->name('collapses.update-for-part'),
    Route::resource('galleries', 'GalleriesController')->middleware('auth:admin'),
    Route::resource('text-books', 'TextBooksController')->middleware('auth:admin'),
    Route::post('text-books/{id}/part', 'TextBooksController@addBookPart')->middleware('auth:admin')->name('add-book-part'),
    Route::get('text-books/{id}/build', 'TextBooksController@buildBookForm')->middleware('auth:admin')->name('text-books.build'),
    Route::put('text-books/{id}/build', 'TextBooksController@buildBook')->middleware('auth:admin')->name('text-books.build'),
    Route::post('text-books/{id}/add-part', 'TextBooksController@addBookPart')->middleware('auth:admin')->name('text-books.add-part'),
    Route::resource('programs', 'ProgramsController')->middleware('auth:admin'),
    Route::resource('text-book-parts', 'TextBookPartsController')->middleware('auth:admin'),
    Route::resource('digital-books', 'DigitalBooksController')->middleware('auth:admin'),
    Route::resource('schools', 'SchoolsController')->middleware('auth:admin'),
    Route::get('add-books/{id}', 'SchoolsController@addBooks')->middleware('auth:admin')->name('schools-book.build'),
    Route::resource('grades', 'GradesController')->middleware('auth:admin'),
    Route::resource('plays', 'PlaysController')->middleware('auth:admin'),
    Route::get('channel-manager', 'NadConsole\DashboardController@channelManagerIndex')->middleware('auth:admin')->name('channel-manager.index'),
    Route::get('channel-manager/fetch', 'NadConsole\DashboardController@channelManagerFetch')->middleware('auth:admin')->name('channel-manager.fetch'),
    Route::post('channel-manager/save', 'NadConsole\DashboardController@channelManagerSave')->middleware('auth:admin')->name('channel-manager.save'),

    // secretary
    Route::get('secretary/grades/{user_id}', 'Secretary\\GradesController@index')->middleware('auth:admin')->name('secretary.grades.index'),
    Route::post('secretary/grades', 'Secretary\\GradesController@store')->middleware('auth:admin')->name('secretary.grades.store'),
    Route::put('secretary/grades/{user_id}', 'Secretary\\GradesController@update')->middleware('auth:admin')->name('secretary.grades.update'),
    Route::get('secretary/books', 'Secretary\\BooksController@index')->middleware('auth:admin')->name('secretary.books.index'),
    Route::resource('secretary/teachers', 'Secretary\\TeachersController')->middleware('auth:admin'),

    // Admin
    Route::get('profile', 'ProfileController@index')->middleware('auth:admin')->name('profile.index'),
    Route::put('profile/update', 'ProfileController@update')->middleware('auth:admin')->name('profile.update'),

    // Teacher
    Route::get('teacher/students', 'Teacher\\StudentsController@index')->middleware('auth:teacher')->name('teachers.students.index'),
    Route::get('teacher/students/performance/{book_id}', 'Teacher\\StudentsController@performance')->middleware('auth:teacher')->name('teachers.students.performance'),
    Route::get('teacher/students/book-content-exams/{book_content_id}', 'Teacher\\StudentsController@bookContentExams')->middleware('auth:teacher')->name('teachers.students.exams'),
    Route::get('teacher/students/student-answer/{book_content_id}/{student_id}', 'Teacher\\StudentsController@stduentAnswer')->middleware('auth:teacher')->name('teachers.students.answers'),
    Route::get('teacher/profile', 'Teacher\\ProfileController@index')->middleware('auth:teacher')->name('teacher.profile.index'),
    Route::put('teacher/profile/update', 'Teacher\\ProfileController@update')->middleware('auth:teacher')->name('teacher.profile.update'),

    // Platform
    Route::get('digital-books/{id}/{path?}', 'Api\\PlatformController@index')->middleware('auth:admin')->name('digital-books.build')->where('path', '.*'),


];

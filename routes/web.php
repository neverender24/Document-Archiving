<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('college','CollegeController');
Route::resource('office','OfficeController');
Route::resource('department','DepartmentController');
Route::resource('category','CategoryController');
Route::resource('drawer','DrawerController');
Route::resource('document','DocumentController');
Route::resource('document.attachment','AttachmentController');
Route::get('document/{document_id}/attachment/{attchement_id}/download','AttachmentController@download')->name('attachment.download');

Route::get('drawers', function(){

	$category_id = \Request::get('category_id');

	$drawers = \App\Drawer::where('category_id', $category_id)->get();

	return $drawers;
});

Route::get('get-offices', function(){

	$offices = \App\Office::all();

	return $offices;
});

Route::get('get-colleges', function(){

	$colleges = \App\College::all();

	return $colleges;
});


Route::get('get-departments', function(){

	$college_id = \Request::get('college_id');

	$dept = \App\Department::where('college_id', $college_id)->get();

	return $dept;
});
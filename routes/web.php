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

Route::get('change-password', function(){
    return view('auth/change');
})->name('change-password');

Route::post('change-password/update', function(){

   $old     = \Request::get('old-password');
   $new     = \Request::get('new-password');
   $confirm = \Request::get('password_confirmation');

    if (!Hash::check($old, \Auth::user()->password))
    {
        \Session::flash('flash_message_delete','Old password incorrect.');
        return view('auth/change-password');
    }

    if($new !== $confirm)
    {
        \Session::flash('flash_message_delete','New password not match with confirm password.');
        return view('auth/change-password');
    }

    $user = App\User::findOrFail( \Auth::user()->id);
    $user->password = bcrypt($new);
    $user->save();
    \Session::flash('flash_message','Password updated.');
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('college','CollegeController');
Route::resource('office','OfficeController');
Route::resource('department','DepartmentController');
Route::resource('category','CategoryController');
Route::resource('drawer','DrawerController');
Route::resource('document','DocumentController');

Route::get('document/{search?}','DocumentController@index')->name('document.search');
Route::get('inbox/{search?}','InboxController@index')->name('inbox.search');

Route::resource('inbox','InboxController');
Route::get('document/{document_id}/sending','InboxController@sending')->name('sending');

Route::get('document/{document_id}/log','InboxController@log')->name('log');

Route::post('document/{document_id}/sent','InboxController@sent')->name('sent');

Route::post('document/{document_id}/receive/{id}','InboxController@receive')->name('receive');

Route::resource('document.attachment','AttachmentController');
Route::get('document/{document_id}/attachment/{attchement_id}/download','AttachmentController@download')->name('attachment.download');

Route::get('drawers', function(){

	$category_id = \Request::get('category_id');

	$drawers = \App\Drawer::where('category_id',$category_id);

	if(!is_null(\Auth::user()->office_id)){
	    $drawers->where('office_id', \Auth::user()->office_id);
	}

	if(!is_null(\Auth::user()->department_id)){
	    $drawers->where('department_id', \Auth::user()->department_id);
	}

	$drawers = $drawers->get();

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

Route::get('noti', function(){

	$inbox = App\Inbox::where('receiver_id', \Auth::user()->id)->where('received_at', '=', NULL)->count();

	return $inbox;
});
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

use Illuminate\Support\Facades\Input;



//Testing

//Route::get('/appliances', function(){
//    return view('threads.TestAppl');
//});

Route::get('report/{id}', 'ReportController@generate')->name('report');

Route::post('/report/{id}', 'ReportController@resolveReport')->name('resolveReport');


//

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send','AboutEmailController@sendEmail',function(){
    return view('about');
})->name('sendEmail');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/profile', function () {
    return view('profile');
});
Route::get('form', function () {
    return View::make('form');
});

Route::any('form-submit', function () {
    var_dump(Input::file('file'));
});

Route::get('/addproperty', function () {
    return view('addproperty');

});
Route::get('maintenance/{id}', function () {
    return view('maintenance');

});
Route::get('expenses/{id}', function () {
    return view('expenses');

});


Auth::routes();

Route::get('/home', 'UserHomeController@myform')->name('home');

Route::get('/userhome', 'UserHomeController@myform')->name('homeUser');

Route::get('manageproperty/{id}', 'ManageProperty@create')->name('manageproperty');

Route::get('managebuilding/{id}', 'ManageBuilding@create')->name('managebuilding');

Route::get('manageunit/{id}', 'ManageUnit@create')->name('manageunit');

Route::get('addbuilding/{id}', 'AddBuildings@create')->name('addbuilding');

Route::get('addunit/{id}', 'AddUnits@create')->name('addunit');

Route::post('addmaintenance/{id}', 'MaintenanceRequest@create')->name('addmaintenance');

Route::get('addexpenses/{id}', 'updateExpenses@create')->name('addexpenses');

Route::get('userhome', 'UserHomeController@myform');

Route::get('viewmaintenance', 'ViewMaintenanceRequests@create')->name('viewmaintenance');

Route::get('/charts', 'ChartController@chart')->name('charts');

Route::post('updatedinterests', 'UserController@updateInterests')->name('updateinterests');

Route::post('updatedcart', 'UserController@updateCart')->name('updateCart');

Route::post('updatedproperty', 'RegisterProperty@updateProperty')->name('updateProperty');

Route::post('updatedbuilding/{id}', 'RegisterBuilding@updateBuilding')->name('updateBuilding');

Route::post('updatedunit/{id}', 'RegisterUnit@updateUnits')->name('updateUnit');

Route::post('updatedrequest/{id}', 'RegisterRequest@updateRequests')->name('updateRequest');

Route::post('updateduser', 'UserHomeController@addUnit')->name('updateUserUnit');

Route::post('select-building', ['as'=>'select-building','uses'=>'UserHomeController@selectBuilding']);

Route::post('select-unit', ['as'=>'select-unit','uses'=>'UserHomeController@selectUnit']);

Route::get('updateMaintenanceRequest/{id}','UpdateMaintenance@changeStatus')->name('updateMaintenanceRequest');

Route::get('/changeProfile', 'ChangeProfile@create')->name('changeProfile');

Route::post('/changeProfile', 'ChangeProfile@up')->name('changeProfilePicture');

Route::get('/userUpdate/{user}', 'ManageUser@create')->name('ManageUserForm');

Route::get('/deleteUser/{user}', 'ManageUser@delete')->name('DeleteUser');

Route::post('/updateUser/{user}', 'updateUser@update')->name('updateUser');

Route::post('/threads/{channel}/{thread}', 'ReplyController@store');

Route::post('/threads','ThreadController@store');

Route::get('/threads/create', 'ThreadController@create');

Route::get('/threads/{channel}/{thread}','ThreadController@show')->name('threads');

Route::get('/threads','ThreadController@index')->name('threads');

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group and "App\Http\Controllers\Api" namespace.
| and "api." route's alias name. Enjoy building your API!
|
*/
Route::post('/register', 'RegisterController@register')->name('sanctum.register');
Route::post('/login', 'LoginController@login')->name('sanctum.login');
Route::post('/firebase/login', 'LoginController@firebase')->name('sanctum.login.firebase');

Route::post('/password/forget', 'ResetPasswordController@forget')->name('password.forget');
Route::post('/password/code', 'ResetPasswordController@code')->name('password.code');
Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.reset');
Route::get('/select/users', 'UserController@select')->name('users.select');

Route::get('verification/verify/{code}', 'VerificationController@verify');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('password', 'VerificationController@password')->name('password.check');
    Route::post('verification/send', 'VerificationController@send')->name('verification.send');
    Route::get('profile', 'ProfileController@show')->name('profile.show');
    Route::match(['put', 'patch'], 'profile', 'ProfileController@update')->name('profile.update');
    Route::post('addaccountbank', 'ProfileController@addaccountbank');
    Route::get('showaccountbank', 'ProfileController@showaccountbank');

    

});
Route::post('/editor/upload', 'MediaController@editorUpload')->name('editor.upload');
Route::get('/settings', 'SettingController@index')->name('settings.index');
Route::get('/settings/pages/{page}', 'SettingController@page')
    ->where('page', 'about|terms|privacy')->name('settings.page');

Route::get('notifications/count', 'NotificationController@count')->name('notifications.count');
Route::middleware('auth:sanctum')->get('notifications', 'NotificationController@index')->name('notifications.index');

Route::post('feedback', 'FeedbackController@store')->name('feedback.send');
/*  The routes of generated crud will set here: Don't remove this line  */

//


// CategoryProvider Routes.
Route::apiResource('categoryprovider', 'CategoryProviderController');


///CategoryPost Routes.
Route::apiResource('categorypost', 'CategoryPostController');


///Posts Routes.
Route::apiResource('posts', 'PostsController');
Route::get('my/posts', 'PostsController@getMyposts');
Route::post('posts/favorite/{post}', 'PostsController@favorite');
Route::get('posts/list/favorite', 'PostsController@list_favorite');

//Home Routes.
Route::apiResource('home', 'HomeController');

//AvailableTime  Routes.
Route::apiResource('availabletime', 'AvailableTimeController');
Route::patch('availabletime/lock/{id}', 'AvailableTimeController@toggleLock');
Route::patch('availabletime/daylock/{id}', 'AvailableTimeController@daylock');
Route::patch('availabletime/dayunlock/{id}', 'AvailableTimeController@dayunlock');


//reservations   Routes.
Route::apiResource('reservations', 'ReservationController');
Route::get('reservations/finish/{id}', 'ReservationController@finish_reservation');

Route::get('paymobverify', 'ReservationController@paymob_payment_verify')->name('paymob');



//Provider routes.

Route::apiResource('providers', 'ProviderController');
Route::post('providers/favorite/{provider}', 'ProviderController@favorite');
Route::get('providers/list/favorite', 'ProviderController@list_favorite');

// Review routes.

Route::apiResource('reviews', 'ReviewController');


//Transaction routes.


Route::apiResource('transactions', 'TransactionController');




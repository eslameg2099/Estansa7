<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "dashboard" middleware group and "App\Http\Controllers\Dashboard" namespace.
| and "dashboard." route's alias name. Enjoy building your dashboard!
|
*/
Route::get('locale/{locale}', 'LocaleController@update')->name('locale')->where('locale', '(ar|en)');

Route::get('/', 'DashboardController@index')->name('home');

// Select All Routes.
Route::delete('delete', 'DeleteController@destroy')->name('delete.selected');
Route::delete('forceDelete', 'DeleteController@forceDelete')->name('forceDelete.selected');
Route::delete('restore', 'DeleteController@restore')->name('restore.selected');

// Customers Routes.
Route::get('trashed/customers', 'CustomerController@trashed')->name('customers.trashed');
Route::get('trashed/customers/{trashed_customer}', 'CustomerController@showTrashed')->name('customers.trashed.show');
Route::post('customers/{trashed_customer}/restore', 'CustomerController@restore')->name('customers.restore');
Route::delete('customers/{trashed_customer}/forceDelete', 'CustomerController@forceDelete')->name('customers.forceDelete');
Route::resource('customers', 'CustomerController');

// Supervisors Routes.
Route::get('trashed/supervisors', 'SupervisorController@trashed')->name('supervisors.trashed');
Route::get('trashed/supervisors/{trashed_supervisor}', 'SupervisorController@showTrashed')->name('supervisors.trashed.show');
Route::post('supervisors/{trashed_supervisor}/restore', 'SupervisorController@restore')->name('supervisors.restore');
Route::delete('supervisors/{trashed_supervisor}/forceDelete', 'SupervisorController@forceDelete')->name('supervisors.forceDelete');
Route::resource('supervisors', 'SupervisorController');


// providers Routes.
Route::resource('providers', 'ProviderController');

Route::get('providers/sendactive/{id}', 'ProviderController@sendactive')->name('providers.sendactive');
Route::get('providers/senddeactive/{id}', 'ProviderController@senddeactive')->name('providers.senddeactive');


Route::post('providers/active', 'ProviderController@active')->name('providers.active');
Route::post('providers/disactive', 'ProviderController@disactive')->name('providers.disactive');
// Admins Routes.
Route::get('trashed/admins', 'AdminController@trashed')->name('admins.trashed');
Route::get('trashed/admins/{trashed_admin}', 'AdminController@showTrashed')->name('admins.trashed.show');
Route::post('admins/{trashed_admin}/restore', 'AdminController@restore')->name('admins.restore');
Route::delete('admins/{trashed_admin}/forceDelete', 'AdminController@forceDelete')->name('admins.forceDelete');
Route::resource('admins', 'AdminController');

// Settings Routes.
Route::get('settings', 'SettingController@index')->name('settings.index');
Route::patch('settings', 'SettingController@update')->name('settings.update');
Route::get('backup/download', 'SettingController@downloadBackup')->name('backup.download');

// Feedback Routes.
Route::get('trashed/feedback', 'FeedbackController@trashed')->name('feedback.trashed');
Route::get('trashed/feedback/{trashed_feedback}', 'FeedbackController@showTrashed')->name('feedback.trashed.show');
Route::post('feedback/{trashed_feedback}/restore', 'FeedbackController@restore')->name('feedback.restore');
Route::delete('feedback/{trashed_feedback}/forceDelete', 'FeedbackController@forceDelete')->name('feedback.forceDelete');
Route::patch('feedback/read', 'FeedbackController@read')->name('feedback.read');
Route::patch('feedback/unread', 'FeedbackController@unread')->name('feedback.unread');
Route::resource('feedback', 'FeedbackController')->only('index', 'show', 'destroy');

/*  The routes of generated crud will set here: Don't remove this line  */


//CategoryProvider routes.
Route::get('trashed/categoryprovider', 'CategoryProviderController@trashed')->name('categoryprovider.trashed');
Route::get('trashed/categoryprovider/{trashed_categoryprovider}', 'CategoryProviderController@showTrashed')->name('categoryprovider.trashed.show');
Route::post('categoryprovider/{trashed_categoryprovider}/restore', 'CategoryProviderController@restore')->name('categoryprovider.restore');
Route::delete('categoryprovider/{trashed_categoryprovider}/forceDelete', 'CategoryProviderController@forceDelete')->name('categoryprovider.forceDelete');
Route::resource('categoryprovider', 'CategoryProviderController');

//categorypost routes.
Route::Resource('categorypost', 'CategoryPostController');
Route::get('categorypost/deactive/{categorypost}', 'CategoryPostController@deactive');
Route::get('categorypost/active/{categorypost}', 'CategoryPostController@active');


// 
//posts routes.
Route::Resource('posts', 'PostController');



///Reservations routes.

Route::Resource('reservations', 'ReservationController');

// Coupons Routes.
Route::get('trashed/coupons', 'CouponController@trashed')->name('coupons.trashed');
Route::get('trashed/coupons/{trashed_coupon}', 'CouponController@showTrashed')->name('coupons.trashed.show');
Route::post('coupons/{trashed_coupon}/restore', 'CouponController@restore')->name('coupons.restore');
Route::delete('coupons/{trashed_coupon}/forceDelete', 'CouponController@forceDelete')->name('coupons.forceDelete');
Route::resource('coupons', 'CouponController');


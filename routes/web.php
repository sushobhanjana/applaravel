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
/*-----------------User route--------------------*/
Route::group(['middleware' => ['web']], function () {
    // your routes here
    //Route::get('/','User\LoginController@user_auth');
});


/*-----------------Business route----------------*/
Route::group(['middleware' => ['business_before_auth']],function(){
	Route::get('business','Business\LoginController@business_auth');
	Route::post('business_authentication','Business\LoginController@business_authentication');
	Route::get('/','Business\RegistrationController@business_registration');
	Route::get('check_business_url','Business\RegistrationController@check_business_url');
	Route::get('check_business_email','Business\RegistrationController@check_business_email');
	Route::post('register_business_data','Business\RegistrationController@register_business_data');
	Route::post('business_forget_password','Business\LoginController@business_forget_password');
	Route::post('check_otp','Business\LoginController@check_otp');
	Route::post('business_reset_password','Business\LoginController@business_reset_password');
});

Route::group(['middleware' => ['business_after_auth']],function(){
	Route::get('business_dashboard','Business\BusinessDashboard@dashboard');
	Route::get('newspost', 'Business\NewsController@newspost');
	Route::post('save_news', 'Business\NewsController@save_news');
	Route::get('newsread', 'Business\NewsController@newsread');
	Route::get('deletenews', 'Business\NewsController@deletenews');
	Route::get('new_poll', 'Business\PollController@new_poll');
	Route::post('save_poll', 'Business\PollController@save_poll');
	Route::post('updatepollform','Business\PollController@updatepollform');
	Route::get('poll_status','Business\PollController@poll_status');
	Route::get('delete_poll_option','Business\PollController@delete_poll_option');
	
	Route::get('business_logout','Business\BusinessDashboard@business_logout');
});


/*-----------------Admin route----------------*/
Route::group(['middleware' => ['admin_before_auth']],function(){
	Route::get('admin','Admin\LoginController@admin_auth');
	Route::post('admin_authentication','Admin\LoginController@superAdminLogin');
});
Route::group(['middleware' => ['admin_after_auth']],function(){
	Route::get('admin_dashboard','Admin\AdminDashboard@admin_dashboard');
	Route::get('admin_widgetaccess/{company_id}','Admin\AdminDashboard@admin_widgetaccess');
	Route::post('admin_widgetaccess','Admin\AdminDashboard@admin_widgetprocess');
	Route::get('admin_companywidgetaccess','Admin\AdminDashboard@admin_companywidgetaccess');
	Route::get('admin_logout','Admin\AdminDashboard@admin_logout');
});

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
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::domain('slim.laravel.com')->group(function () {
    /* betform routing */
    Route::any('/', 'PagesController@main')->name('market_main');
    Route::any('market/bettoday', 'PagesController@secondstep')->name('secondstep');
    Route::any('market/laststep', 'PagesController@laststep')->name('laststep');

});

Route::get('/', 'HomeController@index');
Route::get('/admin/login', 'UserController@adminlogin')->name('adminlogin');
Route::get('/admin/logout', 'UserController@adminlogout')->name('adminlogout');
Route::get('/loginstatus', 'UserController@loginstatus')->name('login-status');
Route::get('/checkuserStatus', 'UserController@checkuserStatus')->name('check-user-status');

Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ga_index', 'HomeController@ga_index')->name('ga_index');
Route::get('/oauth2callback', 'HomeController@oauth2callback')->name('oauth2callback');





Route::post('weighin/{challenge_id}', 'UserPostController@saveWeighIn');

Route::group(['middleware' => ['is_admin'], 'prefix' => 'admin'], function () {

	Route::get('dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('users/reward_list', 'UserController@reward_list')->name('reward_list');
	Route::get('/challenge/listtypes', 'ChallengeController@listtypes')->name('listtypes')
    Route::any('/setting/bannerads', 'BanneradsController@index')->name('bannerads');
    Route::get('/bannerads/edit/{id}', 'BanneradsController@edit')->name('bannerad_edit');
    Route::get('/bannerads/delete/{id}', 'BanneradsController@destroy')->name('delete');
    Route::any('/bannerads/create', 'BanneradsController@create')->name('create');
    Route::any('/bannerads/store', 'BanneradsController@store')->name('store');
    Route::any('/bannerads/update', 'BanneradsController@update')->name('update');

    Route::any('log/index', 'LogActivityController@index')->name('loglist');
    Route::any('log/top_visitors', 'LogActivityController@top_visitors')->name('topvisitors');
    Route::any('log/send_email', 'LogActivityController@send_email')->name('send_email');
    Route::post('log/sendgift', 'LogActivityController@sendgift')->name('sendgift');
    Route::post('blog/saveblogcategory', 'BlogCategoriesController@saveblogcategory')->name('saveblogcategory');
    Route::get('blog/deletecategory/{id}', 'BlogCategoriesController@deletecategory')->name('deletecategory');
    Route::get('/blog/getcategory_details/{id}', 'BlogCategoriesController@getcategory_details')->name('getcategory_details');
    Route::get('/blog/blogcomments/{id}', 'BlogsController@blogcomments')->name('blogcomments');
    Route::post('/blog/update_blogcomment', 'BlogsController@update_blogcomment')->name('updateblogcomment');
    Route::get('blog/deletecomment/{id}', 'BlogsController@deletecomment')->name('deletecomment');
   

    Route::any('pages/privacy', 'PagesController@privacy')->name('admin_privacy');
    Route::any('pages/faq', 'PagesController@faq')->name('admin_faq');
    Route::any('pages/contact-us', 'PagesController@contact_us')->name('admin_contact-us');
    Route::any('pages/addfaq', 'PagesController@addfaq')->name('addfaq');
    Route::any('pages/updatefaq/{id}', 'PagesController@updatefaq')->name('updatefaq');
    Route::any('pages/deletefaq/{id}', 'PagesController@deletefaq')->name('deletefaq');
    Route::any('pages/save_contact_us', 'PagesController@save_contact_us')->name('save_contact_us');
   
    /* Threads/ Forums Routing */
    Route::get('thread/search','ThreadController@search');
    Route::get('thread/tags','ThreadController@tags')->name('tags');
    Route::post('/thread/savetag', 'ThreadController@savetag')->name('savetag');
    Route::get('/thread/deletetag/{id}', 'ThreadController@deletetag')->name('deletetag');
    Route::get('/thread/gettag_details/{id}', 'ThreadController@gettag_details')->name('gettag_details');
    
   
});

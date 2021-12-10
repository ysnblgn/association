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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::namespace('Frontend')->group(function () {
Route::get('/', 'DefaultController@index')->name('home.Index');
//    Route::get('/logout', 'DefaultController@logout')->name('ybadmin.Logout');
//    Route::post('/login', 'DefaultController@authenticate')->name('ybadmin.Authenticate');

    //ACTIVITY
    Route::get('/etkinliklerimiz','ActivityController@index')->name('activity.Index');
    Route::get('/etkinliklerimiz/{slug}','ActivityController@detail')->name('activity.Detail');

    //ABOUT
    Route::get('/hakkimizda','AboutController@index')->name('about.Index');
    Route::get('/hakkimizda/{slug}','AboutController@detail')->name('about.Detail');

    //CONTACT
    Route::get('/iletisim','DefaultController@contact')->name('contact.Detail');
    Route::post('/iletisim','DefaultController@sendMail');

    //FEE
    Route::get('/aidat/{fee}','FeeController@index')->name('fee.Index');
//    Route::get('/etkinliklerimiz/{slug}','ActivityController@detail')->name('activity.Detail');



//    Route::get('/', 'DefaultController@login')->name('dernek.Login')->middleware('CheckLogin');
//    Route::get('/logout', 'DefaultController@logout')->name('ybadmin.Logout');
//    Route::get('/uye-girisi', 'DefaultController@authenticate')->name('ybadmin.Authenticate');




});

Route::namespace('Backend')->group(function () {

    Route::prefix('ybadmin')->group(function () {
        Route::get('/dashboard', 'DefaultController@index')->name('ybadmin.Index')->middleware('admin');
        Route::get('/', 'DefaultController@login')->name('ybadmin.Login')->middleware('CheckLogin');
        Route::get('/logout', 'DefaultController@logout')->name('ybadmin.Logout');
        Route::post('/login', 'DefaultController@authenticate')->name('ybadmin.Authenticate');
        Route::get('/login', 'DefaultController@login')->name('ybadmin.Login')->middleware('CheckLogin');

    });


    Route::middleware(['admin'])->group(function () {
        Route::prefix('ybadmin/settings')->group(function () {
            Route::get('/', 'SettingsController@index')->name('settings.Index');
            Route::post('', 'SettingsController@sortable')->name('settings.Sortable');
            Route::get('/delete/{id}', 'SettingsController@destroy')->name('settings.Destroy');
            Route::get('/edit/{id}', 'SettingsController@edit')->name('settings.Edit');
            Route::post('/{id}', 'SettingsController@update')->name('settings.Update');
        });
    });
});

Route::namespace('Backend')->group(function () {
    Route::prefix('ybadmin')->group(function () {

        Route::middleware(['admin'])->group(function () {

            //ABOUT
            Route::post('/about/sortable', 'AboutController@sortable')->name('about.Sortable');
            Route::resource('about', 'AboutController');

            //ACTIVITY
            Route::post('/activity/sortable', 'ActivityController@sortable')->name('activity.Sortable');
            Route::resource('activity', 'ActivityController');

            //SLIDER
            Route::post('/slider/sortable', 'SliderController@sortable')->name('slider.Sortable');
            Route::resource('slider', 'SliderController');

            //FEE
            Route::post('/fee/sortable', 'FeeController@sortable')->name('fee.Sortable');
            Route::post('/fee/save', 'FeeController@save')->name('fee.save');
            Route::post('/fee/updated', 'FeeController@updated')->name('fee.updated');
            Route::get('/fee/{fee}/edit', 'FeeController@edit')->name('fee.edit');
            Route::get('/fee', 'FeeController@index')->name('fee.index');
            Route::post('/determine', 'FeeController@determine')->name('fee.determine');
            Route::get('/get_determine', 'FeeController@getDetermine')->name('fee.get_determine');

            //USER
            Route::post('/user/sortable', 'UserController@sortable')->name('user.Sortable');
            Route::resource('user', 'UserController');

            //DETERMINE FEE AMOUNT
            Route::post('/determine/sortable', 'DetermineController@sortable')->name('determine.Sortable');


        });
    });
});


Auth::routes();

Route::namespace('Frontend')->group(function () {
    Route::get('/', 'DefaultController@index')->name('home.Index');

});

//Route::get('/home', 'HomeController@index')->name('home');

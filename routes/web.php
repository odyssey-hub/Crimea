<?php

use App\Models\Bid;
use Illuminate\Support\Facades\Route;

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
    return view('main_page');
})->name('main_page');;


Route::get('/routes', function () {
    $routes = \App\Models\Route::orderBy('cost')->get();
    return view('routes', ['routes' => $routes]);
})->name('routes.index');


Route::get('/routes_admin', function () {
    $routes = \App\Models\Route::orderBy('cost')->get();
   return view('routes_admin', ['routes' => $routes]);
})->name('routes.admin');


Route::get('/bids', function (){
    $bids =  Bid::paginate(5);
    return view('bids', ['bids' => $bids]);
})->name('bids.index');

Route::post('/bids/delete', [\App\Http\Controllers\BidsController::class, 'delete']);
Route::post('/add/bids', 'App\Http\Controllers\BidsController@store')->name('bids.store');

Route::post('/routes_admin/add',  [\App\Http\Controllers\RoutesController::class, 'add']);
Route::post('/routes_admin/editInfo', [\App\Http\Controllers\RoutesController::class, 'editInfo']);
Route::post('/routes_admin/savePath', [\App\Http\Controllers\RoutesController::class, 'savePath']);
Route::post('/routes_admin/delete', [\App\Http\Controllers\RoutesController::class, 'delete']);
Route::get('/routes_admin/getData', [\App\Http\Controllers\RoutesController::class, 'getData']);
Route::get('/routes_admin/getPath', [\App\Http\Controllers\RoutesController::class, 'getPath']);


Route::get('/reports', 'App\Http\Controllers\ReportController@index')->name('reports.index');
Route::get('/reports/create', 'App\Http\Controllers\ReportController@create')->name('reports.create');
// Route::get('/reports/show/{id}', 'App\Http\Controllers\ReportController@show')->name('reports.show');
Route::get('/reports/edit/{id}', 'App\Http\Controllers\ReportController@edit')->name('reports.edit');
Route::post('/reports', 'App\Http\Controllers\ReportController@store')->name('reports.store');
Route::get('/reports/download/{id}', 'App\Http\Controllers\ReportController@download')->name('reports.download');
Route::patch('/reports/{id}', 'App\Http\Controllers\ReportController@update')->name('reports.update');
Route::delete('/reports/destroy/{id}', 'App\Http\Controllers\ReportController@destroy')->name('reports.destroy');


Route::get('/calendar', 'App\Http\Controllers\CalendarController@index')->name('calendar.index');
Route::post('/calendar', 'App\Http\Controllers\CalendarController@store')->name('calendar.store');
Route::post('/calendar/edit/{id}', 'App\Http\Controllers\CalendarController@edit')->name('calendar.edit');
Route::post('/calendar/update/{id}', 'App\Http\Controllers\CalendarController@update')->name('calendar.update');
Route::delete('/calendar/destroy/{id}', 'App\Http\Controllers\CalendarController@destroy')->name('calendar.destroy');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

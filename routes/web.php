<?php

use Illuminate\Support\Facades\App;
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

Route::get('/welcome/{lang}', function ($lang) {
    App::setLocale($lang);
    return view('welcome')->with([
        'lang' => $lang
    ]);
})->name('welcome');

Route::get('/', function () {
    return redirect(route('welcome','en'));
});

// remove register option and password reset options and their routes
Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/companies', 'CompanyController');

// we cannot use a route resource, need to manually do the employees
//Route::resource('/employees', 'EmployeeController');
Route::get('/companies/{company}/employees','EmployeeController@index')->name('employees.index');
Route::get('/companies/{company}/employees/create','EmployeeController@create')->name('employees.create');
Route::post('/companies/{company}/employees/store','EmployeeController@store')->name('employees.store');
Route::get('/companies/{company}/employees/{employee}/edit','EmployeeController@edit')->name('employees.edit');
Route::put('/companies/{company}/employees/{employee}/update','EmployeeController@update')->name('employees.update');
Route::delete('/companies/{company}/employees/{employee}/delete','EmployeeController@destroy')->name('employees.destroy');




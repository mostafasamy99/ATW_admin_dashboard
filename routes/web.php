<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

// home route
Route::get('/',[HomeController::class,'home'] );

//lang routes
Route::get('languageConverter/{locale}',function($locale){
    if(in_array($locale,['ar','en'])){
        session()->put('locale',$locale);
    }
    return redirect()->back();
})->name('languageConverter');



Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');



//group routes for admin only
Route::group(['middleware' => ['IsAdminMiddleware']], function ()
{
            //companies routes
            Route::prefix('companies')->name('companies.')->group( function ()
            {

                Route::controller(CompanyController::class)->group( function () {
                    Route::get('/index' , 'index')->name('index');
                    Route::get('/create' , 'create')->name('create');
                    Route::post('/store' , 'store')->name('store');
                    Route::get('/edit/{company}' , 'edit')->name('edit');
                    Route::post('/update/{id}' , 'update')->name('update');
                    Route::get('/delete/{company}' , 'delete')->name('delete');
                });
            }); // End of companies routes

            //companies routes
            Route::prefix('employees')->name('employees.')->group( function ()
            {

                Route::controller(EmployeeController::class)->group( function () {
                    Route::get('/index' , 'index')->name('index');
                    Route::get('/create' , 'create')->name('create');
                    Route::post('/store' , 'store')->name('store');
                    Route::get('/edit/{employee}' , 'edit')->name('edit');
                    Route::post('/update/{id}' , 'update')->name('update');
                    Route::get('/delete/{employee}' , 'delete')->name('delete');
                });
            }); // End of companies routes
});

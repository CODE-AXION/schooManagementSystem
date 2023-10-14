<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AcademicBatchController;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// Route::group([
//     'prefix'     => '/batch/{batch}/class/{class}/section/{section}',
//     'middleware' => \App\Http\Middleware\IdentifyCustomer::class,
//     'name'         => 'class.section.',
// ], function () {
//     // routes here
// });

Route::group(['controller' => RoleController::class,'prefix' => '/roles','as' => 'admin.roles.',], function () {

    Route::get('/create','create')->name('create'); // *Used

    Route::get('/','allRoles')->name('all'); // *Used

    Route::get('/edit/{id}','edit')->name('edit'); // *Used

    Route::post('/store','store')->name('store'); // *Used

    Route::put('/update/{id}','update')->name('update'); // *Used

    Route::delete('/delete/{id}','delete')->name('delete');  // *Used

});


Route::group(['controller' => StudentController::class,'prefix' => '/academics/students','as' => 'academics.students.',], function () {

    Route::get('/create','create')->name('create'); // *Used

    Route::get('/','allStudent')->name('all'); // *Used

    Route::post('/','store')->name('store'); // *Used
    
    Route::get('/edit/{user}','edit')->name('edit'); // *Used

    Route::put('/update/{user}','update')->name('update'); // *Used

    Route::delete('/delete/{user}','delete')->name('delete');  // *Used

});

Route::group(['controller' => AcademicBatchController::class,'prefix' => '/academics/batches','as' => 'academics.batches.',], function () {

    Route::get('/create','create')->name('create'); // *Used

    Route::get('/','allBatches')->name('all'); // *Used

    Route::post('/','store')->name('store'); // *Used
    
    Route::get('/edit/{academicBatch}','edit')->name('edit'); // *Used

    Route::put('/update/{academicBatch}','update')->name('update'); // *Used

    Route::delete('/delete/{academicBatch}','delete')->name('delete');  // *Used

});

require __DIR__.'/auth.php';

<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', [PracticeController::class, 'home']);

Route::get('/time', function () {

    $data = [
        'input' => date("Y-m-d h:i:s A", '1618878474'),
        'max_input' => date("Y-m-d h:i:s A", '1617180621'),
        'current' => date("Y-m-d h:i:s A", time()),
        'extra_time' => '1618878474' - time(),
        'new_time'=> date("Y-m-d h:i:s A", (1618878474 + 17964))
    ];

    return $data;

});

Route::get('/email', function () {
    return view('email.email');
});


Route::post('/email-store', [DashboardController::class, 'emailStore'])->name('emailStore');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/url', [DashboardController::class, 'url']);
Route::get('/test', [DashboardController::class, 'test']);
//Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/test', [DashboardController::class, 'test']);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);


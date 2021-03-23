<?php


use Illuminate\Support\Facades\Config;
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


    $configuration = \App\Models\Provider::whereFromAddress('lemonpatwari@gmail.com')->first();

    if (!is_null($configuration)) {
        $config = array(
//            'MAIL_DRIVER' => $configuration->driver,
//            'MAIL_HOST' => $configuration->host,
//            'MAIL_PORT' => $configuration->port,
//            'MAIL_FROM_ADDRESS' => $configuration->from_address,
//            'MAIL_FROM_NAME' => $configuration->from_name,
//            'MAIL_ENCRYPTION' => $configuration->enccryption,
            'username' => $configuration->from_name,
//            'MAIL_PASSWORD' => $configuration->password,
        );
        Config::set('mail', $config);
    }



    return date("Y-m-d h:i:s A", '1616511060');


});

Route::get('/email', function () {
    return view('email.email');
});


Route::post('/email-store', [DashboardController::class, 'emailStore'])->name('emailStore');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';



Route::get('/url', [DashboardController::class,'url']);
Route::get('/test', [DashboardController::class,'test']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/test', [DashboardController::class, 'test']);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);


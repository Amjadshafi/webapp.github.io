<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SpendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;

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

// Route::get('/test',[LoginRegisterController::class,'test']);

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [LoginRegisterController::class, 'login']);

Route::get('/newForm', function () {
    return view('users.userdashboard');
});
Route::get('login', [LoginRegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');


Route::group(['middleware' => 'auth'], function () {
    Route::controller(LoginRegisterController::class)->group(function () {
        Route::post('/language/change', 'changeLanguage')->name('changeLanguage');
        Route::post('/store', 'store')->name('registerUser');
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::get('language/{locale}', function ($locale) {
        session(['locale' => $locale]); // Store locale in session
        App::setLocale($locale);
        return redirect()->back();
    })->name('language');


    Route::controller(ProjectController::class)->group(function () {
        Route::POST('/projects/store', 'store')->name('createProject');
        Route::patch('{project}/update', 'update')->name('projectUpdate');
        Route::delete('{project}/delete', 'destroy')->name('projectDelete');
    });
    Route::controller(SpendController::class)->group(function () {
        Route::POST('/store/spend', 'store')->name('createSpend');
        Route::put('/spends/{id}', 'update')->name('spendUpdate');
        Route::delete('/spends/{id}', 'destroy')->name('spendDelete');
        Route::POST('/filterData/spends', 'filterReport')->name('filterData.spends');
        Route::Post('/filterData/spends/download-pdf', 'downloadPDF')->name('spendReport.downloadPDF');
        Route::Post('spends/downloadCSV', 'downloadCSV')->name('spendReport.downloadCSV');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::POST('/category/store', 'store')->name('createCategory');
        Route::patch('category/{id}/update', 'update')->name('categoryUpdate');
        Route::DELETE('category/{id}/delete', 'destroy')->name('categoryDelete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::post('/users/store', 'store')->name('createUser');
        Route::patch('/users/{user}', 'update')->name('userUpdate');
        // Route::delete('/users/{id}/delete', 'destroy')->name('userDelete');
    });

});



Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::controller(LoginRegisterController::class)->group(function () {
        // Route::post('/language/change', 'changeLanguage')->name('changeLanguage');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/register', 'register')->name('registerUserForm');
        // Route::post('/store', 'store')->name('registerUser');
        // Route::post('/logout', 'logout')->name('logout');
    });
    Route::get('language/{locale}', function ($locale) {
        session(['locale' => $locale]); // Store locale in session
        App::setLocale($locale);
        return redirect()->back();
    })->name('language');


    Route::controller(ProjectController::class)->group(function () {
        Route::GET('/projects', 'index')->name('projectsList');
        Route::GET('/projects/create', 'create')->name('createProjectForm');
        // Route::POST('/projects/store', 'store')->name('createProject');
        Route::get('/{project}/show', 'show')->name('projectDetails');
        Route::get('{project}/edit', 'edit')->name('projectUpdateForm');
        // Route::patch('{project}/update', 'update')->name('projectUpdate');
        // Route::delete('{project}/delete', 'destroy')->name('projectDelete');
    });
    Route::controller(SpendController::class)->group(function () {
        Route::GET('/spends', 'index')->name('spendsList');
        Route::GET('/spends/create', 'create')->name('createSpendForm');
        // Route::POST('/store/spend', 'store')->name('createSpend');
        Route::get('/spends/{id}/show', 'show')->name('spendDetails');
        Route::get('/spends/{id}/edit', 'edit')->name('spendUpdateForm');
  //      Route::put('/spends/{id}', 'update')->name('spendUpdate');
        // Route::delete('/spends/{id}', 'destroy')->name('spendDelete');
        Route::get('/spends/report', 'report')->name('spendReport');
        // Route::POST('/filterData/spends', 'filterReport')->name('filterData.spends');

        // Route::Post('/filterData/spends/download-pdf', 'downloadPDF')->name('spendReport.downloadPDF');
        // Route::Post('spends/downloadCSV', 'downloadCSV')->name('spendReport.downloadCSV');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::GET('/categories', 'index')->name('categoriesList');
        Route::GET('/categories/create', 'create')->name('createCategoryForm');
        // Route::POST('/category/store', 'store')->name('createCategory');
        Route::get('/category/{id}/show', 'show')->name('categoryDetails');
        Route::get('category/{id}/edit', 'edit')->name('categoryUpdateForm');
        // Route::patch('category/{id}/update', 'update')->name('categoryUpdate');
        // Route::DELETE('category/{id}/delete', 'destroy')->name('categoryDelete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('usersList');
        // Route::Put('/users', 'index')->name('usersList');
        Route::get('/users/create', 'create')->name('createUserForm');
        // Route::post('/users/store', 'store')->name('createUser');
        Route::get('/users/{user}', 'show')->name('userDetails');
        Route::get('/users/{user}/edit', 'edit')->name('userUpdateForm');
        // Route::patch('/users/{user}', 'update')->name('userUpdate');
        // Route::delete('/users/{id}/delete', 'destroy')->name('userDelete');
    });

    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
});

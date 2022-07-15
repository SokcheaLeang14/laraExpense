<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignUpController;
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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard',[DasboardController::class, 'Index']);

    Route::get('/wallets',[WalletsController::class, 'Index']);
    Route::get('/wallet/form', [WalletsController::class, 'Transaction']);
    Route::get('/wallet/view', [WalletsController::class, 'View']);
    Route::post('/wallet/store', [WalletsController::class, 'Store']);
    Route::post('/wallet/update', [WalletsController::class, 'Update']);
    Route::post('/wallet/delete', [WalletsController::class, 'Destroy']);

    Route::get('/expense_categories', [ExpenseCategoryController::class, 'Index']);
    Route::get('/expense_category/form', [ExpenseCategoryController::class, 'Transaction']);
    Route::post('/expense_category/store', [ExpenseCategoryController::class, 'Store']);
    Route::post('/expense_category/update', [ExpenseCategoryController::class, 'Update']);
    Route::post('/expense_category/delete', [ExpenseCategoryController::class, 'Destroy']);

    Route::get('/expenses', [ExpensesController::class, 'Index']);
    Route::get('/expense/view', [ExpensesController::class, 'View']);
    Route::get('/expense/form', [ExpensesController::class, 'Transaction']);
    Route::post('/expense/store', [ExpensesController::class, 'Store']);
    Route::post('/expense/update', [ExpensesController::class, 'Update']);
    Route::post('/expense/delete', [ExpensesController::class, 'Destroy']);

    Route::get('/income_categories', [IncomeCategoryController::class, 'Index']);
    Route::get('/income_category/form', [IncomeCategoryController::class, 'Transaction']);
    Route::post('/income_category/store', [IncomeCategoryController::class, 'Store']);
    Route::post('/income_category/update', [IncomeCategoryController::class, 'Update']);
    Route::post('/income_category/delete', [IncomeCategoryController::class, 'Destroy']);

    Route::get('/incomes', [IncomesController::class, 'Index']);
    Route::get('/income/view', [IncomesController::class, 'View']);
    Route::get('/income/form', [IncomesController::class, 'Transaction']);
    Route::post('/income/store', [IncomesController::class, 'Store']);
    Route::post('/income/update', [IncomesController::class, 'Update']);
    Route::post('/income/delete', [IncomesController::class, 'Destroy']);
});



Route::get('/',function(){
    return redirect('/login');
});
Route::get('/login', [AuthController::class, 'Index']);
Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/logout', [AuthController::class, 'Logout']);


Route::get('/register', [SignUpController::class, 'Index']);
Route::post('/register', [SignUpController::class, 'Register'])->name('register');


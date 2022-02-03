<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TicketController;

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
    return redirect()->route('ticket.create');
});
Route::middleware(['guest'])->group(function () {
    Route::resource('ticket', TicketController::class)->except('destroy', 'update', 'edit');
    Route::get('check/status',[TicketController::class,'checkStatus'])->name('check.status');
    Route::post('ticket/status',[TicketController::class,'ticketStaus'])->name('ticket.status');
});
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('tickets', SupportTicketController::class);
});



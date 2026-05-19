<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;

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

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('chat.room');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/{id}', [GroupController::class, 'chat'])->name('groups.chat');
    Route::post('/groups/send', [GroupController::class, 'send'])->name('groups.send');

    Route::post('/heartbeat', function () {

        auth()->user()->update([
            'last_seen' => now()
        ]);

        return response()->json([
            'success' => true
        ]);

    })->name('heartbeat');

});

require __DIR__.'/auth.php';
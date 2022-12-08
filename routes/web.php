<?php

use App\Events\MassageCreated;
use App\Http\Controllers\TesController;
use App\Http\Livewire\Chat\ChatingPage;
use App\Http\Livewire\Chat\ChatPage;
use App\Http\Livewire\FormAbout\FormAboutPage;
use App\Http\Livewire\Friend\FriendPage;
use App\Http\Livewire\Home\Home;
use App\Http\Livewire\Notification\NotificationPage;
use App\Http\Livewire\User\UserProfilePage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

// Auth::routes(['verify' => true]);
Route::get('/', function () {

    return view('auth.login');
})->middleware('guest');


// Route::middleware(['auth','verified'])->group(fucn)
Route::get('/email/verify', function () {
    // dd('woi');
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified',
    'new.user.check'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', Home::class)->name('home');

    Route::get('/friend', FriendPage::class)->name('friend');

    Route::get('/chat', ChatPage::class)->name('chat');
    Route::get('/notifications', NotificationPage::class)->name('notification');
    Route::get('/profile/{slug}', UserProfilePage::class)->name('profile');
    Route::get('/profile-setting', function () {
        return view('profile.show',);
    })->name('profile-setting')->withoutMiddleware('new.user.check');
});

Route::get('/logout', function () {
    Auth()->logout();
    return redirect('/');
})->middleware('auth')->name('logout');

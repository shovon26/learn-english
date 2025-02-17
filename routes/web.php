<?php

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
Route::namespace('\App\Http\Controllers')->group(function () {
    Route::get('/', function () {
        return redirect()->route('/home');
    });
    Route::get('/home', 'DashboardController@indexAction')->name('home');
    Route::get('/sign-up', 'DashboardController@signupAction');
    Route::get('/plan', 'DashboardController@planAction');
    Route::get('/start', 'DashboardController@startAction');
    Route::get('/speak-ai-agent', 'SpeakController@indexAction')->name('speak-ai-agent');
    Route::get('/subscription-plan', 'SpeakController@subscriptionPlanIndex')->name('/subscription-plan');
    Route::post('/api/process-voice',  'SpeakController@processVoice');
});

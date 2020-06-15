<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
------------- THINGS TO FIX --------------
1. Fix the authentication issue
2. After 1. is fixed, substitute all user(userId) pass through routes to auth()->user();
3. then, remove all user(user->id) passed in all routes.

*/
Auth::routes();
Route::resource('user', 'UserController', ['only' => ['index', 'show', 'store']]);

Route::resource('message', 'MessageController', ['only' => ['index']]);

Route::resource('user.receiver.message', 'MessageController', ['only' => ['store']]);

Route::get('allConversation/{id}', 'MessageController@getAllConversation');

Route::get('privateMessage/{user}/{friend}', 'MessageController@privateMessage');

Route::put('mark_as_read/{user}/{friend}', 'MessageController@markAsRead');
// When the markAsRead route is called, make sure the frontend call, the privateMessage function again.
// ============== END OF CHATAPP ROUTE ==================

// Create a full model for friends


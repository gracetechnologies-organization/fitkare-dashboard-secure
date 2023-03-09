<?php

use App\Http\Controllers\ExercisesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('exercises')->group(function(){
     /** Butt Reduce Routes **/
     Route::get('/butt_reduce/{cat_id}', [ExercisesController::class, 'listAllDataButtReduce']);
    /** Route For All Categories **/
     Route::get('/category/{cat_id}', [ExercisesController::class, 'listAllDataButtReduce']);
});

// fallback for 404 URL's
Route::fallback(function () {
    return response()->json(
        [
            'data' => [],
            'success' => 0,
            'message' => 'Invalid Route, No API found against this URL. In case if you have declared a new route but still it\'s NOT FOUND then please reset the route cache of your application.'
        ],
        404
    );
});
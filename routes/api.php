<?php

use App\Http\Controllers\API\v1\AnswerController;
use App\Http\Controllers\API\v1\FeedbackController;
use App\Http\Controllers\API\v1\QuestionController;
use App\Models\Question;
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

// Route::prefix('v1')->middleware(['auth:sanctum', 'verified'])->group(function () {
Route::prefix('v1')->group(function () {
    Route::apiResource('/questions', QuestionController::class)->only(['index', 'store', 'show', 'destroy']);
    Route::apiResource('/answers', AnswerController::class)->only([/*'index', */'store'/*, 'show'*/]);
    Route::apiResource('/feedbacks', FeedbackController::class)->only([/*'index', */'store'/*, 'show'*/]);
    Route::get('/questions/download/{id}', [QuestionController::class, 'downloadable'])->where([
        'id'=>'[0-9]+'
    ])->name('download.get');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

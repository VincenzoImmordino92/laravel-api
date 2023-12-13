<?php

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/projects', [PageController::class,'index']);
//restituisco non una vista-vieW ma un file json
Route::get('/projects/get-project/{slug}', [PageController::class,'getProjectBySlug']);
Route::post('/invio-email', [LeadController::class,'store']);


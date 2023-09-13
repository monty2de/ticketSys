<?php

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


// user
Route::post('/user/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user/get', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->post('/user/store', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->post('/user/update', [UserController::class, 'update']);
Route::middleware('auth:sanctum')->post('/user/show', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->post('/user/delete', [UserController::class, 'destroy']);

//ticket
Route::middleware('auth:sanctum')->post('/ticket/get', [TicketController::class, 'index']);
Route::middleware('auth:sanctum')->post('/ticket/store', [TicketController::class, 'store']);
Route::middleware('auth:sanctum')->post('/ticket/update', [TicketController::class, 'update']);
Route::middleware('auth:sanctum')->post('/ticket/show', [TicketController::class, 'show']);
Route::middleware('auth:sanctum')->post('/ticket/delete', [TicketController::class, 'destroy']);


//tag
Route::middleware('auth:sanctum')->get('/tag/get', [TagController::class, 'index']);
Route::middleware('auth:sanctum')->post('/tag/store', [TagController::class, 'store']);
Route::middleware('auth:sanctum')->post('/tag/update', [TagController::class, 'update']);
Route::middleware('auth:sanctum')->post('/tag/show', [TagController::class, 'show']);
Route::middleware('auth:sanctum')->post('/tag/delete', [TagController::class, 'destroy']);


//comment
Route::middleware('auth:sanctum')->get('/comment/get', [CommentController::class, 'index']);
Route::middleware('auth:sanctum')->post('/comment/store', [CommentController::class, 'store']);
Route::middleware('auth:sanctum')->post('/comment/update', [CommentController::class, 'update']);
Route::middleware('auth:sanctum')->post('/comment/show', [CommentController::class, 'show']);
Route::middleware('auth:sanctum')->post('/comment/delete', [CommentController::class, 'destroy']);

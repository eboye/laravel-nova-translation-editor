<?php

use Eboye\LaravelNovaTranslationEditor\Http\Controllers\LaravelNovaTranslationEditorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get( '/index', LaravelNovaTranslationEditorController::class . '@index' );

Route::post( '/save', LaravelNovaTranslationEditorController::class . '@save' );

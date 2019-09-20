<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Spatie\TranslationLoader\LanguageLine;

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

Route::get('/index', function (Request $request) {
    $translatables = config('trans_editor');
    $response      = [];
    foreach ($translatables as $translatable) {
        $response[$translatable] = Lang::get($translatable);
    }
    return $response;
});

Route::post('/save', function (Request $request) {
    if ($request->has(['group', 'key', 'text', 'locale'])) {
        return LanguageLine::firstOrCreate(
            [
                'group' => $request->get('group'),
                'key'   => $request->get('key')
            ],
            [
                'group' => $request->get('group'),
                'key'   => $request->get('key'),
                'text'  => [
                    $request->get('locale') => $request->get('text')
                ],
            ]
        );
    } else {
        return response(null, 400);
    }
});

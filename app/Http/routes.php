<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function (Request $request) {
    return view('main', ['js' => $request->input('js', false)]);
});

Route::post('/paste', 'PasteController@create');

Route::get('/paste/{paste}', 'PasteController@view');

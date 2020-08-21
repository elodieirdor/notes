<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Note;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('notes', 'NoteController@index');
Route::post('notes', 'NoteController@create');
Route::put('notes/{note}', 'NoteController@update');
Route::delete('notes/{note}', 'NoteController@delete');

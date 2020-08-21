<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    public function index()
    {
        return Note::all();
    }

    public function create(Request $request)
    {
        $note = Note::create($request->all());

        return response()->json($note, 201);
    }

    public function update(Request $request, Note $note)
    {
        $note->update($request->all());

        return response()->json($note, 200);
    }

    public function delete(Request $request, Note $note)
    {
        $note->delete();

        return response()->json(null, 204);
    }
}

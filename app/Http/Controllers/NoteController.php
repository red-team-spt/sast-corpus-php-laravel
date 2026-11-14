<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $notes = Note::where('user_id', $request->user()->id)
            ->where('title', 'like', '%' . $request->query('q', '') . '%')
            ->latest()
            ->paginate(20);

        return view('notes.index', ['notes' => $notes]);
    }

    public function store(StoreNoteRequest $request)
    {
        $note = $request->user()->notes()->create($request->validated());

        return redirect()->route('notes.show', $note);
    }

    public function show(Request $request, Note $note)
    {
        $this->authorize('view', $note);

        return view('notes.show', ['note' => $note]);
    }

    public function stats(Request $request)
    {
        $rows = DB::select(
            'SELECT DATE(created_at) AS day, COUNT(*) AS n FROM notes WHERE user_id = ? GROUP BY day',
            [$request->user()->id]
        );

        return response()->json($rows);
    }

    public function attachment(Request $request, Note $note)
    {
        $this->authorize('view', $note);
        $name = basename($request->query('file', ''));

        return Storage::disk('attachments')->download($note->id . '/' . $name);
    }
}

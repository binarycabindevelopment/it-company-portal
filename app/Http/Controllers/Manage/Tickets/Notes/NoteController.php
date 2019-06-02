<?php

namespace App\Http\Controllers\Manage\Tickets\Notes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create($ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        return view('manage.ticket.note.create',['ticket'=>$ticket]);
    }

    public function store(Request $request, $ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $noteData = $request->all();
        $noteData['notable_type'] = get_class($ticket);
        $noteData['notable_id'] = $ticket->id;
        $note = \App\Note::create($noteData);
        return redirect($ticket->path())->withSuccess('Saved');
    }

    public function edit($ticketId, $noteId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $note = \App\Note::findOrFail($noteId);
        return view('manage.ticket.note.edit',['ticket'=>$ticket,'note'=>$note]);
    }

    public function update(Request $request, $ticketId, $noteId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $note = \App\Note::findOrFail($noteId);
        $note->update($request->all());
        return redirect($ticket->path())->withSuccess('Saved');
    }

    public function destroy($ticketId, $noteId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $note = \App\Note::findOrFail($noteId);
        $note->delete();
        return redirect($ticket->path())->withSuccess('Deleted');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Message;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string|min:20',
        ]);

        // Create a new ticket
        $ticket = Ticket::create([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
        ]);

        // Create a new message associated with the ticket
        Message::create([
            'ticket_id' => $ticket->id,
            'message' => $request->input('message'),
        ]);

        // Return a success response
        return response()->json(['success' => 'Your message was sent successfully!']);
    }
}

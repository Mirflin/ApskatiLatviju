<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class SupportController extends Controller
{
    public function support()
    {
        return view('pages.support');
    }

    public function submitTicket(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000',
        ], [
            'email.required' => 'E-pasta adrese ir obligāta.',
            'email.email' => 'Lūdzu, ievadiet derīgu e-pasta adresi.',
            'email.max' => 'E-pasta adresei jābūt ne garākai par 255 simboliem.',
            'content.required' => 'Komentārs ir obligāts.',
            'content.string' => 'Komentāram jābūt teksta formātā.',
            'content.max' => 'Komentāram jābūt ne garākam par 1000 simboliem.',
        ]);

        Ticket::create([
            'email' => $request->input('email'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('support')->with('success', 'Jūsu ziņa ir veiksmīgi nosūtīta!');
    }
}
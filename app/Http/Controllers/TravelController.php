<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::whereNull('deleted_at')->get();
        return view('welcome', compact('travels'));
    }

    public function show($id)
    {
        $travel = Travel::findOrFail($id);
        return view('pages.travel-details', compact('travel'));
    }

    public function requestForm(Request $request)
    {
        $travel = null;
        $allTravels = Travel::all(); // Для dropdown списка

        if ($request->has('travel_id')) {
            $travel = Travel::find($request->get('travel_id'));
        }

        return view('pages.travel-request', compact('travel', 'allTravels'));
    }
}
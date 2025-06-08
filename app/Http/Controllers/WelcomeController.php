<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\News;
use App\Models\Client;

class WelcomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        $travels = Travel::whereNull('deleted_at')->get();
        $coops = Client::all();

        return view('welcome', compact('news', 'travels', 'coops'));
    }

    public function showTravelDetails($id)
    {
        $travel = Travel::findOrFail($id);
        return view('pages.travel-details', compact('travel'));
    }

    public function showNewsDetails($id)
    {
        $news = News::findOrFail($id);

        $imagePath = 'news/' . $news->image;
        $news->image_url = $news->image && \Storage::disk('public')->exists($imagePath)
            ? asset('storage/' . $imagePath)
            : asset('no-image.png');

        return view('pages.news-details', compact('news'));
    }

    public function travelRequest(Request $request)
    {
        $travel = null;
        $allTravels = Travel::all();

        if ($request->has('travel_id')) {
            $travel = Travel::find($request->get('travel_id'));
        }

        return view('pages.travel-request', compact('travel', 'allTravels'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\News;
use App\Models\Client;
use App\Models\Service;
use App\Models\Review;

class WelcomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        
        return view('welcome', compact('news'));
    }
    
    public function travels()
    {
        $travels = Travel::whereNull('deleted_at')->get();

        return view('pages.travels', compact('travels'));
    }

    public function myTravels()
    {
        return view('pages.my-travels');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function services()
    {
        $services = Service::whereNull('deleted_at')->get();

        return view('pages.services', compact('services'));
    }

    public function showTravelDetails($id)
    {
        $travel = Travel::findOrFail($id);

        // get 10 comments with limit-10
        $reviews = Review::with('client')->latest()->paginate(10);


        return view('pages.travel-details', compact('travel', 'reviews'));
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

    public function serviceRequest(Request $request)
    {
        $service = null;
        $allServices = Service::all();

        if ($request->has('service_id')) {
            $service = Service::find($request->get('service_id'));
        }
        
        return view('pages.service-request', compact('service', 'allServices'));
    }
}
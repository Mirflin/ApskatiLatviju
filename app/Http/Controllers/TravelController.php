<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\Review;
use App\Models\travel_check;

class TravelController extends Controller
{
    public function index(Request $request)
    {
        $query = Travel::query()->whereNull('deleted_at');

        if ($price_min = $request->query('price_min')) {
            $query->where('price', '>=', $price_min);
        }
        if ($price_max = $request->query('price_max')) {
            $query->where('price', '<=', $price_max);
        }
        if ($season = $request->query('season')) {
            $query->where('seazon_id', $season);
        }
        if ($date_from = $request->query('date_from')) {
            $query->where('time_term', '>=', $date_from);
        }
        if ($date_to = $request->query('date_to')) {
            $query->where('time_term', '<=', $date_to);
        }
        if ($city = trim($request->query('city'))) {
            $query->where('city', 'like', '%' . $city . '%');
        }
        if ($name = trim($request->query('name'))) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($spot_count = $request->query('spot_count')) {
            $query->where('spot_count', '>=', $spot_count);
        }

        $travels = $query->get();

        return view('pages.travels', compact('travels'));
    }

    public function showTravelDetails(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);
        $allTravels = Travel::whereNull('deleted_at')->get();
        $reviews = Review::with('client')
            ->where('travel_id', $id)
            ->whereNull('deleted_at')
            ->latest()
            ->get();

        return view('pages.travel-details', compact('travel', 'reviews', 'allTravels'));
    }

    public function storeReview(Request $request, $travel_id)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'review' => 'required|string|max:255',
            'is_anonymous' => 'nullable|boolean',
        ]);

        // Code check
        $check = travel_check::where('code', $request->code)
            ->where('travel_id', $travel_id)
            ->whereNull('deleted_at')
            ->firstOrFail();

        // Existence
        $existingReview = Review::where('travel_id', $travel_id)
            ->where('client_id', $check->client_id)
            ->whereNull('deleted_at')
            ->first();

        if ($existingReview) {
            // Update current review (which is already existed)
            $existingReview->update([
                'review' => $request->review,
            ]);
        } else {
            // Post comment
            Review::create([
                'travel_id' => $travel_id,
                'client_id' => $check->client_id,
                'review' => $request->review,
            ]);
        }

        // Anonym
        if ($request->is_anonymous) {
            session()->flash('anonymous_review_' . $check->client_id, true);
        } else {
            session()->forget('anonymous_review_' . $check->client_id);
        }

        return redirect()->route('travel.details', $travel_id)->with('success', 'Komentārs pievienots vai atjaunināts!');
    }
}
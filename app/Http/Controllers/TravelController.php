<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\Client;
use App\Models\Travel_check;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TravelCheckConfirmation;
use Illuminate\Support\Facades\Log;

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
        Log::info('TravelController::showTravelDetails called with id: ' . $id);
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

        try {
            $check = Travel_check::where('code', $request->code)
                ->where('travel_id', $travel_id)
                ->whereNull('deleted_at')
                ->firstOrFail();

            $existingReview = Review::where('travel_id', $travel_id)
                ->where('client_id', $check->client_id)
                ->whereNull('deleted_at')
                ->first();

            if ($existingReview) {
                $existingReview->update(['review' => $request->review]);
            } else {
                Review::create([
                    'travel_id' => $travel_id,
                    'client_id' => $check->client_id,
                    'review' => $request->review,
                ]);
            }

            if ($request->is_anonymous) {
                session()->flash('anonymous_review_' . $check->client_id, true);
            } else {
                session()->forget('anonymous_review_' . $check->client_id);
            }

            return redirect()
                ->route('travel.details', $travel_id)
                ->with('success', 'Komentārs pievienots vai atjaunināts!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('travel.details', $travel_id)
                ->withErrors(['code' => 'Nepareizs čeka kods. Lūdzu, pārbaudiet un mēģiniet vēlreiz.'])
                ->withInput();
        }
    }

    public function storeTravelRequest(Request $request)
    {
        Log::info('TravelController::storeTravelRequest called with data: ' . json_encode($request->all()));

        try {
            $request->validate([
                'name' => 'required|string|max:60',
                'surname' => 'required|string|max:60',
                'email' => 'required|email|max:255',
                'telephone' => 'required|string|size:8',
                'people-count' => 'required|integer|min:1|max:50',
                'travel_id' => 'required|exists:travel,id',
                'comment' => 'nullable|string|max:255',
            ], [
                'name.required' => 'Vārds ir obligāts',
                'name.max' => 'Vārds nedrīkst pārsniegt 60 rakstzīmes',
                'surname.required' => 'Uzvārds ir obligāts',
                'surname.max' => 'Uzvārds nedrīkst pārsniegt 60 rakstzīmes',
                'email.required' => 'E-pasts ir obligāts',
                'email.email' => 'Lūdzu, ievadiet derīgu e-pasta adresi',
                'email.max' => 'E-pasts nedrīkst pārsniegt 255 rakstzīmes',
                'telephone.required' => 'Telefona numurs ir obligāts',
                'telephone.regex' => 'Lūdzu, ievadiet derīgu telefona numuru (8 cipari)',
                'people-count.required' => 'Personu skaits ir obligāts',
                'people-count.integer' => 'Personu skaitam jābūt veselam skaitlim',
                'people-count.min' => 'Personu skaitam jābūt vismaz 1',
                'people-count.max' => 'Personu skaits nedrīkst pārsniegt 50',
                'travel_id.required' => 'Ceļojuma izvēle ir obligāta',
                'travel_id.exists' => 'Izvēlētais ceļojums nav atrasts',
                'comment.max' => 'Komentārs nedrīkst pārsniegt 255 rakstzīmes',
            ]);

            $travel = Travel::whereNull('deleted_at')->findOrFail($request->travel_id);
            Log::info('Travel found: ' . $travel->id);

            $peopleCount = $request->input('people-count');
            if ($peopleCount > $travel->spot_count) {
                return redirect()->route('travel.details', $travel->id)
                    ->withErrors(['people-count' => 'Norādītais personu skaits pārsniedz pieejamo vietu skaitu (' . $travel->spot_count . ').'])
                    ->withInput();
            }

            if ($travel->spot_count < $peopleCount) {
                Log::warning('Insufficient spots for travel_id: ' . $travel->id);
                return redirect()->route('travel.details', $travel->id)
                    ->withErrors(['people-count' => 'Nav pietiekami daudz brīvu vietu ceļojumam.'])
                    ->withInput();
            }

            $client = Client::where('email', $request->email)
                ->whereNull('deleted_at')
                ->first();

            if ($client) {
                $client->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'phone' => $request->telephone,
                    'comment' => $request->comment,
                ]);
                Log::info('Client updated: ' . $client->id);
            } else {
                $client = Client::create([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'email' => $request->email,
                    'phone' => $request->telephone,
                    'comment' => $request->comment,
                ]);
                Log::info('Client created: ' . $client->id);
            }

            do {
                $code = Str::random(12);
            } while (Travel_check::where('code', $code)->exists());
            Log::info('Check code generated: ' . $code);

            $check = Travel_check::create([
                'travel_id' => $travel->id,
                'client_id' => $client->id,
                'code' => $code,
                'people_count' => $peopleCount,
            ]);
            Log::info('Travel check created: ' . $check->id);

            $travel->decrement('spot_count', $peopleCount);
            Log::info('Spot count updated for travel_id: ' . $travel->id);

            try {
                Mail::to($client->email)
                    ->send(new TravelCheckConfirmation($check, $travel));
                Log::info('Email queued for client: ' . $client->email . ', code: ' . $code);
            } catch (\Exception $e) {
                Log::error('Failed to queue travel check email: ' . $e->getMessage());
            }

            Log::info('Request processed successfully');
            return redirect()->route('travel.details', $travel->id)
                ->with('success', 'Pieteikums nosūtīts! Čeka kods nosūtīts uz jūsu e-pastu.');
        } catch (\Exception $e) {
            Log::error('Error in storeTravelRequest: ' . $e->getMessage() . ' | Stack: ' . $e->getTraceAsString());
            return redirect()->route('travel.details', $request->travel_id)
                ->withErrors(['general' => 'Pieteikuma apstrādes laikā radās kļūda: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Client;
use App\Models\Services_check;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceCheckConfirmation;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()->whereNull('deleted_at');

        if ($price_min = $request->query('price_min')) {
            $query->where('price', '>=', $price_min);
        }
        if ($price_max = $request->query('price_max')) {
            $query->where('price', '<=', $price_max);
        }
        if ($name = trim($request->query('name'))) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $services = $query->get();
        $allServices = Service::whereNull('deleted_at')->get();

        return view('pages.services', compact('services', 'allServices'));
    }

    public function serviceRequest(Request $request)
    {
        $allServices = Service::whereNull('deleted_at')->get();
        $service = null;

        if ($request->filled('service_id')) {
            $service = $allServices->firstWhere('id', $request->get('service_id'));

            if (!$service) {
                return redirect()->back()->withErrors(['service_id' => 'Izvēlētais pakalpojums nav atrasts.']);
            }
        }

        return view('pages.service-request', compact('service', 'allServices'));
    }

    public function storeServiceRequest(Request $request)
    {
        Log::info('ServicesController::storeServiceRequest called with data: ' . json_encode($request->all()));

        try {
            $request->validate([
                'name' => 'required|string|max:60',
                'surname' => 'required|string|max:60',
                'email' => 'required|email|max:255',
                'telephone' => 'required|string|size:8',
                'service_id' => 'required|exists:services,id',
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
                'telephone.size' => 'Telefona numurs jābūt 8 cipariem',
                'service_id.required' => 'Pakalpojuma izvēle ir obligāta',
                'service_id.exists' => 'Izvēlētais pakalpojums nav atrasts',
                'comment.max' => 'Komentārs nedrīkst pārsniegt 255 rakstzīmes',
            ]);

            $service = Service::whereNull('deleted_at')->findOrFail($request->service_id);
            Log::info('Service found: ' . $service->id);

            $client = Client::where('email', $request->email)->whereNull('deleted_at')->first();

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
            } while (Services_check::where('code', $code)->exists());
            Log::info('Check code generated: ' . $code);

            $check = Services_check::create([
                'service_id' => $service->id,
                'client_id' => $client->id,
                'code' => $code,
            ]);
            Log::info('Service check created: ' . $check->id);

            try {
                Mail::to($client->email)->send(new ServiceCheckConfirmation($check, $service));
                Log::info('Email queued for client: ' . $client->email . ', code: ' . $code);
            } catch (\Exception $e) {
                Log::error('Failed to queue service check email: ' . $e->getMessage());
            }

            Log::info('Request processed successfully');
            return redirect()->route('services.index')->with('success', 'Pieteikums nosūtīts! Čeka kods nosūtīts uz jūsu e-pastu.');
        } catch (\Exception $e) {
            Log::error('Error in storeServiceRequest: ' . $e->getMessage() . ' | Stack: ' . $e->getTraceAsString());
            return redirect()->route('services.index')->withErrors(['general' => 'Pieteikuma apstrādes laikā radās kļūda: ' . $e->getMessage()])->withInput();
        }
    }

        public function cancelCheck(Request $request)
    {
        try {
            $request->validate([
                'check_code' => 'required|string|exists:Travel_checks,code,deleted_at,NULL|exists:services_checks,code,deleted_at,NULL',
                'travel_id' => 'nullable|exists:travel,id',
                'service_id' => 'nullable|exists:services,id',
            ]);

            $check = null;
            if ($request->travel_id) {
                $check = Travel_check::where('code', $request->check_code)
                    ->where('travel_id', $request->travel_id)
                    ->whereNull('deleted_at')
                    ->firstOrFail();
                $check->delete();
                Log::info('Travel check canceled: ' . $request->check_code);
            } elseif ($request->service_id) {
                $check = Services_check::where('code', $request->check_code)
                    ->where('service_id', $request->service_id)
                    ->whereNull('deleted_at')
                    ->firstOrFail();
                $check->delete();
                Log::info('Service check canceled: ' . $request->check_code);
            }

            return response()->json(['success' => true, 'message' => 'Pieteikums atcelts veiksmīgi!']);
        } catch (\Exception $e) {
            Log::error('Error in cancelCheck: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Neizdevās atcelt pieteikumu: ' . $e->getMessage()], 500);
        }
    }
}
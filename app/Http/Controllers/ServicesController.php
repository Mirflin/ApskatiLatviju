<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()->whereNull('deleted_at');

        // Min to max
        if ($price_min = $request->query('price_min')) {
            $query->where('price', '>=', $price_min);
        }
        if ($price_max = $request->query('price_max')) {
            $query->where('price', '<=', $price_max);
        }

        // By name
        if ($name = trim($request->query('name'))) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $services = $query->get();

        return view('pages.services', compact('services'));
    }

    public function serviceRequest(Request $request)
    {
        $service = null;
        $allServices = Service::whereNull('deleted_at')->get();

        if ($request->has('service_id')) {
            $service = Service::findOrFail($request->get('service_id'));
        }

        return view('pages.service-request', compact('service', 'allServices'));
    }
}
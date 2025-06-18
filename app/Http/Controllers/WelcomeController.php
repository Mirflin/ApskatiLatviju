<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel_check;
use App\Models\Services_check;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function myChecks(Request $request)
    {
        $check = null;
        $type = null;
        $check_code = $request->input('check_code', '');

        if ($request->isMethod('post') && $check_code) {
            // Search in travel_checks
            $travel_check = Travel_check::with('travel')
                ->where('code', $check_code)
                ->whereNull('deleted_at')
                ->first();

            if ($travel_check) {
                $check = $travel_check;
                $type = 'travel';
            } else {
                // Search in services_checks
                $serviceCheck = Services_check::with('service')
                    ->where('code', $check_code)
                    ->whereNull('deleted_at')
                    ->first();

                if ($serviceCheck) {
                    $check = $serviceCheck;
                    $type = 'service';
                } else {
                    return redirect()->route('my.checks')
                        ->withErrors(['check_code' => 'Čeks ar norādīto kodu nav atrasts.'])
                        ->withInput();
                }
            }
        }

        return view('pages.my-checks', compact('check', 'type', 'check_code'));
    }
}
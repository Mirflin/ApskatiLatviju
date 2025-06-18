<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel_check;
use App\Models\Services_check;
use App\Models\Travel;
use Illuminate\Support\Facades\Log;

class CheckController extends Controller
{
    public function cancelCheck(Request $request)
    {
        try {
            Log::info('Received cancelCheck request: ' . json_encode($request->all()));
            $request->validate([
                'check_code' => 'required|string',
                'travel_id' => 'nullable|exists:travel,id',
                'service_id' => 'nullable|exists:services,id',
            ]);

            $check = null;
            $travel = null;
            $peopleCount = 0;

            if ($request->travel_id) {
                Log::info('Searching travel check with code: ' . $request->check_code . ', travel_id: ' . $request->travel_id);
                $checkExists = Travel_check::where('code', $request->check_code)
                    ->where('travel_id', $request->travel_id)
                    ->whereNull('deleted_at')
                    ->exists();
                if (!$checkExists) {
                    throw new \Exception('The selected check code is not found for travel_id: ' . $request->travel_id);
                }
                $check = Travel_check::where('code', $request->check_code)
                    ->where('travel_id', $request->travel_id)
                    ->whereNull('deleted_at')
                    ->firstOrFail();
                $travel = Travel::findOrFail($request->travel_id);
                $peopleCount = $check->people_count;
                $check->delete();
                $travel->increment('spot_count', $peopleCount);
                Log::info('Travel check canceled: ' . $request->check_code);
            } elseif ($request->service_id) {
                Log::info('Searching service check with code: ' . $request->check_code . ', service_id: ' . $request->service_id);
                $checkExists = Services_check::where('code', $request->check_code)
                    ->where('service_id', $request->service_id)
                    ->whereNull('deleted_at')
                    ->exists();
                if (!$checkExists) {
                    throw new \Exception('The selected check code is not found for service_id: ' . $request->service_id);
                }
                $check = Services_check::where('code', $request->check_code)
                    ->where('service_id', $request->service_id)
                    ->whereNull('deleted_at')
                    ->firstOrFail();
                $check->delete();
                Log::info('Service check canceled: ' . $request->check_code);
            } else {
                throw new \Exception('Neither travel_id nor service_id provided.');
            }

            return response()->json(['success' => true, 'message' => 'Pieteikums atcelts veiksmīgi!']);
        } catch (\Exception $e) {
            Log::error('Error in cancelCheck: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());
            return response()->json(['success' => false, 'message' => 'Neizdevās atcelt pieteikumu: ' . $e->getMessage()], 500);
        }
    }
}
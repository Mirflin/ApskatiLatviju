<?php

namespace App\Http\Controllers;

use App\Models\Action_history;
use App\Models\Action_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Service;
use App\Models\Travel;
use App\Models\Travel_group;
use App\Models\Seazon_group;
use App\Models\news;
use App\Models\User;
use App\Models\Travel_check;
use App\Models\Services_check;
use App\Models\Ticket;
use App\Models\Permision_groups;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class apiController extends Controller
{
    public function createNewService(Request $request){
        $validated = $request->only(['id','name', 'description', 'price']);
        if($validated['id'] !== null){
            $exists_service = Service::find($validated['id']);
            $exists_service->name = $validated['name'];
            $exists_service->description = $validated['description'];
            $exists_service->price = $validated['price'];
            $exists_service->save();

            Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Mainits pakalpojums ".$validated['name'],
                "status_id" => 2
            ]);

            return response()->json([
                'message' => 'Redacted!',
            ], 201);
        }else{
            try {
                Service::create($validated);
                Action_history::create([
                    "user_id" => Auth::user()->id,
                    "action" => "Uztaisīts jauns pakalpojums ".$validated['name'],
                    "status_id" => 2
                ]);
                return response()->json([
                    'message' => 'Success!',
                ], 201);
            } catch (\Exception $e) {

                return response()->json([
                    'message' => 'Failed to create service.',
                ], 500);
            }
        }
    }
    public function deleteService(Request $request){
        $validated = $request->only('id');
        $service = Service::where('id', $validated['id'])->first();
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        Services_check::where('service_id', $validated['id'])->delete();
        $service->delete();

        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Dzests pakalpojums ".$service->name,
            "status_id" => 2
        ]);

        return response()->json(['message' => 'Deleted Successfully!'], 200);
    }

    public function createNewTravel(Request $request){
        $validated = $request->only(['group_id','name','ŗoad_marks','city','image','description','price','seazon_id','spot_count','time_term']);

        if($validated['group_id'] && $validated['name'] && $validated['ŗoad_marks'] && $validated['city'] && $validated['image'] && $validated['description'] && $validated['price'] && $validated['seazon_id'] && $validated['spot_count'] && $validated['time_term']){
            $travel = [
                "group_id" => $validated['group_id'],
                "name" => $validated['name'],
                "ŗoad_marks" => $validated['ŗoad_marks'],
                "city" => $validated['city'],
                "image" => $validated['image'],
                "description" => $validated['description'],
                "price" => $validated['price'],
                "seazon_id" => $validated['seazon_id'],
                "spot_count" => $validated['spot_count'],
                "time_term" => $validated['time_term']
            ];
            Travel::create($travel);
            Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Uztaisīts jauns ceļojums ".$validated['name'],
                "status_id" => 2
            ]);
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createNewTravelGroup(Request $request){
        $validated = $request->only(['name']);

        if($validated['name']){
            Travel_group::create($validated);
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createNewNews(Request $request){
        $validated = $request->only(['header','paragraph','image']);

        if($validated['header'] && $validated['paragraph'] && $validated['image']){
            $news = [
                "header" => $validated['header'],
                "paragraph" => $validated['paragraph'],
                "image" => $validated['image']
            ];
            News::create($news);

            Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Uztaisīta jauna zīņa ".$validated['header'],
                "status_id" => 2
            ]);

            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createNewUser(Request $request){
        $validated = $request->only('name','email','permision_group');
        $password = rand(10000,100000);
        $exists_user = User::where('name', $validated['name'])
                   ->orWhere('email', $validated['email'])
                   ->first();

        if($exists_user){
            $exists_user->email = $validated['email'];
            $exists_user->name = $validated['name'];
            $exists_user->permision_group = $validated['permision_group'];
            $exists_user->save();
            Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Mainits lietotājs ".$exists_user->name,
                "status_id" => 2
            ]);
            return response()->json(['message' => 'redacted'], 200);
        }else{
            $user = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($password),
                'permision_group' => $validated['permision_group']
            ];
            Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Uztaisīts lietotājs ".$user->name,
                "status_id" => 2
            ]);
            User::create($user);
            return response()->json(['message' => $password], 201);
        }
    }
    public function deleteUser(Request $request){
        $validated = $request->only('id');
        $user = User::where('id', $validated['id'])->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        Action_history::where('user_id', $validated['id'])->delete();
        Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Dzests lietotājs ".$user->name,
                "status_id" => 2
        ]);
        $user->status_id = 7;
        $user->save();
        $user->delete();
        return response()->json(['message' => 'Deleted Successfully!'], 200);
    }
    public function restoreUser(Request $request){
        $validated = $request->only('id');
        $user = User::withTrashed()->where('id', $validated['id'])->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Atjaunots lietotājs ".$exists_user->name,
            "status_id" => 2
        ]);
        $user->status_id = 6;
        $user->save();
        $user->restore();
        return response()->json(['message' => 'Restored Successfully!'], 200);
    }

    public function createTravelCheck(Request $request){
        $validated = $request->only(['travel_id', 'client_id']);
        if($validated['travel_id'] && $validated['client_id']){
            $check = [
                "travel_id" => $validated['travel_id'],
                "client_id" => $validated['client_id'],
                "code" => '12345'
            ];
            Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Uztaisits ceļojuma čeks  ".$check->code,
                "status_id" => 2
            ]);
            travel_check::create($check);
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createServiceCheck(Request $request){
        $validated = $request->only(['service_id', 'client_id']);
        if($validated['service_id'] && $validated['client_id']){
            $check = [
                "service_id" => $validated['service_id'],
                "client_id" => $validated['client_id'],
                "code" => '12345'
            ];
            travel_check::create($check);
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function userList(){
        $users = User::withTrashed()->get();
        $userList = [];
        foreach($users as $user){
            $elem = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "permission" => Permision_groups::find($user->permision_group)->permision_name,
                "status" => Action_status::find($user->status_id)->name,
                "created_at" => $user->created_at
            ];
            array_push($userList, $elem);
        }
        return $userList;
    }

    public function activeModerator(){

        $topModerators = User::where('permision_group', 2)
            ->select('users.id', 'users.name', DB::raw('COUNT(action_histories.id) as action_count'))
            ->leftJoin('action_histories', 'users.id', '=', 'action_histories.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('action_count')
            ->take(5)
            ->get();

        return $topModerators;
    }

    public function getTravelRequests(){
        $checks = Travel_check::with(['client', 'travel'])->get();
        $data = $checks->map(function ($check) {
            return [
                'id' => $check->id,
                'name' => $check->travel->name,
                'city' => $check->travel->city,
                'price' => $check->travel->price,
                'client_name' => $check->client->name,
                'client_email' => $check->client->email,
                'code' => $check->code,
                'time_term' => $check->travel->time_term,
                'created_at' => $check->created_at,
            ];
        });

        return $data;
    }
    private function generatePassword($length = 8, $useSymbols = false) {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $symbols = '!@#$%^&*()_+~`|}{[]:;?><,./-=';

        $characters = $letters . $numbers;
        if ($useSymbols) {
            $characters .= $symbols;
        }

        $password = '';
        $maxIndex = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $maxIndex)];
        }

        return $password;
    }
    public function getServiceRequests(){
        $checks = Services_check::with(['client', 'service'])->get();
        $data = $checks->map(function ($check) {
            return [
                'id' => $check->id,
                'name' => $check->name,
                'description' => $check->description,
                'price' => $check->price,
                'client_name' => $check->client->name,
                'client_email' => $check->client->email,
                'code' => $check->code,
                'created_at' => $check->created_at,
            ];
        });

        return $data;
    }

    public function getNews(){
        $checks = news::all();
        $data = $checks->map(function ($check) {
            return [
                'id' => $check->id,
                'header' => $check->header,
                'paragraph' => $check->paragraph,
                'image' =>$check->image,
                'created_at' => $check->created_at,
            ];
        });
        return $data;
    }
    public function getTravels(){
        $checks = Travel::withTrashed()->get();
        $data = $checks->map(function ($check) {
            return [
                'id' => $check->id,
                'group' => Travel_group::where('id', $check->group_id)->first()->name,
                'name' => $check->name,
                'city' => $check->city,
                'description' => $check->description,
                'price' => $check->price,
                'seazon' => Seazon_group::where('id', $check->seazon_id)->first()->name,
                'city' => $check->city,
                'spot_count' => $check->spot_count,
                'time_term' => $check->time_term,
                'status' => Action_status::find($check->status_id)->name,
                'created_at' => $check->created_at,
            ];
        });
        return $data;
    }
    public function getServices(){
        $checks = Service::all();
        $data = $checks->map(function ($check) {
            return [
                'id' => $check->id,
                'name' => $check->name,
                'description' => $check->description,
                'price' => $check->price,
            ];
        });
        return $data;
    }
    public function getHistory(){
        $checks = Action_history::all();
        $data = $checks->map(function ($check) {
            $user = User::where('id', $check->user_id)->first();
            $permissionGroup = $user
                ? Permision_groups::where('id', $user->permision_group)->first()
                : 2;

            $status = Action_status::where('id', $check->status_id)->first();

            return [
                'id' => $check->id,
                'user' => $user ? $user->name : null,
                'permission' => $permissionGroup ? $permissionGroup->permision_name : null,
                'action' => $check->action,
                'status' => $status ? $status->name : null,
                'created_at' => $check->created_at,
            ];
        });

        return $data;
    }
    public function getCurrentUser(){
        $user = Auth::user();
        return $user;
    }
    public function createNews(Request $request){
        $validated = $request->only(['header','paragraph','image']);

        if ($request->has('image') && $validated['image'] != '') {
            $image = $request->input('image');

            [$type, $data] = explode(';', $image);
            [$_, $extension] = explode('/', $type);
            $data = explode(',', $data)[1];

            $filename = uniqid() . '.' . $extension;
            Storage::disk('public')->put("news/{$filename}", base64_decode($data));

            $validated['image'] = "{$filename}";
        }
        Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Uztaisita jauna zīņa ".$validated['header'],
                "status_id" => 2
        ]);

        news::create($validated);

        return response()->json([
            'message' => 'Created!',
        ],201);
    }
    public function editNews(Request $request){
        $validated = $request->only(['id','header','paragraph','image']);
        $news = news::find($validated['id']);

        if ($request->has('image') && $validated['image'] != '') {
            $image = $request->input('image');
            [$type, $data] = explode(';', $image);
            [$_, $extension] = explode('/', $type);
            $data = explode(',', $data)[1];
            $filename = uniqid() . '.' . $extension;
            Storage::disk('public')->put("news/{$filename}", base64_decode($data));

            $validated['image'] = "{$filename}";
            $news->image = $validated['image'];
        }
        Action_history::create([
                "user_id" => Auth::user()->id,
                "action" => "Mainita ziņa ".$news->header,
                "status_id" => 2
        ]);
        $news->header = $validated['header'];
        $news->paragraph = $validated['paragraph'];
        $news->save();

        return response()->json([
            'message' => "Redacted!",
        ],200);
    }
    public function deleteNews(Request $request){
        $validated = $request->only('id');

        $news = news::find($validated['id']);
        $news->delete();
        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Dzesta zīņa ".$news->header,
            "status_id" => 2
        ]);
        return response()->json([
            'message' => "Deleted!",
        ],200);
    }
    public function createTravel(Request $request){
        $validated = $request->only(['name','city','description','image','price','time_term','seazon_id','group_id','road_marks','spot_count']);

        if ($request->has('image') && $validated['image'] != '') {
            $image = $request->input('image');
            [$type, $data] = explode(';', $image);
            [$_, $extension] = explode('/', $type);
            $data = explode(',', $data)[1];
            $filename = uniqid() . '.' . $extension;
            Storage::disk('public')->put("travels/{$filename}", base64_decode($data));

            $validated['image'] = "{$filename}";
        }

        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Uztaisits jauns ceļojums ".$validated['name'],
            "status_id" => 2
        ]);

        Travel::create($validated);

        return response()->json([
            'message' => "Created!",
        ],200);
    }
    public function editTravel(Request $request){
        $validated = $request->only(['id','name','city','description','image','price','time_term','seazon_id','group_id','road_marks','spot_count']);
        $travel = Travel::find($validated['id']);

        if ($request->has('image') && $validated['image'] != '') {
            $image = $request->input('image');
            [$type, $data] = explode(';', $image);
            [$_, $extension] = explode('/', $type);
            $data = explode(',', $data)[1];
            $filename = uniqid() . '.' . $extension;
            Storage::disk('public')->put("travels/{$filename}", base64_decode($data));

            $validated['image'] = "{$filename}";
            $travel->image = $validated['image'];
        }

        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Mainits ceļojums ".$travel->name,
            "status_id" => 2
        ]);

        $travel->name = $validated['name'];
        $travel->city = $validated['city'];
        $travel->description = $validated['description'];
        $travel->price = $validated['price'];
        $travel->time_term = $validated['time_term'];
        $travel->seazon_id = $validated['seazon_id'];
        $travel->group_id = $validated['group_id'];
        $travel->road_marks = $validated['road_marks'];
        $travel->save();

        return response()->json([
            'message' => "Redacted!",
        ],200);
    }
    public function getTravelGroups(){
        return Travel_group::all();
    }
    public function getSeazons(){
        return Seazon_group::all();
    }
    public function deleteTravel(Request $request){
        $validated = $request->only('id');
        $travel = Travel::find($validated['id']);
        Travel_check::where('travel_id', $travel->id)->delete();
        $travel->status_id = 7;
        $travel->save();
        $travel->delete();

        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Dzests ceļojums ".$travel->name,
            "status_id" => 2
        ]);

        return response()->json([
            'message' => "Deleted!",
        ],201);
    }
    public function restoreTravel(Request $request){
        $validated = $request->only('id');
        $travel = Travel::withTrashed()->where('id', $validated['id'])->first();
        $travel->status_id = 6;
        $travel->restore();
        $travel->save();
        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Atjaunots ceļojums ".$travel->name,
            "status_id" => 2
        ]);
        return response()->json([
            'message' => "Restored!",
        ],201);
    }

    public function deleteTravelRequest(Request $request){
        $validated = $request->only('id');
        $request = Travel_check::find($validated['id']);
        $request->delete();
        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Dzests ceļojuma čeks ".$request->code,
            "status_id" => 2
        ]);
        return response()->json([
            'message' => "Deleted!",
        ],200);
    }
    public function deleteServiceRequest(Request $request){
        $validated = $request->only('id');
        $request = Service_check::find($validated['id']);
        $request->delete();
        Action_history::create([
            "user_id" => Auth::user()->id,
            "action" => "Dzests pakalpojuma čeks ".$request->code,
            "status_id" => 2
        ]);
        return response()->json([
            'message' => "Deleted!",
        ],200);
    }
}


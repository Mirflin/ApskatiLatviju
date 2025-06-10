<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Travel;
use App\Models\Travel_group;
use App\Models\News;
use App\Models\User;
use App\Models\travel_check;
use App\Models\Ticket;

class apiController extends Controller
{
    public function createNewService(Request $request){
        $validated = $request->only(['name', 'description', 'price']);
        $service = [
            "name" => $validated['name'],
            "description" => $validated['description'],
            "price" => $validated['price']
        ];
        if($validated['name'] && $validated['description'] && $validated['price']){
            Service::create($service);
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createNewTravel(Request $request){
        $validated = $request->only(['group_id','name','ŗoad_marks','country','image','description','price','seazon_id','spot_count','time_term']);

        if($validated['group_id'] && $validated['name'] && $validated['ŗoad_marks'] && $validated['country'] && $validated['image'] && $validated['description'] && $validated['price'] && $validated['seazon_id'] && $validated['spot_count'] && $validated['time_term']){
            $travel = [
                "group_id" => $validated['group_id'],
                "name" => $validated['name'],
                "ŗoad_marks" => $validated['ŗoad_marks'],
                "country" => $validated['country'],
                "image" => $validated['image'],
                "description" => $validated['description'],
                "price" => $validated['price'],
                "seazon_id" => $validated['seazon_id'],
                "spot_count" => $validated['spot_count'],
                "time_term" => $validated['time_term']
            ];
            Travel::create($travel);
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
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createNewUser(Request $request){
        $validated = $request->only(['name','email','password','permision_group']);

        if($validated['name'] && $validated['email'] && $validated['password'] && $validated['permision_group']){
            $user = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'permision_group' => $validated['permision_group']
            ];
            User::create($user);
            return response()->json([
                'message' => "Success!",
            ],201);
        }

        return response()->json([
            'message' => "Failure!",
        ],301);
    }

    public function createTravelCheck(Request $request){
        $validated = $request->only(['travel_id', 'client_id']);
        if($validated['travel_id'] && $validated['client_id']){
            $check = [
                "travel_id" => $validated['travel_id'],
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

    public function createTicket(Request $request){
        $validated = $request->only(['email','content']);
        if($validated['email'] && $validated['content']){
            Ticket::create($validated);
            return response()->json([
                'message' => "Success!",
            ],201);
        }
        return response()->json([
            'message' => "Failure!",
        ],301);
    }


}

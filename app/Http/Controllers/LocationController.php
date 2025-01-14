<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationCountries;
use App\Models\LocationStates;
use App\Models\LocationCities;

class LocationController extends Controller
{
    public function get_state_list(Request $r){
        $states = LocationStates::where('country_id',$r->country_id)->where('is_visible',1)->get();
        echo json_encode($states);
    }

    public function get_city_list(Request $r){
        $cities = LocationCities::where('state_id',$r->state_id)->where('is_visible',1)->get();
        echo json_encode($cities);
    }



    public function get_countries_api(Request $request){
        $countries = LocationCountries::where('is_visible',1)->get();
        return response()->json([
            'status' => "true",
            'data' => $countries
        ], 200);
    }

    public function get_state_api($country_id = null){
        if($country_id != null){
            $states = LocationStates::where('country_id',$country_id)->where('is_visible',1)->get();
        }else{
            $states = LocationStates::where('is_visible',1)->get();
        }
        return response()->json([
            'status' => "true",
            'data' => $states
        ], 200);
    }

    public function get_city_api($state_id = null){
        if($state_id != null){
            $cities = LocationCities::where('state_id',$state_id)->where('is_visible',1)->get();
        }else{
            $cities = LocationStates::where('is_visible',1)->get();
        }
        return response()->json([
            'status' => "true",
            'data' => $cities
        ], 200);
    }
}

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
}

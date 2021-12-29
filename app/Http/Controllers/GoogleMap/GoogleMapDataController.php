<?php

namespace App\Http\Controllers\GoogleMap;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapCollection;
use App\Models\GoogleMap\GeoLocation;
use Illuminate\Http\Request;

class GoogleMapDataController extends Controller
{
    public function addMapLocation(){

        return view('add_location');
    }
    public function mapRouteView($routeId = null)
    {
        $location = GeoLocation::where('id', $routeId)->first();

        $route_data = GeoLocation::all();

        return view('map_view', compact('location','route_data'));
    }

    public function store(Request $request)
    {
        try {
            $distance = $this->measureDistance($request);
            $request['distance'] = $distance;
            $location = GeoLocation::create($request->all());

            return redirect()->route('map.view', $location->id);
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

    //algorithm for kilometer measurement
    public function measureDistance($request, $unit = 'K')
    {
        $theta = $request->start_longitude - $request->end_longitude;
        $dist = sin(deg2rad($request->start_latitude)) * sin(deg2rad($request->end_latitude)) + cos(deg2rad($request->start_latitude)) * cos(deg2rad($request->end_latitude)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

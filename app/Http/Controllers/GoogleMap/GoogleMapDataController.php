<?php

namespace App\Http\Controllers\GoogleMap;

use App\Http\Controllers\Controller;
use App\Http\Resources\MapCollection;
use App\Models\GoogleMap\GeoLocation;
use Illuminate\Http\Request;

class GoogleMapDataController extends Controller
{
    public function mapRouteView()
    {
        $location = GeoLocation::where('id', 2)->first();
        $start['latitude'] = $location->start_latitude;
        $start['longitude'] = $location->start_longitude;

        $end['latitude'] = $location->end_latitude;
        $end['longitude'] = $location->end_longitude;

        $collection = array_map(function ($start, $end) {
            return [
                'latitude' => $start,
                'longitude' => $end,
            ];
        }, $start, $end);
        $array = json_encode($collection);
        return view('map_view',compact('array'));
    }

    public function store(Request $request)
    {
        try {
            $distance = $this->measureDistance($request);
            $request['distance'] = $distance;
            GeoLocation::create($request->all());

            return redirect()->back()->with('success', 'Geo location saved successfully');
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

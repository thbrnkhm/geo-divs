<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request)
    {
        // grab the districts id
        $districtId = $request->query('districtId');

        if ($districtId) {
            // Fetch stations related to a specific district
            $stations = Station::where('district_id', $districtId)->paginate(10);
            $district = District::find($districtId);
        } else {
            // Return all districts
            $stations = Station::paginate(10);
            $district = null;
        }

        return view('polling-stations.index', [
            'stations' => $stations,
            'district' => $district,
        ]);
    }
}

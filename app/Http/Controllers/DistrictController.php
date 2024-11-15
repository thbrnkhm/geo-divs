<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\District;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DistrictController extends Controller
{
    // show all districts 
    public function index(Request $request)
    {
        // since we're passing an id and using a dynamic layout element we have to use request to grab the id
        $constituencyId = $request->query('constituencyId');

        if ($constituencyId) {
            // Fetch districts related to a specific constituency
            $districts = District::where('constituency_id', $constituencyId)->paginate(10);
            $constituency = Constituency::find($constituencyId);
        } else {
            // Return all districts
            $districts = Cache::remember('districts', 100, fn() => District::with('station')->paginate(10)) ; // with station so we can do count
            $constituency = null; // Explicitly set it to null
        }

        return view('polling-districts.index', [
            'districts' => $districts,
            'constituency' => $constituency,
        ]);
    }

    // show all stations associated with said district
    public function show($id)
    {
        // find the dist... with the id
        $district = District::find($id);

        if (!$district) {
            abort(404, 'district not found');
        }

        // paginate the stations associated with the district
        $stations = Station::where('district_id', $id)->paginate(10);

        // pass the paginated stations and district to the view
        return view('polling-districts.show', [
            'stations' => $stations,
            'district' => $district
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\District;
use App\Models\Station;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // get the search query

        //  it would be ideal for a user to be able to search for const.. + dist... + stations. either way the results would show the constituency the user searched.
        $constituencies = Constituency::where('name', 'LIKE', "%$query%")->get();

        $districts = District::where('name', 'LIKE', "%$query%")->with('constituency')->get();

        $stations = Station::where('name', 'LIKE', "%$query%")->with('district.constituency')->get();

        return view('search', [
            'query' => $query,
            'constituencies' => $constituencies,
            'districts' => $districts,
            'stations' => $stations,
        ]);
    }
}

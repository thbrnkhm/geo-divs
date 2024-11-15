<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConstituencyController extends Controller
{
    // show all constituencies
    public function index()
    {
        //  wanted to cache but we cant since we have a paginator that we want to be returning "real time" data
        return view('constituencies.index', [
            'constituencies' => Cache::remember('contituencies', 2, fn() => Constituency::with('district')->paginate(10))
        ]);

        // we use pagination that way we can control how many records are being returned
        // $constituencies = Constituency::with('district')->paginate(10);

        // //  then we return the view with a collection of all the constituencies
        // return view('constituencies.index', ['constituencies' => $constituencies]);
    }

    // show districts that belong to a specific consti...
    public function show($id)
    {
        // find the const.. with the id
        $constituency = Constituency::find($id);

        // dd($constituency, $id);

        if (!$constituency) {
            abort(404, 'Constituency not found');
        }

        // paginate the districts associated with the constituency
        $districts = District::where('constituency_id', $id)->paginate(10);

        // pass the paginated districts and constituency to the view
        return view('constituencies.show', [
            'districts' => $districts,
            'constituency' => $constituency
        ]);
    }
}

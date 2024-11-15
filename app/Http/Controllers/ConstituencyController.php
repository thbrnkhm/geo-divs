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
        return view('constituencies.index', [
            'constituencies' => Cache::remember('contituencies', 10, fn() => Constituency::with('district')->paginate(10))
        ]);
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

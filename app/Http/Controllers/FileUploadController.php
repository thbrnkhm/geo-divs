<?php

namespace App\Http\Controllers;

use App\Imports\FileUploadImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadController extends Controller
{
    // show 
    public function show()
    {
        return view('uploads');
    }

    public function uploading(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls|max:2048',
        ]);

        try {
            Excel::import(new FileUploadImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['file' => 'Failed to import data. ' . $e->getMessage()]);
        }
    }
}

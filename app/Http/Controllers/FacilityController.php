<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function view_fac_management(){

        $facilities = Facility::all();
        return view('admin.facility.fac_management',compact('facilities'));
    }
    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Facility::create($request->all());

        return redirect()->route('admin.fac_management')->with('success', 'Facility added successfully!');

    }

    public function updateFacility(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $facility->update($request->all());

        return redirect()->route('admin.fac_management')->with('success', 'Facility updated successfully!');
    }

    public function destroyFacility(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.fac_management')->with('success', 'Facility deleted successfully!');
    }
}

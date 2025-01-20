<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Session;

class VehiclesController extends Controller
{
    var $items = [];

    public function show(Request $request)
    {
        $vehicles = Vehicle::orderBy("vin")->get();
        return Inertia::render('Vehicles/Show', [
            'vehicles' => $vehicles,
            'items' => $request->session()->get('allitems') ?? [],
        ]);
    }
    

    public function save(Request $request)
    {
        $validated = $request->validate([
            'selecteditem.vin' => 'required',
            'selecteditem.make' =>  'required',
            'selecteditem.model' => 'required',
            'selecteditem.year' => 'required',
        ]);

        $vehicle = Vehicle::create([
            'vin' => $request->selecteditem['vin'],
            'make' =>  $request->selecteditem['make'],
            'model' => $request->selecteditem['model'],
            'year' => $request->selecteditem['year']
        ]);

        $allitems = $request->allitems;
        foreach ($allitems as $key => $value) {
            if ($value['vin'] == $request->selecteditem['vin']) {
                unset($allitems[$key]);
            }
        }
        session(['allitems' => $allitems]);
        return redirect()->route('vehicle.show');
    }

    public function delete(Request $request)
    {
        $vehicle = Vehicle::find($request->id); 
        $vehicle->delete(); 
        return redirect()->route('vehicle.show');
    }
}
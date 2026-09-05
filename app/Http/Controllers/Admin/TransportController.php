<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportRoute;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportController extends Controller
{
    public function index()
    {
        $schoolId = Auth::user()->school_id;
        $routes = TransportRoute::where('school_id', $schoolId)->withCount('vehicles')->get();
        $vehicles = Vehicle::where('school_id', $schoolId)->with('route')->get();
        return view('admin.transport.index', compact('routes', 'vehicles'));
    }

    public function storeRoute(Request $request)
    {
        $request->validate(['name' => 'required|string', 'fare' => 'required|numeric|min:0']);
        TransportRoute::create([
            'school_id' => Auth::user()->school_id,
            'name' => $request->name,
            'fare' => $request->fare,
            'active_status' => true,
        ]);
        return redirect()->route('transport.index')->with('success', 'Route created.');
    }

    public function storeVehicle(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|string',
            'vehicle_type' => 'required|in:bus,van,car',
            'capacity' => 'required|integer|min:1',
            'transport_route_id' => 'nullable|exists:transport_routes,id',
            'driver_name' => 'nullable|string',
            'driver_phone' => 'nullable|string',
        ]);

        Vehicle::create(array_merge($request->all(), [
            'school_id' => Auth::user()->school_id,
            'active_status' => true,
        ]));

        return redirect()->route('transport.index')->with('success', 'Vehicle added.');
    }

    public function destroyRoute($id)
    {
        TransportRoute::find($id)->delete();
        return redirect()->route('transport.index')->with('success', 'Route deleted.');
    }

    public function destroyVehicle($id)
    {
        Vehicle::find($id)->delete();
        return redirect()->route('transport.index')->with('success', 'Vehicle deleted.');
    }
}

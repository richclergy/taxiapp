<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RideController extends Controller
{
    /**
     *  Action for administrator to list drivers' drives by driver
     */
    public function listDrives($driverId)
    {
        // let's grab the Ride Model
        $ride = new Ride();
        $driverDrives = $ride::where('driver_id', "=", $driverId);

        // we pass the list of the driver's drives to the view for display
        return view('admin.listdrives', $driverDrives);
    }

    /**
     *  Action for Administrator to list riders' rides by rider
     */
    public function listRides($riderId)
    {        
        // let's grab the Ride Model
        $ride = new Ride();
        $riderRides = $ride::where('rider_id', "=", $riderId);

        // We pass the list of the rider's rides to the view for display
        return view('admin.listrides', $riderRides);
    }

    /**
     *  Action for a Rider to order a ride
     */
    public function orderRide(Request $request)
    {
        // for a rider to other a ride the must be logged in to show they are registed
        if(Session::has('loginId')){
            $ride = new Ride();
            $ride->driver_id = $request->driver_id;
            $ride->rider_id = $request->rider_id;
            $ride->pickup_location = $request->pickup_location;
            $ride->destination_location = $request->destination_location;

            // lets store the rides details in the database
            $result = $ride->save();

            // let's confirm the ride order status to use
            if($result){
                return back()->with('success', 'You have successfully order a ride');
            }else{
                return back()->with('fail', 'We have been unable to fulfill your order for a ride');
            }
        }
    }
}

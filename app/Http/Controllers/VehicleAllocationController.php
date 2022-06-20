<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VehicleAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VehicleAllocationController extends Controller
{  
    /**
     *  Action for drivers to request/pickup a vehicle to drive
     */
    public function getVehicleAllocation(Request $request)
    {
        if(Session::has('loginId')){
            // if the user is logged in let's get his/her user id
            $driverId = Session::get('loginId');

            // use the user id to pull the complete user data
            $driverDetails = User::where('id', '=', $driverId);

            // let's get the license type of this use
            $driverLicenseType = $driverDetails->license_type;

            // A car is vehicle type 1 while bus is vehicle type 2
            // Standard Licence Type is Type 1 and can only be used for pick a car up
            // Heavy Weight Licence Type is Type and can be used to pick up either a car or bus
            // let's check the vehicle type requested against the license type of this user
            // This check will enable us determine if this driver has the license type for the requested vehible type
            if($request->vehicle_type == 2 && $driverLicenseType == 2){
                $allocation = new VehicleAllocation();
                $allocation->driver_id = $request->driver_id;
                $allocation->vehicle_id = $request->vehicle_id;

                // let's make the allocation
                $result = $allocation->save();
                if($result){
                    return back()->with('success', 'Vehicle successfully allocated');
                }
            }else{
                return back()->with('fail', 'Your license type cannot be used to drive a bus');
            }

        }else{
            return back()->with('fail', 'You have to be logged in to get a vehicle allocation');
        }
    }


    /**
     *  Action to answer who was driving a specific vehicle on a specific day
     */
    public function vehicleDriverByDate()
    {
        
    }
}

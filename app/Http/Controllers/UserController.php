<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /*
    |---------------------------------------------
    | Rider Registration
    |---------------------------------------------
    |
    */
    public function register()
    {
        return view('register');
    }

    /*
    |---------------------------------------------
    | User Login Page
    |---------------------------------------------
    |
    */
    public function login()
    {
        return view('login');
    }

    /*
    |---------------------------------------------
    | Rider Registration
    |---------------------------------------------
    |
    */
    public function registerUser(Request $request)
    {
        /**
         *  Let's validate our input
         */
        $request->validate([
            'firstname'=> 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:5',
            'password' => 'required|min:8'
        ]);

        /**
         *  // Let's get our model prepared for saving to db
         */

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $result = $user->save();

        /**
         *  Let's confirm if successfully saved and return appropriate response
         */
        if($result){
            return back()->with('success', 'You have successfully registered as a rider on TaxiApp');
        }else{
            return back()->with('fail', 'Something went wrog while you were registring');
        }
    }

    /*
    |---------------------------------------------
    | Users Login
    |---------------------------------------------
    |
    */
    public function loginUser(Request $request)
    {
        /**
         *  Let's validate our input
         */
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        /**
         *  Let's write our login logic
         */
        $user = User::where('email', '=', $request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                if($user->user_type == 1){
                    return redirect('/rider/dashboard');
                }elseif($user->user_type == 2){
                    return redirect('/driver/dashboard');
                }elseif($user->user_type == 3){
                    return redirect('/admin/dashboard');
                }
            }else{
                return back()->with('fail', 'Your password is incorrect. Please chech and try again');
            }
        }else{
            return back()->with('fail', 'The provided email address is not registered');
        }
    }

}

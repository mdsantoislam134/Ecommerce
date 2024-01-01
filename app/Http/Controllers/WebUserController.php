<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WebUserController
{
     public function loginview(){
 
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return view('user.loginuser');
     }


     public function login(Request $request)
     {
         $credentials = $request->only('email', 'password');
     
         if (Auth::attempt($credentials)) {
             $user = $request->user();
     
             if ($user->user_type == "Admin") {
                 Auth::logout();
                 return redirect()->back()->with('error', "Invalid User");
             }
     
             return redirect('home');
         }
     
         return redirect()->back()->with('error', "Invalid User");
     }
     
    
   
        

     


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('message', 'Logged Out');
    }
    


    public function logoutapi()
{
    $user = Auth::user();

    if ($user) {
        // Revoke the user's access token
        $user->tokens()->delete();
    }

    Auth::logout();

    return response()->json(['success' => 'Logout successfully'], 200);
}
    

}

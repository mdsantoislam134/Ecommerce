<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Policy;
class PolicyController extends Controller
{
  
  public function allpolicy(){
    $pol = Policy::all();
    return view('Admin.policy',['policy'=>$pol]);
  }


  public function showForm(){
    return view('Admin.addpolicy');
  }


    public function add_policy(Request $request){
    
        $policy = New Policy;
        $policy->policy_text = $request->policy_text;
        $policy->save();

    
        return redirect('add-Policy');

    }
}

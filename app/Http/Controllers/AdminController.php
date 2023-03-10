<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Auth;

class AdminController extends Controller
{
    public function authenticate(Request $request){

        $this->validate($request,[
'email' => 'required|email',
 'password' => 'required'
        ]);
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' =>$request->password],
        $request->get('remember'))){
return redirect()->route('admin.dashboard');

        } else{
            session()->flash('error','either Email/Password is incorrect');
            return back()->withInput($request->only('email'));
        }
    }
}

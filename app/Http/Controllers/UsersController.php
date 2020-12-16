<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Auth;



class UsersController extends Controller
{
    //register form view
    function registerForm(){
        return view('users/register');
    }
    function registerHandle(Request $request){
        $validator = \Validator::make($request->all(), [
            
            'firstName' => 'required|max:10|min:2',
            'lastName' => 'required|max:10|min:2',
            'email'=>'required|unique:users|email',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}/',      // must contain at least one lowercase letter
            ],
             'confirm_password'=>'required|same:password' ,
             'phone'=>'required|min:11'
            
        ]
    );
     
        
        if($validator->fails())
        {
             return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }
         //
         
         $user=new User();
         $user->firstName=$request->firstName;
         $user->lastName=$request->lastName;
         $user->email=$request->email;
         $user->phone=$request->phone;
         $user->password=\Hash::make($request->password);
         $user->access_token=Str::random(64);
          $user->save();
return redirect ('/login');
    }
function loginForm(){
    return view('users/login');   
}
function loginHandle(Request $request){
    $vaildator=Validator::make($request->all(),[
        'email'=>'required|max:100|min:3',
        'password' => 'required|min:6',             
        
    ]);
    if ($vaildator->fails()){
        return redirect('login')
            ->withErrors($vaildator)
            ->withInput();
    }
    $cred=array('email'=>$request->email,'password'=>$request->password);
                
    if(Auth::attempt($cred))
     {
            return redirect('/');
                
      }           
                
  else   {
 return view('/users/login')->withErrors(["notLog"=>"You've tried to sign in too many times with an incorrect account or password."]);

    } 
}
function logout(){
    Auth::logout();
    return redirect('/');
}
}

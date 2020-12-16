<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trips;
use App\Models\Seats;
use App\Models\Bus;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
class ApiController extends Controller
{
    //login form
    function loginHandle(Request $request){
        $vaildator=\Validator::make($request->all(),[
            'email'=>'required|max:100|min:3',
            'password' => 'required|min:6',             
            
        ]);
        if($vaildator->fails())
        {
            return response()->json([
                'message'=>'user is not logged',
                'errors'=>$vaildator->errors()
            ]);
            
        }
        $cred=array('email'=>$request->email,'password'=>$request->password);
                    
        if(Auth::attempt($cred))
        {
            return response()->json([
                'user'=>Auth::user()
            ]);
        }else
        {
            return response()->json([
                'message'=>'not logged in '
            ]);
        }

    }
    //register form
    function registerHandle(Request $request){
        $vaildator = \Validator::make($request->all(), [
            
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
     
        
        if($vaildator->fails())
        {
            return response()->json([
                'message'=>'user is not logged',
                'errors'=>$vaildator->errors()
            ]);
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
    
          return response()->json([
            'message'=>'user created successfully',
            'user'=>$user
        ]);
        }
        //booktrip
        function bookTrip(Request $request){
            $vaildator=Validator::make($request->all(),[
                'regionFrom'=>'required',
                'regionTo' => 'required',   
                'seat_no'=>'required'          
                
            ]);
            if($vaildator->fails())
            {
                return response()->json([
                    'message'=>'Ticket is Not Booked',
                    'errors'=>$vaildator->errors()
                ]);
            }
        $trip=new Trips();
        $seat_no=$request->seat_no;
        $bus=DB::table('city')->where('city',$request->regionFrom)->first();
        $seat=DB::table('seats')->where([
            ['seat_no',$seat_no],
            ['bus_id',$bus->bus_id]
    ])->first();
      
    
        $trip->start=$request->regionFrom;
        $trip->end=$request->regionTo;
        $trip->user_id=Auth::User()->id;
        $trip->bus_id=$bus->bus_id;
        $trip->seat_id=$seat->id;
        $state=Seats::findorfail($seat->id);
        $state->state=1;
        $trip->save();
        $state->save();
        return response()->json([
            'message'=>'Success !',
            'trip'=>$trip,
            'state'=>$state
        ]);    
    
    
        } 
       

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trips;
use App\Models\Seats;
use App\Models\Bus;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;





class TripController extends Controller
{
    //
    function bookView(){
        return view('forms/booking');

    }
    function bookTrip(Request $request){
        $vaildator=Validator::make($request->all(),[
            'regionFrom'=>'required',
            'regionTo' => 'required',   
            'seat_no'=>'required'          
            
        ]);
        if ($vaildator->fails()){
            return redirect('book')
                ->withErrors($vaildator)
                ->withInput();
        }
    $trip=new Trips();
    $seat_no=$request->seat_no;
    $bus=DB::table('city')->where('city',$request->regionFrom)->first();
    $seat=DB::table('seats')->where([
        ['seat_no',$seat_no],
        ['bus_id',$bus->bus_id]
])->first();
    $type = $request->get('regionTo');
    

    $trip->start=$request->regionFrom;
    $trip->end=$request->regionTo;
    $trip->user_id=Auth::User()->id;
    $trip->bus_id=$bus->bus_id;
    $trip->seat_id=$seat->id;
    $state=Seats::findorfail($seat->id);
    $state->state=1;
    $trip->save();
    $state->save();
  
    return redirect()->back()->with('msg', 'success!');

    } 
    //create bus and  number of seates
    function create(){
        return view('forms/bus');

    } 
    function createHandle(Request $request){
        $capacity= 12;
        $bus=new Bus();
$bus->last_city=$request->last_city;
$bus->driver=$request->driver_name;
$bus->save();
for($i=1; $i<=$capacity;$i++){
    $seat=new Seats();
    $seat->seat_no=$i;
    $seat->bus_id=$bus->id;
    $seat->save();
}
    }
    function availableSeats(){
        $country_list=DB::table('regions')->groupBy('regionFrom')->orderBy('id')->get();
        $seats=DB::table('seats')->where('state',"0")->get();
       
        
        return view('forms/booking',compact('seats','country_list'));
    }
  /*  function fetch(Request $request){
       
        $dependent=$request->get('dependent');
        $value=$request->get('value');
        $city1=DB::table('city')->where('city',$value)->first();
        if($city1 !=null){
        $current_city=$city1->orderNo;
       $bus=DB::table('buses')->where('id',$city1->bus_id)->first();
       $city2=DB::table('city')->where('city',$bus->last_city)->first();
       $last_city=$city2->orderNo;

        }
    }*/
    function reset (){
        $bus=Bus::get();
        return view('forms/reset',compact('bus'));
    }
    function resetHandle(Request $request){
        $driver=$request->driver_name;
        $bus=DB::table('buses')->where('driver',$driver)->first();
        $id=$bus->id;
        $seats=DB::table('seats')->where([
            ['bus_id',$id],
            ['state',1]

        ])->get();
        foreach($seats as $seat){
            $state=Seats::findorfail($seat->id);
            $state->state=0;
$state->save();


        }
        return redirect('/reset');

        }
}


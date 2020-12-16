<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use DB;

class RegionsController extends Controller
{
    //
  
    function fetch(Request $request){
        $select=$request->get('select');
        $value=$request->get('value');
        $dependent=$request->get('dependent');
        $data=DB::table('regions')->where($select,$value)->groupBy($dependent)->get();

        $output=' <option selected value=""> To</option>';
        foreach($data as $row){
            $output.='<option value="'.$row->$dependent.'">
            '.$row->$dependent.'</option>';
            
        }
        echo $output;     

    }
   
    
}

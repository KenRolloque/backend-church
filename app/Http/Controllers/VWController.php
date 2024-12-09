<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Models\One2OneModel;
use App\Models\VictoryWeekendModel;

class VWController extends Controller
{
    //
    public function add(Request $request){

        // Check Policy
        $status = Gate::inspect('vw', VictoryWeekendModel::class);
        if(!$status->allowed()){
            return $status;
        }

        // Check field is not empty
        $validate = Validator::make($request->all(),
            [
                'admin_id' => 'required',
                'attendes_id'=> 'required',
                'vw_batch_no'=> 'required',
                'vw_date'=> 'required',
                'vw_day1'=> 'required',
                'vw_day2'=> 'required',
                'vw_water_baptism'=> 'required',
                'status'=> 'required',
            ]
            );

        
        if($validate->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field'
                ],406
            );
        }

        // Check if record exists
        try{
            $isExist = VictoryWeekendModel::where('attendes_id',$request->attendes_id)->exists();
            if($isExist){
                return response()->json(
                    ["message" => "Record already exist"]
                );
            }
        }catch(\Exception $e){
            return $e;
        }
     
        /// Insert Data
        try{
            VictoryWeekendModel::insert(
                [
                    'admin_id' => $request->admin_id,
                    'attendes_id'=> $request->attendes_id,
                    'vw_batch_no'=> $request->vw_batch_no,
                    'vw_date'=> $request->vw_date,
                    'vw_day1'=> $request->vw_day1,
                    'vw_day2'=> $request->vw_day2,
                    'vw_water_baptism'=> $request->vw_water_baptism,
                    'status'=> $request->status,
                ]
                );

            return response()->json(
                [
                    'message'=>"Added Succesfully"
                ],200
            );

        }catch(\Exception $e){
            return $e;
        }
    }

    public function getAll(Request $request){

        $status = Gate::inspect('vw', VictoryWeekendModel::class);      
        if(!$status->allowed()){
            return $status;
        }

        try{
            $response = DB::table('victoryweekend as vw')
            ->join('attendees as a','a.attendes_id','=','vw.attendes_id')
            ->select(
                DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendee_fullname"),
                'vw.vw_batch_no',
                'vw.vw_date',
                'vw.vw_day1',
                'vw.vw_day2',
                'vw.vw_water_baptism',
                'vw.status'
            )
            ->get();

            return $response;
        }catch(\Exception $e){
            return response()->json([
                'message'=>$e
            ],500);;
        }
    }
}

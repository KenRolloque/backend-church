<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Models\One2OneModel;

class One2OneController extends Controller
{
    //
    public function add(Request $request){

        // Check Policy
        $status = Gate::authorize('getOne2One', One2OneModel::class);
       
        if(!$status->allowed()){
            return $status;
        }

        // Check field is not empty
        $validate = Validator::make($request->all(),
            [
                'admin_id' => 'required',
                'attendes_id' => 'required',
                'leader_id'=>'required',
                'date_start'=>'required',
                'date_end'=>'required',
                'status'=>'required',
            ]
            );

        if ($validate->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field'
                ],406
            );
        }

        // Check if attendees exist
        $isExist = One2OneModel::where('attendes_id',$request->attendes_id)->exists();

        if($isExist){
            return response()->json(
                ["message" => 'Record already exist']
            );
        }

        // Insert Data
        try{
            One2OneModel::insert([
                'admin_id' => $request->admin_id,
                'attendes_id' => $request->attendes_id,
                'leader_id'=>$request->leader_id,
                'date_start'=>$request->date_start,
                'date_end'=>$request->date_end,
                'status'=>$request->status,
            ]);

            return response()->json(200);

        }catch(\Exception $e){
            return response()->json(
                [
                    'message' => 'An error occured while fetching data. Please try again',
                    'error'=>$e
                ],504
            );
        }
    }

    public function getAll(Request $request){

        // Check Policy
       $status = Gate::authorize('getOne2One', One2OneModel::class);
        try{
            if(!$status->allowed()){
                return $status;
            }

            $response = DB::table('one2one')
                ->join('attendees','attendees.attendes_id','=','one2one.attendes_id')
                ->join('leader','leader.leader_id','=','one2one.leader_id')
                ->join('attendees as a2','a2.attendes_id','=','leader.attendes_id')
                ->select(
                    'one2one_id',
                    DB::raw(
                    "CONCAT(attendees.attendees_fname,' ',attendees.attendees_mname,' ',attendees.attendees_lname) as attendee_fullname"
                    ),
                    DB::raw(
                        "CONCAT(a2.attendees_fname,' ',a2.attendees_mname,' ',a2.attendees_lname) as leader_fullname"
                    ),
                    'one2one.date_start',
                    'one2one.date_end',
                    'one2one.status'
                )->get();

                return $response;

        }catch(\Exception $e){
            return response()->json(
                [
                    'message' => 'An error occured while fetching data. Please try again',
                    'error' => $e
                ],504
            );
        }
   
    }
}

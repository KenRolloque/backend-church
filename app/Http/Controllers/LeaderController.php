<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Models\LeaderModel;
use App\Models\Attendees;

class LeaderController extends Controller
{
    //

    public function add(Request $request){
        
        // Check Policy
        $status = Gate::inspect('addLeader', LeaderModel::class);
        if(!$status->allow()){
            return $status;
        }

        // Check Field if empty
        $isEmpty = Validator::make($request->all(),    
            [
                'admin_id'=> 'required',
                'attendes_id'=> 'required',
                'status' => 'required'
            ]
        );

        if($isEmpty->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field'
                ],406
            );
        }

        // Check if leader exist in attendees
        $leader = '';
        try{
            $leader = LeaderModel::where('attendes_id',$request->attendes_id)->exists();
            if($leader){
                return response()->json(
                    [
                        'message' => 'Record already exist.'
                    ]
                );
            }
        }catch(\Exception $e){
            return $e;
        }


        // Insert Data    
        try{
            LeaderModel::insert([
                'admin_id'=> $request->admin_id,
                'attendes_id'=>$request->attendes_id,
                'status' => 'Active'
            ]);
    
            return response()->json([
                'message'=>'Added Successfully'
            ],200);

        }catch(\Exception $e){
            // return $e;

            return response()->json(
                [
                    "message" => $e
                ],500
            );
        }
      
    }

    public function getAll(Request $request){
        $reponse = DB::table('leader')
                ->join('attendees','leader.attendes_id','=','attendees.attendes_id')
                ->select(
                        'leader.leader_id',
                        DB::raw("CONCAT(attendees.attendees_fname,' ',attendees.attendees_mname,' ',attendees.attendees_lname ) AS fullname"))
                ->get();
        return response()->json($reponse);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\InternModel;

class InternController extends Controller
{
    //
    public function add(Request $request){

        // Policy
        $policy = Gate::inspect('intern', InternModel::class);
        if(!$policy->allow()){
            return $policy;
        }

        // Check Field
        $validate = Validator::make($request->all(),
            [
                "admin_id"=> "required",
                "attendes_id" => "required",
                "leader_id" => "required"
            ]
            );
        
        if($validate->fails()){
            return response()->json(["message" => "Please fill all required fields."]);
        }

        // Check for duplicate

        try{
            $isExist = InternModel::where('attendes_id',$request->attendes_id)->exists();
            if($isExist){
                return response()->json(["message" => "Record already exists."]);
            }

        }catch(\Exception $e){
            return response()->json(
                [
                    "message" => 'An error occured',
                    "error" => $e
                ]
            );
        }

        //Insert Record
        try{
            InternModel::insert(
                [
                    'admin_id' => $request->admin_id,
                    'attendes_id' => $request->attendes_id,
                    'leader_id' => $request->leader_id
                ]
                );
            
            return response()->json(["message" => "Record added successfully"]);

        }catch(\Exception $e){
            return response()->json(
                [
                    "message" => "An error occured. Please try again",
                    "error" => $e
                ]
            );
        }

    }

    public function getAll(){
            // Policy
            $policy = Gate::inspect('intern', InternModel::class);
            if(!$policy->allow()){
                return $policy;
            }
            
            // Fetch Data
            try{
                $data = DB::table('intern as i')
                    ->join('attendees as a1','a1.attendes_id','i.attendes_id')
                    ->join('attendees as a2','i.leader_id','a2.attendes_id')
                    ->select(
                        'i.intern_id',

                        DB::raw("CONCAT(
                            a1.attendees_fname,' ',
                            a1.attendees_mname,' ',
                            a1.attendees_lname
                            ) as intern_fullname"),

                        'i.leader_id',

                        DB::raw("CONCAT(
                            a2.attendees_fname,' ',
                            a2.attendees_mname,' ',
                            a2.attendees_lname
                            ) as leader_fullname"),
                        
                    )->get();
                return $data;
            }catch(\Exception $e){

                return response()->json([
                    "message"=>"An error occured.Please try again",
                    "error" =>  $e
                ]);
            }
    }
}

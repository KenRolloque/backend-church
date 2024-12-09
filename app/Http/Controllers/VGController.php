<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Gate;

use App\Models\VGModel;

class VGController extends Controller
{
    //
    public function add(Request $request){
        
        // Policy
        $policy = Gate::inspect('vg', VGModel::class);
        if(!$policy->allow()){
            return $policy;
        }

        // Validate
        $validate = Validator::make($request->all(),[
            'admin_id'=>'required',
            'leader_id' => 'required',
            'intern_id' => 'required',
            'vg_no' => 'required',
            'vg_no_members' => 'required',
            'vg_life_stage' => 'required',
            'vg_status' => 'required',
            'year' => 'required'
        ]);
        
        if ($validate->fails()){
            return response()->json([
                "message"=>"Please fill all required field"
            ]);
        }

        // Check duplicate
        try{
            $isExist = VGModel::where('year',$request->year)->exists();
            if($isExist){
                return response()->json([
                    "message" => "Record already exist"
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "An error occured on checking existence of record",
                "error" => $e
            ]);
        }


        // Insert
        try{
            VGModel::insert([
                'admin_id'=> $request->admin_id,
                'leader_id' => $request->leader_id,
                'intern_id' => $request->intern_id,
                'vg_no' => $request->vg_no,
                'vg_no_members' => $request->vg_no_members,
                'vg_life_stage' => $request->vg_life_stage,
                'vg_status' => $request->vg_status,
                'year' => $request->year
            ]);
            
            return response()->json([
                "message" => "Record added successfully"
            ]);
        }catch(\Exception $e){
            return response()->json([
                "message" => "An error occured while inserting record",
                "error" => $e
            ]);
        }

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Models\One2OneModel;
use App\Models\ChurchCommunityModel;
use App\Models\PurpleBook1Model;
use App\Models\PurpleBook2Model;
use App\Models\PurpleBook3Model;
use App\Models\PurpleBook4Model;
use App\Models\MakingDisciples1Model;
use App\Models\MakingDisciples2Model;
use App\Models\EmpoweringLeadersTable;
use App\Models\Leaders113Model;

use App\Models\ClassesModel;

class ClassesController extends Controller
{
    //
    public function add(Request $request){

        //Check Policy
        $policy = Gate::inspect('classesPolicy', ClassesModel::class);

        if(!$policy->allow()){
            return $policy;
        }

        // Check data
        $validate = Validator::make($request->all(),
            [
                'attendes_id' => 'required',
                'admin_id' => 'required',
                'class' => 'required',
                'date' => 'required',
                'status' => 'required'
            ]
            );

        if ($validate->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field'
                ],406
            );
        }

        // Check if data exist
        try{
            $isExist =  DB::table('classes')
                    ->where('attendes_id',$request->attendes_id)
                    ->where('class',$request->class)
                    ->exists();
            if($isExist){
                return response()->json(["message"=>"Attendees already exist in the Record"]);
            }
           
                DB::table('classes')->insert([
                    'attendes_id' =>$request->attendes_id,
                    'admin_id'=> $request->admin_id,
                    'class' => $request->class,
                    'date' => $request->date,
                    'status' => $request->status
                ]);
            
                return response()->json(['message'=>"Added Successfully"],200);
            
            
        }catch(\Exception $e){
            return response()->json([$e],500);
        }
    }

    public function getAll(Request $request){
        $policy = Gate::inspect('classesPolicy', ClassesModel::class);

        if(!$policy->allow()){
            return $policy;
        }

        // Fetch Data
        try{

           $data = ClassesModel::get();
           return $data;

        }catch(\Exception $e){
            return response()->json(
                [
                    "message" => "An error occured. Please try again",
                    "error" => $e
                ]
            );
        }
  


    }

    public function get(Request $request, string $class){
        $policy = Gate::inspect('classesPolicy', ClassesModel::class);

        if(!$policy->allow()){
            return $policy;
        }

        // Church Community
        if($class == 'church_community'){
            try{
                $response = DB::table('classes as cc')
                    ->join('attendees as a','a.attendes_id' ,'=','cc.attendes_id')
                    ->where('cc.class','Church Community')
                    ->select(
                        'cc.id',
                        'cc.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'cc.date',
                        'cc.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }

        }

        else if($class == 'church_purble_book1'){
            try{
                $response = DB::table('classes as pb')
                    ->join('attendees as a','a.attendes_id' ,'=','pb.attendes_id')
                    ->where('pb.class','Purple Book 1')
                    ->select(
                        'pb.id',
                        'pb.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'pb.date',
                        'pb.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
        else if($class == 'church_purble_book2'){
            try{
                $response = DB::table('classes as pb')
                    ->join('attendees as a','a.attendes_id' ,'=','pb.attendes_id')
                    ->where('pb.class','Purple Book 2')
                    ->select(
                        'pb.id',
                        'pb.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'pb.date',
                        'pb.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
        else if($class == 'church_purble_book3'){
            try{
                $response = DB::table('classes as pb')
                    ->join('attendees as a','a.attendes_id' ,'=','pb.attendes_id')
                    ->where('pb.class','Purple Book 3')
                    ->select(
                        'pb.id',
                        'pb.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'pb.date',
                        'pb.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
        else if($class == 'church_purble_book4'){
            try{
                $response = DB::table('classes as pb')
                    ->join('attendees as a','a.attendes_id' ,'=','pb.attendes_id')
                    ->where('pb.class','Purple Book 4')
                    ->select(
                        'pb.id',
                        'pb.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'pb.date',
                        'pb.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
        else if($class == 'making_disciples1'){
            try{
                $response = DB::table('classes as md')
                    ->join('attendees as a','a.attendes_id' ,'=','md.attendes_id')
                    ->where('md.class','Making Disciples 1')
                    ->select(
                        'md.id',
                        'md.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'md.date',
                        'md.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
        else if($class == 'making_disciples2'){
         
            try{
                $response = DB::table('classes as md')
                    ->join('attendees as a','a.attendes_id' ,'=','md.attendes_id')
                    ->where('md.class','Making Disciples 2')
                    ->select(
                        'md.id',
                        'md.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'md.date',
                        'md.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
        else if($class == 'empowering_leaders'){
        
            try{
                $response = DB::table('classes as el')
                    ->join('attendees as a','a.attendes_id' ,'=','el.attendes_id')
                    ->where('el.class','Empowering Leaders')
                    ->select(
                        'el.id',
                        'el.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'el.date',
                        'el.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }

        }
        else if($class == 'leaders113'){
            try{
                $response = DB::table('classes as l')
                    ->join('attendees as a','a.attendes_id' ,'=','l.attendes_id')
                    ->where('l.class','Leaders 113')

                    ->select(
                        'l.id',
                        'l.attendes_id',
                        DB::raw("CONCAT(a.attendees_fname,' ',a.attendees_mname,' ',a.attendees_lname) as attendees_fullname"),
                        'l.date',
                        'l.status'
                    )->get();
                
            return $response;

            }catch(\Except $e){

                return response()->json(["message"=>$e],500);
            }
        }
    }
}

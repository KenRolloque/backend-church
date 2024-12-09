<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Attendees;

use App\Models\KidsModel;
use App\Models\AdminMinistryModel;
use App\Models\CommunicationModel;
use App\Models\CreativeDesignModel;
use App\Models\MusicTeamModel;
use App\Models\PrayerTeamModel;
use App\Models\TechModel;
use App\Models\UsheringModel;

use App\Models\One2OneModel;
use App\Models\VictoryWeekendModel;
use App\Models\ChurchCommunityModel;
use App\Models\EmpoweringLeadersTable;
use App\Models\Leaders113Model;
use App\Models\MakingDisciples1Model;
use App\Models\MakingDisciples2Model;
use App\Models\PurbleBook1Model;
use App\Models\PurbleBook2Model;
use App\Models\PurbleBook3Model;
use App\Models\PurbleBook4Model;


class AttendeesController extends Controller
{
    //
       /**
     * Update the given blog post.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function getAttendes(Request $request, string $service){

        Gate::authorize('getUser', Attendees::class);

        try{
            if($service =='all'){
                $response = DB::table('attendees')
                ->select(
                    'attendes_id',
                    DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"),
                    'attendees_birthday',
                    'attendees_facebook',
                    'attendees_mobile_number',
                    'attendees_life_stage',
                    'attendees_sector_of_society',
                    'attendees_school',
                    'attendees_school_level',
                    'attendees_service_commitment',
                    )
                ->get();
            return $response;
            
            }else if($service == 'nine'){
                $response = DB::table('attendees')
                ->where('attendees_service_commitment','9am Service')
                ->select(
                    'attendes_id',
                    DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"),
                    'attendees_birthday',
                    'attendees_facebook',
                    'attendees_mobile_number',
                    'attendees_life_stage',
                    'attendees_sector_of_society',
                    'attendees_school',
                    'attendees_school_level',
                    'attendees_service_commitment',
                    )
                
                ->get();

                return $response;
            }

            else if($service == 'eleven'){
                $response = DB::table('attendees')
                ->where('attendees_service_commitment','11am Service')
                ->select(
                    'attendes_id',
                    DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"),
                    'attendees_birthday',
                    'attendees_facebook',
                    'attendees_mobile_number',
                    'attendees_life_stage',
                    'attendees_sector_of_society',
                    'attendees_school',
                    'attendees_school_level',
                    'attendees_service_commitment',
                    )
                
                ->get();

                return $response;
            }

            else if($service == 'three'){
                $response = DB::table('attendees')
                ->where('attendees_service_commitment','3pm Service')
                ->select(
                    'attendes_id',
                    DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"),
                    'attendees_birthday',
                    'attendees_facebook',
                    'attendees_mobile_number',
                    'attendees_life_stage',
                    'attendees_sector_of_society',
                    'attendees_school',
                    'attendees_school_level',
                    'attendees_service_commitment',
                    )
                
                ->get();

                return $response;
            }

            else if($service == 'five'){
                $response = DB::table('attendees')
                ->where('attendees_service_commitment','5pm Service')
                ->select(
                    'attendes_id',
                    DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"),
                    'attendees_birthday',
                    'attendees_facebook',
                    'attendees_mobile_number',
                    'attendees_life_stage',
                    'attendees_sector_of_society',
                    'attendees_school',
                    'attendees_school_level',
                    'attendees_service_commitment',
                    )
                
                ->get();

                return $response;
            }

            else if($service == 'youth'){
                $response = DB::table('attendees')
                ->where('attendees_service_commitment','Youth Service')
                ->select(
                    'attendes_id',
                    DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"),
                    'attendees_birthday',
                    'attendees_facebook',
                    'attendees_mobile_number',
                    'attendees_life_stage',
                    'attendees_sector_of_society',
                    'attendees_school',
                    'attendees_school_level',
                    'attendees_service_commitment',
                    )
                
                ->get();

                return $response;
            }

        }catch(\Exception $e){

                return response()->json(
                    [
                        'message' => 'An error occured while fetching data. Please try again'
                    ],504
                );
            }
        

    }

    public function getAttendee(Request $request){

     Gate::authorize('getAttendee', Attendees::class);
  
        $response = Attendees::select('attendes_id',
                            DB::raw("CONCAT(attendees_fname,' ', attendees_mname,' ',attendees_lname) AS fullname"))->get();
        if($response->isEmpty()){
            
            return response()->noContent();
        }else{
                // return $response;
                return response()->json(
                    $response
                );
        }

    }


    public function add(Request $request){

        // Check Policy
        Gate::authorize('getUser', Attendees::class);
 
        $response = Gate::authorize('create', Attendees::class);

        // Validate User
        $validate_request = Validator::make($request->all(),
            [
                'admin_id' => 'required',
                'attendees_fname' => 'required',
                'attendees_lname' => 'required',
                'attendees_mname' => 'required',
                'attendees_birthday' =>'required',
                'attendees_facebook' =>'required',
                'attendees_mobile_number'=>'required',
                'attendees_life_stage'=>'required',
                'attendees_sector_of_society'=>'required',
                'attendees_school'=>'required',
                'attendees_school_level'=>'required',
                'attendees_service_commitment'=>'required'
            ]
        );

        if($validate_request->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field'
                ],406
            );
        }

        // Check if data exists

        $attendees = '';
        try{
            $attendees = Attendees::where('attendees_fname',$request->attendees_fname)
            ->where('attendees_mname',$request->attendees_mname)
            ->where('attendees_lname',$request->attendees_lname)
            ->exists();

            if($attendees){
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
        if($response->allowed()){

            try{
                Attendees::insert([
                    'admin_id' => $request->admin_id,
                    'attendees_fname' => $request->attendees_fname,
                    'attendees_lname' => $request->attendees_lname,
                    'attendees_mname' => $request->attendees_mname,
                    'attendees_birthday' => $request->attendees_birthday,
                    'attendees_facebook' => $request->attendees_facebook,
                    'attendees_mobile_number' => $request->attendees_mobile_number,
                    'attendees_life_stage' => $request->attendees_life_stage,
                    'attendees_sector_of_society' => $request->attendees_sector_of_society,
                    'attendees_school' => $request->attendees_school,
                    'attendees_school_level' => $request->attendees_school_level,
                    'attendees_service_commitment' => $request->attendees_service_commitment,
                ]);
                return response()->json([
                   
                    'message' => "Added Successfully",
                ],200);

            }catch(\Exception $e){
                return $e;
            }

        }else{
            return response('Unauthorized Action',401);
        }

    }


    public function update (Request $request){
        
        //Check Policy
        Gate::authorize('update', Attendees::class);

        $validate = Validator::make($request->all(),
            [
                'attendes_id' => 'required',
                'attendees_fname' => 'required',
                'attendees_lname' => 'required',
                'attendees_mname' => 'required',
                'attendees_birthday' => 'required',
                'attendees_facebook' => 'required',
                'attendees_mobile_number' => 'required',
                'attendees_life_stage' => 'required',
                'attendees_sector_of_society' => 'required',
                'attendees_school' => 'required',
                'attendees_school_level' => 'required',
                'attendees_service_commitment' =>'required'
            ]
            );
        
        // Validate
        if($validate->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field.'
                ],406
            );
        }   


        // Check Duplicate in Database
        $attendees = '';
        try{
            $attendees = Attendees::where('attendees_fname',$request->attendees_fname)
            ->where('attendees_mname',$request->attendees_mname)
            ->where('attendees_lname',$request->attendees_lname)
            ->exists();

        }catch(\Exception $e){
            return $e;
        }
     
        if($attendees){
            return response()->json(
                [
                     'message' => 'Record already exist.'
                ]
            );
        }

        // Update Record
        if($response->allowed()){

            try{
                Attendees::where('attendes_id', $request->attendes_id)->update([
                    'attendees_fname' => $request->attendees_fname,
                    'attendees_lname' => $request->attendees_lname,
                    'attendees_mname' => $request->attendees_mname,
                    'attendees_birthday' => $request->attendees_birthday,
                    'attendees_facebook' => $request->attendees_facebook,
                    'attendees_mobile_number' => $request->attendees_mobile_number,
                    'attendees_life_stage' => $request->attendees_life_stage,
                    'attendees_sector_of_society' => $request->attendees_sector_of_society,
                    'attendees_school' => $request->attendees_school,
                    'attendees_school_level' => $request->attendees_school_level,
                    'attendees_service_commitment' => $request->attendees_service_commitment,
                ] );
                return response()->json([
                    'message' => "Updated Successfully",
                    'status' => 200
                ]);

            }catch(\Exception $e){

                return $e;
            }

    
        }else{
            return response('Unauthorized Action',401);
        }

    }
}

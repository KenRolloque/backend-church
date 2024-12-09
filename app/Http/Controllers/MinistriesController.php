<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Models\Attendees;
use App\Models\KidsModel;
use App\Models\PrayerTeamModel;
use App\Models\UsheringModel;
use App\Models\CommunicationModel;
use App\Models\TechModel;
use App\Models\MinistryModel;

class MinistriesController extends Controller
{
    //
   

        public function add(Request $request){

            // Check Policy
            $status = Gate::inspect('ministry', MinistryModel::class);
            if(!$status->allowed()){
                return $status;
            }

            // Check if request is not empty
            $validate = Validator::make($request->all(),
                [
                    'attendes_id'=>'required',
                    'admin_id' => 'required',
                    'ministry' => 'required',
                    'date_joined' => 'required',
                    'service_commitment' => 'required',
                    'status'=>  'required',
                ]
        
            );

            if($validate->fails()){
                return response()->json(
                    [
                        'message' => 'Please fill all required field'
                    ],406
                );
            }

            // Check if record exist
            try{
                $isExist = MinistryModel::where('attendes_id',$request->attendes_id)
                ->where('ministry',$request->ministry)
                ->exists();
    
                if($isExist){
                    return response()->json(
                        [
                            "message" => "Record already exist"
                        ]
                    );
                }
            }catch(\Exception $e){
                return $e;
            }
            
            // Insert Record
            try{
                MinistryModel::insert(
                    [
                        "admin_id" => $request->admin_id,
                        "attendes_id" => $request->attendes_id,
                        "ministry" => $request->ministry,
                        "date_joined" => $request->date_joined,
                        "service_commitment" => $request->service_commitment,
                        "status" => $request->status
                    ]
                    );

                    return response()->json(["message"=>"Added Successfully"]);
            }catch(\Exception $e){
                return response()->json([
                    "message"=>"Failed to add date ",
                    "error" => $e
                ]);

            }

            // try{
            //     if($ministry == 'kids'){
           
            //         $attendees = DB::table('kids')
            //             ->where('attendes_id',$request->attendes_id )
            //             ->first();
    
            //         if($attendees){
            //             return response()->json([
            //                 'message' => 'Record already Exist'
            //             ],201);
                    
            //         }
    
            //         try{
            //             KidsModel::insert([
            //                 'attendes_id'=> $request->attendes_id,
            //                 'admin_id' => $request->admin_id,
            //                 'date_joined' => now(),
            //                 'service_commitment' =>  $request->service,
            //                 'status'=>  $request->status,
            //             ]);
            
            //             return response()->json(
            //                 [
            //                     'message' => 'Added Successfully'
            //                 ],200
            //             );
            
            //         }catch(QueryException $e){
            //             return response->json( ['message'=>'Failed to add to the ministry '.$e->getMessage()],500 );
            //         }catch(\Exception $e){
            //             return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
            //         }
    
            //     }
                
            //     else if( $ministry == 'prayer'){
    
            //         try{
            //             PrayerTeamModel::insert([
            //                 'attendes_id'=> $request->attendes_id,
            //                 'admin_id' => $request->admin_id,
            //                 'date_joined' => now(),
            //                 'service_commitment' =>  $request->service,
            //                 'status'=>  $request->status,
            //             ]);
            
            //             return response()->json(
            //                 [
            //                     'message' => 'Added Successfully'
            //                 ],200
            //             );
            
            //         }catch(QueryException $e){
            //             return response->json( ['message'=>'Failed to add to the ministry '.$e->getMessage()],500 );
            //         }catch(\Exception $e){
            //             return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
            //         }
            //     }
    
            //     else if( $ministry == 'ushering'){
    
            //         try{
            //             UsheringModel::insert([
            //                 'attendes_id'=> $request->attendes_id,
            //                 'admin_id' => $request->admin_id,
            //                 'date_joined' => now(),
            //                 'service_commitment' =>  $request->service,
            //                 'status'=>  $request->status,
            //             ]);
            
            //             return response()->json(
            //                 [
            //                     'message' => 'Added Successfully'
            //                 ],200
            //             );
            
            //         }catch(QueryException $e){
            //             return response->json( ['message'=>'Failed to add to the ministry '.$e->getMessage()],500 );
            //         }catch(\Exception $e){
            //             return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
            //         }
            //     }
    
            //     else if( $ministry == 'communication'){
    
            //         try{
            //             CommunicationModel::insert([
            //                 'attendes_id'=> $request->attendes_id,
            //                 'admin_id' => $request->admin_id,
            //                 'date_joined' => now(),
            //                 'service_commitment' =>  $request->service,
            //                 'status'=>  $request->status,
            //             ]);
            
            //             return response()->json(
            //                 [
            //                     'message' => 'Added Successfully'
            //                 ],200
            //             );
            
            //         }catch(QueryException $e){
            //             return response->json( ['message'=>'Failed to add to the ministry '.$e->getMessage()],500 );
            //         }catch(\Exception $e){
            //             return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
            //         }
            //     }
    
            //     else if( $ministry == 'tech'){
    
            //         try{
            //             TechModel::insert([
            //                 'attendes_id'=> $request->attendes_id,
            //                 'admin_id' => $request->admin_id,
            //                 'date_joined' => now(),
            //                 'service_commitment' =>  $request->service,
            //                 'status'=>  $request->status,
            //             ]);
            
            //             return response()->json(
            //                 [
            //                     'message' => 'Added Successfully'
            //                 ],200
            //             );
            
            //         }catch(QueryException $e){
            //             return response->json( ['message'=>'Failed to add to the ministry '.$e->getMessage()],500 );
            //         }catch(\Exception $e){
            //             return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
            //         }
            //     }
                
            // }catch(\Exception $e){

            // }
          
        }
    
        public function getAll(Request $request){

            // Check Policy
            $status = Gate::inspect('ministry', MinistryModel::class);
            if(!$status->allowed()){
                return $status;
            }

            try{
                $response = DB::table('ministry as m')
                                ->join('attendees as a', 'm.attendes_id','=','a.attendes_id')
                                ->select(
                                    'a.attendes_id',
                                    DB::raw("CONCAT(
                                    a.attendees_fname,' ',
                                    a.attendees_mname,' ',
                                    a.attendees_lname
                                    ) as attendees_fullname"),
                                    'a.attendees_fname',
                                    'a.attendees_mname',
                                    'a.attendees_lname',
                                    'm.ministry',
                                    'm.date_joined',
                                    'm.service_commitment',
                                    'm.status')
                                ->get();
                
                return response()->json($response, 200);

  
            }catch(\Exception $e){
                return $e;
            }
     


        }

        public function get(Request $request, string $ministry){
            $status = Gate::inspect('ministry', MinistryModel::class);
            if(!$status->allowed()){
                return $status;
            }

            try{
                if($ministry == 'kids'){
                    $response = DB::table('ministry as m')
                    ->join('attendees as a', 'm.attendes_id','=','a.attendes_id')
                    ->where('m.ministry','Kids Church')
                    ->select(
                        'm.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'm.ministry',
                        'm.date_joined',
                        'm.service_commitment',
                        'm.status')
                    ->get();
    
                    return response()->json($response, 200);
                }
    
                else if($ministry =='prayer'){
                    $response = DB::table('ministry as pt')
                    ->join('attendees as a', 'pt.attendes_id','=','a.attendes_id')
                    ->where('pt.ministry','Prayer Team')
                    ->select(
                        'pt.id',
                        DB::raw("CONCAT(
                            a.attendees_fname,' ',
                            a.attendees_mname,' ',
                            a.attendees_lname
                            ) as attendees_fullname"),
                        'pt.ministry',
                        'pt.date_joined',
                        'pt.service_commitment',
                        'pt.status')
                    ->get();
    
                    return response()->json($response, 200);
                }
    
                else if($ministry =='ushering'){
                    $response = DB::table('ministry as u')
                    ->join('attendees as a', 'u.attendes_id','=','a.attendes_id')
                    ->where('u.ministry','Ushering & Security')
                    ->select(
                        'u.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'u.ministry',
                        'u.date_joined',
                        'u.service_commitment',
                        'u.status')
                    ->get();
    
                    return response()->json($response, 200);
                }
    
                else if($ministry =='communication'){
                    $response = DB::table('ministry as c')
                    ->join('attendees as a', 'c.attendes_id','=','a.attendes_id')
                    ->where('c.ministry','Communication')
                    ->select(
                        'c.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'c.ministry',
                        'c.date_joined',
                        'c.service_commitment',
                        'c.status')
                    ->get();
    
                    return response()->json($response, 200);
                }
    
                else if($ministry =='tech'){
                    $response = DB::table('ministry as ts')
                    ->join('attendees as a', 'ts.attendes_id','=','a.attendes_id')
                    ->where('ts.ministry','Technical & Stage Management')
                    ->select(
                        'ts.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'ts.ministry',
                        'ts.date_joined',
                        'ts.service_commitment',
                        'ts.status')
                    ->get();
    
                    return response()->json($response, 200); 
                }
    
                else if($ministry =='admin'){
                    $response = DB::table('ministry as am')
                    ->join('attendees as a', 'am.attendes_id','=','a.attendes_id')
                    ->where('am.ministry','Admin')
                    ->select(
                        'am.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'am.ministry',
                        'am.date_joined',
                        'am.service_commitment',
                        'am.status')
                    ->get();
    
                    return response()->json($response, 200); 
                }
    
                else if($ministry =='music'){
                    $response = DB::table('ministry as mt')
                    ->join('attendees as a', 'mt.attendes_id','=','a.attendes_id')
                    ->where('mt.ministry','Music Team')
                    ->select(
                        'mt.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'mt.ministry',
                        'mt.date_joined',
                        'mt.service_commitment',
                        'mt.status')
                    ->get();
    
                    return response()->json($response, 200); 
                }
    
                else if($ministry =='creative'){
                    $response = DB::table('ministry as cd')
                    ->join('attendees as a', 'cd.attendes_id','=','a.attendes_id')
                    ->where('cd.ministry','Creative Design')
                    ->select(
                        'cd.id',
                        DB::raw("CONCAT(
                        a.attendees_fname,' ',
                        a.attendees_mname,' ',
                        a.attendees_lname
                        ) as attendees_fullname"),
                        'cd.ministry',
                        'cd.date_joined',
                        'cd.service_commitment',
                        'cd.status')
                    ->get();
    
                    return response()->json($response, 200); 
                }
            }catch(\Exception $e){

                return response()->json(
                    [
                        "message" => "Failed to fetch data",
                        "error" => $e
                    ]
                );
            }


        }

   
    }


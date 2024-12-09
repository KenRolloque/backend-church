<?php

namespace App\Http\Controllers;

use App\Models\KidsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KidsController extends Controller
{
    //
    public function add(Request $request){

        try{
            KidsModel::insert([
                'attendes_id'=> $request->attendes_id,
                'admin_id' => $request->admin_id,
                'kids_date_joined' => now(),
                'kids_service_commitment' =>  $request->service,
                'kids_status'=>  $request->kids_status,
            ]);

            return response()->json(
                [
                    'message' => 'Added Successfully'
                ],200
            );

        }catch(QueryException $e){
            return response->json( ['message'=>'Failed to add to the ministry '.$e->getMessage()],500 );
        }catch(\Exception $e){
            return response()->json(['message' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
        }

       
    }

    public function getAll(Request $request){
        // $response = KidsModel::get();
        $response = DB::table('kids')
                        ->join('attendees', 'kids.attendes_id','=','attendees.attendes_id')
                        ->select(
                            'attendees.attendees_fname',
                            'attendees.attendees_mname',
                            'attendees.attendees_lname',
                            'kids.kids_date_joined',
                            'kids.kids_service_commitment',
                            'kids.kids_status')
                        ->get();
        return response()->json($response, 200);
    }
}

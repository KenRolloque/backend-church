<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Attendance;

class AttendanceController extends Controller
{
    //
    public function view(Request $request){

        $response = Gate::authorize('view', Attendance::class);

        if ($response->allowed()){
            return response()->json([

                'message' => 'This is view',
                'status' => 200,
            ]);
        }else{
            return response('Forbidden',401);
        }

        
    }

    public function create(Request $request){

    
        $status = Validator::make($request->all(),
            [
                'service_id'=> 'required',
                'attendance_date'=> 'required',
                'attendance_kids'=> 'required',
                'attendance_adults'=> 'required',
                'attendance_foreigner'=> 'required',
                'attendance_toddlers'=> 'required',
                'attendance_total'=> 'required',

            ]
            );

        if($status->fails()){
            return response()->json(
                [
                    'message' => 'Please fill all required field.'
                ],406
            );
        }

        try{
            $response = Gate::authorize('create', Attendance::class);
            if ($response->allowed()){

                $isExist = Attendance::where('attendance_date',$request->attendance_date)
                        ->where('service_id',$request->service_id)->exists();

                if ($isExist){

                    return response()->json(
                        [
                            'message' => 'Record already exist.'
                        ],204
                    );

                }

                Attendance::insert([
                    'admin_id' => $request->admin_id,
                    'service_id'=> $request->service_id,
                    'attendance_date'=> $request->attendance_date,
                    'attendance_kids'=> $request->attendance_kids,
                    'attendance_adults'=> $request->attendance_adults,
                    'attendance_foreigner'=> $request->attendance_foreigner,
                    'attendance_toddlers'=> $request->attendance_toddlers,
                    'attendance_total'=> $request->attendance_total,
                    'created_at' => now(),
                    'updated_at' => null,
                ]);    
                return response()->json([
                    'message' => 'Added Successfully',
                    'status' => 200,
                ]);
            }else{
                return response('Forbidden',401);
            }

        }catch(\Exception $e){

            return $e;
            // return response()->json(
            //     [
            //         'message' => $e
            //     ],500
            // );
        }


        
    }

    public function update(Request $request){
        return "This is request";
    }

    public function getLatest(Request $request){

       $latestDate = Attendance::max('attendance_date');

       $latestData = DB::table('attendance as a')
                    ->join('service as s','s.service_id','a.service_id')
                    ->select(
                        'attendance_id',
                        'admin_id',
                        's.service',
                        'attendance_date',
                        'attendance_kids',
                        'attendance_adults',
                        'attendance_foreigner',
                        'attendance_toddlers',
                        'attendance_total',
                    )
                    ->where('attendance_date','=',$latestDate)
                    ->whereIn('s.service_id',[1,2,3,4])
                    ->get();
                    // ->groupBy('s.service_id');

        $sumKids = Attendance::where('attendance_date','=', $latestDate )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_kids');
                
        $sumAdults = Attendance::where('attendance_date','=', $latestDate )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_adults');   

        $sumForeingers = Attendance::where('attendance_date','=', $latestDate )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_foreigner');  

        $sumToddlers = Attendance::where('attendance_date','=', $latestDate )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_toddlers'); 
                
        $totalSum = Attendance::where('attendance_date','=', $latestDate )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_total'); 

       return response()->json(
        [
            
           'date' => $latestDate,
           'All' =>[
            'attendance_service' => 'All',
            'attendance_date' => $latestDate,
            'attendance_total' => $totalSum,
            'attendance_kids' => $sumKids,
            'attendance_adults' => $sumAdults,
            'attendance_foreigner' => $sumForeingers,
            'attendance_toddlers' => $sumForeingers,
            ],
            'Services' => $latestData
        ]
    );

}
    public function customDate(Request $request, string $id){
        
        $getDate = Attendance::where('attendance_date','=',$id)->exists();

        if(!$getDate){
            return response()->noContent();
        }
        $latestData = DB::table('attendance as a')
                ->join('service as s','s.service_id','a.service_id')
                ->select(
                    'attendance_id',
                    'admin_id',
                    's.service',
                    'attendance_date',
                    'attendance_kids',
                    'attendance_adults',
                    'attendance_foreigner',
                    'attendance_toddlers',
                    'attendance_total',
                )
                ->where('attendance_date',$id)
                ->whereIn('s.service_id',[1,2,3,4])
                ->get();
 
         $sumKids = Attendance::where('attendance_date','=', $id )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_kids');
                 
         $sumAdults = Attendance::where('attendance_date','=', $id )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_adults');   
 
         $sumForeingers = Attendance::where('attendance_date','=', $id )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_foreigner');  
 
         $sumToddlers = Attendance::where('attendance_date','=', $id )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_toddlers'); 
                 
         $totalSum = Attendance::where('attendance_date','=', $id )
                    ->whereIn('service_id',[1,2,3,4])
                    ->sum('attendance_total'); 
 
        return response()->json(
         [
        
            'date' => $getDate,
            'All' =>[
             'attendance_service' => 'All',
             'attendance_date' => $id,
             'attendance_total' => $totalSum,
             'attendance_kids' => $sumKids,
             'attendance_adults' => $sumAdults,
             'attendance_foreigner' => $sumForeingers,
             'attendance_toddlers' => $sumForeingers,
             ],
             'Services' => $latestData
         ]
     );
    }

    public function totalAttendees(Request $request){

        //Policy
        $policy = Gate::inspect('create', Attendance::class);

        if(!$policy){
            return $policy;
        }

        $month = DB::table('attendance as a')
                ->join('service as s','s.service_id','a.service_id')
                ->select(
                    's.service_id',
                    's.service as service',
                    DB::raw("MONTH(a.attendance_date) as month_id"),
                    DB::raw('DATE_FORMAT(a.attendance_date, "%M") as month'),

                    DB::raw("sum(attendance_total) as attendance_total")
                )
                ->whereBetween('a.attendance_date',['2024-01-01','2024-03-31'])
                ->groupBy('month_id','month','s.service_id','s.service')

           
                ->get();
        return response()->json($month);
    }

    public function total_attendees_per_classification(){

        // Policy
        $policy = Gate::inspect('create', Attendance::class);

        if(!$policy){
            return $policy;
        }

        // Fetch
        $data = DB::table('attendance as a')
                ->join('service as s','s.service_id','a.service_id')
                ->select(
                    // 's.service_id',
                    // 's.service as service',
                    // DB::raw("MONTH(a.attendance_date) as month_id"),
                    // DB::raw('DATE_FORMAT(a.attendance_date, "%M") as month'),
                    DB::raw("sum(attendance_adults) as total_adults"),
                    DB::raw("sum(attendance_kids) as total_kids"),
                    DB::raw("sum(attendance_toddlers) as total_toddlers"),
                    DB::raw("sum(attendance_foreigner) as total_foreigner")
                )
                ->whereBetween('a.attendance_date',['2024-01-01','2024-03-31'])
                // ->groupBy('month_id','month','s.service_id','s.service')

           
                ->get();

            return $data;
    }

   
     

}

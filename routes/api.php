<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendeesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\MinistriesController;
use App\Http\Controllers\KidsController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\One2OneController;
use App\Http\Controllers\VWController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\VGController;

Route::get('/auth', function (){
    return response(200);
})->middleware('auth:sanctum');

Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    // For Attendees
    Route::controller(AttendeesController::class)->group(function (){
        Route::post('/attendees/get/{service}','getAttendes');
        Route::post('/attendees/add','add');
        Route::post('/attendees/update','update');
        // Route::get('/attendees/get/all','getAttendee');
        // Route::get('/attendees/get/{service}','getPerServvice');
    });

    // For Attendance
    Route::controller(AttendanceController::class)->group(function (){
        Route::get('/attendance/get/latest','getLatest');
        Route::get('/attendance/get/latest/{date}','customDate');
        Route::post('/attendance/view','view');
        Route::post('/attendance/create','create');
        Route::post('/attendance/update','update');

        Route::get('/attendance/get/total/latest','totalAttendees');
        Route::get('/attendance/get/total/classification','total_attendees_per_classification');
    });

    //
    Route::controller(KidsController::class)->group(function (){
        Route::post('/kids/create','add');
        Route::get('/kids/get','getAll');
    });

    Route::controller(MinistriesController::class)->group(function (){
        // Route::post('ministry/{ministry}/create', 'add');
        // Route::get('ministry/{ministry}/get', 'getAll');
        Route::post('ministry/add', 'add');
        Route::get('ministry/get', 'getAll');
        Route::get('ministry/get/{ministry}', 'get');
    });

    Route::controller(LeaderController::class)->group(function (){
        Route::post('leader/add','add');
        Route::get('leader/get','getAll');
    });

    Route::controller(InternController::class)->group(function (){
        Route::post('intern/add','add');
        Route::get('intern/get/all','getAll');
    });


    Route::controller(One2OneController::class)->group(function (){
        Route::post('one2one/add','add');
        Route::get('one2one/get','getAll');
    });

    Route::controller(VWController::class)->group(function (){
        Route::post('vw/add','add');
        Route::get('vw/get','getAll');
    });

    Route::controller(ClassesController::class)->group(function (){
        Route::post('classes/add','add');
        Route::get('classes/get','getAll');
        Route::get('classes/get/{class}','get');
        // Route::get('vw/get','getAll');
    });

    Route::controller(VGController::class)->group(function (){
        Route::post('vg/add','add');
        // Route::get('classes/get','getAll');
        // Route::get('classes/get/{class}','get');
        // Route::get('vw/get','getAll');
    });
});
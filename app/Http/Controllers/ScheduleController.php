<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Schedules = Schedule::all();
        foreach($Schedules as $Schedule){
            echo "Id      : ".$Schedule->id;
            echo "\nEmployee name      : ".$Schedule->employee->name;
            echo "\nLocation         : ".$Schedule->location->city.','.$Schedule->location->area;
            echo "\nShift            : ".$Schedule->shift->timings;
            echo "\n";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'employee_id' => 'required|exists:employees,id',
            'location_id' => 'required|exists:locations,id',
            'shift_id' => 'required|exists:shifts,id',
            'time' => 'required',
            'day' => 'required'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        $schedule = new Schedule();
        $schedule->employee_id = $request->employee_id;
        $schedule->location_id = $request->location_id;
        $schedule->shift_id = $request->shift_id;
        $schedule->day = $request->day;
        $schedule->time = $request->time;
        $schedule->save();

        return "Stored successfully!";
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}

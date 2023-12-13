<?php

namespace App\Http\Controllers;

use App\Models\Shifts;
use Illuminate\Http\Request;

class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shifts::all();
        foreach($shifts as $shift){
            echo "Timings      : ".$shift->timings;
            echo "\n";
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'timings' => 'required'
        ]);

        $shift = new Shifts();
        $shift->timings = $request->timings;
        $shift->save();
        return "Stored successfully!";
    }

    /**
     * Display the specified resource.
     */
    public function show(Shifts $shifts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shifts $shifts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shifts $shifts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shifts $shifts)
    {
        //
    }
}

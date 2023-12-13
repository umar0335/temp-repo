<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendence::all();
        foreach($attendances as $attendance){
            echo "Id      : ".$attendance->id;
            echo "\nPresent      : ".$attendance->present;
            echo "\nEmployee name: ".$attendance->employee->name;
            echo "\nSchedule    : ".$attendance->schedule->shift->timings;
            echo "\n\n";
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
        $this->validate($request, [
            'attendance_data' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('attendance_data');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'present' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'employee_id' => $sheet->getCell( 'B' . $row )->getValue(),
                    'schedule_id' => $sheet->getCell( 'C' . $row )->getValue(),
                ];
                $startcount++;
            }

            // dd($data);
            Attendence::insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return 'There was a problem uploading the data!';
        }
        return 'Great! Data has been successfully uploaded.';
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendence $attendence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendence $attendence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendence $attendence)
    {
        //
    }
}

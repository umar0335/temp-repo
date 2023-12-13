<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        foreach($employees as $employee){
            echo "Id      : ".$employee->id;
            echo "\nName      : ".$employee->name;
            echo "\nDepartment: ".$employee->dept;
            echo "\nSalary    : ".$employee->salary;
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
        $this->validate($request, [
            'data_file' => 'required|file|mimes:xls,xlsx'
        ]);
        $the_file = $request->file('data_file');
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
                    'name' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'dept' => $sheet->getCell( 'B' . $row )->getValue(),
                    'salary' => $sheet->getCell( 'C' . $row )->getValue(),
                ];
                $startcount++;
            }

            // dd($data);
            Employee::insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return 'There was a problem uploading the data!';
        }
        return 'Great! Data has been successfully uploaded.';
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}

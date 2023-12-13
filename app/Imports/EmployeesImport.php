<?php
// EmployeesImport.php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Employee;

class EmployeesImport implements ToModel
{
    public function model(array $row)
    {
        return new Employee([
            'name' => $row[0], // Adjust indexes based on your Excel columns
            'dept' => $row[1],
            'salary' => $row[2],
        ]);
    }
}

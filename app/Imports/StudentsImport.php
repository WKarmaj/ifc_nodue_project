<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
         // Skip rows where any required field is missing
        if (
            empty($row['name']) || 
            empty($row['student_id']) || 
            empty($row['programme_id']) || 
            empty($row['student_contact_no'])
        ) {
            return null; // Skip this row
        }

        return new Student([
            'name' => $row['name'], // Adjusted key 
            'student_id' => $row['student_id'], // Adjusted key 
            'programme_id' => $row['programme_id'], // Adjusted key 
            'contact_no' => $row['student_contact_no'],
        ]);
    }
}

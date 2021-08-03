<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class EmployeesImport implements ToCollection,
    WithHeadingRow, SkipsOnError, WithValidation,
    SkipsOnFailure, WithBatchInserts

{
    use Importable, SkipsErrors, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        /*return new Employee([
            'firstname'=>$row['firstname'],
            'lastname'=>$row['lastname'],
            'employee_type_id'=>$row['employee_type_id'],
            'idno'=>$row['idnumber'],
            'email'=>$row['email']
        ]);*/
        $rules = [
            '*.email' => ['email', 'unique:employees,email'],
            '*.idnumber' => 'required|unique:employees,idno',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The employee :attribute already exists!. Please rectify and upload afresh!',
        ];

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        foreach ($rows as $row) {
            $emp = Employee::create([
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'middlename' => $row['middlename'],
                'gender' => $row['gender'],
                'dob' => $row['dateOfBirth'],
                'employee_type_id' => $row['employeeTypeId'],
                'category_id' => $row['categoryId'],
                'idno' => $row['idnumber'],
                'email' => $row['email'],
                'krapin' => $row['krapin'],
                'date_hired' => $row['dateHired'],
                'is_active' => $row['Active'],
            ]);

            $emp->contracts()->create([
                'employee_id' => $emp->id,
                'start_date' => Date::excelToDateTimeObject($row['startdate']),
                'end_date' => Date::excelToDateTimeObject($row['enddate']),
                'employee_type_id' => $emp->employee_type_id,
                'station_id' => $row['stationID'],
                'status'=>$row['status'],

            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:employees,email'],
            '*.idnumber' => ['required', 'unique:employees,idno'],
        ];
    }

    public function batchSize(): int
    {
        return 30;
    }


}

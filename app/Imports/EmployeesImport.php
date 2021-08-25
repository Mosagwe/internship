<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Database\QueryException;
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
use PHPUnit\Exception;
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
        $rules = [
            // '*.email' => ['email', 'unique:employees,email'],
            '*.idnumber' => 'required|unique:employees,idno',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The employee +1 :attribute already exists!. Please rectify and upload afresh!',
        ];

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        try{
            foreach ($rows as $row) {
                $emp = Employee::create([
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'middlename' => $row['middlename'],
                    'gender' => $row['gender'],
                    'dob' => $row['dob'],
                    'employee_type_id' => $row['employeetypeid'],
                    'category_id' => $row['category'],
                    'idno' => $row['idnumber'],
                    'email' => $row['email'],
                    'krapin' => $row['krapin'],
                    'date_hired' => Date::excelToDateTimeObject($row['initialdatehired']),
                    'is_active' => $row['status'],
                ]);

                $emp->contracts()->create([
                    'employee_id' => $emp->id,
                    'start_date' => Date::excelToDateTimeObject($row['startdate']),
                    'end_date' => Date::excelToDateTimeObject($row['enddate']),
                    'employee_type_id' => $emp->employee_type_id,
                    'station_id' => $row['station'],
                    'status'=>$row['status'],
                ]);
            }
        }catch (\ErrorException $errorException){
            dd($errorException->getMessage() );
        }catch (QueryException $queryException){
            dd($queryException->errorInfo);
        }catch (\Exception $exception){
            dd(get_class($exception));
        }


    }

    public function rules(): array
    {
        return [
            //'*.email' => ['email', 'unique:employees,email'],
            '*.idnumber' => ['required', 'unique:employees,idno'],
        ];
    }

    public function batchSize(): int
    {
        return 30;
    }


}

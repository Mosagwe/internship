<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * Status for a active user
     */
    const ACTIVE = 1;

    /**
     * Status for a deactivated user
     */
    const DEACTIVATED = 0;

    protected $guarded=[];

    protected $appends=['full_name'];

   /* public function setDateHiredAttribute($value)
    {
        $this->attributes['date_hired'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDateHiredAttribute()
    {
        if ($this->attributes['date_hired'] != null)
        {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['date_hired'])->format('d/m/Y');
        }
    }*/

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname).' '.ucfirst($this->middlename).' '.ucfirst($this->lastname);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);

    }


}

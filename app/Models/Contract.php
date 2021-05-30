<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    const ACTIVE=1;
    const INACTIVE=0;

    protected $fillable=[
        'employee_id',
        'employee_type',
        'start_date',
        'end_date',
        'comments',
        'station_id',
        'unit_id',
        'salary',
        'bank_id',
        'bank_branch',
        'bank_code',
        'bank_account'
    ];



    public function getStartDateAttribute()
    {
        if ($this->attributes['start_date']!=null){
            return Carbon::createFromFormat('Y-m-d',$this->attributes['start_date'])->format('d/m/Y');
        }
    }

   /* public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }*/
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

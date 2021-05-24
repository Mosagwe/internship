<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
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
}

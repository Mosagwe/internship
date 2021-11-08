<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes,HasRoles;

    /**
     * Status for a active user
     */
    const ACTIVE = 1;

    /**
     * Status for a deactivated user
     */
    const DEACTIVATED = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeApprover($query)
    {
        return $query->permission('approve payroll');
    }

    public function scopeHrmanager()
    {
        $users=User::whereHas('roles',function ($q){
            $q->where('name','HR Manager');
        })->get();
        return $users;

    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }


}

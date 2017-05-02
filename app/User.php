<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'karyawan_id', 'cabang_id', 'level', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function detail ()
    {
        return $this->hasOne('App\Karyawan');
    }
    public function cabang ()
    {
        return $this->belongsTo('App\Cabang');
    }
    public function cuti ()
    {
        return $this->hasOne('App\Cuti');
    }
    public function gaji ()
    {
        return $this->hasOne('App\Gaji');
    }
    public function potongan ()
    {
        return $this->hasOne('App\Potongan');
    }
}

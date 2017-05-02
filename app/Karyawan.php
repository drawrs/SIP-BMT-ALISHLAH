<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    //
    protected $table = 'user_detail';
    protected $fillable = [
        'user_id', 'jabatan_id', 'ktp', 'nama', 'jk', 'tgl', 'alamat', 'status_id', 'telp', 'grade', 'status_pr_id', 'status_pg', 'anak', 'last_pd', 'foto'
    ];
    public function jabatan ()
    {
        return $this->belongsTo('App\Jabatan');
    }
    
}

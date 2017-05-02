<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Priode extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'priode_absen';
    protected $fillable = ['rekap_id', 'user_id','bulan_id', 'hari_id', 'tgl', 'out_ijin', 'in_ijin', 'kt_ijin', 'jam_kerja','menit_kerja', 'jam_in', 'jam_out'
    ];
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}

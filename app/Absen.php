<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Absen extends Model
{
    //
    use SoftDeletes;
    protected $table = 'absen';
    protected $fillable = [
        'user_id','bulan_id', 'hari_id', 'tgl', 'out_ijin', 'in_ijin', 'kt_ijin', 'jam_kerja', 'menit_kerja', 'jam_in', 'jam_out'
    ];
    protected $dates = ['deleted_at'];
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}

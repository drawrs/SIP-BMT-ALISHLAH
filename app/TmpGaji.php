<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TmpGaji extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'rekap_gaji_per_priode';
    protected $fillable = ['user_id',
    'bulan_id',
    'tmp_potongan_id',
    'tgl_priode_awal',
    'tgl_priode_akhir',
    'gaji_pokok',
    'tunjab',
    'tunkel',
    'pensiun',
    'bpjs_kes',
    'bpjs_tk',
    'uang_makan',
    'uang_transport',
    'p_kasbon',
    'p_angs',
    'p_simwa',
    'p_bpjs',
    'p_arisan',
    'p_zis',
    'p_donasi',
    'p_vipm',
    'p_qh',
    'p_dplk',
    'hari_kerja',
    'jam_kerja',
    'menit_kerja'];
    public function priode ()
    {
        return $this->hasOne('App\Priode', 'rekap_id');
    }
    public function bulan () 
    {
        return $this->belongsTo('App\Bulan', 'bulan_id');
    }
    public function user () 
    {
        return $this->belongsTo('App\User');
    }
    public function tmp_potongan () 
    {
        return $this->belongsTo('App\TmpPotongan');
    }
}

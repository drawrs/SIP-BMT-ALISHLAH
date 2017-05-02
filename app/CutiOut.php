<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CutiOut extends Model
{
    //
    protected $table = 'cuti_out';
    protected $fillable = [
        'user_id', 'kode', 'qty', 'from', 'to', 'note', 'status','jenis_cuti_id'
    ];
    public function user () 
    {
        return $this->belongsTo('App\User');
    }
    public function jenisCuti () 
    {
        return $this->belongsTo('App\JenisCuti');
    }
}

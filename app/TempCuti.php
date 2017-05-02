<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCuti extends Model
{
    //
    protected $table = 'temp_cuti';
    public function user () 
    {
        return $this->belongsTo('App\User');
    }
    public function jenisCuti () 
    {
        return $this->belongsTo('App\JenisCuti');
    }
    
}

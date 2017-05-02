<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    //
    protected $table = 'tunjangan';
    protected $fillable = ['user_id','gapok', 'tunjab', 'tunkel', /*'dplk',*/ 'pensiun', 'bpjs_kes','bpjs_tk','um','transport'];
}

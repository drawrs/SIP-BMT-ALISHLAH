<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    //
    protected $table = 'potongan';
    protected $fillable = ['user_id','kasbon', 'angs', 'simwa', 'bpjs', 'arisan', 'zis','donasi', 'vipm', 'qh', 'dplk'];
}

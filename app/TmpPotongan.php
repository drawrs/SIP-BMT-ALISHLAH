<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TmpPotongan extends Model
{
    //
    protected $table = 'tmp_potongan';
    protected $fillable = ['kasbon', 'angs', 'simwa', 'bpjs', 'arisan', 'zis','lain'];
}

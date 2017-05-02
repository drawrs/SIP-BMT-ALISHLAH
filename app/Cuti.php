<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    //
    protected $table = 'cuti';
    protected $fillable = [
    'qty','user_id','satuan'];
}

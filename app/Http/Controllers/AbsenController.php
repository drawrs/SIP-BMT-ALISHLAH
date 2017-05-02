<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Absen;
use Carbon\Carbon;
use DateTimeZone;
use Auth;
class AbsenController extends Controller
{
    //
    public function getDelAbsen($id){
        $absen = Absen::find($id);
        if ($absen->forceDelete()) {
            $message = "Berhasil Dihapus!";
            $type = "success";
        } else {
            $message = "Gagal menghapus.";
            $type = "danger";
        }
        return redirect()->back()->with(['message' => $message, 'type' => $type]);
    }
}

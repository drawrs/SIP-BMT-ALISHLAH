<?php

namespace App\Http\Controllers;
use Crypt;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\PinGaji;
use App\User;
use App\Gaji;
use App\Cabang;
use App\Potongan;
class GajiController extends Controller
{
    //
    public function index(Request $request){
        if ($request->session()->has('bisa_edit_gaji')) {
            $opsi = new User; // Untuk HRD
            $cabangs = Cabang::all();
            $get_opsi = 'all';
            if ($request->has('opsi')) {
                if ($request->opsi !== 'all') {
                    $get_opsi = $request->opsi;
                    $opsi = User::where('cabang_id', $request->opsi);
                }
            }
            /*if (Auth::user()->level == 'pc') { // Untuk Pimpinan Cabang
                $opsi = User::where('cabang_id', Auth::user()->cabang_id);
            }*/
            $users = $opsi->orderBy('karyawan_id', 'asc')->paginate(20);
            return view('gaji.karyawan', compact('users', 'cabangs', 'get_opsi'));
        }else {
            return view('gaji.enter-pin');
        }
        
    }
    public function postEnterPIN(Request $request){
        $pin = PinGaji::where('pin', sha1($request->pin));
        if ($pin->count() > 0) {
            $request->session()->put('bisa_edit_gaji', 'false');

        }
        return redirect()->back()->with(['message' => "PIN Salah!"]);

    }
    public function cekPin(Request $request){
        $pin = PinGaji::where('pin', sha1($request->pin));
        if ($pin->count() > 0) {
            $correct = "true";
        } else {
            $correct = 'false';
        }
        return $correct;

        //$pin->create(['pin' => bcrypt($request->q)]);
        
    }
    public function postEdit(Request $request){
        // bukan id user tapi gaji id (males ganti)
        $gaji = Gaji::find($request->user_id);
        if ($gaji->update(['gapok' => $request->gapok,
            'tunjab' => $request->tunjab,
            'tunkel' => $request->tunkel,
            /*'dplk' => $request->dplk,*/
            'pensiun' => $request->pensiun,
            'bpjs_kes' => $request->bpjs_kes,
            'bpjs_tk' => $request->bpjs_tk,
            'um' => $request->um,
            'transport' => $request->transport])){
            $result = 1;   
        } else {
            $result = 2;
        }
        return $result;
        
    }
    public function indexPotongan(Request $request){
        if ($request->session()->has('bisa_edit_gaji')) {
            $opsi = new User; // Untuk HRD
            $cabangs = Cabang::all();
            $get_opsi = 'all';
            if ($request->has('opsi')) {
                if ($request->opsi !== 'all') {
                    $get_opsi = $request->opsi;
                    $opsi = User::where('cabang_id', $request->opsi);
                }
            }
            /*if (Auth::user()->level == 'pc') { // Untuk Pimpinan Cabang
                $opsi = User::where('cabang_id', Auth::user()->cabang_id);
            }*/
            $users = $opsi->orderBy('karyawan_id', 'asc')->paginate(20);
            return view('potongan.data-potongan', compact('users', 'cabangs', 'get_opsi'));
        }else {
            return view('gaji.enter-pin');
        }
        
    }
    public function postEditPotongan(Request $request){
        //return $request->all();
        // bukan id user tapi potongan id (males ganti)
        $gaji = Potongan::find($request->user_id);
        if ($gaji->update(['kasbon' => $request->kasbon,
            'angs' => $request->angs,
            'simwa' => $request->simwa,
            'bpjs' => $request->bpjs,
            'arisan' => $request->arisan,
            'zis' => $request->zis,
            'donasi' => $request->donasi,
            'vipm' => $request->vipm,
            'qh' => $request->qh,
            'dplk' => $request->dplk])){
            $result = 1;
        } else {
            $result = 2;
        }
        return $result;
         
    }

}

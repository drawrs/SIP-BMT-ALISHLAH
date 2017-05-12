<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use DateTimeZone;
use App\Absen;
use App\Priode;
use App\Bulan;
use App\Cuti;
use App\TempCuti;
use App\CutiOut;
use App\User;
use App\Jabatan;
use App\Gaji;
use App\Karyawan;
use App\Cabang;
use App\TmpGaji;
use Validator;
use Auth;
use DB;

class PriodeController extends Controller
{
    //
    protected $alamatKantor = "Jl. Raya Ottista No.17 Plumbon Cirebon Barat";
    protected $telpKantor = "(0231) 325 975";
    protected $kotaCetak = "Cirebon";
    protected $namaUnit = "UNIT SIMPAN PINJAM PEMBIAYAAN SYARI'AH";
    protected $namaHRD = "DIAN CHUSNUL CHOTIMAH";

    public function getListUser($id){
        $user_id = $id;

        $rekap = new TmpGaji;
        $priode = new Priode;

        $data_rekap = $rekap->where('user_id', $user_id)->orderBy('id','desc')->paginate(20);
        $user = User::find($user_id);

        return view('priode.list-priode', compact('data_rekap', 'user'));
    }
    // ini bisa dilihat karyawan
    public function getRekapAbsensiku(){
        $user_id = Auth::user()->id;
        return $this->getListUser($user_id);
    }
    public function getViewRekapByDate($user_id, Request $request){
        if (isset($request->date_range)) {
            $date_range = $request->date_range;
            $start_date = dateFromRange($date_range, 'start');
            $end_date = dateFromRange($date_range, 'end');
        }

        // Jaga jaga kalo bukan hrd yg nyoba print struk user lain
        if (Auth::user()->level !== 'hrd') {
            if (Auth::user()->id !== $user_id) {
                return redirect()->route('home')->with(['message' => "Anda tidak memiliki ijin untuk mencetak struk ini!", 'type' => "warning"]);
            }
        }
        // nambahin tampilkan priode berdasarkan tanggal
        $data_absen = Priode::whereBetween('tgl', [$start_date, $end_date])->where('user_id', $user_id)->get();

        $user = User::find($user_id);
        $bulan = Bulan::orderBy('bulan_id','asc')->get();
        
        return view('priode.viewByDateRekap', compact('data_absen', 'bulan','user', 'cek'));
    }
    public function getViewRekap($rekap_id, Request $request){
        // kalo terdeteksi date range
        if (isset($request->date_range)) {
            $date_range = $request->date_range;
            $start_date = dateFromRange($date_range, 'start');
            $end_date = dateFromRange($date_range, 'end');
        }

        $data_rekap = TmpGaji::find($rekap_id);
        if (is_null($data_rekap)) {
            return redirect()->route('home')->with(['message' => "DATA TIDAK DITEMUKAN!", 'type' => "danger"]);
        }
        // Jaga jaga kalo bukan hrd yg nyoba print struk user lain
        if (Auth::user()->level !== 'hrd') {
            if (Auth::user()->id !== $data_rekap->user_id) {
                return redirect()->route('home')->with(['message' => "Anda tidak memiliki ijin untuk mencetak struk ini!", 'type' => "warning"]);
            }
        }
        // nambahin tampilkan priode berdasarkan tanggal
        if (!isset($request->date_range)) { // kalo ngga pake tanggal
            $data_absen = Priode::where(['rekap_id' => $data_rekap->id])->get();
        } else {
            $data_absen = Priode::whereBetween('tgl', [$start_date, $end_date])->get();
        }
        $user = User::find($data_rekap->user_id);
        $cek = $data_rekap->count();
        $bulan = Bulan::orderBy('bulan_id','asc')->get();
        
        return view('priode.view', compact('data_absen','data_rekap', 'bulan','user', 'cek'));
    }
    public function getDelRekap($id){
        $rekap = TmpGaji::find($id);
        $priode = Priode::where('rekap_id', $id);
        
        if ($rekap->delete() || $priode->delete()) {
            $message = "Data rekapan telah dihapus";
            $type = "success";
        } else {
            $message = "Data rekapan gagal dihapus";
            $type = "danger";
        }
        return redirect()->back()->with(['message' => $message, 'type' => $type]); 
    }
    public function getRestoreRekap($id, $all = false){
        $rekap = TmpGaji::find($id);
        $priode = Priode::where('rekap_id', $id);

        $tgl_awal = $rekap->tgl_priode_awal;
        $tgl_akhir = $rekap->tgl_priode_akhir;

        // Restore absensi
     
        $absen = Absen::withTrashed()->where('user_id', $rekap->user_id )->whereBetween('tgl', [$tgl_awal, $tgl_akhir])->restore();
        // hapus permanen
        if ($rekap->forceDelete() && $priode->forceDelete()) {
            $message = "DATA ABSEN TELAH DIKEMBALIKAN";
            $type = "success";
        } else {
            $message = "GAGAL MENGEMBALIKAN DATA ABSEN";
            $type = "danger";
        }
        if ($all == false) {
            return redirect()->back()->with(['message' => $message, 'type' => $type]); 
        }
    }
    public function getRestoreRekapAll(){
        $tmpgaji = TmpGaji::select('tgl_priode_awal', 'tgl_priode_akhir')
                            ->orderBy('id', 'desc');
        if ($tmpgaji->count() == 0) {
            return redirect()->back()->with(['message' => "Tidak ditemukan data apapun", 'type' => "danger"]); 
        }
        $tgl_last_priode = $tmpgaji->first();
        $rekaps = TmpGaji::where(['tgl_priode_awal' => $tgl_last_priode->tgl_priode_awal, 'tgl_priode_akhir' => $tgl_last_priode->tgl_priode_akhir])->get();
        foreach ($rekaps as $last_rekap) {
            $this->getRestoreRekap($last_rekap->id, true);
        }
        return redirect()->back()->with(['message' => "Rekap absensi telah dibatalkan", 'type' => "success"]); 
    }
    public function getListBulan($id = 0){
        $bulan = Bulan::all();
        $cabang = Cabang::all();
        $rekap = new TmpGaji;
        if ($id == 0) {
            return view('priode.list-bulan', compact('bulan', 'rekap', 'cabang'));
        }
        $bulan = Bulan::find($id);
        $bulan_id = $bulan->bulan_id;
        $priode = new Priode;

        $data_rekap = $rekap->where('bulan_id', $bulan_id)->orderBy('id','desc')->paginate(20);
        //return $bulan_id;
        //$user = User::find($user_id);

        return view('priode.list-priode-all', compact('data_rekap', 'bulan','rekap', 'cabang'));
        //return view('priode.list-priode-all', compact('varname'));

    }
    public function getErrorMessage(Request $request){
        echo "<title>INFORMASI ABSENSI YANG TIDAK VALID</title>";
        echo $request->message;
    }
    public function getPostingAbsen(){
        $bulan = Bulan::all();
        $users = User::all();
        return view('priode.posting', compact('bulan', 'users'));
    }
    public function getPrintRekap(Request $request){
        // Olah tanggal dulug
        // Format yang diterimaa : 12/21/2016 - 12/28/2016
        $data_tgl = $request->tgl;
        $cab_id = $request->cab;

        $tgl = explode("-", $data_tgl);
        // pisah2 data dan hilangkan spasi
        //  bentuk data 12/31/2016
        $n_awal = explode("/", trim($tgl[0]));
        $n_akhir = explode("/", trim($tgl[1]));
        

        $tgl_awal = $n_awal[2]."-".$n_awal[0]."-".$n_awal[1];
        $tgl_akhir = $n_akhir[2]."-".$n_akhir[0]."-".$n_akhir[1];

        $rekap = TmpGaji::where(['tgl_priode_awal' => $tgl_awal, 'tgl_priode_akhir' => $tgl_akhir])->get();
        if ($rekap->count() < 1) {
            return redirect()->back()->with(['message' => "DATA TIDAK DITEMUKAN", 'type' => "danger"]);
        }
        $bulan = Bulan::orderBy('bulan_id','asc')->get();
        
        $priode = new Priode;
        if ($cab_id !== 'all'){
            $cabang_name = Cabang::select('name')->where('id', $cab_id)->first()->name;
        } else {
            $cabang_name = "Semua Cabang";
        }
        //return $rekap;
        
        return view('report.rekap.priode', compact('cabang_name','rekap','priode', 'bulan', 'cab_id', 'tgl_awal', 'tgl_akhir'));
    }
    public function getPrintRekapAbsen(Request $request){
        $tgl_awal = NULL;
        $tgl_akhir = NULL;
        if (!empty($request->tgl)) {
            $data_tgl = $request->tgl;
            $cab_id = $request->cab;

            $tgl = explode("-", $data_tgl);
            // pisah2 data dan hilangkan spasi
            //  bentuk data 12/31/2016
            $n_awal = explode("/", trim($tgl[0]));
            $n_akhir = explode("/", trim($tgl[1]));
            

            $tgl_awal = $n_awal[2]."-".$n_awal[0]."-".$n_awal[1];
            $tgl_akhir = $n_akhir[2]."-".$n_akhir[0]."-".$n_akhir[1];
            $rekap = Priode::whereBetween('tgl', [$tgl_awal, $tgl_akhir])->orderBy('tgl', 'asc')->get();
        } else {
            $rekap = Priode::orderBy('tgl', 'asc')->get();
        }
        
        $carbon = new Carbon;
        return view('report.rekap.absen', compact('rekap',  'carbon','tgl_awal', 'tgl_akhir'));
    }
     public function getPrintStruk(Request $request){
        $rekap_id = $request->rekap_id;
        $alamat_kantor = $this->alamatKantor;
        $telp_kantor = $this->telpKantor;
        $kota_cetak = $this->kotaCetak;
        $nama_unit = $this->namaUnit;
        $nama_hrd = $this->namaHRD;
        $data_rekap = TmpGaji::find($rekap_id);

        // Jaga jaga data kosong
        if (is_null($data_rekap)) {
            return redirect()->route('home')->with(['message' => "DATA TIDAK DITEMUKAN!", 'type' => "danger"]);
        }
        // Jaga jaga kalo bukan hrd yg nyoba print struk user lain
        if (Auth::user()->level !== 'hrd') {
            if (Auth::user()->id !== $data_rekap->user_id) {
                return redirect()->route('home')->with(['message' => "Anda tidak memiliki ijin untuk mencetak struk ini!", 'type' => "warning"]);
            }
        }
        $data_absen = Priode::where(['rekap_id' => $data_rekap->id])->get();
        $user = User::find($data_rekap->user_id);
        $cek = $data_rekap->count();
        $bulan = Bulan::orderBy('bulan_id','asc')->get();
        
        return view('report.rekap.struk-gaji', compact('data_absen','data_rekap', 'bulan','user', 'cek', 'nama_unit', 'alamat_kantor', 'telp_kantor', 'kota_cetak','nama_hrd'));
    }
}

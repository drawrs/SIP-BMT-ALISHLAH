<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Absen;
use App\Cabang;
use App\Jabatan;
use App\Karyawan;
use App\Cuti;
use App\CutiOut;
use App\Gaji;
use App\Potongan;
use App\Status;
use App\StatusPr;
use Carbon\Carbon;
use DateTimeZone;
use Auth;
class AdminController extends Controller
{
    //
    protected $pathPhoto = 'upload/foto_pegawai';
    protected $bulan = array(
                        '1' => 'Januari',
                        '2' => 'Ferbuari',
                        '3' => 'Maret',
                        '4' => 'April',
                        '5' => 'Mei',
                        '6' => 'Juni',
                        '7' => 'Juli',
                        '8' => 'Agustus',
                        '9' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember'
                    );
    public function report_absen ()
    {
        $users = User::orderBy('karyawan_id', 'asc')
                ->get();
        $cabangs = Cabang::orderBy('id', 'asc')
                ->get();
        return view('report.list-absen', compact('users','cabangs'));
    }
    public function getEditAbsen ($id)
    {
        $absen = Absen::find($id);
        if (is_null($absen)) {
            return redirect()->route('home');
        }
        return view('absen.edit', compact('absen'));
    }
    public function postEditAbsen (Request $request)
    {
        $this->validate($request, [
            'jam_in' => 'max:8|required',
            'jam_out' => 'max:8',
            'out_ijin' => 'max:8',
            'in_ijin' => 'max:8',
            'kt_ijin' => 'max:50',
            'user_id' => 'required'
            ]);
        $absen = Absen::find($request->id);
        $user_id = $request->user_id;
        if (is_null($absen)) {
            return redirect('/');
        }
        $jam_in = $request->jam_in;
        $jam_out = $request->jam_out;
        $out_ijin = $request->out_ijin;
        $in_ijin = $request->in_ijin;

        if (empty($request->jam_in)) {
            $jam_in = NULL;
        }
        if (empty($request->jam_out)) {
            $jam_out = NULL;
        }
        if (empty($request->out_ijin)) {
            $out_ijin = NULL;
        }
        if (empty($request->in_ijin)) {
            $in_ijin = NULL;
        }
        $absen->update([
            'jam_in' => $jam_in,
            'jam_out' => $jam_out,
            'out_ijin' => $out_ijin,
            'in_ijin' => $in_ijin,
            'kt_ijin' => $request->kt_ijin
            ]);
        $data = $absen;
        $n_date = $data->tgl;
        $n_in = $data->jam_in;
        $n_out = $data->jam_out;
        if ($n_in !== NULL && $n_out !== NULL) {
            $date = explode('-', $n_date);
            $hour_in = explode(':', $n_in);
            $hour_out = explode(':', $n_out);
            $time_in = Carbon::create($date[0], $date[1], $date[2], $hour_in[0], $hour_in[1], $hour_in[2]);
            $time_out = Carbon::create($date[0], $date[1], $date[2], $hour_out[0], $hour_out[1], $hour_out[2]);
            // Bagian ini perhitungan jam kerja
            if ($data->out_ijin == NULL) {
                        // Ambil selisih Jam
                        $result = $time_out->diffInHours($time_in);
                        // Ambil selisih menit
                        $total_menit = $time_out->diffInMinutes($time_in);
                    } else { 
                        $hour_out_ijin = $data->out_ijin;

                        $ijin_out = Carbon::parse($n_date." ".$hour_out_ijin);
                         // Ambil selisih Jam
                        $result = $ijin_out->diffInHours($time_in);
                          // Ambil selisih menit
                        $total_menit = $ijin_out->diffInMinutes($time_in);
                        if ($data->in_ijin !== NULL) {
                            $hour_in_ijin = $data->in_ijin;
                            $ijin_in = Carbon::parse($n_date." ".$hour_in_ijin);
                            $result += $time_out->diffInHours($ijin_in);
                            $total_menit += $time_out->diffInMinutes($ijin_in);
                        }
                    }
                    $absen->update(['jam_kerja' => $result, 'menit_kerja' => $total_menit]);
        }
        return redirect()->route('absen.detail', ['id' => $user_id]);
    }
    public function postRefreshAbsen(Request $rikwes){
        
        $absen = Absen::where('user_id', $rikwes->user_id)->get();
        $message = array();
        foreach ($absen as $request) {
            $user_id = $request->user_id;
            
            $jam_in = $request->jam_in;
            $jam_out = $request->jam_out;
            $out_ijin = $request->out_ijin;
            $in_ijin = $request->in_ijin;

            if (empty($request->jam_in)) {
                $jam_in = NULL;
            }
            if (empty($request->jam_out)) {
                $jam_out = NULL;
            }
            if (empty($request->out_ijin)) {
                $out_ijin = NULL;
            }
            if (empty($request->in_ijin)) {
                $in_ijin = NULL;
            }
            $data = Absen::find($request->id);
            
            $data->update([
                'jam_in' => $jam_in,
                'jam_out' => $jam_out,
                'out_ijin' => $out_ijin,
                'in_ijin' => $in_ijin,
                'kt_ijin' => $request->kt_ijin
                ]);
            $n_date = $data->tgl;
            $n_in = $data->jam_in;
            $n_out = $data->jam_out;
            if ($n_in !== NULL && $n_out !== NULL) {
                $date = explode('-', $n_date);
                $hour_in = explode(':', $n_in);
                $hour_out = explode(':', $n_out);
                $time_in = Carbon::create($date[0], $date[1], $date[2], $hour_in[0], $hour_in[1], $hour_in[2]);
                $time_out = Carbon::create($date[0], $date[1], $date[2], $hour_out[0], $hour_out[1], $hour_out[2]);
                // Bagian ini perhitungan jam kerja
                if ($data->out_ijin == NULL) {
                            // Ambil selisih Jam
                            $result = $time_out->diffInHours($time_in);
                            // Ambil selisih menit
                            $total_menit = $time_out->diffInMinutes($time_in);
                        } else { 
                            $hour_out_ijin = $data->out_ijin;

                            $ijin_out = Carbon::parse($n_date." ".$hour_out_ijin);
                             // Ambil selisih Jam
                            $result = $ijin_out->diffInHours($time_in);
                              // Ambil selisih menit
                            $total_menit = $ijin_out->diffInMinutes($time_in);
                            if ($data->in_ijin !== NULL) {
                                $hour_in_ijin = $data->in_ijin;
                                $ijin_in = Carbon::parse($n_date." ".$hour_in_ijin);
                                $result += $time_out->diffInHours($ijin_in);
                                $total_menit += $time_out->diffInMinutes($ijin_in);
                            }
                        }
                        $data->update(['jam_kerja' => $result, 'menit_kerja' => $total_menit]);
            }
        }
        
        return json_encode(['type' => "success", 'message' => "Berhasil diupdate!"]);
    }
    public function getAddAbsen ($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect('/');
        }
        return view('absen.add', compact('user'));   
    }
    public function postAddAbsen (Request $request, $id)
    {
        $this->validate($request, [
            'jam_in' => 'required|min:8|max:8',
            'tgl' => 'required|min:10|max:10'
            ]);
        $absen = new Absen;
        $user_id = $id;
        $date = explode('/', $request->tgl);
        $tgl = $date[2].'-'.$date[1].'-'.$date[0];
        $bln = explode('-', $tgl)[1];
        $jam_in = $request->jam_in;
        $jam_out = $request->jam_out;
        $out_ijin = $request->out_ijin;
        $in_ijin = $request->in_ijin;


        // Mencegah absen ganda dengan mencari data pada table absen. Parameter tgl absen hari ini
                $cek = $absen->where(['tgl' => $tgl, 'user_id' => $user_id ]);
                if ($cek->count() > 0) {
                    // Langsung kembalikan nilai 1
                    return redirect()->back()->with(['message' => "Pegawai sudah melakukan absen pada tanggal tersebut!", 'type' => "danger"]);
                }

        if (empty($request->jam_in)) {
            $jam_in = NULL;
        }
        if (empty($request->jam_out)) {
            $jam_out = NULL;
        }
        if (empty($request->out_ijin)) {
            $out_ijin = NULL;
        }
        if (empty($request->in_ijin)) {
            $in_ijin = NULL;
        }
        $data = $absen;
        $n_date = $tgl;
        $n_in = $jam_in;
        $n_out = $jam_out;
        if ($n_in !== NULL && $n_out !== NULL) {
            $date = explode('-', $n_date);
            $hour_in = explode(':', $n_in);
            $hour_out = explode(':', $n_out);
            $time_in = Carbon::create($date[0], $date[1], $date[2], $hour_in[0], $hour_in[1], $hour_in[2]);
            $time_out = Carbon::create($date[0], $date[1], $date[2], $hour_out[0], $hour_out[1], $hour_out[2]);
            
            if ($out_ijin == NULL) {
                        // Ambil selisih Jam
                        $result = $time_out->diffInHours($time_in);
                        // Ambil selisih menit
                        $total_menit = $time_out->diffInMinutes($time_in);
                    } else { 
                        $hour_out_ijin = $out_ijin;

                        $ijin_out = Carbon::parse($n_date." ".$hour_out_ijin);
                         // Ambil selisih Jam
                        $result = $ijin_out->diffInHours($time_in);
                          // Ambil selisih menit
                        $total_menit = $ijin_out->diffInMinutes($time_in);
                        if ($in_ijin !== NULL) {
                            $hour_in_ijin = $in_ijin;
                            $ijin_in = Carbon::parse($n_date." ".$hour_in_ijin);
                            $result += $time_out->diffInHours($ijin_in);
                            $total_menit += $time_out->diffInMinutes($ijin_in);
                        }
                    }
            $absen->create([
                'user_id' => $user_id,
                'tgl' => $tgl,
                'bulan_id' => $bln,
                'jam_in' => $jam_in,
                'jam_out' => $jam_out,
                'out_ijin' => $out_ijin,
                'in_ijin' => $in_ijin,
                'kt_ijin' => $request->kt_ijin,
                'jam_kerja' => $result,
                'menit_kerja' => $total_menit
                ]);
        } else {
            $absen->create([
                'user_id' => $user_id,
                'tgl' => $tgl,
                'bulan_id' => $bln,
                'jam_in' => $jam_in,
                'jam_out' => $jam_out,
                'out_ijin' => $out_ijin,
                'in_ijin' => $in_ijin,
                'kt_ijin' => $request->kt_ijin
                ]);
        }
        
        return redirect()->route('absen.detail', ['id' => $user_id]);
    }
    public function report_karyawan ()
    {
        $users = User::orderBy('karyawan_id', 'asc')
                ->get();
        $cabangs = Cabang::orderBy('id', 'asc')
                ->get();
        return view('report.list-karyawan', compact('users','cabangs'));
    }
    public function printReportAbsen (Request $request)
    {
        $this->validate($request, [
            'opsi' => 'required'
            ]);
        $aksi = $request->opsi;
        if (isset($aksi[2])) {
            $this->validate($request, [
                'date' => 'required'
                ]);
                $date = explode('-', $request->date);
                $cut_from = explode('/', trim($date[0]));
                $cut_to = explode('/', trim($date[1]));
                $from = $cut_from[2].'-'.$cut_from[0].'-'.$cut_from[1];
                $to = $cut_to[2].'-'.$cut_to[0].'-'.$cut_to[1];
        }
        if (isset($aksi[3])) {
            $this->validate($request, [
                'user' => 'required'
                ]);
            $user_id = $request->user;
        }
        if (isset($aksi[4])) {
            $this->validate($request, [
                'cabang' => 'required'
                ]);
                $cabang = $request->cabang;
        }

        if (isset($aksi[1])) { // Tampil Semua
            $data = Absen::orderBy('tgl', 'asc');
            if (isset($aksi[4])) {
                $data = Absen::whereHas('User', function($q) use ($cabang){
                                $q->where('cabang_id', $cabang);
                            });
            }
        } elseif (isset($aksi[3])) { // Nama Karyawan
            $data = Absen::where('user_id', $user_id);
            if (isset($aksi[2])) {
                $data = Absen::where('user_id', $user_id)
                            ->whereBetween('tgl', [$from, $to]);
            }
        } elseif (isset($aksi[2])) { // Tanggal
            $data = Absen::whereBetween('tgl', [$from, $to]);
            if (isset($aksi[3])) {
                $data = Absen::whereBetween('tgl', [$from, $to])
                            ->where('user_id', $user_id);
            } elseif (isset($aksi[4])) {
                $data = Absen::whereBetween('tgl', [$from, $to])
                            ->whereHas('User', function($q) use ($cabang){
                                $q->where('cabang_id', $cabang);
                            });
            }
        } elseif (isset($aksi[4])) { //Cabang
            $data = Absen::whereHas('User', function($q) use ($cabang){
                    $q->where('cabang_id', $cabang);
                });
            if (isset($aksi[2])) {
                $data = Absen::whereHas('User', function($q) use ($cabang){
                    $q->where('cabang_id', $cabang);
                })->whereBetween('tgl', [$from, $to]);
            }
        }
       
        /*switch ($request->opsi) {
            case 'all':
                $opsi = new Absen;
                break;
            case 'name':
            $this->validate($request, [
                'user' => 'required'
                ]);
                $opsi = Absen::where('user_id', $request->user);
                break;
            case 'date':
            $this->validate($request, [
                'date' => 'required'
                ]);
                $date = explode('-', $request->date);
                $cut_from = explode('/', trim($date[0]));
                $cut_to = explode('/', trim($date[1]));
                $from = $cut_from[2].'-'.$cut_from[0].'-'.$cut_from[1];
                $to = $cut_to[2].'-'.$cut_to[0].'-'.$cut_to[1];
                $opsi = Absen::whereBetween('tgl', [$from, $to]);
                break;
            case 'cabang':
            $this->validate($request, [
                'cabang' => 'required'
                ]);
                $cabang = $request->cabang;
                $opsi = Absen::whereHas('User', function($q) use ($cabang){
                    $q->where('cabang_id', $cabang);
                });
                break;
            default:
               return redirect()->back();
                break;
        } */
        $absens = $data->get();
        return view('report.absen', ['absens' => $absens]);
    }
    public function printReportKaryawan (Request $request)
    {
        $this->validate($request, [
            'opsi' => 'required|max:12'
            ]);
        switch ($request->opsi) {
            case 'all':
                $opsi = new User;
                break;
            case 'name':
            $this->validate($request, [
                'user' => 'required'
                ]);
                $opsi = User::where('id', $request->user);
                break;
            default:
               return redirect()->back();
                break;
        }
        $users = $opsi->orderBy('id','asc')->get();
        return view('report.karyawan', compact('users'));
    }
    public function cuti_req ()
    {
        if (Auth::user()->level == 'pc') {
            $opsi = CutiOut::where('status','3');
        }
        else if (Auth::user()->level == 'hrd') {
            $opsi = CutiOut::where('status','2');
        } else {
            return redirect('/');
        }
        $cuti = $opsi->orderBy('updated_at','desc')->get();
        $cuti_ok = CutiOut::whereIn('status', ['1', '4'])->orderBy('updated_at','desc')->paginate(10);
        return view('cuti.manage-cuti', compact('cuti', 'cuti_ok'));
    }
    public function cuti_aksi (Request $request)
    {
        $this->validate($request, [
            'act' => 'required',
            'id' => 'required'
            ]);
        $cuti = CutiOut::find($request->id);
        if (is_null($cuti)) {
            return '0';
        }
        // Id yg ngajuin cuti
        $user_id = $cuti->user_id;
        if ($request->act == 'acc') {
            if (Auth::user()->level == 'pc') {
                $cuti->status = '2';
            } else if (Auth::user()->level == 'hrd') {
                $cuti->status = '1';
            }
        } elseif ($request->act == 'dec') {
            $stmt = Cuti::where('user_id', $user_id)->first();
            // Jika jenis cutinya cuti tahunan
            if ($cuti->jenis_cuti_id == '0') {
                $stmt->update(['qty' => $stmt->qty + $cuti->qty]);
            }
            $cuti->status = '0';
        }
        if($cuti->update()) {
            return '1';
        }
        return '2';
    }
    public function cuti_update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'user_id' => 'required',
            'date' => 'required'
            ]);
        $id = $request->id;
        $user_id = $request->user_id;
        $tgl = $request->date;
        $date = explode('-', $tgl);

        $from = trim($date[0]);
        $to = trim($date[1]);

        $cut_from = explode('/', $from);
        $cut_to = explode('/', $to);
       
        $x_from = Carbon::create($cut_from[2], $cut_from[0], $cut_from[1], 0, 0, 0);
        $y_to = Carbon::create($cut_to[2], $cut_to[0], $cut_to[1], 0, 0, 0);
        
        // Jumlah hari cuti
        $result = date_diff($x_from, $y_to)->format("%a");
        // Ambil Cuti_out
        $cuti_out = CutiOut::find($id);

        if (is_null($cuti_out)) {
            return '0';
        }
        $cuti = Cuti::where('user_id', $cuti_out->user_id)->first();
       
        if ($result <= $cuti_out->qty) {
            $new_qty_out = $cuti_out->qty - $result;
            $cuti->update(['qty' => $cuti->qty + $new_qty_out]);
            $cuti_out->update(['qty' => $result, 'from' => $from, 'to' => $to]);
            return '1';
        } else {
            $min = $result - $cuti_out->qty;
            if ($min > $cuti->qty) {
                return 'over';
            }
            $cuti->update(['qty' => $cuti->qty - $min]);
            $cuti_out->update(['qty' => $result, 'from' => $from, 'to' => $to]);
            return '1';
        }
        return '0';
        
    }
    public function printCuti ($id = null)
    {
        if ($id == null) {
            return redirect('/');
        }
        $cuti_ok = CutiOut::find($id);
        $cuti = Cuti::where('user_id', $cuti_ok->user->id)->first();
        $no = CutiOut::where('status', '1')->count() + 1;
        $array = array(
            '1' => 'I',
            '2' => 'II',
            '3' => 'III',
            '4' => 'IV',
            '5' => 'V',
            '6' => 'VI',
            '7' => 'VII',
            '8' => 'VIII',
            '9' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII'
            );
        $month = Carbon::now(new DateTimeZone('Asia/Jakarta'))->month;
        $bulan = $array[$month];
        $nm_bln = $this->bulan[$month];
        $date_from = explode('/', $cuti_ok->from);
        $from = $date_from[1].'/'.$date_from[0].'/'.$date_from[2];
        $date_to = explode('/', $cuti_ok->to);
        $to = $date_to[1].'/'.$date_to[0].'/'.$date_to[2];
        return view('report.cuti', compact('cuti_ok', 'cuti', 'no', 'bulan','nm_bln', 'from', 'to'));
    }
    public function karyawan ()
    {
        $opsi = new User; // Untuk HRD
        if (Auth::user()->level == 'pc') { // Untuk Pimpinan Cabang
            $opsi = User::where('cabang_id', Auth::user()->cabang_id);
        }
        $users = $opsi->orderBy('karyawan_id', 'asc')->paginate(20);
        return view('karyawan', compact('users'));
    }
    public function addUser (Request $request)
    {
        
    }
    public function getAddKaryawan () {
        $jabs = Jabatan::where('id', '!=', '6')->get();
        $cabs = Cabang::all();
        $stats = Status::all();
        $stat_pr = StatusPr::all();
        return view('karyawan.tambah', compact('jabs','cabs','stats','stat_pr'));
    }
    public function postAddKaryawan (Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'level' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'tgl' => 'required',
            'thn' => 'required',
            'bln' => 'required',
            'ktp' => 'required',
            'jk' => 'required|max:2',
            'alamat' => 'required|max:250',
            'jabatan' => 'required',
            'cabang' => 'required',
            'cuti' => 'required|integer'
            ]);
        $user = User::select('id')->orderBy('id','desc')->first();

        if (empty($user)) {
            $kode = 1;
        } else {
            $kode = $user->id + 1;
        }
        // buat ID Karyawan Format AIS-0001/AIS-xxxx
        $karyawan_id = 'AIS-000'. $kode;
        if ($kode >= 1000) {
            $karyawan_id = 'AIS-'. $kode;
        } elseif ($kode >= 100) {
            $karyawan_id = 'AIS-0'. $kode;
        } elseif ($kode >= 10) {
            $karyawan_id = 'AIS-00'. $kode;
        }
        User::create([
            'name' => $request->name,
            'karyawan_id' => $karyawan_id,
            'cabang_id' => $request->cabang,
            'level' => $request->level,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user = User::select('id')->orderBy('id','desc')->first();
        $user_id = $user->id;
        Karyawan::create([
            'user_id' => $user_id,
            'jabatan_id' => $request->jabatan,
            'status_id' => $request->status_pg,
            'ktp' => $request->ktp,
            'nama' => $request->name,
            'jk' => $request->jk,
            'tgl' => $request->thn.'-'.$request->bln.'-'.$request->tgl,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'status_pr_id' => $request->status_pr,
            'anak' => $request->anak,
            'last_pd' => $request->last_pd,
            'grade' => $request->grade
        ]);
        Cuti::create([
            'user_id' => $user_id,
            'qty' => $request->cuti,
            'satuan' => 'hari'
            ]);
        Gaji::create([
            'user_id' => $user_id/*,
            'gapok' => $request->gapok,
            'tunjab' => $request->tunjab,
            'tunkel' => $request->tunkel,
            'dplk' => $request->dplk,
            'pensiun' => $request->pensiun,
            'bpjs_kes' => $request->bpjs_kes,
            'bpjs_tk' => $request->bpjs_tk,
            'um' => $request->um,
            'transport' => $request->transport*/
            ]);
        Potongan::create([
            'user_id' => $user_id/*,
            'gapok' => $request->gapok,
            'tunjab' => $request->tunjab,
            'tunkel' => $request->tunkel,
            'dplk' => $request->dplk,
            'pensiun' => $request->pensiun,
            'bpjs_kes' => $request->bpjs_kes,
            'bpjs_tk' => $request->bpjs_tk,
            'um' => $request->um,
            'transport' => $request->transport*/
            ]);
        return redirect()->route('karyawan');
    }
    public function getEditKaryawan ($id) {
        $user = User::findOrFail($id);
        $jabs = Jabatan::where('id', '!=', '6')->get();
        $cabs = Cabang::all();
        $stats = Status::all();
        $stat_pr = StatusPr::all();
        $tgl = explode('-', $user->detail->tgl);
        $pathPhoto = $this->pathPhoto;
        return view('karyawan.edit', compact('user','jabs','cabs', 'stats', 'stat_pr', 'tgl', 'pathPhoto'));
    }
    public function postEditKaryawan (Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|max:255',
            /*'level' => 'required|max:100',*/
            'tgl' => 'required',
            'thn' => 'required',
            'bln' => 'required',
            'ktp' => 'required',
            'jk' => 'required|max:2',
            'alamat' => 'required|max:250',
            'jabatan' => 'required',
            'cabang' => 'required',
            'cuti' => 'required|integer',
            'foto' => 'mimes:jpeg,bmp,png, jpg, gif'
            ]);
        $user_id = $request->id;
        
        $user = User::findOrFail($user_id);
        if (is_null($request->level)) {
            $level_user = $user->level;
        } else {
            $level_user = $request->level;
        }
        $filename = $user->detail->foto;
        $destinationPath = $this->pathPhoto;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename  =  date("Y-m-d"). '-'.$user_id. "-" . $file->getClientOriginalName()."";

            //$path = public_path($destinationPath.'/' . $filename);
 
            $request->file('foto')->move($destinationPath, $filename);
        }
        $user->update([
            'name' => $request->name,
            'cabang_id' => $request->cabang,
            'level' => $level_user
        ]);
        
        Karyawan::where('user_id', $user_id)
            ->update([
            'user_id' => $user_id,
            'jabatan_id' => $request->jabatan,
            'status_id' => $request->status_pg,
            'ktp' => $request->ktp,
            'nama' => $request->name,
            'jk' => $request->jk,
            'tgl' => $request->thn.'-'.$request->bln.'-'.$request->tgl,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'status_pr_id' => $request->status_pr,
            'anak' => $request->anak,
            'last_pd' => $request->last_pd,
            'grade' => $request->grade,
            'foto' => $filename
        ]);
        Cuti::where('user_id', $user_id)
            ->update([
            'user_id' => $user_id,
            'qty' => $request->cuti,
            'satuan' => 'hari'
            ]);
        /*Gaji::where(['user_id' => $user_id])
            ->update([
                'gapok' => $request->gapok,
                'tunjab' => $request->tunjab,
                'tunkel' => $request->tunkel,
                'dplk' => $request->dplk,
                'pensiun' => $request->pensiun,
                'bpjs_kes' => $request->bpjs_kes,
                'bpjs_tk' => $request->bpjs_tk,
                'um' => $request->um,
                'transport' => $request->transport
            ]);*/
        return redirect()->back();
    }
    public function gantiPwd (Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
            ]);
        $user_id = $request->id;
        User::where('id', $user_id)->update(['password' => bcrypt($request->password)]);
        return redirect()->back()->with(['message' => 'Katasandi Dirubah', 'type' => 'success']);
    }
    public function hapusUser (Request $request)
    {
        $user = User::find($request->id);
        if (is_null($user)) {
            return '0';
        }
        if ($user->delete()) {
            Karyawan::where('user_id', $request->id)->delete();
            Cuti::where('user_id', $request->id)->delete();
            Absen::where('user_id', $request->id)->delete();
            CutiOut::where('user_id', $request->id)->delete();
            Gaji::where('user_id', $request->id)->delete();
            Potongan::where('user_id', $request->id)->delete();
            return '1';
        }
        return '2';
    }
    public function postAddCabang (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:2',
            ]);
        $cabs = Cabang::create(['name' => $request->name, 'desk' => 'none']);
        if ($cabs) {
            return '1';
        }
        return '0';
    }
    public function postDelCabang (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            ]);
        $cabs = Cabang::find($request->id);
        if (is_null($cabs)) {
            return '0';
        }
        if ($cabs->delete()) {
            $users = User::where('cabang_id', $request->id)->get();
            foreach ($users as $user) {
                Karyawan::where('user_id', $user->id)->delete();
                Cuti::where('user_id', $user->id)->delete();
                Absen::where('user_id', $user->id)->delete();
                CutiOut::where('user_id', $user->id)->delete();
                User::where('id', $user->id)->delete();
            }
            return '1';
        }
        return '2';
    }

    public function postAddJabatan (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:2',
            ]);
        $cabs = Jabatan::create(['name' => $request->name, 'desk' => 'none']);
        if ($cabs) {
            return '1';
        }
        return '0';
    }
    public function postDelJabatan (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            ]);
        $master = 6; // ID Master Jabatan yg ngga bisa di ganggu gugat!
        if ($request->id == $master) {
            return '0';
        }
        $cabs = Jabatan::find($request->id);
        if (is_null($cabs)) {
            return '0';
        }
        if ($cabs->delete()) {
            $users = Karyawan::where('jabatan_id', $request->id)->update(['jabatan_id' => $master]);
            return '1';
        }
        return '2';
    }
    public function postAddStatus (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100|min:2',
            ]);
        $stat = Status::create(['name' => $request->name]);
        if ($stat) {
            return '1';
        }
        return '0';
    }
    public function postDelStatus (Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            ]);
        $master = 1; // ID Master Status yg ngga bisa di ganggu gugat!
        if ($request->id == $master) {
            return '0';
        }
        $cabs = Status::find($request->id);
        if (is_null($cabs)) {
            return '0';
        }
        if ($cabs->delete()) {
            $users = Karyawan::where('status_id', $request->id)->update(['status_id' => $master]);
            return '1';
        }
        return '2';
    }
}

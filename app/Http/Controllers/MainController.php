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
use App\Config;
use App\JenisCuti;
use Validator;
use Auth;
use DB;
class MainController extends Controller
{
    //
    protected $date = '';
    protected $bulan = [
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
                ];
    public function date ($x){
        return $x;
    }
    public function getMaster () {
        $jabs = Jabatan::all();
        $cabs = Cabang::all();
        return view('karyawan.master', compact('jabs','cabs'));
    }
    public function postMaster (Request $request) {
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
            'ktp' => $request->ktp,
            'nama' => $request->name,
            'jk' => $request->jk,
            'tgl' => $request->thn.'-'.$request->bln.'-'.$request->tgl,
            'alamat' => $request->alamat
        ]);
        Cuti::create([
            'user_id' => $user_id,
            'qty' => $request->cuti,
            'satuan' => 'hari'
            ]);
        Gaji::create([
            'user_id' => $user_id,
            'gapok' => $request->gapok,
            'tunjab' => $request->tunjab,
            'tunkel' => $request->tunkel,
            'dplk' => $request->dplk,
            'pensiun' => $request->pensiun,
            'bpjs_kes' => $request->bpjs_kes,
            'bpjs_tk' => $request->bpjs_tk,
            'um' => $request->um,
            'transport' => $request->transport
            ]);
        return redirect()->route('karyawan');
    }
    public function home ()
    {
        /*$tgl = Carbon::createFromDate( date('Y'), date('m'), date('d'), 'Asia/Jakarta');*/
        $date = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $absen = Absen::where('user_id', Auth::user()->id)
                        ->where('tgl', $date->toDateString())->get();
        $btn = array('out' => '');
        if ($absen->count() == 0) {
            $info = array(
                'msg' => "Anda Belum absen hari ini.",
                'st_in' => "",
                'st_out' => "disabled"
                );
            $ijin = array(
                    'out' => 'disabled',
                    'in' => 'disabled'
                    );
        } else {

            if ($absen->first()->jam_out == NULL){
                $info = array(
                    'msg' => "Absen pagi berhasil, jangan lupa absen pulang.",
                    'st_in' => "disabled",
                    'st_out' => ""
                    );
            } else {
                $info = array(
                    'msg' => "Absen hari ini selesai, Terimakasih. :)",
                    'st_in' => "disabled",
                    'st_out' => "disabled"
                    );
            }
            if ($absen->first()->out_ijin == NULL AND $absen->first()->jam_out == NULL) {
                $ijin = array(
                    'out' => '',
                    'in' => 'disabled'
                    );
            } elseif ($absen->first()->in_ijin == NULL AND $absen->first()->jam_out == NULL) {
                $ijin = array(
                    'out' => 'disabled',
                    'in' => ''
                    );
            } else {
                $ijin = array(
                    'out' => 'disabled',
                    'in' => 'disabled'
                    );
            }

            if ($absen->first()->out_ijin !== NULL AND $absen->first()->in_ijin == NULL) {
                $btn = array(
                    'out' => 'disabled',
                    );
            }
        }
        return view('home', ['absen' => $absen, 'btn' => $btn, 'info' => $info, 'btn_ijin' => $ijin]);
    }
    public function absen_now (Request $request)
    {
        $date = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $user_id = Auth::user()->id;
        $absen = new Absen;
        $act = $request->act;
        $kt_ijin = $request->kt_ijin;
        switch ($act) {
            case 'in':
                // Mencegah absen ganda dengan mencari data pada table absen. Parameter tgl absen hari ini
                $cek = $absen->where(['tgl' => $date->toDateString(), 'user_id' => Auth::user()->id ]);
                if ($cek->count() > 0) {
                    // Langsung kembalikan nilai 1
                    return '1';
                }
                $absen->user_id = $user_id;
                // inputkan 
                $absen->tgl = $date->toDateString();
                // menambahkan ID Hari ini
                $absen->hari_id = $date->parse()->setTimezone('GMT+7')->dayOfWeek;
                $absen->bulan_id = $date->parse()->setTimezone('GMT+7')->month;
                $absen->jam_in = $date->toTimeString();
                if ($absen->save()) {
                    return '1';
                }
                break;

            case 'out':
                $absen = Absen::where('user_id', Auth::user()->id)
                            ->where('tgl', $date->toDateString());
                if ($absen->update(['jam_out' => $date->toTimeString()]))
                {
                    $data = $absen->first();
                    $n_date = $data->tgl;
                    $n_in = $data->jam_in;
                    $n_out = $data->jam_out;
                    $date = explode('-', $n_date);
                    $hour_in = explode(':', $n_in);
                    $hour_out = explode(':', $n_out);
                    $time_in = Carbon::parse($n_date." ".$n_in);
                    $time_out = Carbon::parse($n_date." ".$n_out);
                    /*$time_in = Carbon::create($date[0], $date[1], $date[2], $hour_in[0], $hour_in[1], $hour_in[2]);
                    $time_out = Carbon::create($date[0], $date[1], $date[2], $hour_out[0], $hour_out[1], $hour_out[2]);*/
                    
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
                    return '1';
                }
                break;

            case 'out_ijin':
                $ijin_out_now = $absen->where('user_id', Auth::user()->id)
                                ->where('tgl', $date->toDateString());
                if ($ijin_out_now->update(['out_ijin' => $date->toTimeString(), 'kt_ijin' => $kt_ijin ]))
                {
                    return '1';
                }
                break;

            case 'in_ijin':
                if ($absen->where('user_id', Auth::user()->id)
                      ->where('tgl', $date->toDateString())
                      ->update(['in_ijin' => $date->toTimeString()]))
                {
                    return '1';
                }
                break;
        }
        return '0';
    }
    public function data_absen ($id = null)
    {
        if ($id == null) {
            $id = Auth::user()->id;
        }
        $user = User::find($id);
        $bulan = Bulan::orderBy('bulan_id','asc')->get();
        $month = Bulan::all();
        $cek = Absen::where('user_id', $id)->count();
        return view('absen.data-absen', ['bulan' => $bulan, 'month' => $month,  'cek' => $cek, 'user_id' => $id, 'user' => $user]);
    }
    
    public function cuti ()
    {
        $cuti = Cuti::where('user_id', Auth::user()->id)->first();
        $jenis_cuti = JenisCuti::where('special', Auth::user()->detail->jk)->orWhere('special', 'none')->get();

        $temp_cuti = TempCuti::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        $cuti_out = CutiOut::where('user_id' , Auth::user()->id)->orderBy('id','desc')->paginate(5);
        return view('cuti.cuti', compact('cuti', 'jenis_cuti', 'temp_cuti', 'cuti_out'));
    }
    public function cuti_temp (Request $request)
    {
        $this->validate($request, [
            'date' => 'required|max:100',
            'note' => 'required|max:200'
            ]);


        $tgl = $request->date;
        $note = $request->note;
        $date = explode('-', $tgl);

        $from = trim($date[0]);
        $to = trim($date[1]);

        $cut_from = explode('/', $from);
        $cut_to = explode('/', $to);
       
        $x_from = Carbon::create($cut_from[2], $cut_from[0], $cut_from[1], 0, 0, 0);
        $y_to = Carbon::create($cut_to[2], $cut_to[0], $cut_to[1], 0, 0, 0);
        
        // Jumlah hari cuti
        $result = date_diff($x_from, $y_to)->format("%a") + 1;
        $cuti = Cuti::where('user_id', Auth::user()->id)->first();
         // Jenis cuti
        $type = $request->type;

        // jika bukan cuti tahunan (id cuti tahunan == 0)
        if($type !== '0'){
            $jenis_cuti = JenisCuti::find($type);
            // Jika cuti yang diminta lebih besar dari batas hari cuti
            if ($result > $jenis_cuti->day_limit) {
                return redirect()->back()->with(['message' => 'Jangka waktu cuti melebihi batas cuti yang diperbolehkan.', 'type' => 'danger']);
            }
            
        } else {
             if ($result > $cuti->qty) {
                return redirect()->back()->with(['message' => 'Permintaan waktu cuti melebihi sisa cuti anda.', 'type' => 'danger']);
            }
            // update jumlah sisa jatah cuti
            $cuti->update(['qty' => $cuti->qty-$result ]);
        }

        
       
        
        // Buat kode
        $get = TempCuti::select('id')->orderBy('id','desc')->first();
        
        if (empty($get)) {
            $kode = 1;
        } else {
            $kode = $get->id + 1;
        }
        // Keperluan/Keterangan
        $note = $request->note;
        // Status : Pending = 3
        $status = 3;
        $temp = new TempCuti;
        $temp->user_id = Auth::user()->id;
        $temp->jenis_cuti_id = $type; // id jenis cuti
        $temp->kode = 'CUTI-'.$kode.'-'.date("dmY");
        $temp->qty = $result;
        $temp->from = $from;
        $temp->to = $to;
        $temp->note = $note;
        $temp->status = $status;
        if ($temp->save()) {
            $message = 'Ditambahkan';
            $type = 'info';
        } else {
            $message = 'Terjadi kesalahan';
            $type = 'danger';
        }
        return redirect()->back()->with(['message' => $message, 'type' => $type]);
    }
    public function cuti_send (Request $request)
    {
        $temp = TempCuti::where('user_id', Auth::user()->id);
        $cuti = $temp->get();
        //$cuti_out = new CutiOut;
        foreach ($cuti as $cuti) {
            $from = $cuti->from;
            $to = $cuti->to;
            
            // Jumlah hari cuti
            $result = $cuti->qty;
            // Buat kode
            $kode = $cuti->kode;
            // Keperluan/Keterangan
            $note = $cuti->note;
            // Status : Pending = 3
            $status = 3;
            //S$cuti_out = new CutiOut;
            $cuti_out = new CutiOut;
            $cuti_out->create(['user_id' => $cuti->user_id,
                                'jenis_cuti_id' => $cuti->jenis_cuti_id,
                                'kode' => $kode,
                                'qty' => $result,
                                'from' => $from,
                                'to' => $to,
                                'note' => $note]);
            $temp->delete();
            
        }
        return redirect()->back();
    }
    public function cuti_batal(Request $request)
    {
        $temp = TempCuti::find($request->cuti_id);
        if (is_null($temp)) {
            return '0';
        }
        $cuti = Cuti::where('user_id', Auth::user()->id);
        // Jika cuti tahunan yang dibatalkan
        if ($temp->jenis_cuti_id == 0) {
            $cuti->update(['qty' => $cuti->first()->qty + $temp->qty]);
        }
        if ($temp->delete()) {
            return '1';
        }
        return '2';
    }
    public function report_absen ()
    {
        $absen = Absen::where('user_id', '1')
                ->orderBy('tgl','asc')
                ->get();
        return view('report.absen', ['absens' => $absen]);
    }
    public function tiasa($request){
        return $request->all();
    }
    public function tos (Request $request)
    {
        // get day name
       /* $tgl = Carbon::parse("2016-12-13");
        return $tgl->formatLocalized('%A, %d %B %Y');*/
        // diff in hour and minutes
        $to = Carbon::parse("2008-12-13 10:42:00");
        $from = Carbon::parse("2008-12-13 8:21:00");

        $stat = $to->diff($from); // DateInterval object
        $cek = diff_hm('2016-07-12', '08:00:00', '10:00:00');
        return $cek;
        return $stat->format('%H:%I');
        /*Convert to minutes*/
        if ($request->q == 'a') {
            return $this->tiasa($request);
        }
        function convertToHoursMins($time, $format = '%02d:%02d') {
            if ($time < 1) {
                return;
            }
            $hours = floor($time / 60);
            $minutes = ($time % 60);
            return sprintf($format, $hours, $minutes);
        }

        return convertToHoursMins(60, '%02d hours %02d minutes'); 
        $n_date = "2016-12-01";
        $n_in = '08:15:00';
        $n_out = '16:30:00';
        
        $time_out = Carbon::parse("2016-12-31 16:30:00");
       
        $time_in = Carbon::parse("2016-12-01 08:15:00");
        $result = $time_in->diffInMinutes($time_out);
        return $result;
       /* $date = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        return $date->parse()->setTimezone('GMT+7')->dayOfWeek;*/
        
        $absen = new Absen;
        $priode = new Priode;
        $tmp_gaji = new TmpGaji;
        $user_id = 11;
        $tgl_awal = '2016-11-01';
        $tgl_akhir = '2016-11-27';
        $gaji_pokok = 120000;
        $uang_makan = 15000;
        $uang_transport = 20000;
        // total jam kerja
        $total_jk = 0;
        // Total hari kerja
        $total_hk = 0;
        // Ambil data dari tabel dengan tanggal mulai dan akhir
        $data =  $absen->where('user_id', $user_id)
                ->whereBetween('tgl', [$tgl_awal, $tgl_akhir]);
        
        //$user_id = 0;
        // Loopeing cek data doublel
        foreach ($data->get() as $d) {
            // Jika hari sabtu maka tidak dikurangi 1 jam istirahat
            if ($d->hari_id == 6) {
                // Tambahkan Jam kerja ke variable total_jk
                $total_jk += $d->jam_kerja;
            } else {
                // Tambahkan Jam kerja ke variable total_jk - 1 jam istirahat
                $total_jk += $d->jam_kerja - 1 ;
            }

            // Tambahkan +1 ke total_hk
            $total_hk++;

            // isi varible user id
            //$user_id = $d->user_id;
            // Cek absensi double
            $cek_double = $absen->where(['tgl' => $d->tgl, 'user_id' => $user_id]);
            if ($cek_double->count() > 1) { // jika ditemukan baris data lebih dari satu
                return "ada yang double di tanggal : ".$d->tgl;
            }
            // Cek lupa ngisi jam keluar
            if ($d->jam_out == NULL) {
                return "Jam keluar masih kosong pada Absensi tgl ". $d->tgl;
            }
            // Cek belum ijin masuk setelah ijin keluar
            if ($d->out_ijin !== NULL && $d->in_ijin == NULL) {
                return "Ada yang udah ijin keluar tapi belum ngisi ijin masuk di tanggal ".$d->tgl;
            }
           
            // Cek barangkali ada jam kerja yang kosong
            if ($d->jam_kerja == NULL) {
                return "Jumlah jam kerja masih kosong untuk Absensi tgl " . $d->tgl;
            }
        }
        
         //Get the priode ID & Cegah data double Dan berdasarkan ID User
         $stmt = $tmp_gaji->select('id')->where(['user_id' => $user_id,'tgl_priode_awal' => $tgl_awal, 'tgl_priode_akhir' => $tgl_akhir]);
         // jika ditemukan data dengan ketetuan tanggal dan user id diatas
         if ($stmt->count() > 0) {
            // Kembalikan untuk menghentikan proses input
            return "Sudah ada data tersimpan untuk priode ini";
         }
         // Masukan rekap data ke tabel rekap_gaji_per_priode
         $tmp_gaji->create(['user_id' => $user_id,
                'tgl_priode_awal' => $tgl_awal,
                'tgl_priode_akhir' => $tgl_akhir,
                'gaji_pokok' => $gaji_pokok,
                'uang_makan' => $uang_makan,
                'hari_kerja' => $total_hk,
                'jam_kerja' => $total_jk]);

         // Ambil id_rekap
         $id_rekap = $stmt->first()->id;
      
        //looping input data
        foreach ($data->get() as $d) {
          
            // Tambahkan data yang terpilih ke tabel priode_absen
            $priode->create([
                'rekap_id' => $id_rekap,
                'user_id' => $d->user_id,
                'bulan_id' => $d->bulan_id,
                'hari_id' => $d->hari_id,
                'tgl' => $d->tgl,
                'out_ijin' => $d->out_ijin,
                'in_ijin' => $d->in_ijin,
                'kt_ijin' => $d->kt_ijin,
                'jam_kerja' => $d->jam_kerja,
                'jam_in' => $d->jam_in,
                'jam_out' => $d->jam_out]);
        }
       
       $message = "Sukses";
        // hapus data lama karena sudah dipindahkan ke tabel baru priode_absen
        /*if ($data->delete()) {
            $message = "Berhasil diposting!";
        } else {
            $message = "Terjadi kesalahan! Data tidak dapat diposting. Silahkan hubungi Administrator.";
        }*/
        return $message;
        //return $data;
    }
    // Proses Posting
    public function postCekPosting(Request $request)
    {   
        if ($request->act == 'post_all') {
            return $this->postCekPostingAll($request);
        }
        $absen = new Absen;
        $priode = new Priode;
        $tmp_gaji = new TmpGaji;
        $config = new Config;
        // Olah tanggal dulug
        // Format yang diterimaa : 12/21/2016 - 12/28/2016
        $data_tgl = $request->tgl;

        $tgl = explode("-", $data_tgl);
        // pisah2 data dan hilangkan spasi
        //  bentuk data 12/31/2016
        $n_awal = explode("/", trim($tgl[0]));
        $n_akhir = explode("/", trim($tgl[1]));
        

        $tgl_awal = $n_awal[2]."-".$n_awal[0]."-".$n_awal[1];
        $tgl_akhir = $n_akhir[2]."-".$n_akhir[0]."-".$n_akhir[1];
    

        $user_id = $request->user_id;
        $gaji_pokok = $request->gapok;
        // id bulan
        $bulan_id = $request->bln;
        // konstanta uang makan 
        $k_um = $request->u_makan;
        $uang_makan = 0;
        // Konstanta uang transport
        $uang_transport = 0;
        $k_utp = $request->u_transport;

        // total jam kerja
        $total_jk = 0;
        // Total hari kerja
        $total_hk = 0;
        // total menit kerja
        $total_menit = 0;
        // status validasi
        $status_valid = 1;
        // Pesan error
        $message = NULL;
        // Ambil data dari tabel dengan tanggal mulai dan akhir
        $data =  $absen->where('user_id', $user_id)
                ->whereBetween('tgl', [$tgl_awal, $tgl_akhir]);
        // Jika tidak ada data yang ditemukan
        if ($data->count() < 1) {
            $message = "Maaf, absensi untuk priode <i><strong>".$tgl_awal."</strong></i> - <i><strong>".$tgl_akhir."</strong></i> ini tidak ditemukan.";
            $type = "error";
            return json_encode(['type' => $type, 'message' => $message]);
        }

        //$user_id = 0;
        // Loopeing cek data doublel
        foreach ($data->get() as $d) {
            // Jika hari sabtu maka tidak dikurangi 1 jam istirahat
            if ($d->hari_id == 6) {
                // Tambahkan Jam kerja ke variable total_jk
                $total_jk += $d->jam_kerja;
                $total_menit += $d->menit_kerja;
                // untuk hari sabtu. tambahkan selalu dengan format: (total_menit_kerja_hri_ini / konstanta_dari_tabel_config) * konstanta_uang_makan
                $uang_makan += ($d->menit_kerja/$config->find('hari_s')->menit)*$k_um;


            } else {
                // Tambahkan Jam kerja ke variable total_jk
                $total_jk += $d->jam_kerja; // 1 parameter 1 jam
                $total_menit += $d->menit_kerja; // 60 parameter 60 menit

                // untuk hari normal. tambahkan selalu dengan format: (total_menit_kerja_hri_ini / konstanta_dari_tabel_config) * konstanta_uang_makan
                $uang_makan += ($d->menit_kerja/$config->find('hari_n')->menit)*$k_um;
            }
           
            // Tambahkan +1 ke total_hk
            $total_hk++;

            
            // Cek absensi double
            $cek_double = $absen->where(['tgl' => $d->tgl, 'user_id' => $user_id]);
            if ($cek_double->count() > 1) { // jika ditemukan baris data lebih dari satu
                $message .= "<li>Terdapat <b>absensi ganda</b> pada tanggal : <b><u>".$d->tgl."</u></b></li>";
                $type = "error";
                $status_valid = 0;
                //return json_encode(['type' => $type, 'message' => $message]);
            }
            // Cek lupa ngisi jam keluar
            if ($d->jam_out == NULL) {
                $message .= "<li><b>Jam keluar</b> masih kosong pada absensi tanggal : <b><u>".$d->tgl."</u></b></li>";
                $type = "error";
                // rubah status jadi 0 untuk error
                $status_valid = 0;
                //return json_encode(['type' => $type, 'message' => $message]);
            }
            // Cek belum ijin masuk setelah ijin keluar
            if ($d->out_ijin !== NULL && $d->in_ijin == NULL) {
                $message .= "<li>Karyawan ijin keluar tapi belum mengisi <b>ijin masuk</b> pada tanggal : <b><u>".$d->tgl."</u></b></li>";
                $type = "error";
                // rubah status jadi 0 untuk error
                $status_valid = 0;
                //return json_encode(['type' => $type, 'message' => $message]);
            }
           
            // Cek barangkali ada jam kerja yang kosong
            if ($d->jam_kerja == NULL) {
                $message .= "<li><b>Jumlah Jam Kerja</b> masih kosong untuk absensi tanggal : <b><u>".$d->tgl."</u></b></li>";
                $type = "error";
                // rubah status jadi 0 untuk error
                $status_valid = 0;
                //return json_encode(['type' => $type, 'message' => $message]);
            }
            if ($d->menit_kerja == NULL) {
                        $message .= "<li><b>Jumlah Menit Kerja</b> masih kosong untuk absensi tanggal : <b><u>".$d->tgl."</u></b></li>";
                        $type = "error";
                        // rubah status jadi 0 untuk error
                        $status_valid = 0;
                        
                        //return json_encode(['type' => $type, 'message' => $message]);
                    }
        }
        
        // kembalikan jika status 0 
        if ($status_valid == 0) {
            return json_encode(['type' => $type, 'message' => $message]);
        }
        // Nah ini untuk Uang transport langsung saja di kalikan Harikerja*Uangtransport krena sabtu & hari lain sama saja
        $uang_transport += $total_hk*$k_utp;

         //Get the priode ID & Cegah data double Dan berdasarkan ID User
         $stmt = $tmp_gaji->select('id')->where(['user_id' => $user_id,'tgl_priode_awal' => $tgl_awal, 'tgl_priode_akhir' => $tgl_akhir]);
        
         // jika ditemukan data dengan ketetuan tanggal dan user id diatas
         if ($stmt->count() > 0) {
            // Kembalikan untuk menghentikan proses input
            $message .= "<li>Data sudah tersimpan untuk periode ini!</li>";
            $type = "error";
            return json_encode(['type' => $type, 'message' => $message]);
         }
        if ($request->act == 'cek') {
            $message .= "<li>Semua data absensi valid <strong>( ".$data_tgl." )</strong>. Klik <b>'POSTING'</b> untuk melanjutkan.</li>";
            $type = "success";
            return json_encode(['type' => $type, 'message' => $message]);
        }
        // ambil data tunjangan 
        $tunjangan = User::find($user_id)->gaji;
        // ambil data tunjangan 
        $potongan = User::find($user_id)->potongan;

         // Masukan rekap data ke tabel rekap_gaji_per_priode
         $tmp_gaji->create(['user_id' => $user_id,
                'bulan_id' => $bulan_id,
                'tgl_priode_awal' => $tgl_awal,
                'tgl_priode_akhir' => $tgl_akhir,
                'gaji_pokok' => $gaji_pokok,
                'tunjab' => $tunjangan->tunjab,
                'tunkel' => $tunjangan->tunkel,
                'pensiun' => $tunjangan->pensiun,
                'bpjs_kes' => $tunjangan->bpjs_kes,
                'bpjs_tk' => $tunjangan->bpjs_tk,
                'uang_makan' => $uang_makan,
                'uang_transport' => $uang_transport,
                'p_kasbon' => $potongan->kasbon,
                'p_angs' => $potongan->angs,
                'p_simwa' => $potongan->simwa,
                'p_bpjs' => $potongan->bpjs,
                'p_arisan' => $potongan->arisan,
                'p_zis' => $potongan->zis,
                'p_donasi' => $potongan->donasi,
                'p_vipm' => $potongan->vipm,
                'p_qh' => $potongan->qh,
                'p_dplk' => $potongan->dplk,
                'hari_kerja' => $total_hk,
                'jam_kerja' => $total_jk,
                'menit_kerja' => $total_menit]);

         // Ambil id_rekap dari data yang baru saja diinputkan
         $id_rekap = $stmt->first()->id;
        //looping input data
        foreach ($data->get() as $d) {
            // Tambahkan data yang terpilih ke tabel priode_absen

            $priode->create([
                'rekap_id' => $id_rekap,
                'user_id' => $d->user_id,
                'bulan_id' => $d->bulan_id,
                'hari_id' => $d->hari_id,
                'tgl' => $d->tgl,
                'out_ijin' => $d->out_ijin,
                'in_ijin' => $d->in_ijin,
                'kt_ijin' => $d->kt_ijin,
                'jam_kerja' => $d->jam_kerja,
                'menit_kerja' => $d->menit_kerja,
                'jam_in' => $d->jam_in,
                'jam_out' => $d->jam_out]);
        }
       
       
        // hapus data lama karena sudah dipindahkan ke tabel baru priode_absen
        // blm ditambahin fitur delete
        if ($data->delete()) {
            $message = "Berhasil! Data telah diposting!";
            $type = "complete";
        } else {
            $message = "Terjadi kesalahan! Data tidak dapat diposting. Silahkan hubungi Administrator.";
            $type = "fail";
        }
        return json_encode(['type' => $type, 'message' => $message]);
        // tinggal terusin ke save data! btn simpan!
        //return $data;
    }
    public function postCekPostingAll (Request $request){
        // sampe nambahin kolom baru
        $absen = new Absen;
        $priode = new Priode;
        $tmp_gaji = new TmpGaji;
        $config = new Config;
        $users = new User;
        $posting = false;
        // Olah tanggal dulu
        // Format yang diterimaa : 12/21/2016 - 12/28/2016
        $data_tgl = $request->tgl;
        $report = array();
        $report['status'] = null;
        $report['null_data'] = null;
        $report['save'] = null;
        $report['contents']['type'] = "info";
        $report['contents']['message'] = "";
        // kalo ngga ada error statusnya
        $status_report = 0;
        $status_absen_null = 0;
        $status_save = 0;

        $tgl = explode("-", $data_tgl);
        // pisah2 data dan hilangkan spasi
        //  bentuk data 12/31/2016
        $n_awal = explode("/", trim($tgl[0]));
        $n_akhir = explode("/", trim($tgl[1]));
        

        $tgl_awal = $n_awal[2]."-".$n_awal[0]."-".$n_awal[1];
        $tgl_akhir = $n_akhir[2]."-".$n_akhir[0]."-".$n_akhir[1];
    
        if ($request->user == 'all') {
            $data_user = $users->all();   
        } else {
            $data_user = $users->where('id', $request->user)->get();
        }
        //return $data_user;
        foreach ($data_user as $user) {
            $report['contents']['message'] .= "<ul>";
            /*awal foreach*/
            $user_id = $user->id;
            $user_nama = "<b><a href='".route('absen.detail', ['id' => $user->id])."' target='_blank'>".$user->detail->nama."</a></b>";
            $gaji_pokok = $user->gaji->gapok;
            // id bulan
            $bulan_id = $request->bln;
            // konstanta uang makan 
            $k_um = $user->gaji->um;
            $uang_makan = 0;
            // Konstanta uang transport
            $uang_transport = 0;
            $k_utp = $user->gaji->transport;

            // total jam kerja
            $total_jk = 0;
            // Total hari kerja
            $total_hk = 0;
            // total menit kerja
            $total_menit = 0;
            // status validasi
            $status_valid = 1;
            // Pesan error
            $message = NULL;
            // Ambil data dari tabel dengan tanggal mulai dan akhir
            $data =  $absen->where('user_id', $user_id)
                    ->whereBetween('tgl', [$tgl_awal, $tgl_akhir]);
            // Jika tidak ada data yang ditemukan
            if ($data->count() < 1) {
                $message = "<li>$user_nama : Maaf, absensi untuk priode <i><strong>".$tgl_awal."</strong></i> - <i><strong>".$tgl_akhir."</strong></i> ini tidak ditemukan.</li>";
                $type = "error";
                // tambahkan +1 setiap ada error
                $status_absen_null += 1;
                $report['contents']['message'] .= "$message";
                //echo "'type' => $type, 'message' => $message <hr>";
            } else {
                // Loopeing cek data doublel
                foreach ($data->get() as $d) {
                    // Jika hari sabtu maka tidak dikurangi 1 jam istirahat
                    if ($d->hari_id == 6) {
                        // Tambahkan Jam kerja ke variable total_jk
                        $total_jk += $d->jam_kerja;
                        $total_menit += $d->menit_kerja;
                        // untuk hari sabtu. tambahkan selalu dengan format: (total_menit_kerja_hri_ini / konstanta_dari_tabel_config) * konstanta_uang_makan
                        $uang_makan += ($d->menit_kerja/$config->find('hari_s')->menit)*$k_um;


                    } else {
                        // Tambahkan Jam kerja ke variable total_jk
                        $total_jk += $d->jam_kerja; // 1 parameter 1 jam
                        $total_menit += $d->menit_kerja; // 60 parameter 60 menit

                        // untuk hari normal. tambahkan selalu dengan format: (total_menit_kerja_hri_ini / konstanta_dari_tabel_config) * konstanta_uang_makan
                        $uang_makan += ($d->menit_kerja/$config->find('hari_n')->menit)*$k_um;
                    }
                   
                    // Tambahkan +1 ke total_hk
                    $total_hk++;

                    
                    // Cek absensi double
                    $cek_double = $absen->where(['tgl' => $d->tgl, 'user_id' => $user_id]);
                    if ($cek_double->count() > 1) { // jika ditemukan baris data lebih dari satu
                        $message .= "<li>$user_nama : Terdapat <b>absensi ganda</b> pada tanggal : <b><u><a href='".route('absen.edit', ['id' => $d->id])."' target='_blank'>".$d->tgl."</a></u></b></li>";
                        $type = "error";
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        $status_valid = 0;
                        //return json_encode(['type' => $type, 'message' => $message]);
                    }
                    // Cek lupa ngisi jam keluar
                    if ($d->jam_out == NULL) {
                        $message .= "<li><b>$user_nama : Jam keluar</b> masih kosong pada absensi tanggal : <b><u><a href='".route('absen.edit', ['id' => $d->id])."' target='_blank'>".$d->tgl."</a></u></b></li>";
                        $type = "error";
                        // rubah status jadi 0 untuk error
                        $status_valid = 0;
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        //return json_encode(['type' => $type, 'message' => $message]);
                    }
                    // Cek belum ijin masuk setelah ijin keluar
                    if ($d->out_ijin !== NULL && $d->in_ijin == NULL) {
                        $message .= "<li>$user_nama : Karyawan ijin keluar tapi belum mengisi <b>ijin masuk</b> pada tanggal : <b><u><a href='".route('absen.edit', ['id' => $d->id])."' target='_blank'>".$d->tgl."</a></u></b></li>";
                        $type = "error";
                        // rubah status jadi 0 untuk error
                        $status_valid = 0;
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        //return json_encode(['type' => $type, 'message' => $message]);
                    }
                   
                    // Cek barangkali ada jam kerja yang kosong
                    if ($d->jam_kerja == NULL) {
                        $message .= "<li>$user_nama : <b>Jumlah Jam Kerja</b> masih kosong untuk absensi tanggal : <b><u><a href='".route('absen.edit', ['id' => $d->id])."' target='_blank'>".$d->tgl."</a></u></b></li>";
                        $type = "error";
                        // rubah status jadi 0 untuk error
                        $status_valid = 0;
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        //return json_encode(['type' => $type, 'message' => $message]);
                    }
                    // menit kerja kosong
                    if ($d->menit_kerja == NULL) {
                        $message .= "<li>$user_nama : <b>Jumlah Menit Kerja</b> masih kosong untuk absensi tanggal : <b><u><a href='".route('absen.edit', ['id' => $d->id])."' target='_blank'>".$d->tgl."</a></u></b></li>";
                        $type = "error";
                        // rubah status jadi 0 untuk error
                        $status_valid = 0;
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        //return json_encode(['type' => $type, 'message' => $message]);
                    }
                }
                
                // kembalikan jika status 0 
                if ($status_valid == 0) {
                    $report['contents']['message'] .= "$message";
                    //echo "type' => $type, 'message' => $message <hr>";
                } else {
                        // Nah ini untuk Uang transport langsung saja di kalikan Harikerja*Uangtransport krena sabtu & hari lain sama saja
                    $uang_transport += $total_hk*$k_utp;

                     //Get the priode ID & Cegah data double Dan berdasarkan ID User
                     $stmt = $tmp_gaji->select('id')->where(['user_id' => $user_id,'tgl_priode_awal' => $tgl_awal, 'tgl_priode_akhir' => $tgl_akhir]);
                    
                     // jika ditemukan data dengan ketetuan tanggal dan user id diatas
                     $tersimpan = false;
                     if ($stmt->count() > 0) {
                        // Kembalikan untuk menghentikan proses input
                        $message .= "<li>$user_nama : Data sudah tersimpan untuk periode ini!</li>";
                        $type = "error";
                        $tersimpan = true;
                        // tambahkan +1 setiap ada error
                        $status_report += 1;
                        $report['contents']['message'] .= "$message";
                        //echo "'type' => $type, 'message' => $message <hr>";
                     }
                    if ($tersimpan == false) {
                        if ($request->act == 'cek') {
                            $message .= "<li>$user_nama : Semua data absensi valid <strong>( ".$data_tgl." )</strong>. Klik <b>'POSTING'</b> untuk melanjutkan.</li>";
                            $type = "success";
                            // sudah bisa diposting
                            $posting = true;
                        }
                    }
                    
                     
                    if ($request->act == 'post') {
                        $tunjangan = User::find($user_id)->gaji;
                        // ambil data tunjangan 
                        $potongan = User::find($user_id)->potongan;
                        
                         // Masukan rekap data ke tabel rekap_gaji_per_priode
                         $tmp_gaji->create(['user_id' => $user_id,
                                'bulan_id' => $bulan_id,
                                'tgl_priode_awal' => $tgl_awal,
                                'tgl_priode_akhir' => $tgl_akhir,
                                'gaji_pokok' => $gaji_pokok,
                                'tunjab' => $tunjangan->tunjab,
                                'tunkel' => $tunjangan->tunkel,
                                'pensiun' => $tunjangan->pensiun,
                                'bpjs_kes' => $tunjangan->bpjs_kes,
                                'bpjs_tk' => $tunjangan->bpjs_tk,
                                'uang_makan' => $uang_makan,
                                'uang_transport' => $uang_transport,
                                'p_kasbon' => $potongan->kasbon,
                                'p_angs' => $potongan->angs,
                                'p_simwa' => $potongan->simwa,
                                'p_bpjs' => $potongan->bpjs,
                                'p_arisan' => $potongan->arisan,
                                'p_zis' => $potongan->zis,
                                'p_donasi' => $potongan->donasi,
                                'p_vipm' => $potongan->vipm,
                                'p_qh' => $potongan->qh,
                                'p_dplk' => $potongan->dplk,
                                'hari_kerja' => $total_hk,
                                'jam_kerja' => $total_jk,
                                'menit_kerja' => $total_menit]);
                         // Ambil id_rekap dari data yang baru saja diinputkan
                         $id_rekap = $stmt->first()->id;
                        //looping input data
                        foreach ($data->get() as $d) {
                            // Tambahkan data yang terpilih ke tabel priode_absen

                            $priode->create([
                                'rekap_id' => $id_rekap,
                                'user_id' => $d->user_id,
                                'bulan_id' => $d->bulan_id,
                                'hari_id' => $d->hari_id,
                                'tgl' => $d->tgl,
                                'out_ijin' => $d->out_ijin,
                                'in_ijin' => $d->in_ijin,
                                'kt_ijin' => $d->kt_ijin,
                                'jam_kerja' => $d->jam_kerja,
                                'menit_kerja' => $d->menit_kerja,
                                'jam_in' => $d->jam_in,
                                'jam_out' => $d->jam_out]);
                        }
                       
                       
                        // hapus data lama karena sudah dipindahkan ke tabel baru priode_absen
                        // blm ditambahin fitur delete
                        if ($data->delete()) {
                            $message = "$user_nama : Berhasil! Data telah diposting!";
                            $type = "complete";
                            $status_save += 1;
                        } else {
                            $message = "$user_nama : Terjadi kesalahan! Data tidak dapat diposting. Silahkan hubungi Administrator.";
                            $type = "fail";
                        }
                        
                    }
                    $report['contents']['message'] .= "$message";
                    //echo "'type' => $type, 'message' => $message <hr>";
                }
            }
            // tinggal terusin ke save data! btn simpan!
            //return $data;
            $report['contents']['message'] .= "</ul> <hr>";
        }
        $report['save'] = $status_save;
        $report['status'] = $status_report;
        $report['null_data'] = $status_absen_null;
        return json_encode($report);
    }
}


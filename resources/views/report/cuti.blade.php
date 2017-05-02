<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Surat Cuti {{$cuti_ok->user->detail->nama}}</title>
<style type="text/css">
body {
    padding-top: 5cm;
    font-size: .9em;
    line-height: 16px;
    font-family: arial;
}
#logo {
 width: 300px;
 height: 200px; 
 float:left;
}
#judul {
 margin-left : 90px;
 width:900px;
 text-align:center;
}
</style>
</head>

<body>
       <table>
            <tr>
                <td width="100px">Nomor</td>
                <td>:</td>
                <td>{{$no < 10 ? '0'.$no: $no}}/USPPS-AI/HRD-SCT/{{ $bulan }}/{{ date("Y") }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>:</td>
                <td>CIREBON</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ date('d')." $nm_bln ".date('Y') }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>Disposisi Permohonan Izin Cuti</td>
            </tr>
        </table>
        <p style="padding-left:3px">Kepada Yth: <br>
            {{ $cuti_ok->user->detail->nama }} <br>
            Melalui :<br>
            Pimpinan Cabang UJKS BMT Al-Ishlah<br>
            Di :<br>
            {{ $cuti_ok->user->cabang->name }}</p>
        <p style="padding-left: 3px">
            Assalamualaikum Wr.Wb <br>
        Berdasarkan surat permohonan izin dispensasi izin cuti yang diajukan oleh :</p>
        <table>
            <tr>
                <td width="100px">Nama</td>
                <td>:</td>
                <td><span style="text-transform: uppercase;">{{$cuti_ok->user->detail->nama}}</span></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>Kantor {{ $cuti_ok->user->cabang->name }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $cuti_ok->user->detail->jabatan->name}}</td>
            </tr>
            <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td>{{ $from }} s.d {{ $to }}</td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td>:</td>
                <td>{{ $cuti_ok->note }}</td>
            </tr>
        </table>
        <p style="padding-left: 3px">
            Setelah menimbang dan memperhatikan, maka HRD memberikan ACC pengajuan izin dispensasi <b>{{$cuti_ok->jenisCuti->name}}</b> Saudara {{ $cuti_ok->user->detail->nama }} sebanyak {{ $cuti_ok->qty }} hari kerja.
            Demikian surat disposisi ini dibuat. Agar dapat digunakan sebagaimana mestinya.
        </p>
        <p>Wassalamualaikum Wr .Wb</p>
        <p style="margin-left:340px">Cirebon, {{ date('d')." $nm_bln ".date('Y') }}</p> <br>
        <br>
        <p style="margin-left:340px"><b>DIAN CHUSNUL CHOTIMAH</b><br />
        HRD</p>
        <table border="1" cellspacing="0" style="border-collapse:collapse">
            <tr>
                <td valign="top" rowspan="2">
                   CATATAN KEPEGAWAIAN :
                    <ol style="padding-left:20px;">
                        @if($cuti_ok->jenis_cuti_id == 0 )
                            <li style="padding-left:10px;padding-right:10px">
                            Sisa cuti awal&nbsp;&nbsp;&nbsp;: {{ $cuti->qty + $cuti_ok->qty}} hari <br>
                            Cuti sekarang&nbsp;&nbsp;&nbsp;: <u>{{$cuti_ok->qty}} hari</u> -<br>
                            Sisa cuti&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$cuti->qty}} hari<br>
                        </li>
                        @endif
                        <br>
                        <li style="padding-left:10px;padding-right:10px">
                            Cuti diberikan selama {{ $cuti_ok->qty}} hari kerja
                        </li>
                    </ol>
                </td>
                <td valign="top">
                    <u>KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</u>
                    <br><br><br><br>
                    <b><u>DADAN PERDANA</u></b> <br>
                    Manager Umum
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <u>ACC ATASAN LANGSUNG</u>
                    <br><br><br><br>
                    <b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b> <br>
                        Pimpinan Cabang {{ $cuti_ok->user->cabang->name }}
                </td>
            </tr>
        </table>
        <!-- </body></html> -->
</body>
<br/>
<br/>
<br/>
<center>
<input type="submit" name="button" class="DTTT_button" value="Print" onclick="print()" /></center>
</html>


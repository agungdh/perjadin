<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\MatrikPerjalanan;
use Illuminate\Http\Request;
use App\Pegawai;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\SuratTugas;
use App\Spd;
use App\Unitkerja;
use App\Mail\MailPersetujuan;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Tanggal;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request('flag_trx') == NULL)
        {
            $flag_trx = '';
        }
        else {
            $flag_trx = request('flag_trx');
        }
        $FlagTrx = config('globalvar.FlagTransaksi');
        $FlagKonfirmasi = config('globalvar.FlagKonfirmasi');
        $MatrikFlag = config('globalvar.FlagMatrik');
        $DataPegawai = Pegawai::where([['flag', '=', '1'], ['jabatan', '<', '5']])->get();
        $DataBidang = Unitkerja::where('eselon', '<', '4')->orderBy('kode', 'asc')->get();
        /*
        $users = App\User::with(['posts' => function ($query) {
    $query->where('title', 'like', '%first%');
}])->get();
*/
        if ($flag_trx=='')
        {
            $dataTransaksi = Transaksi::with('Matrik')->where('tahun_trx', '=', Session::get('tahun_anggaran'))
            ->when(request('unitkerja'),function($query){
                return $query->whereHas('matrik',function($q){
                    return $q->where('unit_pelaksana',request('unitkerja'));
                });
            })->orderBy('flag_trx', 'ASC')->orderBy('tgl_brkt', 'desc')->get();
        }
        else
        {
            $dataTransaksi = Transaksi::with('Matrik')->where('tahun_trx', '=', Session::get('tahun_anggaran'))
            ->when(request('unitkerja'),function($query){
                return $query->whereHas('Matrik',function($q){
                    return $q->where('unit_pelaksana',request('unitkerja'));
                });
            })->where('flag_trx',request('flag_trx'))->orderBy('flag_trx', 'ASC')->orderBy('tgl_brkt', 'desc')->get();
        }
        
        return view('transaksi.matrik', compact('dataTransaksi', 'FlagTrx', 'FlagKonfirmasi', 'DataPegawai', 'MatrikFlag', 'DataBidang'));
        //dd($dataTransaksi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        /*
        $datapeg = Pegawai::find($request->peg_id);
        $datapeg -> nip_baru = $request['nipbaru'];
        //$datapeg -> nip_lama = $request['niplama'];
        $datapeg -> nama = $request['nama'];
        $datapeg -> tgl_lahir = Carbon::parse($request['tgllahir'])->format('Y-m-d');
        $datapeg -> jk = $request['jk'];
        $datapeg -> gol = $request['gol'];
        $datapeg -> unitkerja = $request['unitkerja'];
        $datapeg -> jabatan = $request['jabatan'];
        $datapeg -> update();

        */
        if ($request->aksi == "alokasipegawai") {
            //search pegawai
            $dt_pegawai = Pegawai::where('nip_baru','=',$request->peg_nip)->first();

            $bnyk_hari = $request->lamanya - 1;
            $datatrx = Transaksi::where('trx_id', '=', $request->trxid)->first();
            $datatrx->bnyk_hari = $request->lamanya;
            $datatrx->tugas = $request->tugas;
            $datatrx->tgl_brkt = Carbon::parse($request->tglberangkat)->format('Y-m-d');
            $datatrx->tgl_balik = Carbon::parse($request->tglberangkat)->addDays($bnyk_hari)->format('Y-m-d');
            $datatrx->peg_nip = $request->peg_nip;
            $datatrx->peg_nama = $dt_pegawai->nama;
            $datatrx->peg_gol = $dt_pegawai->gol;
            $datatrx->peg_unitkerja = $dt_pegawai->unitkerja;
            $datatrx->peg_jabatan = $dt_pegawai->jabatan;
            $datatrx->peg_unitkerja_nama = $dt_pegawai->Unitkerja->nama;
            $datatrx->flag_trx = $request->diajukan;
            $datatrx->kabid_konfirmasi = 0;
            $datatrx->kabid_ket = NULL;
            $datatrx->ppk_konfirmasi = 0;
            $datatrx->ppk_ket = NULL;
            $datatrx->kpa_konfirmasi = 0;
            $datatrx->kpa_ket = NULL;
            $datatrx->update();
            //cek tabel surat tugas dan spd

            $count = SuratTugas::where('trx_id', $request->trxid)->count();
            if ($count > 0) {
                //sudah ada update aja
                $datasrt = SuratTugas::where('trx_id', $request->trxid)->first();
                $datasrt->flag_surattugas = 0;
                $datasrt->flag_ttd = 0;
                $datasrt->nomor_surat = NULL;
                $datasrt->tgl_surat = NULL;
                $datasrt->update();
            }

            //isi SPD juga
            $count = Spd::where('trx_id', $request->trxid)->count();
            if ($count > 0) {
                //sudah ada update aja
                $dataspd = Spd::where('trx_id', $request->trxid)->first();
                $dataspd->flag_spd = 0;
                $dataspd->flag_ttd = 0;
                $dataspd->nomor_spd = NULL;
                $dataspd->update();
            }


            if ($request->diajukan == 1) {
                $dataMatrik = MatrikPerjalanan::where('id', $request->matrikid)->first();
                $dataMatrik->flag_matrik = '3';
                $dataMatrik->update();
                //kirim mail pemberitahuan ke kabid sm

                $objEmail = new \stdClass();
                $objEmail->setuju = 'KABID/KABAG';
                $objEmail->bidang = $dataMatrik->UnitPelaksana->nama;
                $objEmail->trx_id = $datatrx->kode_trx;
                $objEmail->nama = $datatrx->peg_nama;
                $objEmail->nip = $datatrx->peg_nip;
                $objEmail->tugas = $datatrx->tugas;
                $objEmail->tgl_brkt = Tanggal::Panjang($datatrx->tgl_brkt);
                $objEmail->tgl_kembali = Tanggal::Panjang($datatrx->tgl_balik);
                $objEmail->tujuan = $dataMatrik->Tujuan->nama_kabkota;
                $objEmail->durasi = $datatrx->bnyk_hari.' hari';
                $objEmail->sm = $dataMatrik->DanaUnitkerja->nama;
                $objEmail->up = $dataMatrik->UnitPelaksana->nama;
                $objEmail->mak = $dataMatrik->DanaAnggaran->mak;
                $objEmail->komponen = '['.$dataMatrik->DanaAnggaran->komponen_kode.'] '.$dataMatrik->DanaAnggaran->komponen_nama;
                $objEmail->detil = $dataMatrik->DanaAnggaran->uraian;
                $objEmail->totalbiaya = 'Rp. '.number_format($dataMatrik->total_biaya,0,',','.');

                $dataKabid = Pegawai::where('unitkerja','=',$dataMatrik->unit_pelaksana)->where('jabatan','<','3')->where('flag','=','1')->first();

                Mail::to($dataKabid->email)->send(new MailPersetujuan($objEmail));

                Session::flash('message', 'Data Perjalanan ke ' . $request->tujuan . ' tanggal ' . $request->tglberangkat . ' sudah di ajukan');
                Session::flash('message_type', 'warning');
                return redirect()->route('transaksi.index');
            }
            Session::flash('message', 'Data Perjalanan ke ' . $request->tujuan . ' tanggal ' . $request->tglberangkat . ' sudah di update');
            Session::flash('message_type', 'warning');
            return redirect()->route('transaksi.index');
        } 
        
        elseif ($request->aksi == "editalokasi") {
            //search pegawai
            //dd($request->all());
            $dt_pegawai = Pegawai::where('nip_baru','=',$request->peg_nip)->first();
            //menu ini hanya superadmin            
            $bnyk_hari = $request->lamanya - 1;
            $datatrx = Transaksi::where('trx_id', '=', $request->trxid)->first();
            $datatrx->bnyk_hari = $request->lamanya;
            $datatrx->tugas = $request->tugas;
            $datatrx->tgl_brkt = Carbon::parse($request->edittglberangkat)->format('Y-m-d');
            $datatrx->tgl_balik = Carbon::parse($request->edittglberangkat)->addDays($bnyk_hari)->format('Y-m-d');
            $datatrx->peg_nip = $request->peg_nip;
            $datatrx->peg_nama = $dt_pegawai->nama;
            $datatrx->peg_gol = $dt_pegawai->gol;
            $datatrx->peg_unitkerja = $dt_pegawai->unitkerja;
            $datatrx->peg_jabatan = $dt_pegawai->jabatan;
            $datatrx->peg_unitkerja_nama = $dt_pegawai->Unitkerja->nama;
            $datatrx->flag_trx = $request->flag_transaksi;
            $datatrx->kabid_konfirmasi = $request->kabid_setuju;
            $datatrx->ppk_konfirmasi = $request->ppk_setuju;
            $datatrx->kpa_konfirmasi = $request->kpa_setuju;
            $datatrx->update();

            Session::flash('message', 'Data Perjalanan ke ' . $request->tujuan . ' tanggal ' . $request->edittglberangkat . ' sudah diupdate');
            Session::flash('message_type', 'info');
            return redirect()->route('transaksi.index');
        } else {
            dd($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function view()
    {
        return view('transaksi.viewpage');
    }
    public function syncPegawai($tahun)
    {
        $data = Transaksi::where('tahun_trx', '=', $tahun)->get();
        $jml_record = 0 ;
        $arr = array('status'=>false,'data'=>'Tidak tersedia');
        foreach ($data as $i)
        {
            $dataPeg = Pegawai::where('nip_baru','=',$i->peg_nip)->first();
            $dataUpdate = Transaksi::where('peg_nip', '=', $i->peg_nip)->first();
            $dataUpdate->peg_nama = $dataPeg->nama;
            $dataUpdate->peg_gol = $dataPeg->gol;
            $dataUpdate->peg_jabatan = $dataPeg->jabatan;
            $dataUpdate->peg_unitkerja = $dataPeg->unitkerja;
            $dataUpdate->peg_unitkerja_nama = $dataPeg->Golongan->nama;
            $dataUpdate->update();
            $jml_record++;
        }
        return Response()->json($jml_record);
    }
}

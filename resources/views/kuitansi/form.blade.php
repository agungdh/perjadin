@php
$tgl_brkt = explode('-',$dataTransaksi[0]->tgl_brkt);
$tgl_balik = explode('-',$dataTransaksi[0]->tgl_balik);

$bln_brkt = (int)($tgl_brkt[1]);
$bln_balik = (int)($tgl_balik[1]);

$tgl_berangkat = (int)($tgl_brkt[2]) .' '.$Bulan[$bln_brkt].' '.$tgl_brkt[0];
$tgl_blk = (int)($tgl_balik[2]) .' '.$Bulan[$bln_balik].' '.$tgl_balik[0];

if ($dataTransaksi[0]->Kuitansi->flag_kuitansi==0) {
    //kuitansi masih kosong
    //harian
    $harian_rupiah = $dataTransaksi[0]->Matrik->dana_harian;
    $harian_lama = $dataTransaksi[0]->bnyk_hari;
    $harian_total = $dataTransaksi[0]->Matrik->total_harian;
    //biaya penginapan
    $hotel_rupiah = $dataTransaksi[0]->Matrik->dana_hotel;
    $hotel_lama = $dataTransaksi[0]->bnyk_hari-1;
    $hotel_total = $dataTransaksi[0]->Matrik->total_hotel;
    if ($dataTransaksi[0]->Kuitansi->hotel_flag==0) {
        $hotel_flag = "";
    }
    else {
        $hotel_flag ="checked";
    }
    //biaya transportasi
    $transport_rupiah = $dataTransaksi[0]->Matrik->dana_transport;
    $transport_ket = 'Transport dari Mataram ke '. $dataTransaksi[0]->Matrik->Tujuan->nama_kabkota;
    if ($dataTransaksi[0]->Kuitansi->transport_flag==0) {
        $transport_flag = "";
    }
    else {
        $transport_flag ="checked";
    }
     //pengeluaran rill 1
    $rill1_rupiah = $dataTransaksi[0]->Matrik->pengeluaran_rill;
    $rill1_ket = "";
    if ($dataTransaksi[0]->Kuitansi->rill1_flag==0) {
        $rill1_flag = "";
    }
    else {
        $rill1_flag ="checked";
    }
    //pengeluaran rill 2
    $rill2_rupiah = "";
    $rill2_ket = "";
    if ($dataTransaksi[0]->Kuitansi->rill2_flag==0) {
        $rill2_flag = "";
    }
    else {
        $rill2_flag ="checked";
    }
    //pengeluaran rill 3
    $rill3_rupiah = '';
    $rill3_ket = '';
    if ($dataTransaksi[0]->Kuitansi->rill3_flag==0) {
        $rill3_flag = "";
    }
    else {
        $rill3_flag ="checked";
    }
    //totalbiaya
    $totalbiaya = $dataTransaksi[0]->Matrik->total_biaya;
}
else {
    //kuitansi sudah pernah di edit
    $harian_rupiah = $dataTransaksi[0]->Kuitansi->harian_rupiah;
    $harian_lama = $dataTransaksi[0]->Kuitansi->harian_lama;
    $harian_total = $dataTransaksi[0]->Kuitansi->harian_total;
    //biaya penginapan
    $hotel_rupiah = $dataTransaksi[0]->Kuitansi->hotel_rupiah;
    $hotel_lama = $dataTransaksi[0]->Kuitansi->hotel_lama;
    $hotel_total = $dataTransaksi[0]->Kuitansi->hotel_total;
    if ($dataTransaksi[0]->Kuitansi->hotel_flag==0) {
        $hotel_flag = "";
    }
    else {
        $hotel_flag ="checked";
    }
    //biaya transport
    $transport_rupiah = $dataTransaksi[0]->Kuitansi->transport_rupiah;
    $transport_ket = $dataTransaksi[0]->Kuitansi->transport_ket;
    if ($dataTransaksi[0]->Kuitansi->transport_flag==0) {
        $transport_flag = "";
    }
    else {
        $transport_flag ="checked";
    }
    //pengeluaran rill 1
    $rill1_rupiah = $dataTransaksi[0]->Kuitansi->rill1_rupiah;
    $rill1_ket = $dataTransaksi[0]->Kuitansi->rill1_ket;
    if ($dataTransaksi[0]->Kuitansi->rill1_flag==0) {
        $rill1_flag = "";
    }
    else {
        $rill1_flag ="checked";
    }
    //pengeluaran rill 2
    $rill2_rupiah = $dataTransaksi[0]->Kuitansi->rill2_rupiah;
    $rill2_ket = $dataTransaksi[0]->Kuitansi->rill2_ket;
    if ($dataTransaksi[0]->Kuitansi->rill2_flag==0) {
        $rill2_flag = "";
    }
    else {
        $rill2_flag ="checked";
    }
    //pengeluaran rill 3
    $rill3_rupiah = $dataTransaksi[0]->Kuitansi->rill3_rupiah;
    $rill3_ket = $dataTransaksi[0]->Kuitansi->rill3_ket;
    if ($dataTransaksi[0]->Kuitansi->rill3_flag==0) {
        $rill3_flag = "";
    }
    else {
        $rill3_flag ="checked";
    }
    //totalbiaya
    $totalbiaya = $dataTransaksi[0]->Kuitansi->total_biaya;
}
@endphp
<div class="form-group row">
<label for="nama" class="col-2 col-form-label">Nama Pegawai</label>
<div class="input-group col-8">
    <div class="input-group-addon"><i class="ti-user"></i></div>
    <input type="text" class="form-control" id="nama" name="nama" value="{{$dataTransaksi[0]->TabelPegawai->nama}}" placeholder="Tujuan" readonly="">
</div>
</div>
<div class="form-group row">
<label for="nama" class="col-2 col-form-label">Tujuan</label>
<div class="input-group col-8">
    <div class="input-group-addon"><i class="ti-user"></i></div>
    <input type="text" class="form-control" id="nama_tujuan" name="nama_tujuan" value="{{$dataTransaksi[0]->Matrik->Tujuan->nama_kabkota}}" placeholder="Tujuan" readonly="">
</div>
</div>
<div class="form-group row">
<label for="nama" class="col-2 col-form-label">Tugas</label>
<div class="input-group col-8">
    <div class="input-group-addon"><i class="ti-user"></i></div>
    <input type="text" class="form-control" id="tugas" name="tugas" value="{{$dataTransaksi[0]->tugas}}" placeholder="Tugas" readonly="">

</div>
</div>
<div class="form-group row">
<label for="nama" class="col-2 col-form-label">Lamanya</label>
<div class="input-group col-8">
    <div class="input-group-addon"><i class="ti-user"></i></div>
    <input type="text" class="form-control" id="lamanya" name="lamanya"  value="{{$dataTransaksi[0]->bnyk_hari}} Hari" placeholder="Banyak hari" readonly="">
</div>
</div>
<div class="form-group row">
    <label for="Pelaksanaan" class="col-2 col-form-label">Pelaksanaan</label>
    <div class="input-group col-8 input-daterange" id="date-range">
        <div class="input-group-addon" ><i class="ti-user"></i></div>
        <input type="text" class="form-control" id="tglawal" name="tglawal" placeholder="Tgl Awal" required="" value="{{$tgl_berangkat}}" readonly="">
        <span class="input-group-addon bg-info b-0 text-white">s/d</span>
        <input type="text" class="form-control" id="tglakhir" name="tglakhir" placeholder="Tgl Akhir" value="{{$tgl_blk}}" readonly="">
    </div>
</div>
<h3 class="box-title m-t-40">Sumber Dana</h3>
<hr>
<div class="form-group row">
        <label for="MAK" class="col-2 col-form-label">MAK</label>
        <div class="input-group col-8">
            <div class="input-group-addon"><i class="ti-user"></i></div>
            <input type="text" class="form-control" id="dana_mak" name="dana_mak" placeholder="MAK Dana" value="{{$dataTransaksi[0]->Matrik->dana_mak}}" required="" readonly="">
        </div>
    </div>
    <div class="form-group row">
            <label for="dana_uraian" class="col-2 col-form-label">Uraian</label>
            <div class="input-group col-8">
                <div class="input-group-addon"><i class="ti-user"></i></div>
                <input type="text" class="form-control" id="dana_uraian" name="dana_uraian" placeholder="Uraian Dana" value="{{$dataTransaksi[0]->Matrik->DanaAnggaran->uraian}}" readonly="">

            </div>
        </div>
        <div class="form-group row">
                <label for="dana_pagu" class="col-2 col-form-label">Pagu</label>
                <div class="input-group col-8">
                    <div class="input-group-addon"><i class="ti-user"></i></div>
                    <input type="text" class="form-control" id="dana_pagu" name="dana_pagu" placeholder="Pagu Dana" value="{{$dataTransaksi[0]->Matrik->DanaAnggaran->pagu}}" readonly="">

                </div>
            </div>
            <div class="form-group row">
                <label for="dana_unitkerja" class="col-2 col-form-label">Unitkerja</label>
                <div class="input-group col-8">
                    <div class="input-group-addon"><i class="ti-user"></i></div>
                    <input type="text" class="form-control" id="dana_unitkerja" name="dana_unitkerja" placeholder="Unitkerja Sumber Dana" value="{{$dataTransaksi[0]->Matrik->DanaUnitkerja->nama}}" readonly="">

                </div>
            </div>
<h3 class="box-title m-t-40">Input Anggaran Biaya</h3>
<hr>
<div class="form-group row">
        <label for="tgl_kuitansi" class="col-2 col-form-label">Tanggal Kuitansi</label>
        <div class="input-group col-3 input-daterange" id="date-range">
            <div class="input-group-addon"><i class="ti-user"></i></div>
            <input type="text" class="form-control" id="tgl_kuitansi" name="tgl_kuitansi" placeholder="Tanggal kuitansi" required="" value="{{$dataTransaksi[0]->Kuitansi->tgl_kuitansi}}" autocomplete="off">

        </div>
</div>
<div class="form-group row">
    <label for="nama" class="col-2 col-form-label">Uang Harian</label>
    <div class="input-group col-10">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="number" class="form-control" id="uangharian" name="uangharian" placeholder="Nilai Rp." value="{{$harian_rupiah}}" required="">
        <span class="input-group-addon bg-info b-0 text-white">x</span>
        <input type="number" class="form-control" id="harian" name="harian" placeholder="Lama hari" value="{{$harian_lama}}" readonly="">
        <span class="input-group-addon bg-info b-0 text-white">=</span>
        <input type="number" class="form-control" id="totalharian" name="totalharian" placeholder="" value="{{$harian_total}}" readonly="">
    </div>
</div>
<div class="form-group row">
    <label for="nama" class="col-2 col-form-label">Biaya Penginapan</label>
    <div class="input-group col-10">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="number" class="form-control" id="nilaihotel" name="nilaihotel" placeholder="Nilai Hotel Rp." value="{{$hotel_rupiah}}" required="">
        <span class="input-group-addon bg-info b-0 text-white">x</span>
        <input type="number" class="form-control" id="hotelhari" name="hotelhari" placeholder="Lama hari" value="{{$hotel_lama}}" readonly="">
        <span class="input-group-addon bg-info b-0 text-white">=</span>
        <input type="number" class="form-control" id="totalhotel" name="totalhotel" placeholder="" value="{{$hotel_total}}" readonly="">
        <span class="input-group-addon bg-danger b-0 text-white">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="hotel_cek" name="hotel_cek" value="1" {{$hotel_flag}}> Ada bukti dukung
            </label>

        </span>
    </div>
</div>
<div class="form-group row">
    <label for="nilaiTransport" class="col-2 col-form-label">Biaya Transport</label>
    <div class="input-group col-10">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="text" class="form-control" id="transport_ket" name="transport_ket" placeholder="Keterangan Transport" value="{{$transport_ket}}" required="">
        <span class="input-group-addon bg-info b-0 text-white">=</span>
        <input type="number" class="form-control" id="nilaiTransport" name="nilaiTransport" placeholder="Nilai transport Rp." value="{{$transport_rupiah}}" required="" autocomplete="off">
        <span class="input-group-addon bg-warning b-0 text-white">
            <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="transport_cek" name="transport_cek" value="1" {{$transport_flag}}> Ada bukti dukung
                </label>

        </span>

    </div>
</div>
<div class="form-group row">
    <label for="pengeluaranrill" class="col-2 col-form-label">Pengeluaran Rill</label>
    <div class="input-group col-10">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <span class="input-group-addon bg-info b-0 text-white">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="rill_cek1" name="rill_cek1" value="1" {{$rill1_flag}}> Pilih
            </label>
        </span>
        <input type="text" class="form-control" id="rill_ket1" name="rill_ket1" placeholder="ket pengeluaran rill selain transport" value="{{$rill1_ket}}">
        <span class="input-group-addon bg-info b-0 text-white">=</span>
        <input type="number" class="form-control" id="rill1" name="rill1" placeholder="Nilai pengeluaran rill Rp." value="{{$rill1_rupiah}}">
    </div>
</div>
<div class="form-group row">
    <label for="pengeluaranrill" class="col-2 col-form-label">&nbsp;</label>
    <div class="input-group col-10">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <span class="input-group-addon bg-info b-0 text-white">
                <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="rill_cek2" name="rill_cek2" value="1" {{$rill2_flag}}> Pilih
                    </label>

            </span>
            <input type="text" class="form-control" id="rill_ket2" name="rill_ket2" placeholder="ket pengeluaran rill selain transport" value="{{$rill2_ket}}">
            <span class="input-group-addon bg-info b-0 text-white">=</span>
            <input type="number" class="form-control" id="rill2" name="rill2" placeholder="Nilai pengeluaran rill Rp." value="{{$rill2_rupiah}}">
    </div>
</div>
<div class="form-group row">
        <label for="pengeluaranrill" class="col-2 col-form-label">&nbsp;</label>
        <div class="input-group col-10">
            <div class="input-group-addon"><i class="ti-user"></i></div>
            <span class="input-group-addon bg-info b-0 text-white">
                    <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="rill_cek3" name="rill_cek3" value="1" {{$rill3_flag}}> Pilih
                        </label>

                </span>
                <input type="text" class="form-control" id="rill_ket3" name="rill_ket3" placeholder="ket pengeluaran rill selain transport" value="{{$rill3_ket}}">
                <span class="input-group-addon bg-info b-0 text-white">=</span>
                <input type="number" class="form-control" id="rill3" name="rill3" placeholder="Nilai pengeluaran rill Rp." value="{{$rill3_rupiah}}">
        </div>
    </div>
<div class="form-group row">
    <label for="totalbiaya" class="col-2 col-form-label">Total Kuitansi</label>
    <div class="input-group col-10">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <input type="text" class="form-control" id="totalbiaya" name="totalbiaya" placeholder="Total Biaya" required="" readonly="" value="{{$totalbiaya}}"> </div>
</div>
<div class="form-group row">
    <label for="totalbiaya" class="col-2 col-form-label">Bendahara</label>
    <div class="input-group col-3">
        <div class="input-group-addon"><i class="ti-user"></i></div>
        <select class="form-control" name="bendahara_nip" required="" id="bendahara_nip">
            <option value="">Pilih Bendahara</option>
            @foreach ($DataBendahara as $item)
              @if ($item->nip_baru == $dataTransaksi[0]->Kuitansi->bendahara_nip)
                <option value="{{$item->nip_baru}}" selected="selected">{{$item->nama}}</option>
              @else
                <option value="{{$item->nip_baru}}">{{$item->nama}}</option>
              @endif
            @endforeach

        </select>
    </div>
</div>
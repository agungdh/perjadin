<script>
$('#ViewModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var mid = button.data('mid')

  $.ajax({
        url : '{{route("matrik.view","")}}/'+mid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
           
            $('#ViewModal .modal-body #tahun').text(data.hasil.tahun_matrik)
            $('#ViewModal .modal-body #tujuan').text("["+data.hasil.kode_kabkota+"] "+data.hasil.nama_kabkota)
            $('#ViewModal .modal-body #lamanya').text(data.hasil.lamanya+" hari")
            $('#ViewModal .modal-body #subjectmatter').text("["+data.hasil.turunan_unitkode+"] "+data.hasil.turunan_unitnama)
            if (data.hasil.pelaksana_unitkode != null)
            {
                $('#ViewModal .modal-body #pelaksana').text("["+ data.hasil.pelaksana_unitkode +"] "+data.hasil.pelaksana_unitnama)
            }
            $('#ViewModal .modal-body #komponen').text("["+data.hasil.komponen_kode+"] "+data.hasil.komponen_nama)
            $('#ViewModal .modal-body #mak').text(data.hasil.dana_mak+" - "+data.hasil.uraian)
            $('#ViewModal .modal-body #pagu_rencana').text(data.hasil.pagu_rencana)
            $('#ViewModal .modal-body #totalbiaya').text("Rp. "+number_format(data.hasil.total_biaya))
            $('#ViewModal .modal-body #flag').text(data.flag)
            $('#ViewModal .modal-body #waktu').text(data.hasil.tgl_awal+" s/d "+data.hasil.tgl_akhir)
            $('#ViewModal .modal-body #harian').text("Harian : Rp. "+number_format(data.hasil.dana_harian)+" x "+data.hasil.lamanya+" hari = Rp. "+number_format(data.hasil.total_harian))
            if (data.hasil.dana_transport != 0)
            {
                $('#ViewModal .modal-body #transport').text("Transport : Rp. "+number_format(data.hasil.dana_transport))
            }
            if (data.hasil.total_hotel != 0)
            {
                $('#ViewModal .modal-body #hotel').text("Penginapan : Rp. "+number_format(data.hasil.dana_hotel)+" x "+data.hasil.lama_hotel+" hari = Rp. "+number_format(data.hasil.total_hotel))
            }
            if (data.hasil.pengeluaran_rill != 0)
            {
                $('#ViewModal .modal-body #rill').text("Pengeluaran Rill : Rp. "+number_format(data.hasil.pengeluaran_rill))
            }
            $('#ViewModal .modal-footer #EditMatrik').attr("href","{{route('matrik.edit','')}}/"+mid)
        },
        error: function(){
            alert("error");
        }

    });
});

jQuery('#date-range').datepicker({
    format: 'yyyy-mm-dd',
    toggleActive: true,
    todayHighlight: true

    });

$('#lamanya').on('change paste keyup',function(e){

        var hari =  e.target.value;

        $('#harian').val(hari);
        $('#hotelhari').val(hari-1);

});
$('#uangharian').on('change paste keyup',function(e){

var uangharian =  $('#uangharian').val();
var harian = $('#harian').val();
var totalharian = uangharian*harian;
$('#totalharian').val(totalharian);

//untuk total biaya
/*
var totalhotel=$('#totalhotel').val();
var transport = $('#nilaiTransport').val();
var rill =  $('#pengeluaranrill').val(); */
var totalbiaya = parseInt($('#nilaiTransport').val())+ parseInt(totalharian) + parseInt($('#totalhotel').val()) + parseInt($('#pengeluaranrill').val());

    $('#totalbiaya').val(totalbiaya);


});

$('#nilaihotel').on('change paste keyup',function(e){

var nilaihotel =  $('#nilaihotel').val();
var hotelhari = $('#hotelhari').val();
var totalhotel = nilaihotel*hotelhari;
$('#totalhotel').val(totalhotel);

//untuk total biaya
/*
var totalhotel=$('#totalhotel').val();
var transport = $('#nilaiTransport').val();
var rill =  $('#pengeluaranrill').val(); */
var totalbiaya = parseInt($('#nilaiTransport').val())+ parseInt(totalhotel) + parseInt($('#totalharian').val()) + parseInt($('#pengeluaranrill').val());
$('#totalbiaya').val(totalbiaya);

});

$('#nilaiTransport').on('change paste keyup',function(e){

var transport =  $('#nilaiTransport').val();


//untuk total biaya
/*
var totalhotel=$('#totalhotel').val();
var transport = $('#nilaiTransport').val();
var rill =  $('#pengeluaranrill').val(); */
var totalbiaya = parseInt($('#totalhotel').val())+ parseInt(transport) + parseInt($('#totalharian').val()) + parseInt($('#pengeluaranrill').val());
$('#totalbiaya').val(totalbiaya);

});

$('#pengeluaranrill').on('change paste keyup',function(){

var rill =  $('#pengeluaranrill').val()


//untuk total biaya
/*
var totalhotel=$('#totalhotel').val();
var transport = $('#nilaiTransport').val();
var rill =  $('#pengeluaranrill').val(); */
var totalbiaya = parseInt($('#totalhotel').val())+ parseInt(rill) + parseInt($('#totalharian').val()) + parseInt($('#nilaiTransport').val());
$('#totalbiaya').val(totalbiaya);

});
/*
jscript untuk tujuan dan sumberdana
*/
$(document).on('click', '.pilihTujuan', function (e) {
    document.getElementById("nama_tujuan").value = $(this).attr('data-tujuan');
    document.getElementById("kode_kabkota").value = $(this).attr('data-kodekabkota');
    document.getElementById("nilaiTransport").value = $(this).attr('data-rate');
    $('#CariTujuan').modal('hide');
});

$(document).on('click', '.pilihSumberDana', function (e) {
    //var sumberdana = $(this).attr('data-mak') + " " + $(this).attr('data-uraian');
    document.getElementById("dana_makid").value = $(this).attr('data-makid');
    document.getElementById("dana_tid").value = $(this).attr('data-tid');
    document.getElementById("dana_mak").value = $(this).attr('data-mak');
    document.getElementById("dana_komponen").value = $(this).attr('data-komponen');
    document.getElementById("dana_uraian").value = $(this).attr('data-uraian');
    document.getElementById("dana_pagu").value = $(this).attr('data-pagu');
    document.getElementById("dana_kodeunit").value = $(this).attr('data-unitkerja');
    document.getElementById("dana_unitkerja").value = $(this).attr('data-namaunitkerja');
    document.getElementById("dana_pagusisa").value = $(this).attr('data-sisapagu');
    $('#SumberDana').modal('hide');
});
//batas tujuan dan sumber dana //
$(function () {
    $("#TabelSumberDana").dataTable();
});
</script>
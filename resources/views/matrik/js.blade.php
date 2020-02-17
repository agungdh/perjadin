<script>
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
$(function () {
    $("#MatrikTable").dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',  'pdf', 'print'
        ],
        "pageLength": 30
    });
});
</script>
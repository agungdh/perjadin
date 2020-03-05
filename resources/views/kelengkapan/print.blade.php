<!DOCTYPE html>
<html lang="en">
<head>
    <title>PERJADIN_{{strtoupper($data->peg_nama)}}_TRX_ID_{{$data->kode_trx}}</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!-- Bootstrap Core CSS -->
    <link href="{{ asset('tema/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('tema/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    
    <!-- color CSS -->
    <style type="text/css">
       
/* Setting content width, unsetting floats and margins */
/* Attention: the classes and IDs vary from theme to theme. Thus, set own classes here */
body {
    font-size : 10pt;
    font-family: Helvetica !important;
    background: #fff !important;
    color: #000;
}

h1 {
font-size: 20pt;
}

h2, h3, h4 {
font-size: 12pt;
margin-top: 10px;
}
.namakuitansi h2, .namakuitansi {
    font-size: 16pt !important;
}

/* Defining all page breaks */
a {
    page-break-inside:avoid;
}
blockquote {
    page-break-inside: avoid;
}
h1, h2, h3, h4, h5, h6 { page-break-after:avoid;
     page-break-inside:avoid }
img { page-break-inside:avoid;
     page-break-after:avoid; }
table, pre { page-break-inside:avoid }
table {  
        width: 100%;
        /*line-height: normal; /* inherit */
        text-align: left;
        font-size : 10pt; 
        border-collapse: collapse; 
        padding:2pt !important;
}
.halbox {
        max-width: 800px;
        margin: auto;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}
table.normal {
    line-height: normal; /* inherit */
}
table.pad5px tr td {
    padding: 4px;
}
table tr .garis-t {  border-top: 1px solid black !important; }
table tr .garis-b {  border-bottom: 1px solid black !important; }
table tr .garis-l {  border-left: 1px solid black !important; }
table tr .garis-r {  border-right: 1px solid black !important; }
ul, ol, dl  { page-break-before:avoid }
/* Displaying link color and link behaviour */

/* Hiding unnecessary elements for the print */

.kopsurat {
font-size: 13pt;
margin-top: 10pt !important;
}
.nomor {
font-size:11pt;
}

.aturan table {
    border: none !important;
    font-size: 10pt;
    margin:0pt !important;
    }
.aturan table th, .aturan table td { padding:2pt !important; border: none !important;font-size: 10pt;}
.tulisan {
font-size:11pt !important;
}
.namabps {
    font-family: Arial, Helvetica, sans-serif !important;
}
.namatable table, .namatable table td {
    padding:1pt !important;
    border: none !important;
}
.bawah {
    width: 95%;
    font-size:9pt !important;
    position: absolute;
    bottom: 0px;
    padding: 5px;
    text-align: center;
}

footer {
    position: fixed; 
    bottom: -60px; 
    left: 0px; 
    right: 0px;
    height: 60px; 
    font-size:9pt !important;
    text-align: center;
    
}
.kaki {
    position: fixed; 
    bottom: -60px; 
    left: 0px; 
    right: 0px;
    height: 60px; 
    font-size:9pt !important;
    text-align: center;
    
}
.qrcode {
    position: relative;
    bottom: 0px;
    padding: 0px;
    text-align: left;
    line-height: 0px;
}

.pindah-halaman {
    page-break-after: always;
}
.spdhal2 table {
    font-size:9pt !important;
}
    </style>

</head>
<body>
    
    <main>
        <div class="halbox">
            @include('kelengkapan.srttugas')
        </div>
        <div class="pindah-halaman"></div>
        <div class="halbox">
            @include('kelengkapan.spd1')
        </div>
        <div class="pindah-halaman"></div>
        <div class="halbox">
            @include('kelengkapan.spd2')
        </div>
    </main>
    
<!-- jQuery -->
<script src="{{ asset('tema/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->

<script src="{{ asset('tema/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('tema/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js')}}"></script>
<script src="{{asset('js/numberformat.js')}}"></script>
</body>
</html>

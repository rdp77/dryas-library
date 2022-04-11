@extends('layouts.backend.default')
@section('title', __('pages.title') . __(' | Dashboard'))
@section('titleContent', __('Dashboard'))
@section('breadcrumb', __('Tanggal ') . date('d-M-Y'))
<meta http-equiv="refresh" content="30">

@section('content')
    @include('layouts.backend.components.notification')
    {{-- <div class="row" style="margin: 0 -15px;">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px;">
    <div class="small-box bg-yellow">
        <div class="inner">
            <h6 class="kotak_judul"> Transaksi Hari Ini</h6>
            <table>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>    
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($transactionIn, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Pemasukan </td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($transactionOut, 0, ",", ".") }}

                        
                     </strong></td>
                    <td> &nbsp; Pengeluaran</td>
                </tr><tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        
                     </strong></td>
                    <td> &nbsp; </td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa fa-money-bill-alt"></i>
        </div>
        <a class="small-box-footer" href="lap_kas_pinjaman">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px; padding-left: 5px">
    <div class="small-box bg-green">
        <div class="inner">
            <h6 class="kotak_judul"> Status Saldo Kas</h6>
            <table>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px; ">
                        {{ number_format($saldoRek, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Rek BNI</td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($saldoTunai, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Kas Tunai</td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($saldoBesar, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Kas Besar </td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa fa-briefcase"></i>
        </div>
        <a class="small-box-footer" href="lap_simpanan">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"  style="padding-right: 5px; padding-left: 5px">
    <div class="small-box bg-tosca">
        <div class="inner">
            <h6 class="kotak_judul"> Laporan Laba / Rugi</h6>
            <table>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($jumlahPendapatan, 0, ",", ".") }}
                 </strong></td>
                    <td> &nbsp; Pendapatan</td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($totalBiaya, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Biaya</td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($labaRugi, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Jumlah </td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        <a class="small-box-footer" href="lap_saldo">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-left: 5px">
    <div class="small-box bg-purple">
        <div class="inner">
            <h6 class="kotak_judul"> Target & Insentif (Harian)</h6>
            <table>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($totalTarget, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Total Target</td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($getTotalInsentifM, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Jumlah Insentif Berjalan</td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        <a class="small-box-footer" href="lap_saldo">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px;">
    <div class="small-box bg-blue">
        <div class="inner">
            <h6 class="kotak_judul"> Data Anggota</h6>
            <table>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $member }}
                    </strong></td>
                    <td> &nbsp; Data Peminjam Aktif</td>
                </tr>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $member }}
                    </strong></td>
                    <td> &nbsp; Jumlah Seluruh Anggota</td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa fa-user-plus"></i>
        </div>
        <a class="small-box-footer" href="{{ route('member.index') }}">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px; padding-left: 5px">
    <div class="small-box bg-red">
        <div class="inner">
            <h6 class="kotak_judul"> Status Peminjaman</h6>
            <table>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $statusLancar }}
                    </strong></td>
                    <td> &nbsp; Status Kredit Lancar</td>
                </tr>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $statusKol1 }}
                    </strong></td>
                    <td> &nbsp; Status Kredit Macet (Kol 1)</td>
                </tr>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $statusKol2 }}
                    </strong></td>
                    <td> &nbsp; Status Kredit Macet (Kol 2) </td>
                </tr>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $statusKol3 }}
                    </strong></td>
                    <td> &nbsp; Status Kredit Macet (Macet) </td>
                </tr>
                <tr>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ $statusJumlah }}
                    </strong></td>
                    <td> &nbsp; Jumlah Transaksi </td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa fa-calendar-alt"></i>
        </div>
        <a class="small-box-footer" href="{{ route('payInstallments.index') }}">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-right: 5px; padding-left: 5px">
    <div class="small-box bg-aqua">
        <div class="inner">
            <h6 class="kotak_judul"> Laporan Kredit - [Manager/Admin]</h6>
            <table>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($penyaluranM, 0, ",", ".") }}
                 </strong></td>
                    <td> &nbsp; Jumlah Penyaluran Kredit</td>
                </tr>
                <tr>
                    <td class="h_kiri"><strong style="font-size: 20px;">
                        Rp 
                    </strong></td>
                    <td class="h_kanan"><strong style="font-size: 20px;">
                        {{ number_format($penarikanM, 0, ",", ".") }}
                    </strong></td>
                    <td> &nbsp; Jumlah Penarikan Kredit </td>
                </tr>
            </table>
        </div>
        <div class="icon">
            <i class="fa  fa-users"></i>
        </div>
        <a class="small-box-footer" href="{{ route('users.index') }}">
            More info
            <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
@if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '4')
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="padding-left: 5px">
        <div class="small-box bg-grey">
            <div class="inner">
                <h6 class="kotak_judul"> Laporan Kredit Sales</h6>
                <table>
                    <tr>
                        <td class="h_kiri"><strong style="font-size: 20px;">
                            Rp 
                        </strong></td>
                        <td class="h_kanan"><strong style="font-size: 20px;">
                            {{ number_format($penyaluranS, 0, ",", ".") }}
                    </strong></td>
                        <td> &nbsp; Jumlah Penyaluran Kredit</td>
                    </tr>
                    <tr>
                        <td class="h_kiri"><strong style="font-size: 20px;">
                            Rp 
                        </strong></td>
                        <td class="h_kanan"><strong style="font-size: 20px;">
                            {{ number_format($penarikanS, 0, ",", ".") }}
                        </strong></td>
                        <td> &nbsp; Jumlah Penarikan Kredit </td>
                    </tr>
                </table>
            </div>
            <div class="icon">
                <i class="fa  fa-users"></i>
            </div>
            <a class="small-box-footer" href="{{ route('users.index') }}">
                More info
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
@endif
</div>

@if (Auth::user()->roles_id == 0)
    <div class="card card-hero">
        <div class="card-header">
            <div class="card-icon">
                <i class="fas fa-history"></i>
            </div>
            <h6>{{ __('pages.history') }}</h6>
            <div class="card-description">
                {{ __('pages.historyDesc') }}
            </div>
        </div>
        <div class="card-body p-0">
            <div class="tickets-list">
                @foreach ($log as $l)
                <a href="javascript:void(0)" class="ticket-item">
                    <div class="ticket-title">
                        <h6>{{ $l->info }}</h6>
                    </div>
                    <div class="ticket-info">
                        <div>{{ $l->ip }}</div>
                        <div class="bullet"></div>
                        <div class="text-primary">
                            {{ __('Tercatat pada tanggal ').date("d-M-Y", strtotime($l->added_at)).
                            __(' Jam ').date("H:m", strtotime($l->added_at)) }}
                        </div>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('dashboard.log') }}" class="ticket-item ticket-more">
                    {{ __('Lihat Semua ') }} <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
@endif --}}
    <style type="text/css">
        hr.new5 {
            border: 3px solid white;
            border-radius: 5px;
        }

        .alignleft {
            float: left;
        }

        .alignright {
            float: right;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
        integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <div class="col-md-12">
        @if ($checkReportHari == 'tampil')
            <div class="alert alert-danger" role="alert">
                <h2 class="alert-heading">
                    <marquee width="100%" direction="left">
                        KSP Sistem Closing - {{ date('d-M-Y h:i') }} Anda tidak dapat melakukan transaksi apapun sampai dengan pukul 00:01
                    </marquee>
                </h2>
            </div>
        @endif
       
        {{-- Hak Akses Admin --}}
        @if (Auth::user()->roles_id == '1')
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card-2 l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-arrow-left"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Transaksi Hari Ini</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Pemasukan</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($transactionIn, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-2-cherry" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Pengeluaran</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($transactionOut, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-2-cherry" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card-2 l-bg-blue-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Status Saldo Kas</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">{{ App\Models\CashData::cashData(1) }}</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($saldoTunai, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">{{ App\Models\CashData::cashData(2) }}</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($saldoBesar, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>

                            <br>
                            <div id="textbox">
                                <div class="alignleft">{{ App\Models\CashData::cashData(3) }}</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($saldoRek, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card-2 l-bg-green-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-balance-scale"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Laporan Laba Rugi</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Pendapatan</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($jumlahPendapatan, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Biaya</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>

                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($labaRugi, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card-2 l-bg-orange-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Target & Insentif (Harian)</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Total Target</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($totalTarget, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Insentif Berjalan</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($getTotalInsentifM, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-blue-ok">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-coins"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Data Anggota</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Data Peminjam Aktif</div><br>
                            <div class="alignleft">
                                <h4>{{ $member }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Seluruh Anggota</div><br>
                            <div class="alignleft">
                                <h4>{{ $member }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-status-peminjaman">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Status Peminjaman</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Status Kredit Lancar</div><br>
                            <div class="alignleft">
                                <h4>{{ $statusLancar }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Status Kredit Macet (Kol 1)</div><br>
                            <div class="alignleft">
                                <h4>{{ $statusKol1 }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Status Kredit Macet (Kol 2)</div><br>
                            <div class="alignleft">
                                <h4>{{ $statusKol2 }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Status Kredit Macet (Macet)</div><br>
                            <div class="alignleft">
                                <h4>{{ $statusKol3 }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Transaksi</div><br>
                            <div class="alignleft">
                                <h4>{{ $statusJumlah }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-laporan-kredit-manager">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-balance-scale"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Laporan Kredit - [Manager]</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Penyaluran Kredit</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($penyaluranM, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-laporan-kredit-manager2" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Penarikan Kredit</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($penarikanM, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-laporan-kredit-manager2" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card l-bg-laporan-kredit-sales">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Laporan Kredit Sales</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Penyaluran Kredit</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($penyaluranS, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-laporan-kredit-sales2" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Penarikan Kredit</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($penarikanS, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-laporan-kredit-sales2" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Hak Akses Manager --}}
    @if (Auth::user()->roles_id == '2')
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card-2 l-bg-cherry">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-arrow-left"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Transaksi Hari Ini</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Pemasukan</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($transactionIn, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-2-cherry" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Pengeluaran</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($transactionOut, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-2-cherry" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card-2 l-bg-blue-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Status Saldo Kas</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Kas Tunai</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($saldoTunai, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Kas Besar</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($saldoBesar, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>

                        <br>
                        <div id="textbox">
                            <div class="alignleft">Rek BNI</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($saldoRek, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card-2 l-bg-green-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-balance-scale"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Laporan Laba Rugi</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Pendapatan</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($jumlahPendapatan, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-green" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Biaya</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-green" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>

                        <br>
                        <div id="textbox">
                            <div class="alignleft">Jumlah</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($labaRugi, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-green" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card-2 l-bg-orange-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Target & Insentif (Harian)</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Total Target</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($totalTarget, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Jumlah Insentif Berjalan</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($getTotalInsentifM, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-blue-ok">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-coins"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Data Anggota</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Data Peminjam Aktif</div><br>
                                <div class="alignleft">
                                    <h4>{{ $member }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Seluruh Anggota</div><br>
                                <div class="alignleft">
                                    <h4>{{ $member }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-status-peminjaman">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Status Peminjaman</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Lancar</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusLancar }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Kol 1)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol1 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Kol 2)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol2 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Macet)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol3 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Transaksi</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusJumlah }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="card l-bg-laporan-kredit-manager">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-balance-scale"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Laporan Kredit - [Manager]</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Penyaluran Kredit</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($penyaluranM, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-laporan-kredit-manager2" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Penarikan Kredit</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($penarikanM, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-laporan-kredit-manager2" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Hak Akses Kasir --}}
    @if (Auth::user()->roles_id == '3')
        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="card-2 l-bg-cherry">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-arrow-left"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Transaksi Hari Ini</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Pemasukan</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($transactionIn, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-2-cherry" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Pengeluaran</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($transactionOut, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-2-cherry" role="progressbar" data-width="100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card-2 l-bg-blue-dark">
                    <div class="card-statistic-3 p-4">
                        <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="mb-4">
                            <h5 class="card-title mb-0">Status Saldo Kas</h5>
                            <hr class="new5">
                        </div>
                        <div id="textbox">
                            <div class="alignleft">Kas Tunai</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($saldoTunai, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                        <br>
                        <div id="textbox">
                            <div class="alignleft">Kas Besar</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($saldoBesar, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>

                        <br>
                        <div id="textbox">
                            <div class="alignleft">Rek BNI</div><br>
                            <div class="alignleft">
                                <h4>Rp. {{ number_format($saldoRek, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="progress mt-1 " data-height="8" style="height: 8px;">
                            <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-blue-ok">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-coins"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Data Anggota</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Data Peminjam Aktif</div><br>
                                <div class="alignleft">
                                    <h4>{{ $member }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Seluruh Anggota</div><br>
                                <div class="alignleft">
                                    <h4>{{ $member }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-status-peminjaman">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Status Peminjaman</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Lancar</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusLancar }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Kol 1)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol1 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Kol 2)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol2 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Macet)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol3 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Transaksi</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusJumlah }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="card l-bg-laporan-kredit-manager">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-balance-scale"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Laporan Kredit - [Manager]</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Penyaluran Kredit</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($penyaluranM, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-laporan-kredit-manager2" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Penarikan Kredit</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($penarikanM, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-laporan-kredit-manager2" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Hak Akses Sales --}}
    @if (Auth::user()->roles_id == '4')
        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Target & Insentif (Harian)</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Total Target</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($totalTarget, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Insentif Berjalan</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($getTotalInsentifM, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-blue-ok">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-coins"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Data Anggota</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Data Peminjam Aktif</div><br>
                                <div class="alignleft">
                                    <h4>{{ $member }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Seluruh Anggota</div><br>
                                <div class="alignleft">
                                    <h4>{{ $member }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-status-peminjaman">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-hand-holding-usd"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Status Peminjaman</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Lancar</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusLancar }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Kol 1)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol1 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Kol 2)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol2 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Status Kredit Macet (Macet)</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusKol3 }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Transaksi</div><br>
                                <div class="alignleft">
                                    <h4>{{ $statusJumlah }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-laporan-kredit-sales">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Laporan Kredit Sales</h5>
                                <hr class="new5">
                            </div>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Penyaluran Kredit</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($penyaluranS, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-laporan-kredit-sales2" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                            <br>
                            <div id="textbox">
                                <div class="alignleft">Jumlah Penarikan Kredit</div><br>
                                <div class="alignleft">
                                    <h4>Rp. {{ number_format($penarikanS, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-laporan-kredit-sales2" role="progressbar" data-width="100%"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style type="text/css">
        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            height: 550px;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .card-2 {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            height: 375px;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }

        .l-bg-cherry {
            background: linear-gradient(to right, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-2-cherry {
            background: linear-gradient(to left, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: linear-gradient(to right, #373b44, #4286f4) !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: linear-gradient(to right, #0a504a, #38ef7d) !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: linear-gradient(to right, #a86008, #ffba56) !important;
            color: #fff;
        }

        .l-bg-orange-2-dark {
            background: linear-gradient(to left, #a86008, #ffba56) !important;
            color: #fff;
        }

        .l-bg-blue-ok {
            background: linear-gradient(to right, #051937, #004d7a) !important;
            color: #fff;
        }

        .l-bg-status-peminjaman {
            background: linear-gradient(to right, #514A9D, #24C6DC) !important;
            color: #fff;
        }

        .l-bg-laporan-kredit-manager {
            background: linear-gradient(to right, #3f2b96, #a8c0ff) !important;
            color: #fff;
        }

        .l-bg-laporan-kredit-manager2 {
            background: linear-gradient(to right, #a8c0ff, #3f2b96) !important;
            color: #fff;
        }

        .l-bg-laporan-kredit-sales {
            background: linear-gradient(to right, #2c3e50, #3498db) !important;
            color: #fff;
        }

        .l-bg-laporan-kredit-sales2 {
            background: linear-gradient(to right, #3498db, #2c3e50) !important;
            color: #fff;
        }




        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card-2 .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .card-2 .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

    </style>
@endsection
<script>
    window.setTimeout(function () {
  window.location.reload();
}, 30000);
    </script>
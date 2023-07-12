@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1578c9;">
        <div class="col-11 d-flex justify-content-center">
            <p class="text-white text-center"> <b>BRI</b> <span style="color: orange;">mo</span></p>
        </div>
        <div class="col-1 d-flex justify-content-end">
            <a class="text-white" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center"
        style="background-color:#1578c9; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);">
        <div class="col-lg-6 col-md-8 col-sm-12 text-white pl-5 pr-5 pb-5 pt-0">
            <p class="text-center">Saldo Rekening Utama</p>
            <p class="text-center">{{ $data['account']->number }}</p>
            <p class="text-center">Rp.{{ $data['account']->amount }}</p>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="row">
                <div class="col-3 p-4">
                    <a href="{{ route('transfer.index') }}"><i class="bi bi-arrow-right-square-fill"></i> Transfer</a>
                </div>
                <div class="col-3 p-4">
                    <a href="{{ route('withdraw.create') }}"><i class="bi bi-cash-stack"></i> Tarik Tunai</a>
                </div>
                <div class="col-3 p-4">
                    <a href="{{ route('mutation.index') }}"><i class="bi bi-journal-text"></i> Mutasi</a>
                </div>
                <div class="col-3 p-4">
                    <a href="{{ route('pulsa.create') }}"><i class="bi bi-phone"></i> Pulsa</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/dist/css/bootstrap-icons.min.css">

    <!-- ... kode lainnya ... -->

    <div class="row d-flex justify-content-center mt-4 text-center">
        <div class="col-5 p-0">
            <div class="card">
                <div class="card-body">
                    <p style="color: green;"><i class="bi bi-cash"></i> Pemasukan</p>
                    <b>Rp.{{ $data['pemasukan'] }}</b>
                </div>
            </div>
        </div>
        <div class="col-5 p-0">
            <div class="card">
                <div class="card-body">
                    <p style="color: red;"><i class="bi bi-cash"></i> Pengeluaran</p>
                    <b>Rp. {{ $data['pengeluaran'] }}</b>
                </div>
            </div>
        </div>
    </div>
@endsection

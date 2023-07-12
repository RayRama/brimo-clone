@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-1 p-2">
            <a href="{{ route('home') }}" class="text-center text-white"><i style="font-size: 14pt; font-weight: bold;"
                    class="bi bi-arrow-left"></i></a>
        </div>
        <div class="col-10 p-2">
            <h5 class="text-center text-white">Pilih Nomor Rekening</h5>
        </div>
    </div>
    <div class="row justify-content-center" style="background-color: #eef1f6;">
        <div class="col-lg-6 col-md-8 col-sm-12">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <form method="GET" action="{{ route('transfer.create') }}">
                @csrf
                <div class="row justify-content-center" style="background-color: #fff;margin-bottom: 80%;">
                    <div class="col-lg-6 col-md-8 col-sm-12 px-3 pt-3">
                        <div class="form-group">
                            <label for="recipient"><b style="color: #05539b;font-weight: bold;">Nomor Tujuan</b></label>
                            <input type="number" id="recipient" class="form-control" name="recipient" required>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: #eef1f6;">
                    <div class="col-12">
                        <button type="submit" class="btn w-100 text-white py-2"
                            style="background-color: #1f8fe5;margin-top: 10%;">Lanjutkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

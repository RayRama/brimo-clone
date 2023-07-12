@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-1 p-2">
            <a href="{{ route('home') }}" class="text-center text-white"><i style="font-size: 14pt; font-weight: bold;" class="bi bi-arrow-left"></i></a>
        </div>
        <div class="col-10 p-2">
            <h5 class="text-center text-white">Tarik Tunai</h5>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('errors'))
                <div class="alert alert-danger" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <form method="POST" action="{{ route('withdraw.done') }}">
                @csrf
                <input type="text" name="type" value="withdraw" hidden="true">
                <input type="text" name="status" value="pending" hidden="true">
                <input type="number" name="id" value="{{ $withdraw->id }}" hidden="true">
                <div class="row justify-content-center">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3 pt-2">
                        <div class="form-group">
                            <label for="accounts_number"><b style="color: #05539b;font-weight: bold;">Kode Unik</b></label>
                            <input type="text" class="form-control" value="{{ uniqid() }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: #eef1f6;">
                    <div class="col-12">
                        <input type="number" name="amount" id="amount" hidden="true">
                        <button type="submit" class="btn w-100 text-white py-2" style="background-color: #1f8fe5;margin-top: 10%;">Selesai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-12" style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">
            <h5 class="text-center text-white"><b>BRI</b> <br>&nbsp;&nbsp;<span style="color: orange;">mo</span></h5>
        </div>
    </div>
    <div class="row" style="padding-bottom: 1.5em;background-color:#1f8fe5;border-radius: 0 0 45% 45%;">
        <div class="col-12 pt-4">
            <h6 class="text-white text-center">Selamat Datang</h6>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-6 col-md-8 col-sm-12 text-center">
            <img src="{{ asset('img/login-icon.jpg') }}" alt="Image" style="max-width: 50%;">
        </div>
    </div>
    <div class="row justify-content-center mt-4">
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
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group">
                    <label><b style="color: #05539b;font-weight: bold;">Register</b></label>
                    <input type="number" class="form-control" name="id_number" placeholder="No KTP" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control mt-3" name="email" placeholder="example@mail.com" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="text-right mb-3">
                    <a href="{{ route('login.index') }}">Sudah punya Akun? Login Disini</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
@endsection

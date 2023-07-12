@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-1 p-2">
            <a href="{{ route('home') }}" class="text-center text-white"><i style="font-size: 14pt; font-weight: bold;" class="bi bi-arrow-left"></i></a>
        </div>
        <div class="col-10 p-2">
            <h5 class="text-center text-white">Top Up Pulsa</h5>
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
            <form method="POST" action="{{ route('pulsa.store') }}">
                @csrf
                <input type="text" name="type" value="pulsa" hidden="true">
                <input type="text" name="status" value="completed" hidden="true">
                <div class="row justify-content-center">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3 pt-2">
                        <div class="form-group">
                            <label for="phone_number"><b style="color: #05539b;font-weight: bold;">Nomor Telepon</b></label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3 pt-2">
                        <div class="form-group">
                            <label for="accounts_number"><b style="color: #05539b;font-weight: bold;">Sumber Dana</b></label>
                            <select class="form-control" id="accounts_number" name="accounts_number">
                                @foreach($accounts as $account)
                                    <option value="{{ $account->number }}">{{ $account->number }} - Rp.{{ $account->amount }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <style>
                    .selected-nominal{
                        background-color: #0f78cb;
                        color: #fff;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }

                    .selected-nominal:hover{
                        background-color: #0f78cb;
                        color: #fff;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }

                    .non-selected-nominal{
                        background-color: #fff;
                        color: #2d2d2d;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }

                    .non-selected-nominal:hover{
                        background-color: #0f78cb;
                        color: #fff;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }
                </style>
                <div class="row justify-content-center" style="padding-bottom: 28%;">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3">
                        <div class="form-group">
                            <label for="recipient"><b style="color: #05539b;font-weight: bold;">Nominal</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal15" onclick="setNominal(15)" type="button" class="btn non-selected-nominal w-100 py-2">Rp. 15.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal20" onclick="setNominal(20)" type="button" class="btn non-selected-nominal w-100 py-2">Rp. 20.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal50" onclick="setNominal(50)" type="button" class="btn non-selected-nominal w-100 py-2">Rp. 50.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal100" onclick="setNominal(100)" type="button" class="btn non-selected-nominal w-100 py-2">Rp. 100.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal200" onclick="setNominal(200)" type="button" class="btn non-selected-nominal w-100 py-2">Rp. 200.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal300" onclick="setNominal(300)" type="button" class="btn non-selected-nominal w-100 py-2">Rp. 300.000</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: #eef1f6;">
                    <div class="col-12">
                        <input type="number" name="amount" id="amount" hidden="true">
                        <button type="submit" class="btn w-100 text-white py-2" style="background-color: #1f8fe5;margin-top: 10%;">Lanjutkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        let prevButton = null;

        function setNominal(nominal) {
            let currentButton = document.getElementById("pilihNominal" + nominal);
            document.getElementById("amount").value = nominal * 1000;

            if (prevButton !== null) {
                prevButton.classList.remove("selected-nominal");
                prevButton.classList.add("non-selected-nominal");
            }

            currentButton.classList.add("selected-nominal");
            currentButton.classList.remove("non-selected-nominal");
            prevButton = currentButton;
        }

    </script>
@endsection

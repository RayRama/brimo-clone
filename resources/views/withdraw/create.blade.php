@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-1 p-2">
            <a href="{{ route('home') }}" class="text-center text-white"><i style="font-size: 14pt; font-weight: bold;"
                    class="bi bi-arrow-left"></i></a>
        </div>
        <div class="col-10 p-2">
            <h5 class="text-center text-white">Tarik Tunai</h5>
        </div>
    </div>
    <div class="row justify-content-center">
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
            <form method="POST" action="{{ route('withdraw.store') }}">
                @csrf
                <input type="text" name="type" value="withdraw" hidden="true">
                <input type="text" name="status" value="pending" hidden="true">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-sm-12 px-3 pt-2">
                        <div class="form-group">
                            <label for="accounts_number"><b style="color: #05539b;font-weight: bold;">Sumber
                                    Dana</b></label>
                            <select class="form-control" id="accounts_number" name="accounts_number">
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->number }}">{{ $account->number }} -
                                        Rp.{{ $account->amount }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <style>
                    .selected-nominal {
                        background-color: #0f78cb;
                        color: #fff;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }

                    .selected-nominal:hover {
                        background-color: #0f78cb;
                        color: #fff;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }

                    .non-selected-nominal {
                        background-color: #fff;
                        color: #2d2d2d;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }

                    .non-selected-nominal:hover {
                        background-color: #0f78cb;
                        color: #fff;
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                        font-weight: bold;
                    }
                </style>
                <div class="row justify-content-center" style="padding-bottom: 23%;">
                    <div class="col-lg-6 col-md-8 col-sm-12 px-3">
                        <div class="form-group">
                            <label for="recipient"><b style="color: #05539b;font-weight: bold;">Nominal</b></label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal1" onclick="setNominal(1)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 100.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal2" onclick="setNominal(2)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 200.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal3" onclick="setNominal(3)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 300.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal4" onclick="setNominal(4)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 400.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal5" onclick="setNominal(5)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 500.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal6" onclick="setNominal(6)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 600.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal7" onclick="setNominal(7)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 700.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal8" onclick="setNominal(8)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 800.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal9" onclick="setNominal(9)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 900.000</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-2 px-4">
                                        <button id="pilihNominal10" onclick="setNominal(10)" type="button"
                                            class="btn non-selected-nominal w-100 py-2">Rp. 1.000.000</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: #eef1f6;">
                    <div class="col-12">
                        <input type="number" name="amount" id="amount" hidden="true">
                        <button type="submit" class="btn w-100 text-white py-2"
                            style="background-color: #1f8fe5;margin-top: 10%;">Lanjutkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        let prevButton = null;

        function setNominal(nominal) {
            let currentButton = document.getElementById("pilihNominal" + nominal);
            document.getElementById("amount").value = nominal * 100000;

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

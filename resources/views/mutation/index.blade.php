@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-1 p-2">
            <a href="{{ route('home') }}" class="text-center text-white"><i style="font-size: 14pt; font-weight: bold;" class="bi bi-arrow-left"></i></a>
        </div>
        <div class="col-10 p-2">
            <h5 class="text-center text-white">Mutasi</h5>
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
            <form method="GET" action="{{ route('mutation.index') }}">
                @csrf
                <div class="row justify-content-center" style="background-color: #eef1f6;">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3 pb-3 pt-2 m-3" style="background-color: #fff;border-radius: 10px;">
                        <div class="form-group">
                            <label for="accounts_number"><b style="color: #05539b;font-weight: bold;">Cari Mutasi</b></label>
                            <br>
                            <label for="accounts_number">Pilih Rekening</label>
                            <select class="form-control" id="accounts_number" name="accounts_number">
                                @foreach($datas['accounts'] as $account)
                                    <option value="{{ $account->number }}">{{ $account->number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <button type="submit" class="btn w-100 text-white py-2" style="background-color: #0f78cb;font-weight: bold;">Cari</button>
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
                <div class="row justify-content-center pt-2">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-4">
                        <div class="form-group">
                            <label for="recipient"><b style="color: #05539b;font-weight: bold;">{{ request()->query('tanggal')?request()->query('tanggal'):"Daftar Mutasi" }}</b></label>
                                @foreach($datas['mutations'] as $mutation)
                                    <div class="row border-bottom">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    @if($mutation->type == 'transfer')
                                                        <p><b style="text-transform: uppercase;">{{ $mutation->s_name }} TO {{ $mutation->r_name }}</b></p>
                                                    @elseif($mutation->type == 'withdraw')
                                                        <p><b style="text-transform: uppercase;">TARIK TUNAI</b></p>
                                                    @else
                                                        <p><b style="text-transform: uppercase;">TOP UP PULSA</b></p>
                                                    @endif
                                                </div>
                                                <div class="col-4 d-flex justify-content-center">
                                                    <p class="text-center {{ $mutation->r_number == session('account_number')?"text-success":"text-danger" }}" ><b>Rp. {{ $mutation->amount }},00</b></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <p>{{ $mutation->timestamp }} WIB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
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

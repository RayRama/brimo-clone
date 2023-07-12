@extends('layouts.app')

@section('content')
    <div class="row" style="background-color:#1f8fe5;">
        <div class="col-1 p-2">
            <a href="{{ route('home') }}" class="text-center text-white"><i style="font-size: 14pt; font-weight: bold;" class="bi bi-arrow-left"></i></a>
        </div>
        <div class="col-10 p-2">
            <h5 class="text-center text-white">Transfer</h5>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <form method="POST" action="{{ route('transfer.store') }}">
                @csrf
                <input type="text" name="type" value="transfer" hidden="true">
                <input type="text" name="status" value="completed" hidden="true">
                <div class="row justify-content-center">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3 pt-3">
                        <div class="form-group">
                            <label for="recipient"><b style="color: #05539b;font-weight: bold;">Nomor Tujuan</b></label>
                            <input type="number" name="recipient" value="{{ request()->input('recipient') }}" hidden="true">
                            <p class="pb-0 mb-0" style="font-size: 14pt;font-weight: bold;color: #212121;">{{ $datas['recipient']->name }}</p>
                            <p style="font-size: 12pt;color: #212121;">{{ $datas['recipient']->number }}</p>
                        </div>
                    </div>
                </div>
                <style>
                    .custom-div {
                        background-color: #eef1f6;
                        border-radius: 10px; /* Set the desired border radius value */
                        border: none; /* Remove the border */
                    }

                    .inline-text {
                        color: #333438; /* Adjust the spacing between <p> and <input> as desired */
                        padding-top: 9px;
                        font-size: 16pt;
                        font-weight: bold;
                    }

                    .custom-input {
                        font-size: 16pt;
                        font-weight: bold;
                        color: #333438;
                        background-color: #eef1f6;
                        border: none; /* Remove the border */
                        -webkit-appearance: none; /* Remove default styles on WebKit browsers */
                        -moz-appearance: textfield; /* Remove default styles on Mozilla browsers */
                    }

                    .custom-input::-webkit-inner-spin-button,
                    .custom-input::-webkit-outer-spin-button {
                        -webkit-appearance: none; /* Remove increment and decrement buttons on WebKit browsers */
                        margin: 0; /* Remove any default margins */
                    }

                    .custom-input:focus {
                        font-size: 16pt;
                        font-weight: bold;
                        color: #333438;
                        background-color: #eef1f6;
                        outline: none; /* Remove the outline when the input is focused */
                        box-shadow: none; /* Remove the box shadow when the input is focused */
                    }

                </style>
                <div class="row justify-content-center" style="border-top: 10px solid #d8e5ed;">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3 pt-3">
                        <div class="form-group">
                            <label for="amount"><b style="color: #05539b;font-weight: bold;">Nominal Transfer</b></label>
                            <div class="custom-div">
                                <div class="row pt-1 pb-0">
                                    <div class="col-2 d-flex justify-content-end">
                                        <h2 style="color: #05539b; padding-top: 3px;" class="bi bi-cash"></h2>
                                    </div>
                                    <div class="col-10 d-flex justify-content-start pl-0">
                                        <p class="inline-text pb-0 mb-0">Rp</p>
                                        <input type="number" class="form-control custom-input pb-0 mb-0" id="amount" name="amount" min=10000 required>
                                    </div>
                                </div>
                                <div class="row pt-0">
                                    <div class="col-2 d-flex justify-content-end">
                                    </div>
                                    <div class="col-10 d-flex justify-content-start pl-0">
                                        <p style="color: #6f85aa; font-size:10pt; font-weight: bold;padding-top: 0; margin-top: 0;">Minimal Transfer Rp.10.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" style="padding-bottom: 32%;">
                    <div  class="col-lg-6 col-md-8 col-sm-12 px-3">
                        <div class="form-group">
                            <label for="accounts_number"><b style="color: #05539b;font-weight: bold;">Sumber Dana</b></label>
                            <select class="form-control" id="accounts_number" name="accounts_number">
                                @foreach($datas['accounts'] as $account)
                                    <option value="{{ $account->number }}">{{ $account->number }} - Rp.{{ $account->amount }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="background-color: #eef1f6;">
                    <div class="col-12">
                        <button type="submit" class="btn w-100 text-white py-2" style="background-color: #1f8fe5;margin-top: 10%;">Transfer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

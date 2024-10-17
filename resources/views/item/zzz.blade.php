@extends('template.app')

@section('content-dinamis')
<div>
    {{-- Banner --}}
    <img src="{{ asset('images/banner.jpg') }}" class="img-fluid" alt="" style="width: 80%; height: auto; margin: 0 auto; display: block;">
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center">
            {{-- Card --}}
            <div class="card" style="max-width: 300px;"> <!-- Set max width for the card -->
                <div class="text-center">
                    <img src="{{ asset('images/card.jpg') }}" class="card-img-top" alt="" style="width: 80%; margin: 10px auto;"> <!-- Set image width to 80% -->
                </div>
                <div class="card-body">
                    <p class="card-text"><h6>Top Up Sekarang</h6> <b>Cara Top up</b> <br>
                        1. Pilih Nominal Monochrome yang kamu inginkan <br>
                        2. Selesaikan pembayaran <br>
                        3. Produk akan di tambahkan ke dalam akun Zenless Zone Zero kamu</p></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('interface.create.proses')}}" class="card p-5" style="background-color: #F8C617" method="POST">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success')}}
                    </div>
                @endif
                <div class="mb-3 row">
                    <label for="items" class="col-sm-4 col-form-label">Pilih Paket </label>
                    <div class="col-sm-8">
                        <select class="form-select" name="items" id="items" value="{{ old('items') }}">
                            <option selected disabled hidden>Pilih</option>
                            <option value="item1">60 Monocrome (Rp. 12.000)</option>
                            <option value="item2">330 Monocrome (Rp. 61.000)</option>
                            <option value="item3">1090 Monocrome (Rp. 120.000)</option>
                            <option value="item4">2240 Monocrome (Rp. 400.000)</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah: </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="payment" class="col-sm-4 col-form-label">Payment </label>
                    <div class="col-sm-8">
                        <select class="form-select" name="payment" id="payment" value="{{ old('payment') }}">
                            <option selected disabled hidden>Pilih</option>
                            <option value="dana">Dana</option>
                            <option value="qris">Qris</option>
                            <option value="gopay">Gopay</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection

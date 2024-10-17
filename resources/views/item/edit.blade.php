@extends('template.app')


@section('content-dinamis')
{{-- <div class="container">
    <h1>Create</h1>
</div> --}}

<form action="{{ route('interface.ubah.proses', $Item['id'])}}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3 row">
        <label for="items" class="col-sm-2 col-form-label">Pilihan Paket: </label>
        <div class="col-sm-10">
            <select class="form-select" name="items" id="items">
                <option selected disabled hidden>Pilih</option>
                <option value="item1" {{ $Item['items'] == "item1" ? 'selected' : '' }}>60 Monocrome (Rp. 12.000)</option>
                <option value="item2" {{ $Item['items'] == "item2" ? 'selected' : '' }}>330 Monocrome (Rp. 61.000)</option>
                <option value="item3" {{ $Item['items'] == "item3" ? 'selected' : '' }}>1090 Monocrome (Rp. 120.000)</option>
                <option value="item4" {{ $Item['items'] == "item4" ? 'selected' : '' }}>2240 Monocrome (Rp. 400.000)</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $Item['jumlah'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="payment" class="col-sm-2 col-form-label">Jenis Obat: </label>
        <div class="col-sm-10">
            <select class="form-select" name="payment" id="payment">
                <option selected disabled hidden>Pilih</option>
                <option value="dana" {{ $Item['payment'] == "dana" ? 'selected' : '' }}>Dana</option>
                <option value="qris" {{ $Item['payment'] == "qris" ? 'selected' : '' }}>Qris</option>
                <option value="gopay" {{ $Item['payment'] == "gopay" ? 'selected' : '' }}>Gopay</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
@extends('template.app')


@section('content-dinamis')
{{-- <div class="container">
    <h1>Create</h1>
</div> --}}

<form action="{{ route('kelola_akun.ubah.proses', $User['id'])}}" method="POST" class="card p-5">
    {{-- untuk melindungi aplikasi dari serangan CSRF. Token ini memastikan bahwa setiap permintaan yang dibuat oleh pengguna adalah sah dan berasal dari formulir yang valid di aplikasi.  --}}
    @csrf
    {{-- mengindikasikan bahwa formulir yang sedang dikirimkan bertujuan untuk memperbarui data tertentu --}}
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
        <label for="name" class="col-sm-2 col-form-label">Nama Akun: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $User['name'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label">Roles: </label>
        <div class="col-sm-10">
            <select class="form-select" name="role" id="role">
                <option selected disabled hidden>Pilih</option>
                <option value="admin" {{ $User['role'] == "admin" ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $User['role'] == "user" ? 'selected' : '' }}>User</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Ubah email: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" value="{{ $User['email'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Ubah Password: </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection

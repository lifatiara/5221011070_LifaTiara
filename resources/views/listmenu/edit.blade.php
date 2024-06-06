@extends('layout.template')
<!-- START FORM -->
@section('konten')

<form action='{{url('listmenu/'.$data->kode)}}' method='post'>
@csrf
@method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{url('listmenu')}}' class="btn btn-secondary"><< kembali</a>
        <div class="mb-3 row">
            <label for="kode" class="col-sm-2 col-form-label">KODE</label>
            <div class="col-sm-10">
                {{$data->kode}}
                
                @if($errors->has('kode'))
                    <span class="text-danger">{{ $errors->first('kode') }}</span>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">HARGA</label>
            <div class="col-sm-10">
                <input type="number" step="0.01" class="form-control" name='harga' value="{{ $data->harga }}" id="harga">
                @if($errors->has('harga'))
                    <span class="text-danger">{{ $errors->first('harga') }}</span>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{ $data->nama }}" id="nama">
                @if($errors->has('nama'))
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                @endif
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
            </div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection

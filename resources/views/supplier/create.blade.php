@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('supplier') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Kode Supplier</label>
                    <input type="text" name="supplier_kode" class="form-control" value="{{ old('supplier_kode') }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="supplier_nama" class="form-control" value="{{ old('supplier_nama') }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Alamat Supplier</label>
                    <textarea name="supplier_alamat" class="form-control" rows="3" required>{{ old('supplier_alamat') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('supplier') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

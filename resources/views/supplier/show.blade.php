@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label><strong>Kode Supplier:</strong></label>
                <p>{{ $supplier->supplier_kode }}</p>
            </div>
            <div class="form-group">
                <label><strong>Nama Supplier:</strong></label>
                <p>{{ $supplier->supplier_nama }}</p>
            </div>
            <div class="form-group">
                <label><strong>Alamat Supplier:</strong></label>
                <p>{{ $supplier->supplier_alamat }}</p>
            </div>
            <a href="{{ url('supplier') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection

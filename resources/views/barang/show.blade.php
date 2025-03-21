@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Kode Barang</th>
                    <td>{{ $barang->barang_kode }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $barang->barang_nama }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $barang->kategori ? $barang->kategori->kategori_nama : '-' }}</td>
                </tr>
                <tr>
                    <th>Harga Beli</th>
                    <td>{{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Harga Jual</th>
                    <td>{{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                </tr>
            </table>
            <a href="{{ url('barang') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
@endsection

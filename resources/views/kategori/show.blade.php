@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Kode Kategori</th>
                    <td>{{ $kategori->kategori_kode }}</td>
                </tr>
                <tr>
                    <th>Nama Kategori</th>
                    <td>{{ $kategori->kategori_nama }}</td>
                </tr>
            </table>
            <a href="{{ url('kategori') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
@endsection

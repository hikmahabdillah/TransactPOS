@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $breadcrumb->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kategori/import') }}')" class="mt-1 btn btn-sm btn-info">Import
                    Kategori</button>
                <a href="{{ url('/kategori/export_excel') }}" class="btn btn-primary btn-sm mt-1"><i
                        class="fa fa-file-excel"></i> Export
                    Kategori</a>
                <a href="{{ url('/kategori/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export
                    Kategori</a>
                <button onclick="modalAction('{{ url('kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                    Tambah Ajax
                </button>
            </div>
        </div>
        <div class="card-body">
            {{-- <!-- Filter Kategori -->
            <div id="filter" class="form-horizontal p-2 border-bottom mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-sm row text-sm mb-0">
                            <label for="filter_kategori" class="col-md-1 col-form-label">Filter</label>
                            <div class="col-md-3">
                                <select name="filter_kategori" class="form-control form-control-sm filter_kategori">
                                    <option value="">- Semua -</option>
                                    @foreach ($kategori_filter as $kategori)
                                        <option value="{{ $kategori->kategori_id }}">{{ $kategori->kategori_nama }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Kategori</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        let tableKategori;

        $(document).ready(function() {
            tableKategori = $('#table_kategori').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('kategori/list') }}",
                    type: "POST",
                    // data: function(d) {
                    //     d.filter_kategori = $('.filter_kategori').val();
                    // }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kategori_kode',
                        width: "25%"
                    },
                    {
                        data: 'kategori_nama',
                        width: "35%"
                    },
                    {
                        data: 'aksi',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        width: "30%"
                    }
                ]
            });

            $('.filter_kategori').change(function() {
                tableKategori.draw();
            });
        });
    </script>
@endpush

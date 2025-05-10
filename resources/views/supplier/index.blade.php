@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/supplier/import') }}')" class="btn btn-sm mt-1 btn-info">Import
                    Supplier</button>
                <a href="{{ url('/supplier/export_excel') }}" class="btn btn-sm mt-1 btn-primary"><i
                        class="fa fa-file-excel"></i> Export Supplier</a>
                <a href="{{ url('/supplier/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export
                    Supplier</a>
                <button onclick="modalAction('{{ url('supplier/create_ajax') }}')"
                    class="btn btn-success btn-sm mt-1">Tambah
                    Ajax</button>
            </div>
        </div>
        <div class="card-body">
            {{-- Filter (jika diperlukan) --}}
            {{-- <div id="filter" class="form-horizontal filter-date p-2 border-bottom mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-group-sm row text-sm mb-0">
                            <label for="filter_kode" class="col-md-1 col-form-label">Filter</label>
                            <div class="col-md-3">
                                <input type="text" name="filter_kode" class="form-control form-control-sm filter_kode">
                                <small class="form-text text-muted">Kode Supplier</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- Tabel Data --}}
            <table class="table table-bordered table-sm table-striped table-hover" id="table_supplier">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
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

        let dataSupplier;

        $(document).ready(function() {
            dataSupplier = $('#table_supplier').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/supplier/list') }}",
                    type: "POST",
                    dataType: "json",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        width: '5%',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'supplier_kode',
                        className: '',
                        width: '15%',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'supplier_nama',
                        className: '',
                        width: '25%',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'supplier_alamat',
                        className: '',
                        width: '35%',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'aksi',
                        className: 'text-center',
                        width: '20%',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Optional: aktifkan filter
            // $('.filter_kode').change(function () {
            //     dataSupplier.draw();
            // });

            // Optional: pencarian manual
            $('#table_supplier_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) {
                    dataSupplier.search(this.value).draw();
                }
            });
        });
    </script>
@endpush

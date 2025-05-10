<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    // Menampilkan halaman awal daftar supplier
    public function index()
    {
        $activeMenu = 'supplier';

        $breadcrumb = (object)[
            'title' => 'Daftar Supplier',
            'list'  => ['Home', 'Supplier']
        ];

        $page = (object)[
            'title' => 'Daftar supplier yang tersedia dalam sistem'
        ];

        return view('supplier.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Digunakan oleh DataTables untuk mengambil data supplier secara AJAX
    public function list(Request $request)
    {
        $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');

        $filter_nama = $request->input('filter_nama');
        if (!empty($filter_nama)) {
            $supplier->where('supplier_nama', 'like', '%' . $filter_nama . '%');
        }

        return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                $btn  = '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode',
                'supplier_nama' => 'required|string|max:100',
                'supplier_alamat' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            SupplierModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
                'supplier_nama' => 'required|string|max:100',
                'supplier_alamat' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $supplier = SupplierModel::find($id);
            if ($supplier) {
                $supplier->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = SupplierModel::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    // Menampilkan form tambah supplier
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Supplier',
            'list'  => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah supplier baru'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'required|string|max:255',
        ]);

        SupplierModel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
    }

    // Menampilkan detail supplier
    public function show(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan form edit supplier
    public function edit(string $id)
    {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'supplier' => $supplier,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data supplier
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'required|string|max:255',
        ]);

        SupplierModel::find($id)->update([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
    }

    // Menghapus data supplier
    public function destroy(string $id)
    {
        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id);
            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait');
        }
    }

    public function import()
    {
        return view('supplier.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_supplier' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors()
                ]);
            }

            $file = $request->file('file_supplier');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'supplier_kode'  => $value['A'],
                            'supplier_nama'  => $value['B'],
                            'supplier_alamat' => $value['C'],
                            'created_at'     => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    SupplierModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status'  => true,
                    'message' => 'Data supplier berhasil diimport'
                ]);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Tidak ada data supplier yang diimport'
            ]);
        }

        return redirect('/');
    }

    public function export_excel(Request $request)
    {
        // Get supplier data to export (with optional filtering)
        $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->orderBy('supplier_id');

        // Apply the same filter as in list() method
        $filter_nama = $request->input('filter_nama');
        if (!empty($filter_nama)) {
            $suppliers->where('supplier_nama', 'like', '%' . $filter_nama . '%');
        }

        $suppliers = $suppliers->get();

        // Load Excel library
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Supplier');
        $sheet->setCellValue('C1', 'Nama Supplier');
        $sheet->setCellValue('D1', 'Alamat Supplier');
        $sheet->setCellValue('E1', 'ID Supplier');

        // Make headers bold
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Populate data
        $no = 1;
        $row = 2;
        foreach ($suppliers as $supplier) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $supplier->supplier_kode);
            $sheet->setCellValue('C' . $row, $supplier->supplier_nama);
            $sheet->setCellValue('D' . $row, $supplier->supplier_alamat);
            $sheet->setCellValue('E' . $row, $supplier->supplier_id);
            $row++;
            $no++;
        }

        // Auto-size columns
        foreach (range('A', 'E') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set sheet title
        $sheet->setTitle('Data Supplier');

        // Create writer and set headers for download
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Supplier ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf(Request $request)
    {
        $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->orderBy('supplier_id');

        if ($request->filter_nama) {
            $suppliers->where('supplier_nama', 'like', '%' . $request->filter_nama . '%');
        }

        $suppliers = $suppliers->get();

        $pdf = Pdf::loadView('supplier.export_pdf', ['suppliers' => $suppliers]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();
        return $pdf->stream('Data Supplier ' . date('Y-m-d H:i:s') . '.pdf');
    }
}

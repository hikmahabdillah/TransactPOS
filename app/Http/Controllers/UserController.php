<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // tambah data user dengan Eloquent Model
        $data = [
            'nama' => 'Pelanggan Pertama',
        ];

        UserModel::where('username', 'customer-1')->update($data); // update data

        // akses userMOdel
        $user = UserModel::all(); //ambil semua data dari table m_user
        return view('user', ['data' => $user]);
    }

    // soal praktikum sebelumnya
    public function profile($id, $name)
    {
        return view('user.profile', ['id' => $id, 'name' => $name]);
    }
}

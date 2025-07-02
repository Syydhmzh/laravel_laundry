<?php

namespace App\Http\Controllers;

use App\Models\Count;
use Illuminate\Http\Request;

class BelajarController extends Controller
{

    public function index()
    {
        return view('aritmatika');
    }
    public function tambah()
    {
        $title = "aritmatika";
        $jumlah = 0;
        $error = null;
        return view('tambah', compact('title', 'jumlah', 'error'));
    }
    public function tambahAction(Request $request)
    {
        $request->validate(
            [
                'angka1' => 'numeric',
                'angka2' => 'numeric'
            ]
        );


        $angka1 = $request->angka1;
        $angka2 = $request->input('angka2');
        $jumlah = null;
        $error = null;
        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            $error = "data Harus numeric";
        } else {
            $jumlah = $angka1 + $angka2;
        }
        //INSERT INTO counts (jenis, angka1, angka2, hasil) VALUES ($jenis, $angka1, $angka2, $jumlah)
        Count::create([
            'jenis' => $request->jenis,
            'angka1' => $angka1,
            'angka2' => $angka2,
            'hasil' => $jumlah
        ]);
        return view('tambah', compact('jumlah'));
    }
    // public function kurangAction (Request $request) {
    //     $angka1 = $request->angka1;
    //     $angka2 =$request->angka2;


    // }

    public function viewHitungan()
    {
        $counts = Count::all();
        return view('data-hitungan', compact('counts'));
    }
    public function editDataHitung(string $id)
    {
        $title = "Edit Penambahan";
        $error = null;
        $jumlah = null;

        $count = Count::findOrFail($id);
        $jenis = $count->jenis;

        return view('tambah.edit', compact('title', 'error', 'jumlah', 'count'));
    }

    public function updateTambahan(Request $request, string $id)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;

        // SELECT * FROM counts WHERE id = $id
        // Update From counts SET ........ WHERE id=$id
        $count = $angka1 + $angka2;
        $data = Count::findOrFail($id);
        $data->jenis = $request->jenis;
        $data->angka1 = $angka1;
        $data->angka2 = $angka2;
        $data->save();
        // Count::Update([
        // 'jenis' => $request->jenis,
        // ]);
        return redirect()->route('edit.data-hitung', $id)->with(['status' => 'data Berhasil ditambahkan']);
    }

    public function softDeleteTambahan(string $id)
    {
        // SELECT * FROM counts WHERE id=$id
        $sDel = Count::findOrFail($id);
        $sDel->delete();

        return redirect()->route('data.hitungan', $id)->with(['status' => 'data dihapus sementara']);
    }

    public function update($name)
    {
        return "selamat datang $name";
    }
}
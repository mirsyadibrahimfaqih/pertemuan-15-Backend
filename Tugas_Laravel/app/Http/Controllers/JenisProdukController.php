<?php

namespace App\Http\Controllers;


use App\Models\jenisProduk;
use Illuminate\Http\Request;
use Illuminate\support\facades\Validator;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Digunakan untuk menampilkan data Jenis Produk
        $jenis = jenisProduk::all();
        if (count($jenis)) {
            $hasil = [
                "message" => "Data Jenis Produk",
                "data" => $jenis
            ];

            return response()->json($hasil, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ada",
                "data" => $jenis
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Digunakan Untuk Membuat Data
        return view('JenisProduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis' => 'required|string|max:64',
        ]);
        if ($validator->fails()) {
            $fails = [
                "message" => "Data Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        } else {
            $jenis = jenisProduk::create($request->all());
            $succes = [
                "message" => "Data Jenis Produk Berhasil",
                "data" => $jenis
            ];
            return response()->json($succes, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $jenis = jenisProduk::find($id);
        if (!$jenis) {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ada",
                "data" => $jenis
            ];
            return response()->json($fails, 404);
        }

        $succes = [
            "message" => "Data Jenis Produk",
            "data" => $jenis
        ];
        return response()->json($succes, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $jenis = JenisProduk::find($id);
    
    if (!$jenis) {
        $fails = [
            "message" => "Data Jenis Produk Tidak Ditemukan",
            "data" => null
        ];
        return response()->json($fails, 404);
    }
    return view('jenis_produk.edit', compact('jenis'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Digunakan Untuk Mengupdate Data
        $validator = Validator::make($request->all(), [
            'nama_jenis' => 'required|string|max:64',
        ]);
        if ($validator->fails()) {
            $fails = [
                "message" => "Data Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
        }

        $jenis = JenisProduk::find($id);
        if ($jenis) {
            $jenis->update($request->all());
            $succes = [
                "message" => "Data Jenis Produk Berhasil",
                "data" => $jenis
            ];
            return response()->json($succes, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ada",
                "data" => $jenis
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Digunakan Untuk menghapus data
        $jenis = jenisProduk::where('id', $id)->first();
        if (isset($jenis)) {
            $jenis->delete();
            $succes = [
                "message" => "Data Jenis Produk Berhasil",
                "data" => $jenis
            ];
            return response()->json($succes, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ada",
                "data" => $jenis
            ];
            return response()->json($fails, 404);
        }
    }
}

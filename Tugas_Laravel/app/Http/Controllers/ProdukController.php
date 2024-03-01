<?php

namespace App\Http\Controllers;
use App\Models\produk; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Digunakan Untuk Menampilkan Data Produk
        $produk = Produk::all();
        if (isset($produk)) {
            $hasil = [
                "message" => "Data Produk",
                "data" => $produk
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                "message" => "Data Produk Tidak Ada",
                "data" => $produk
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:64',
            'stok' => 'required|integer',
            'harga' => 'required|string|max:64',
            'id_jenis' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $fails = [
                "message" => "Data Tidak Valid",
                "data" => $validator->errors()
            ];

            return response()->json($fails, 400);
        } else {
            $produk = Produk::create($request->all());
            $succes = [
                "message" => "Data Produk Berhasil",
                "data" => $produk
            ];
            return response()->json($succes, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::find($id);
        
        if (!$produk) {
            $fails = [
                "message" => "Data Produk Tidak Ditemukan",
                "data" => null
            ];
            return response()->json($fails, 404);
        }
    
        $hasil = [
            "message" => "Detail Produk",
            "data" => $produk
        ];
        return response()->json($hasil, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $produk = Produk::find($id);
    
    if (!$produk) {
        $fails = [
            "message" => "Data Produk Tidak Ditemukan",
            "data" => null
        ];
        return response()->json($fails, 404);
    }
    return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Digunakan Untuk Mengupdate Data
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:64',
            'stok' => 'required|integer',
            'harga' => 'required|string|max:64',
            'id_jenis' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $fails = [
                "message" => "Data Tidak Valid",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 400);
    }

    $produk = Produk::find($id);
    if ($produk) {
        $produk->update($request->all());
        $succes = [
            "message" => "Data Produk Berhasil",
            "data" => $produk
        ];
        return response()->json($succes, 200);
    } else {
        $fails = [
            "message" => "Data Produk Tidak Ada",
            "data" => $produk
        ];
        return response()->json($fails, 404);
    }
    }  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Digunakan Untuk Menghapus Data
        $produk = Produk::where('id', $id)->first();
        if (isset($produk)) {
            $produk->delete();
            $succes = [
                "message" => "Data Produk Berhasil",
                "data" => $produk
            ];
            return response()->json($succes, 200);
        } else {
            $fails = [
                "message" => "Data Produk Tidak Ada",
                "data" => $produk
            ];
            return response()->json($fails, 404);
        }
    }
}

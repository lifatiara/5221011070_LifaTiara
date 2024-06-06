<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data=menu::where('kode','like',"%$katakunci%")
                     ->orWhere('harga','like',"%$katakunci%")
                     ->orWhere('nama','like',"%$katakunci%")
                     ->paginate($jumlahbaris);
        }else{
            $data = menu::orderBy('kode','desc')->paginate(5);
        }
        return view('listmenu.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listmenu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Set flash message
        Session::flash('kode', $request->kode);
        Session::flash('harga', $request->harga);
        Session::flash('nama', $request->nama);
        
        // Validate request
        $request->validate([
            'kode' => 'required|numeric|unique:menu,kode',
            'harga' => 'required',
            'nama' => 'required',
        ], [
            'kode.required' => 'KODE Wajib Diisi',
            'kode.numeric' => 'KODE Wajib Angka',
            'kode.unique' => 'KODE Sudah Ada',
            'harga.required' => 'HARGA Wajib Diisi',
            'nama.required' => 'NAMA Wajib Diisi',
        ]);

        // Prepare data
        $data = [
            'kode' => $request->kode,
            'harga' => $request->harga,
            'nama' => $request->nama,
        ];

        // Create new menu entry
        Menu::create($data);

        // Return response
        return redirect()->to('listmenu')->with('success','Berhasil Menambahkan Data'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $data = menu::where('kode',$id)->first();
      return view('listmenu.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'harga' => 'required',
            'nama' => 'required',
        ], [
            'harga.required' => 'HARGA Wajib Diisi',
            'nama.required' => 'NAMA Wajib Diisi',
        ]);
        $data = [
            'harga' => $request->harga,
            'nama' => $request->nama,
        ];
        Menu::where('kode',$id)->update($data);
        return redirect()->to('listmenu')->with('success','Berhasil Update Data'); 
    }
    public function destroy(string $id)
    {
       menu::where('kode',$id)->delete();
        return redirect()->to('listmenu')->with('success','Berhasil Hapus');
    }
    }
    /**
     * Remove the specified resource from storage.
     */



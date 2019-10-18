<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori_Pemasukan as KPM;
use App\Kategori_Pengeluaran as KPR;

class Kategori extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_kategori_pemasukan = KPM::all();
        $list_kategori_pengeluaran = KPR::all();
        return view('contents.kategori.list_kategori',['list_kategori_pemasukan'=>$list_kategori_pemasukan,'list_kategori_pengeluaran'=>$list_kategori_pengeluaran,'title'=>'List Kategori']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contents.kategori.form_kategori',['title'=>'Tambah Kategori']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ]);
        if($request->tipe=='pemasukan'){
            $store = new KPM;
        }else{
            $store = new KPR;
            
        }
        $store->nama_kategori = $request->kategori;
        $store->deskripsi = $request->deskripsi;
        $store->save();
        return redirect('kategori/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $validation = $request->validate([
            'tipe'=>'required'
        ]);
        if($request->tipe=='pemasukan'){
            $kategori = KPM::find($id);
        }elseif($request->tipe=='pengeluaran'){
            $kategori = KPR::find($id);
        }else{
            return redirect('kategori');
        }
        return view('contents.kategori.edit_kategori',['title'=>'Edit Kategori','kategori'=>$kategori,'tipe'=>$request->tipe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ]);
        if($request->tipe=='pemasukan'){
            $update = KPM::find($id);
        }else{
            $update = KPR::find($id);
            
        }
        $update->nama_kategori = $request->kategori;
        $update->deskripsi = $request->deskripsi;
        $update->save();
        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $validation = $request->validate([
            'tipe'=>'required'
        ]);
        if($request->tipe=='pemasukan'){
            $cek = KPM::find($id)->pemasukan()->count();
            if($cek==0){
                KPM::destroy($id);
                $alert = 'Berhasil';
            }else{
                $alert = 'Gagal';
            }       
            return back()->with('alert',$alert);     
        }else{
            $cek = KPR::find($id)->pengeluaran->count();
            if($cek==0){
                KPR::destroy($id);
                $alert = 'Berhasil';
            }else{
                $alert = 'Gagal';
            } 
            return back()->with('alert',$alert);           
        }
    }
}

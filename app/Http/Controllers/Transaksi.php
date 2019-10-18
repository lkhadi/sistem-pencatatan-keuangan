<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemasukan;
use App\Kategori_Pemasukan as KPM;
use App\Kategori_Pengeluaran as KPR;
use App\Pengeluaran;

class Transaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->has('_token')){
            $pemasukan = Pemasukan::whereDate('updated_at','>=',$request->mulai)->whereDate('updated_at','<=',$request->akhir)->get();
            $pengeluaran = Pengeluaran::whereDate('updated_at','>=',$request->mulai)->whereDate('updated_at','<=',$request->akhir)->get();
            $caption = 'Tanggal '.date('d F Y',strtotime($request->mulai)).' - '.date('d F Y',strtotime($request->akhir));
        }else{
            $pemasukan = Pemasukan::whereMonth('updated_at','=',date('m'))->get();
            $pengeluaran = Pengeluaran::whereMonth('updated_at','=',date('m'))->get();
            $caption = 'Bulan '.date('F');
        }
        $total_masuk = Pemasukan::sum('pemasukan');
        $total_keluar = Pengeluaran::sum('pengeluaran');
        $saldo = $total_masuk - $total_keluar;
        return view('contents.transaksi.list_transaksi',['title'=>'List Transaksi','saldo'=>$saldo,'pemasukan'=>$pemasukan,'pengeluaran'=>$pengeluaran,'caption'=>$caption]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori_pemasukan = KPM::all();
        $kategori_pengeluaran = KPR::all();
        return view('contents.transaksi.form_transaksi',['title'=>'Tambah Transaksi','kategori_pemasukan'=>$kategori_pemasukan,'kategori_pengeluaran'=>$kategori_pengeluaran]);
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
            'jenis_transaksi' => 'required',
            'kategori' => 'required',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);

        if($request->jenis_transaksi=='pemasukan'){
            $store = new Pemasukan;
            $store->pemasukan = $request->nominal;
        }else{
            $store = new Pengeluaran;
            $store->pengeluaran = $request->nominal;
        }
        $store->id_kategori = $request->kategori;
        $store->deskripsi = $request->deskripsi;
        $store->save();
        return redirect('transaksi/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'tipe'=>'required'
        ]);
        if($request->tipe=='pemasukan'){
            $transaksi = Pemasukan::find($id);
            $kategori = KPM::all();
        }elseif($request->tipe=='pengeluaran'){
            $transaksi = Pengeluaran::find($id);
            $kategori = KPR::all();
        }else{
            return redirect('transaksi');
        }
        return view('contents.transaksi.edit_transaksi',['title'=>'Edit Transaksi','transaksi'=>$transaksi,'tipe'=>$request->tipe,'kategori'=>$kategori]);
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
        $request->validate([
            'tipe' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'nominal' => 'required'
        ]);

        if($request->tipe=='pemasukan'){
            $update = Pemasukan::find($id);
            $update->pemasukan = $request->nominal;
        }elseif($request->tipe=='pengeluaran'){
            $update = Pengeluaran::find($id);
            $update->pengeluaran = $request->nominal;
        }else{
            return redirect('transaksi');
        }
        $update->id_kategori = $request->kategori;
        $update->deskripsi = $request->deskripsi;
        $update->save();
        return redirect('transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate(['tipe'=>'required']);
        if($request->tipe=='pemasukan'){
            Pemasukan::destroy($id);
        }elseif($request->tipe=='pengeluaran'){
            Pengeluaran::destroy($id);
        }
        return redirect('transaksi');
    }
}

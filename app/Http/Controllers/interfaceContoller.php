<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class interfaceContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Item = Item::all();
        return view('pages.interface', compact('Item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.zzz');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items'=> 'required',
            'jumlah' => 'required | numeric',
            'payment' => 'required'
        ], [
            'items.required' => 'Jenis Item Harus Dipilih',
            'jumlah.required' => 'Jumlah Harus Diisi',
            'jumlah.numeric' => 'Jumlah Harus Angka',
            'payment.required' => 'Metode Pembayaran Harus Dipilih'
        ]);

        Item::create($request->all());
        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Item = Item::find($id);
        return view('item.edit', compact('Item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'items'=> 'required',
            'jumlah' => 'required | numeric',
            'payment' => 'required'
        ]);

        Item::where('id', $id)->update([
            'items' => $request->items,
            'payment' => $request->payment,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('interface.data')->with('success', 'Berhasil Mengubah Data pembelian!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Membatalkan pembelian!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderBy = $request->sort_name ? 'name' : 'name';
        // appends : menambahkan/membawa request pagination (data-data pagination tidak berubah meskipun ada request)
        $User = User::where('name', 'LIKE', '%'.$request->cari.'%')->orderBy($orderBy, 'ASC')->simplePaginate(5)->appends($request->all());
        // compact() -> mengirimkan data ($) agar data $nya bisa dipake di blade
        return view('pages.kelola_akun', compact('User'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'role' => 'required',
            'email' => 'required|max:100|unique:users',
            'password' => 'required|max:100'
        ] , [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Maksimal karakter harus 100 karakter',
            'role.required' => 'Harap memilih Role',
            'email.required' => 'Email harus diisi',
            'email.max' => 'Maksimal karakter harus 100 karakter',
            'password.required' => 'password harus diisi',
            'password.max' => 'Maksimal karakter harus 20 karakter'
        ]);

        User::create($request->all());


        return redirect()->back()->with('success', 'Berhasil Menambah Akun baru!');

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
        $User = User::find($id); //mencari user yang ID-nya sesuai dengan parameter yang diberikan dan mengembalikan data user tersebut dalam bentuk objek.
        return view('Users.edit', compact('User')); //Baris ini mengarahkan pengguna ke view (halaman) Users.edit, yang berisi form untuk mengedit data user.

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'role' => 'required',
            'email' => 'required|max:100'
        ]);
    
        // Ambil data user dari database
        // membantu mengvalidasi bahwa data tersebut masih ada saat di update,memberikan jaminan bahwa user yang ingin di-update memang ada dan masih valid.
        $user = User::find($id);
    
        // Update data user dengan data baru dari request
        $data = [
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email
        ];
    
        // Jika password diisi, tambahkan password yang sudah dienkripsi ke array $data
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);  // Password di-enkripsi
        }
    
        // Update data user di database
        $user->update($data);
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Mengubah Akun!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Akun!');

    }
}

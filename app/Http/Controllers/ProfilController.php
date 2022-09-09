<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        return view('profil.index', compact('data'));
    }

    public function update(Request $request)
    {
        $data = Auth::user();
        $this->validate($request,
        [
            'username' => 'required|min:5|max:20|unique:users,username,'.$data->id.',id',
            'email' => 'required|email|unique:users,email,'.$data->id.',id',
            'nama_lengkap' => 'required|string|max:255',
            'lpk' => 'required',
        ]);
        $data->username = $request->username;
        $data->name = $request->nama_lengkap;
        $data->email = $request->email;
        $data->lpk = $request->lpk;
        $data->save();

        return redirect()->route('profil.index')->with('alertSuccess', 'Data berhasil diperbarui.');
    }

    public function indexUpdatePassword()
    {
        $data = Auth::user();
        return view('profil.ubah-password', compact('data'));
    }

    public function updatePassword(Request $request)
    {
        $data = Auth::user();
        if(Hash::check($request->kata_sandi_sekarang,$data->password)){
            $this->validate($request,
            [
                'kata_sandi_sekarang' => 'required',
                'kata_sandi_baru' => 'required|string|min:8|confirmed|max:191',
            ]);
            $data->password = Hash::make($request->kata_sandi_baru);
            $data->save();
            return redirect()->route('profil.indexUpdatePassword')->with('alertSuccess', 'Kata sandi berhasil diubah.');
        }
        else{
            $this->validate($request,
            [
                'kata_sandi_sekarang' => 'required',
                'kata_sandi_baru' => 'required|string|min:8|confirmed|max:191',
            ]);
            return redirect()->back()->with('error', 'Kata sandi tidak sesuai.');
        }
    }
}

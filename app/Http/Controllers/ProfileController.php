<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $akun = Auth::user();
        return view('profile.index',compact('user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();
        
        // Mengembalikan view 'profile' dengan data pengguna
        return view('profile.index', compact('user'));
    }


    public function update(Request $request)
    {
        // Menjalankan transaksi database
        DB::transaction(function () use ($request) {
            $user = Auth::user();

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        });

        return redirect('/profile')->with('status', 'Akun berhasil diubah!');
    }
}

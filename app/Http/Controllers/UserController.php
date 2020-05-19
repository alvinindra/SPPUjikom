<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Spp;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Petugas;
use App\Models\Pembayaran;
use App\User;

class UserController extends Controller
{
    public function manage_users()
    {
        if (Auth::user()->level == "administrator") {
            $users = User::where('level', '!=', 'siswa')->orderBy('created_at', 'asc')->paginate(5);
            return view('/admin/manage_users', ['users' => $users]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function create_user()
    {
        if (Auth::user()->level == "administrator") {
            return view('/admin/form_users');
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function store_user(Request $request)
    {
        if (Auth::user()->level == "administrator") {
            $request->validate([
                'nama_users'    => 'required|max:255',
                'username'      => 'required|min:8',
                'password'      => 'required|confirmed|min:8',
                'email'         => 'required|email|unique:users',
                'level'         => 'required|in:administrator,petugas'
            ]);

            $strRandom = Str::random(100);
            $userCreate = User::create([
                'nama_users'    => $request->nama_users,
                'username'      => $request->username,
                'password'      => $request->password,
                'email'         => $request->email,
                'level'         => $request->level,
                'api_token'     => $strRandom,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            $petugasCreate = Petugas::create([
                'nama_petugas'  => $request->nama_users,
                'username'      => $request->username,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            if ($userCreate && $petugasCreate) {
                return redirect()->route('admin.manage.users')->with([
                    'type' => 'success',
                    'msg' => 'Pengguna ditambahkan'
                ]);
            } else {
                return redirect()->route('admin.manage.users')->with([
                    'type' => 'danger',
                    'msg' => 'Oopss.., Terjadi Kesalahan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function edit_user(User $user)
    {
        if (Auth::user()->level == "administrator") {
            return view('/admin/form_users', ['user' => $user]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function update_user(Request $request, User $user)
    {
        if (Auth::user()->level == "administrator") {
            $request->validate([
                'nama_users'    => 'required|max:255',
                'username'      => 'required|min:8',
                'email'         => 'required|email|unique:users,email,' . $user->id,
                'password'      => 'nullable|confirmed|min:8',
                'level'         => 'required|in:administrator,petugas'
            ]);

            if ($request->password != null) {
                $user->fill($request->input());
            } else {
                $user->fill($request->except('password'));
            }

            if ($user->save()) {
                return redirect()->route('admin.manage.users')->with([
                    'type' => 'success',
                    'msg' => 'Pengguna diubah'
                ]);
            } else {
                return redirect()->route('admin.manage.users')->with([
                    'type' => 'danger',
                    'msg' => 'Oopss.., Terjadi Kesalahan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function delete_user(User $user)
    {
        if (Auth::user()->level == "administrator") {
            if ($user->delete()) {
                return redirect()->route('admin.manage.users')->with([
                    'type' => 'success',
                    'msg' => 'Pengguna dihapus'
                ]);
            } else {
                return redirect()->route('admin.manage.users')->with([
                    'type' => 'danger',
                    'msg' => 'Oopss.., Terjadi Kesalahan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        abort_if(!Gate::allows('list-user'), 403, 'You are not allowed to view this page!');
        return view('user.index', [
            'users' => User::paginate(3)
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'roles'      => 'required',
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'min:8', 'confirmed']
        ]);
        // dd($request->all());
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $roles = $request->get('roles');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->roles = $roles;
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('user.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        // dd($id);
        // Mengembalikan ke view edit beserta data user yang akan di edit
        return view('user.edit', [
            'user' => User::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            'name'      => 'required',
            'roles'      => 'required',
            'email'     => ['required', 'email', 'unique:users,email,' . $id],
            'password'  => ['nullable', 'min:8', 'confirmed']
        ]);

        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $roles = $request->get('roles');

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->roles = $roles;
        if(!empty($password)){
            $user->password = Hash::make($password);
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()-> route('user.index')->with('success', 'Data Berhasil Dihapus!');
    }
}

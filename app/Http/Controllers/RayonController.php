<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\User;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('rayons');
        if ($search) {
            $rayons = rayon::where('rayon', 'like', '%' . $search . '%')->simplePaginate(5);
        } else {
            $rayons = rayon::simplePaginate(10);
        }
        return view('rayon.indexRayon', compact('rayons'));
    }

    public function create()
    {
        $users = User::all();
        return view("rayon.createRayon", compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'user_id' => 'required',
        ]);

        rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id->name,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil Menambah !!! ');
    }

    public function show(rayon $rayon)
    {
        //
    }

    public function edit($id)
    {
        $rayon = rayon::find($id);
        $users = User::where('role', 'ps')->get();
        return view('rayon.edit', compact('rayon', 'users'));
    }

    public function update(Request $request, $id)
    {
        rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data pengguna !!!');
    }
 
    public function destroy($id)
    {
        rayon::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
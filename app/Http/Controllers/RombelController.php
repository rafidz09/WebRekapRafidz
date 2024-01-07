<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('rombels');
        if ($search) {
            $rombels = Rombel::where('rombel', 'like', '%' . $search . '%')->simplePaginate(5);
        } else {
            $rombels = Rombel::simplePaginate(10);
        }
        return view('rombel.index', compact('rombels'));
    }

    public function create()
    {
        return view('rombel.createRombel'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'rombel'=> 'required|min:3',
        ]);

        rombel::create([
        'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil menambahkan data rombel!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombels = rombel::where('id', $id)->first();
        return view('rombel.edit', compact('rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rombel'=> 'required|min:3',
            ]);
    
            rombel::where ('id', $id)->update([
            'rombel' => $request->rombel,
            ]);
    
            return redirect()->route('rombel.index')->with('success', 'Berhasil mengubah data rombel!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        rombel::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}

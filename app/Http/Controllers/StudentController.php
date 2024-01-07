<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\student;
use App\Models\rombel;
use App\Models\rayon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Student::query();

    // Menambahkan kondisi pencarian jika parameter 'search' diatur
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('nis', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        });
    }

    $students = $query->with('rombel', 'rayon')->paginate(10);

    return view('student.admin.index', compact('students', 'search'));
}

    public function data() {
        $rayon = rayon::where('user_id', Auth::user()->id)->pluck('id');
        $siswa = student::whereIn('rayon_id', $rayon)->get();
 
        return view('student.ps.data', compact('siswa'));
    }

    public function create()
    {
        $rayons = rayon::all();
        $rombels = rombel::all();
        return view("student.admin.create", compact('rombels', 'rayons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'=> 'required',
            'name'=> 'required',
            'rombel_id'=> 'required',
            'rayon_id'=> 'required',
        ]);

        $rayon = rayon::where('rayon', $request->rayon)->first();
        $rombel = rombel::where('rombel', $request->rombel)->first();

        Student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data siswa!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(student $student, $id)
    {
        $student = Student::find($id);
        $rayons = Rayon::all(); 
        $rombels = Rombel::all(); 

        return view('student.admin.edit', compact('student', 'rayons', 'rombels'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nis' => 'required',
        'name' => 'required',
        'rombel_id' => 'required',
        'rayon_id' => 'required',
    ]);

    $student = Student::find($id);

    if (!$student) {
        return redirect()->route('admin.student.index')->with('error', 'Data pengguna tidak ditemukan');
    }

    $student->update([
        'nis' => $request->nis,
        'name' => $request->name,
        'rombel_id' => $request->rombel_id,
        'rayon_id' => $request->rayon_id,
    ]);

    return redirect()->route('admin.student.index')->with('success', 'Berhasil mengubah data pengguna !!!');
}


    public function destroy($id)
    {
        student::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function dashboard()
    {
        $name_rayon = Rayon::where('user_id', Auth::user()->id)->pluck('rayon')->first();

        $rayons = Rayon::where('user_id', Auth::user()->id)->pluck('id');
        $students = Student::whereIn('rayon_id', $rayons)->pluck('id');
        $lates = Late::whereIn('student_id', $students)
            ->whereDate('date_time_late', Carbon::today())
            ->get();
        $todayLateCount = $lates->count();
        
        $student = Student::whereIn('rayon_id', $rayons)->count();

        dd($name_rayon, $todayLateCount, $student);
        return view('index', compact('todayLateCount', 'student', 'name_rayon'));
    }
}

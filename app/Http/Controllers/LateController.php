<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExports;
use App\Exports\Siswa1Export;
use App\Models\late;
use App\Models\student;
use App\Models\rayon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;
use Carbon\Carbon;

class LateController extends Controller
{
    //Bagian Late Admin
        public function index(Request $request)
        {
            $search = $request->input('users');

        $users = Late::with('student');

            if ($search) {
            $users->whereHas('student', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $users = $users->simplePaginate(10);

        return view('user.admin.indexUser', compact('users'));
        }

        public function exportExcel(){
            $role = auth()->user()->role;
    
            if ($role === 'admin') {
                return Excel::download(new SiswaExports, 'keterlambatan.xlsx');
            } else {
                $userIdLogin = Auth::id();
                $rayonIdLogin = rayon::where('user_id', $userIdLogin)->value('id');
    
                return Excel::download(new Siswa1Export($userIdLogin, $rayonIdLogin), 'keterlambatan.xlsx');
            }
        }

        public function downloadPDF($id) {
            $late = Late::with('student')->find($id);
        
            $late = [
                'late' => $late
            ];
        
            $pdf = PDF::loadView('user.admin.download-pdf', $late);
        
            return $pdf->download('Data_Keterlambatan.pdf');
        }
    

    public function home() {
        $users = late::with('student')->get();  
    }

    public function create()
    {   
        $student = student::all();
        return view('user.admin.createUser', compact('student')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_lite'=> 'required',
            'information'=> 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = time().'.'.$request->bukti->extension();
        $request->bukti->move(public_path('uploads'), $image);

        late::create([
        'student_id' => $request->student_id,
        'date_time_lite' => $request->date_time_lite,
        'information' => $request->information,
        'bukti' => $image,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data keterlambatan!');
    }


    public function show($id)
{
    $student = Student::find($id);

    if (!$student) {
        abort(404);
    }

    $lates = Late::with('student')
        ->where('student_id', $id)
        ->get();

    return view('user.admin.show', compact('student', 'lates'));
}

    public function edit($id)
    {
        $student = student::find($id);
        return view('user.admin.editUser', compact('student'));
    }

    public function update(Request $request, $id)
{
    $student = Student::find($id);

    if (!$student) {
        abort(404); 
    }

    $request->validate([
        'name' => 'required', // Ubah ke 'name' sebagai nama field yang benar
        'date_time_lite'=> 'required',
        'information'=> 'required',
        'bukti' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('bukti')) {
        $image = time().'.'.$request->bukti->extension();
        $request->bukti->move(public_path('uploads'), $image);
        $student->bukti = $image;
    }

    $student->update([
        'name' => $request->name,
        'date_time_lite' => $request->date_time_lite,
        'information' => $request->information,
    ]);

    return redirect()->route('admin.user.index')->with('success', 'Berhasil mengubah data keterlambatan !!!');
}

    public function destroy($id)
    {
        late::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function rekap() {
        $late = late::all();
        $student = late::with('student')->simplePaginate(10);
        $group  = $late->groupBy('student.nis');
        return view('user.admin.rekap', compact('late', 'student', 'group'));
    }

    //Bagian Late Ps

    public function data() {
        $rayonId = rayon::where('user_id', Auth::user()->id)->pluck('id');
        $siswa = student::whereIn('rayon_id', $rayonId)->get();
        $lates = late::whereIn('student_id', $siswa->pluck('id'))->with('student')->get();
        $groupLates = $lates->groupBy('student.nis');
        return view('user.ps.data', compact('lates', 'groupLates', 'siswa'));
    }

    public function rekap1() {
        {
            $rayonId = rayon::where('user_id', Auth::user()->id)->pluck('id');
            $siswa = student::whereIn('rayon_id', $rayonId)->get();
            $lates = late::whereIn('student_id', $siswa->pluck('id'))->with('student')->get();
            $groupLates = $lates->groupBy('student.nis');
            return view('user.ps.rekap1', compact('lates', 'groupLates', 'siswa'));
        }
    }

    public function show1($id)
{
    $student = Student::find($id);

    if (!$student) {
        abort(404);
    }

    $lates = Late::with('student')
        ->where('student_id', $id)
        ->get();

    return view('user.admin.show', compact('student', 'lates'));
}

public function downloadPDF1($id) {
    $late = Late::find($id); 

    $late = [
        'late' => $late
    ];

    $pdf = PDF::loadView('user.ps.download-pdf', $late);

    return $pdf->download('Data_Keterlambatan.pdf');
}

}








@extends('layouts.template')

@section('content')
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6">Detail Data Keterlambatan</h2>
        
        <div class="flex justify-between items-center bg-gray-200 p-4 mb-6">
            <div class="text-lg">
                <p class="text-gray-600">{{ $student->name }} |{{ $student->nis }} | {{ $student->rombel->rombel }} | {{ $student->rayon->rayon }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($lates as $late)
                <div class="bg-white rounded overflow-hidden shadow-lg">
                    <img class="w-full h-48 object-cover" src="{{ asset('uploads/' . $late->bukti) }}" alt="Bukti Keterlambatan">
                      
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">Keterlambatan Ke-{{ $loop->iteration }}</div>
                        <p class="text-gray-700 text-base">{{ $late->date_time_late }}</p>
                        <p class="text-gray-700 text-base">{{ $late->information }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <div class="py-4">
        <div class="rounded-lg bg-white/5 p-6 text-white">
            <h1 class="text-2xl font-bold border-b border-white/30 pb-2">Student Study Results</h1>
        </div>
        
        <div class="p-6 bg-gray-100">
    {{-- @foreach($semesters as $semesterName => $grades) --}}
    
    <div class="mb-8 bg-white shadow-sm border border-gray-200">
        
        <div class="p-3 border-b border-gray-200">
            {{-- <h3 class="font-bold text-blue-900">IP Semester: {{ $grades[avg('score')] }}</h3> --}}
            {{-- <h3 class="font-bold text-blue-900">IP Semester: {{ collect($grades)->avg('score') }}</h3>    --}}
            <h3 class="font-bold text-blue-900">IP Semester: 99</h3>
            {{-- <p class="text-sm font-semibold">Semester: {{ $semesterName }}</p> --}}
            <p class="text-sm font-semibold">Semester: 2</p>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-emerald-700 text-white text-sm">
                    <th class="p-2 border border-emerald-800">No</th>
                    <th class="p-2 border border-emerald-800">Code</th>
                    <th class="p-2 border border-emerald-800">Subject</th>
                    <th class="p-2 border border-emerald-800 text-center">Credit</th>
                    <th class="p-2 border border-emerald-800 text-center">Score</th>
                    <th class="p-2 border border-emerald-800 text-center">Grade Letter</th>
                    <th class="p-2 border border-emerald-800 text-center">Grade Point</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @foreach ($grades as $index => $grade)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2 border text-center">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{$grade['subject_code']}}</td>
                    <td class="p-2 border">{{ $grade['subject_name'] }}</td>
                    <td class="p-2 border text-center">{{ $grade['credits'] }}</td>
                    <td class="p-2 border text-center">{{ number_format($grade['score'], 2) }}</td>
                    <td class="p-2 border text-center font-bold">{{ $grade['grade_letter'] }}</td>
                    <td class="p-2 border text-center">{{ $grade['grade_point'] }}</td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{-- @endforeach --}}

</div>
    </div>
</x-layout>
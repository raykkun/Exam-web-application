<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>
    

    <div class="text-white py-8 max-w-screen-md border-b border-white/30">
        
        <div class="grid grid-cols-2 gap-4 mt-4">
            <p class="mb-1 text-3xl tracking-tight font-bold text-white-900">Jadwal ujian</p>
            
            <div class="shadow-md p-4 bg-white/10 rounded-lg">
                <h1 class="text-xl font-bold border-b border-white/30">ujian aktif</h1>
                <ul class="mt-4">
                    <li>Matematika: 10 Juli 2024</li>
                    <li>Fisika: 12 Juli 2024</li>
                    <li>Kimia: 14 Juli 2024</li>
                </ul>
            </div>
            <div class="shadow-md p-4 bg-white/10 rounded-lg">
                <h1 class="text-xl font-bold border-b border-white/30">jadwal terdekat</h1>
                <ul class="mt-4">
                    <li>20 desember : bhs.inggris</li>
                    <li>25 desember : bhs.indonesia</li>
                    <li>30 desember : sejarah</li>
                </ul>
            </div>
            
        </div>
    </div>
</x-layout>
<x-layout>
    <x-slot:title> {{ $title }} </x-slot:title>

    <div class="grid grid-cols-2 gap-4 mt-4 text-white">
            
            <div class="shadow-md p-4 bg-white/10 rounded-lg">
                <h1 class="text-xl font-bold border-b border-white/30">ujian hari ini</h1>
                <h2>Hari : Senin, 05 Januari 2026</h2>
                <ul class="mt-4">
                    <li>Matematika  : 07:00 WIB</li>
                    <li>Fisika      : 10:00 WIB</li>
                    <li>Kimia       : 13:00 WIB</li>
                </ul>
            </div> 
          <div class="shadow-md p-4 bg-white/10 rounded-lg">
                <h1 class="text-xl font-bold border-b border-white/30">Jadwal Ujian yang akan Datang Besok Hari</h1>
                <ul class="mt-4">
                    <li>20 desember : bhs.inggris</li>
                    <li>25 desember : bhs.indonesia</li>
                    <li>30 desember : sejarah</li>
                </ul>
            </div>
    </div>
</x-layout>
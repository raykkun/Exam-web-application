        <header class="relative bg-gray-800 after:pointer-events-none after:absolute after:inset-x-0 after:inset-y-0 after:border-y after:border-white/10">
            <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">{{ $slot }}</h1>
            <p class="mt-4 text-white">Selamat datang kembali, di halaman {{ $slot }}</p>
            </div>
        </header>
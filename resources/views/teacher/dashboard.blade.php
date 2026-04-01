<x-layout :title="$title">

    @if(auth()->user()->role === 'teacher')
    <a href="/admin/dashboard">Admin Panel</a>
@endif

<h1>teacher</h1>
<h2>halo </h2>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
</x-layout>

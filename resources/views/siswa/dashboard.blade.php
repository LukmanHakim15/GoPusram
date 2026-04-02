<!DOCTYPE html>
<html>
<head><title>Siswa Dashboard - GoPusram</title></head>
<body>
    <h1>Selamat datang, Siswa!</h1>
    <p>Anda login sebagai: {{ auth()->user()->name }}</p>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
        @csrf
    </form>
</body>
</html>
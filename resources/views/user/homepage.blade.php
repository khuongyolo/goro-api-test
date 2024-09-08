WELCOME
<p>Name: {{ Auth::user()->name }}</p>
<p>Email: {{ Auth::user()->email }}</p>
<form action="{{ route('user.logout') }}">
    <button type="submit">LOGOUT</button>
</form>



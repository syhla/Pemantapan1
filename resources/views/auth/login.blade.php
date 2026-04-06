@extends('layouts.app')

@section('content')

<div class="card" style="max-width:400px; margin:auto;">
    
    <h2 style="text-align:center;">🔐 Login</h2>

    <!-- ERROR -->
    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn btn-primary" style="width:100%; margin-top:10px;">
            Login
        </button>
    </form>

</div>

@endsection
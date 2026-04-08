@extends('layouts.app')

@section('page-title', 'Login')
@section('breadcrumb', 'Toko Indonesia')

@section('content')

<div style="min-height:70vh;display:flex;align-items:center;justify-content:center">
    <div style="width:100%;max-width:400px">

        <div class="card" style="padding:32px">

            <div style="text-align:center;margin-bottom:28px">
                <div style="width:48px;height:48px;background:#ede9fe;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;margin:0 auto 14px">🏪</div>
                <div style="font-size:16px;font-weight:600;color:#111827">Toko Indonesia</div>
                <div style="font-size:12px;color:#9ca3af;margin-top:3px">Masuk ke akun Anda</div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;margin-top:8px;padding:11px">
                    Masuk
                </button>

            </form>

        </div>

        <div style="text-align:center;margin-top:16px;font-size:12px;color:#9ca3af">
            &copy; {{ date('Y') }} Toko Indonesia Management System
        </div>

    </div>
</div>

@endsection
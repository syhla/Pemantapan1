@extends('layouts.app')

@section('page-title', 'Login')
@section('breadcrumb', 'Toko Indonesia')

@section('content')

<div style="min-height:70vh;display:flex;align-items:center;justify-content:center">
    <div style="width:100%;max-width:400px">

        <div class="card" style="padding:32px">

            {{-- HEADER --}}
            <div style="text-align:center;margin-bottom:28px">
                <div style="width:52px;height:52px;background:#ede9fe;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 14px">
                    🏪
                </div>
                <div style="font-size:17px;font-weight:600;color:#111827">Toko Indonesia</div>
                <div style="font-size:12px;color:#9ca3af;margin-top:3px">
                    Masuk ke akun Anda
                </div>
            </div>

            {{-- ERROR --}}
            @if($errors->any())
                <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:14px;font-size:13px">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- EMAIL --}}
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required>
                </div>

                {{-- PASSWORD + TOGGLE --}}
                <div class="form-group">
                    <label>Password</label>

                    <div style="position:relative">
                        <input type="password" name="password" id="password"
                            placeholder="Masukkan password"
                            required
                            style="padding-right:40px">

                        <span onclick="togglePassword()"
                            style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:14px;color:#6b7280">
                            👁️
                        </span>
                    </div>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="btn btn-primary"
                    style="width:100%;justify-content:center;margin-top:10px;padding:11px">
                    Masuk
                </button>

                {{-- OPTIONAL --}}
                <div style="text-align:center;margin-top:14px;font-size:12px;color:#6b7280">
                    *Jika ini login pertama, kamu akan diminta ganti password
                </div>

            </form>

        </div>

        {{-- FOOTER --}}
        <div style="text-align:center;margin-top:16px;font-size:12px;color:#9ca3af">
            &copy; {{ date('Y') }} Toko Indonesia Management System
        </div>

    </div>
</div>

{{-- SCRIPT SHOW PASSWORD --}}
<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

@endsection
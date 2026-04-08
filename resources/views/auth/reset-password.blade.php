@extends('layouts.app')

@section('page-title', 'Ganti Password')
@section('breadcrumb', 'Auth / Ganti Password')

@section('content')
<div style="display:flex;justify-content:center;margin-top:40px">

    <div class="card" style="width:100%;max-width:420px;padding:28px">

        {{-- HEADER --}}
        <div style="text-align:center;margin-bottom:20px">
            <div style="width:50px;height:50px;background:#ede9fe;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;margin:0 auto 12px">
                🔐
            </div>
            <div style="font-size:16px;font-weight:600;color:#111827">
                Ganti Password
            </div>
            <div style="font-size:12px;color:#9ca3af;margin-top:4px">
                Demi keamanan, silakan buat password baru
            </div>
        </div>

        {{-- SUCCESS --}}
        @if(session('success'))
            <div style="background:#dcfce7;color:#166534;padding:10px;border-radius:8px;margin-bottom:12px;font-size:13px">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR --}}
        @if($errors->any())
            <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:12px;font-size:13px">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            {{-- PASSWORD --}}
            <div class="form-group">
                <label>Password Baru</label>

                <div style="position:relative">
                    <input type="password" name="password" id="password"
                        placeholder="Minimal 6 karakter"
                        required
                        style="padding-right:40px">

                    <span onclick="togglePassword('password')"
                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:14px;color:#6b7280">
                        👁️
                    </span>
                </div>
            </div>

            {{-- CONFIRM --}}
            <div class="form-group">
                <label>Konfirmasi Password</label>

                <div style="position:relative">
                    <input type="password" name="password_confirmation" id="confirm_password"
                        placeholder="Ulangi password"
                        required
                        style="padding-right:40px">

                    <span onclick="togglePassword('confirm_password')"
                        style="position:absolute;right:10px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:14px;color:#6b7280">
                        👁️
                    </span>
                </div>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="btn btn-primary"
                style="width:100%;margin-top:10px">
                🔒 Simpan Password
            </button>

        </form>

        {{-- INFO --}}
        <div style="margin-top:14px;font-size:11px;color:#9ca3af;text-align:center">
            Password akan menggantikan password default
        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

@endsection
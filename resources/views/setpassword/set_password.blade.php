@extends('layout.app')

@section('title', 'Set Your Password')

@section('content')
<div style="background-color: #f3f4f6; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: sans-serif; padding: 20px;">
    
    <div style="background: white; width: 100%; max-width: 400px; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #e5e7eb;">
        
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="background-color: #2563eb; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);">
                <span style="color: white; font-size: 24px;">🔒</span>
            </div>
            <h2 style="font-size: 24px; font-weight: 700; color: #111827; margin: 0;">Set Your Password</h2>
            <p style="font-size: 14px; color: #6b7280; margin-top: 8px;">Enter a secure password to activate your account.</p>
        </div>

        {{-- Alerts --}}
        @if(session('status') || $errors->any() || isset($expiresIn))
        <div style="margin-bottom: 20px; font-size: 14px;">
            @if(session('status'))
                <div style="padding: 10px; background: #ecfdf5; border-left: 4px solid #10b981; color: #065f46; border-radius: 4px;">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div style="padding: 10px; background: #fef2f2; border-left: 4px solid #ef4444; color: #991b1b; border-radius: 4px;">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(isset($expiresIn))
                <div style="padding: 8px; background: #fffbeb; color: #92400e; border: 1px solid #fde68a; border-radius: 20px; text-align: center; margin-top: 10px; font-size: 12px;">
                    ⚠️ Link expires in <strong>{{ $expiresIn }}</strong> minutes.
                </div>
            @endif
        </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('password.set') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">New Password</label>
                <input type="password" name="password" required placeholder="••••••••"
                       style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; box-sizing: border-box; outline: none; transition: border-color 0.2s;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px;">Confirm Password</label>
                <input type="password" name="password_confirmation" required placeholder="••••••••"
                       style="width: 100%; padding: 12px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; box-sizing: border-box; outline: none; transition: border-color 0.2s;">
            </div>

            <button type="submit" 
                    style="width: 100%; background-color: #2563eb; color: white; padding: 12px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">
                Update Password
            </button>
        </form>

        <div style="text-align: center; margin-top: 25px;">
            <a href="{{ url('/login') }}" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">
                ← Back to Sign In
            </a>
        </div>
    </div>
</div>
@endsection
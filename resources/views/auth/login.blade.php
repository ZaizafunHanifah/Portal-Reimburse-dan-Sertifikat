@extends('layouts.app')
@section('title', 'Login')
@section('content')
<style>
    .hero-bg {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100vw;
        height: 100vh;
        background: radial-gradient(circle at top right, #e0e7ff, #f9fafb);
        z-index: -1;
    }
    .login-content {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        background: #fff;
        border-radius: 1rem;
        padding: 2rem 2rem 1.5rem 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 370px;
    }
</style>
<div class="hero-bg"></div>
<div class="login-content">
    <div class="login-card">
        <h3 class="mb-4 text-center">Login Admin</h3>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
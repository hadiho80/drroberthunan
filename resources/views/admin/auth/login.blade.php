<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-auth-body">
    <main class="admin-auth-shell">
        <section class="admin-auth-card">
            <div class="admin-auth-copy">
                <p class="section-badge">Admin Login</p>
                <h1>Masuk ke CMS</h1>
                <p>Gunakan akun admin yang terdaftar untuk mengelola konten website.</p>
            </div>

            @if(session('status'))
                <div class="admin-alert">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.store') }}" method="POST" class="admin-auth-form">
                @csrf

                <label>
                    <span>Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                </label>

                <label>
                    <span>Password</span>
                    <input type="password" name="password" autocomplete="current-password" required>
                </label>

                <label class="admin-auth-checkbox">
                    <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat sesi login ini</span>
                </label>

                <button type="submit" class="button-primary">Login</button>
            </form>
        </section>
    </main>
</body>
</html>

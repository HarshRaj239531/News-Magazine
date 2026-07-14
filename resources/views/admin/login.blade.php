<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - VIGYANMEV JAYATE</title>
    <link rel="stylesheet" href="/css/admin.css">
    <style>
        body {
            background-color: var(--primary-color);
            background-image: radial-gradient(circle at 10% 20%, rgba(18, 43, 91, 1) 0%, rgba(9, 13, 22, 1) 90.2%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-card {
            background-color: white;
            border-radius: 12px;
            padding: 45px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.25), 0 10px 10px -5px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
            border-top: 4px solid var(--accent-color);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div style="text-align: center; margin-bottom: 25px;">
            <h1 style="font-size: 1.6rem; color: var(--primary-color); font-weight: 800;">विज्ञानमेव जयते</h1>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 5px; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px;">
                Secure Administration Access
            </p>
        </div>

        @if($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 4px; font-size: 0.8rem; margin-bottom: 20px; font-weight: 600;">
                ❌ {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Administrator Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="admin@vigyanmev.gov.in" required autofocus value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Security Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div style="margin-bottom: 20px; font-size: 0.75rem; color: #64748b; text-align: center;">
                🔒 Authorized government personnel access only.
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 0.95rem; font-weight: bold;">Verify & Enter Dashboard</button>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('home') }}" style="font-size: 0.8rem; color: var(--accent-color); font-weight: bold;">← Back to Website Portal</a>
            </div>
        </form>
    </div>

</body>
</html>

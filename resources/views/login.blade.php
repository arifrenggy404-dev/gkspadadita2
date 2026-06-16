<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI GKS Padadita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f4f8;
        }

        /* ── Left Panel ── */
        .left-panel {
            width: 55%;
            background: linear-gradient(145deg, #003366 0%, #0055aa 60%, #1a7fd4 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 50px;
            position: relative;
            overflow: hidden;
            color: white;
        }

        /* Decorative circles */
        .left-panel::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            border: 60px solid rgba(255,255,255,0.06);
            top: -120px;
            right: -120px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 50px solid rgba(255,255,255,0.06);
            bottom: -80px;
            left: -80px;
        }

        .cross-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .left-panel h1 {
            font-size: 1.9rem;
            font-weight: 800;
            text-align: center;
            line-height: 1.3;
            position: relative;
            z-index: 1;
            margin-bottom: 14px;
        }

        .left-panel p {
            font-size: 0.95rem;
            opacity: 0.8;
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 320px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .divider-line {
            width: 50px;
            height: 3px;
            background: #ffd700;
            border-radius: 2px;
            position: relative;
            z-index: 1;
            margin-bottom: 40px;
        }

        .back-home-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 2px solid rgba(255,255,255,0.45);
            color: white;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            position: relative;
            z-index: 1;
            transition: background 0.2s, border-color 0.2s, transform 0.1s;
        }
        .back-home-btn:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.7);
            color: white;
            transform: scale(1.03);
        }

        /* ── Right Panel ── */
        .right-panel {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 50px;
            background: #f0f4f8;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
        }

        .login-box h2 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #003366;
            margin-bottom: 6px;
        }
        .login-box .subtitle {
            font-size: 0.88rem;
            color: #6c757d;
            margin-bottom: 32px;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group-custom .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1rem;
            pointer-events: none;
            z-index: 2;
        }
        .input-group-custom input {
            padding-left: 42px;
            padding-right: 14px;
            height: 48px;
            border-radius: 10px;
            border: 1.5px solid #dee2e6;
            font-size: 0.92rem;
            width: 100%;
            background: white;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .input-group-custom input:focus {
            border-color: #0055aa;
            box-shadow: 0 0 0 3px rgba(0,85,170,0.1);
        }
        .input-group-custom .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            cursor: pointer;
            font-size: 1rem;
            z-index: 2;
            border: none;
            background: none;
            padding: 0;
        }
        .input-group-custom .toggle-pw:hover { color: #003366; }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            font-size: 0.85rem;
        }
        .remember-row label { color: #6c757d; cursor: pointer; }
        .form-check-input:checked {
            background-color: #003366;
            border-color: #003366;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, #003366, #0055aa);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
        }
        .btn-login:hover { opacity: 0.9; transform: scale(1.01); }

        .alert-custom {
            background: #fff2f2;
            border: 1.5px solid #f5c2c7;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 22px;
            font-size: 0.85rem;
            color: #842029;
        }
        .alert-custom ul { margin: 0; padding-left: 18px; }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            body { flex-direction: column; }

            .left-panel {
                width: 100%;
                padding: 40px 24px 32px;
            }
            .left-panel h1 { font-size: 1.5rem; }
            .left-panel p  { font-size: 0.88rem; margin-bottom: 28px; }

            .right-panel {
                width: 100%;
                padding: 32px 24px 48px;
            }
        }
    </style>
</head>
<body>

    {{-- ══ LEFT PANEL ══ --}}
    <div class="left-panel">
        <div class="cross-icon">✝</div>
        <h1>SI GKS Padadita</h1>
        <p>Sistem Informasi Jemaat<br>GKS Padadita — Menjadi Terang dan Garam Bagi Dunia</p>
        <div class="divider-line"></div>
        <a href="{{ url('/') }}" class="back-home-btn">
            <i class="bi bi-house-door-fill"></i> Kembali ke Beranda
        </a>
    </div>

    {{-- ══ RIGHT PANEL ══ --}}
    <div class="right-panel">
        <div class="login-box">

            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk untuk mengakses dashboard</p>

            {{-- Error --}}
            @if ($errors->any())
            <div class="alert-custom">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <label class="form-label">Email</label>
                <div class="input-group-custom">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" id="email"
                           value="{{ old('email') }}"
                           placeholder="contoh@email.com"
                           required autofocus>
                </div>

                {{-- Password --}}
                <label class="form-label">Password</label>
                <div class="input-group-custom">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" id="password"
                           placeholder="••••••••"
                           required>
                    <button type="button" class="toggle-pw" onclick="togglePassword()">
                        <i class="bi bi-eye" id="pw-icon"></i>
                    </button>
                </div>

                {{-- Remember me --}}
                <div class="remember-row">
                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input mt-0" type="checkbox"
                               name="remember" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>

            </form>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('pw-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
</script>
</body>
</html>
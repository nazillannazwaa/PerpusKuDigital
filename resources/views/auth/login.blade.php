<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Masuk - PerpusKu Digital</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    (function() {
      const savedTheme = localStorage.getItem('perpusku_theme');
      if (savedTheme === 'dark' || (!savedTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark-mode');
      }
    })();
  </script>
  <style>
    :root {
      --bg: #eaf2fd;
      --surface: #ffffff;
      --surface2: #f8fafc;
      --border: rgba(186, 215, 245, 0.7);
      --border-focus: #2563eb;
      --brand: #2563eb;
      --brand-glow: rgba(37, 99, 235, 0.18);
      --cyan: #38bdf8;
      --navy: #0b1a30;
      --navy-light: #1e3a5f;
      --ink: #0b1a30;
      --muted: #64748b;
      --danger: #ef4444;
      --success: #10b981;
    }

    /* DARK MODE PALETTE - SYNC WITH LANDING & DASHBOARD */
    html.dark-mode body,
    body.dark-mode {
      --bg: #0b1322;
      --surface: #111d33;
      --surface2: #0d1627;
      --border: rgba(255, 255, 255, 0.08);
      --border-focus: #3b82f6;
      --brand: #2563eb;
      --brand-glow: rgba(37, 99, 235, 0.25);
      --cyan: #38bdf8;
      --navy: #f8fafc;
      --navy-light: #cbd5e1;
      --ink: #f8fafc;
      --muted: #94a3b8;
    }

    body.dark-mode .glow-1 {
      background: radial-gradient(circle, #1e3a8a, transparent 70%);
      opacity: 0.25;
    }
    body.dark-mode .glow-2 {
      background: radial-gradient(circle, #172554, transparent 70%);
      opacity: 0.25;
    }
    body.dark-mode .auth-card {
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    body.dark-mode .tab-nav {
      background: #0d1627;
      border-color: rgba(255, 255, 255, 0.08);
    }
    body.dark-mode .form-control {
      background: #0d1627;
      border-color: rgba(255, 255, 255, 0.12);
      color: #f8fafc;
    }
    body.dark-mode .form-control::placeholder {
      color: #64748b;
    }
    body.dark-mode .btn-eye:hover {
      color: #f8fafc;
    }
    body.dark-mode .admin-hint-card {
      background: rgba(30, 58, 95, 0.3);
      border-color: rgba(56, 189, 248, 0.2);
      color: #93c5fd;
    }
    body.dark-mode .admin-hint-card b {
      color: #f8fafc;
    }
    body.dark-mode .admin-hint-card code {
      background: #0b1a30;
      color: #38bdf8;
      border: 1px solid rgba(56, 189, 248, 0.2);
    }
    body.dark-mode .back-home {
      color: #94a3b8;
    }
    body.dark-mode .back-home:hover {
      color: #38bdf8;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--bg);
      color: var(--ink);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow-x: hidden;
    }

    /* Ambient Glow Blobs */
    .glow-blob {
      position: fixed;
      border-radius: 50%;
      filter: blur(140px);
      pointer-events: none;
      z-index: 1;
      opacity: 0.45;
      animation: floatPulse 12s ease-in-out infinite alternate;
    }
    .glow-1 { width: 500px; height: 500px; background: radial-gradient(circle, #93c5fd, transparent 70%); top: -120px; left: -100px; }
    .glow-2 { width: 550px; height: 550px; background: radial-gradient(circle, #bfdbfe, transparent 70%); bottom: -150px; right: -120px; animation-delay: -6s; }

    @keyframes floatPulse {
      0% { transform: scale(1) translate(0, 0); opacity: 0.35; }
      100% { transform: scale(1.15) translate(30px, 40px); opacity: 0.55; }
    }

    .login-container {
      position: relative;
      z-index: 2;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2.5rem 1.25rem;
    }

    /* Brand Header */
    .brand-logo {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: inherit;
      margin-bottom: 2rem;
      transition: transform 0.25s ease;
    }
    .brand-logo:hover { transform: translateY(-2px); }
    .logo-box {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      background: linear-gradient(135deg, #38bdf8, #2563eb);
      color: #ffffff;
      display: grid;
      place-items: center;
      box-shadow: 0 4px 16px rgba(37, 99, 235, 0.25);
    }
    .logo-box svg {
      width: 22px;
      height: 22px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }
    .brand-name {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 24px;
      font-weight: 800;
      letter-spacing: -0.4px;
      color: var(--navy);
    }

    /* Auth Card */
    .auth-card {
      width: 100%;
      max-width: 440px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 2.25rem;
      box-shadow: 0 20px 50px rgba(11, 26, 48, 0.08), 0 2px 6px rgba(11, 26, 48, 0.04);
      position: relative;
      overflow: hidden;
    }
    .auth-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, #38bdf8, #2563eb, #1d4ed8);
    }

    /* Tab Switcher */
    .tab-nav {
      display: grid;
      grid-template-columns: 1fr 1fr;
      background: #f1f5f9;
      border: 1px solid rgba(15, 23, 42, 0.06);
      border-radius: 12px;
      padding: 4px;
      margin-bottom: 1.75rem;
      gap: 4px;
    }
    .tab-btn {
      background: none;
      border: none;
      color: var(--muted);
      font-family: inherit;
      font-size: 13.5px;
      font-weight: 700;
      padding: 9px 14px;
      border-radius: 9px;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }
    .tab-btn.active {
      background: var(--brand);
      color: #ffffff;
      box-shadow: 0 2px 10px rgba(37, 99, 235, 0.25);
    }

    /* Tab Content Panes */
    .tab-pane { display: none; }
    .tab-pane.active { display: block; animation: fadeIn 0.25s ease; }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 20px;
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 4px;
    }
    .form-subtitle {
      font-size: 13px;
      color: var(--muted);
      margin-bottom: 1.5rem;
      line-height: 1.5;
    }

    /* Alerts */
    .alert {
      padding: 11px 14px;
      border-radius: 12px;
      font-size: 13px;
      margin-bottom: 1.25rem;
      line-height: 1.45;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .alert-error {
      background: #fee2e2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }
    .alert-success {
      background: #dcfce7;
      border: 1px solid #bbf7d0;
      color: #15803d;
    }

    /* Form Inputs */
    .form-group { margin-bottom: 1.15rem; }
    .form-label {
      display: block;
      font-size: 13px;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 6px;
    }
    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-icon {
      position: absolute;
      left: 14px;
      color: var(--muted);
      pointer-events: none;
      width: 18px;
      height: 18px;
    }
    .form-control {
      width: 100%;
      background: #ffffff;
      border: 1px solid rgba(15, 23, 42, 0.15);
      border-radius: 11px;
      padding: 12px 14px 12px 42px;
      color: var(--navy);
      font-size: 13.5px;
      font-family: inherit;
      outline: none;
      transition: all 0.2s ease;
    }
    .form-control::placeholder {
      color: #94a3b8;
    }
    .form-control:focus {
      border-color: var(--brand);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }
    .btn-eye {
      position: absolute;
      right: 12px;
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
      display: grid;
      place-items: center;
      padding: 4px;
    }
    .btn-eye:hover { color: var(--navy); }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      background: var(--brand);
      color: #fff;
      border: none;
      font-family: inherit;
      font-weight: 700;
      font-size: 14px;
      padding: 12px 18px;
      border-radius: 11px;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin-top: 0.5rem;
    }
    .btn-submit:hover {
      background: #1d4ed8;
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(37, 99, 235, 0.3);
    }

    /* Admin Hint Box */
    .admin-hint-card {
      margin-top: 1.5rem;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-radius: 11px;
      padding: 12px 14px;
      font-size: 12.5px;
      color: var(--muted);
      line-height: 1.5;
    }
    .admin-hint-card b { color: var(--navy); }
    .admin-hint-card code {
      background: #dbeafe;
      color: #1e40af;
      padding: 2px 6px;
      border-radius: 5px;
      font-weight: 700;
      font-size: 12px;
    }

    .back-home {
      margin-top: 1.75rem;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--muted);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: color 0.2s ease;
    }
    .back-home:hover { color: var(--brand); }

    /* Theme Toggle Button */
    .theme-toggle-btn {
      width: 40px;
      height: 40px;
      border-radius: 11px;
      border: 1px solid var(--border);
      background: var(--surface);
      color: var(--ink);
      display: grid;
      place-items: center;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(11, 26, 48, 0.06);
      transition: all 0.2s ease;
    }
    .theme-toggle-btn:hover {
      border-color: var(--brand);
      color: var(--brand);
      transform: translateY(-2px);
    }
    .theme-toggle-btn svg { width: 19px; height: 19px; stroke: currentColor; fill: none; stroke-width: 2; }
    .icon-sun { display: none; }
    body.dark-mode .icon-sun { display: block !important; }
    body.dark-mode .icon-moon { display: none !important; }

    /* Mobile Responsive */
    @media (max-width: 480px) {
      .login-container {
        padding: 4.25rem 1rem 2rem 1rem;
      }
      .auth-card {
        padding: 1.5rem 1.25rem;
        border-radius: 16px;
      }
      .brand-name {
        font-size: 22px;
      }
      .brand-logo {
        margin-bottom: 1.5rem;
      }
      .theme-toggle-wrap {
        top: 14px !important;
        right: 16px !important;
      }
      .theme-toggle-btn {
        width: 36px;
        height: 36px;
      }
      .tab-btn {
        padding: 8px 10px;
        font-size: 13px;
      }
      .form-control {
        padding: 10px 12px 10px 38px;
        font-size: 13px;
      }
      .input-group svg.input-icon {
        left: 12px;
        width: 17px;
        height: 17px;
      }
      .btn-submit {
        padding: 11px 16px;
        font-size: 13.5px;
      }
    }
  </style>
</head>
<body>

  <!-- Theme Toggle Floating in Top-Right -->
  <div class="theme-toggle-wrap" style="position: absolute; top: 20px; right: 24px; z-index: 10;">
    <button type="button" class="theme-toggle-btn" id="themeToggleBtn" title="Ganti Tema (Terang / Gelap)" aria-label="Toggle Theme">
      <!-- Sun icon (shown in dark mode) -->
      <svg class="icon-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
      <!-- Moon icon (shown in light mode) -->
      <svg class="icon-moon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
    </button>
  </div>

  <!-- Background Ambience -->
  <div class="glow-blob glow-1"></div>
  <div class="glow-blob glow-2"></div>

  <div class="login-container">

    <!-- Brand Header -->
    <a href="{{ route('landing') }}" class="brand-logo" title="Kembali ke Beranda Utama">
      <div class="logo-box">
        <svg viewBox="0 0 24 24"><path d="M4 5a2 2 0 012-2h12v16H6a2 2 0 00-2 2zM4 19a2 2 0 012-2h12"/></svg>
      </div>
      <b class="brand-name">PerpusKu</b>
    </a>

    <!-- Auth Card -->
    <div class="auth-card">

      <!-- Tab Switcher -->
      <div class="tab-nav">
        <button type="button" class="tab-btn {{ $errors->has('name') || old('_tab') === 'register' ? '' : 'active' }}" onclick="switchAuthTab('login')">
          <svg style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
          Masuk
        </button>
        <button type="button" class="tab-btn {{ $errors->has('name') || old('_tab') === 'register' ? 'active' : '' }}" onclick="switchAuthTab('register')">
          <svg style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
          Daftar Siswa
        </button>
      </div>

      <!-- Flash Notifications -->
      @if (session('status'))
        <div class="alert alert-success">
          <span>✓</span>
          <span>{{ session('status') }}</span>
        </div>
      @endif

      @if ($errors->has('login_error'))
        <div class="alert alert-error">
          <span>⚠️</span>
          <span>{{ $errors->first('login_error') }}</span>
        </div>
      @endif

      @if ($errors->any() && !$errors->has('login_error'))
        <div class="alert alert-error">
          <span>⚠️</span>
          <div>
            @foreach ($errors->all() as $err)
              <div>{{ $err }}</div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- ================= TAB 1: FORM MASUK ================= -->
      <div class="tab-pane {{ $errors->has('name') || old('_tab') === 'register' ? '' : 'active' }}" id="pane-login">
        <h2 class="form-title">Selamat Datang Kembali</h2>
        <p class="form-subtitle">Masuk untuk mengakses peminjaman buku perpustakaan.</p>

        <form action="{{ route('login.post') }}" method="POST">
          @csrf
          <input type="hidden" name="_tab" value="login">

          <div class="form-group">
            <label class="form-label">Email atau Username</label>
            <div class="input-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <input type="text" name="login" class="form-control" placeholder="admin atau email kamu" value="{{ old('login') }}" required autofocus>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Kata Sandi</label>
            <div class="input-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" name="password" id="loginPassword" class="form-control" placeholder="••••••••" required>
              <button type="button" class="btn-eye" onclick="togglePass('loginPassword', this)" title="Lihat kata sandi">
                <svg style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
          </div>

          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;font-size:13px;color:var(--muted);">
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
              <input type="checkbox" name="remember" value="1" checked style="accent-color:var(--brand);">
              <span>Ingat saya</span>
            </label>
          </div>

          <button type="submit" class="btn-submit">
            <span>Masuk ke Perpustakaan</span>
            <svg style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2.2;" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </button>
        </form>

        <!-- Admin Login Info Hint -->
        <div class="admin-hint-card">
          <b>👑 Akses Admin:</b> Gunakan user <code>admin</code> dan sandi <code>adminperpus123</code> untuk mengelola buku dan persetujuan.
        </div>
      </div>

      <!-- ================= TAB 2: FORM DAFTAR SISWA ================= -->
      <div class="tab-pane {{ $errors->has('name') || old('_tab') === 'register' ? 'active' : '' }}" id="pane-register">
        <h2 class="form-title">Daftar Akun Siswa Baru</h2>
        <p class="form-subtitle">Buat akun untuk mulai meminjam buku favorit kamu.</p>

        <form action="{{ route('register') }}" method="POST">
          @csrf
          <input type="hidden" name="_tab" value="register">

          <div class="form-group">
            <label class="form-label">Nama Lengkap Siswa *</label>
            <div class="input-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Pratama" value="{{ old('name') }}" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Alamat Email *</label>
            <div class="input-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <input type="email" name="email" class="form-control" placeholder="contoh: budi@sekolah.sch.id" value="{{ old('email') }}" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Buat Kata Sandi *</label>
            <div class="input-wrapper">
              <svg class="input-icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" name="password" id="regPassword" class="form-control" placeholder="Minimal 4 karakter" required>
              <button type="button" class="btn-eye" onclick="togglePass('regPassword', this)" title="Lihat kata sandi">
                <svg style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
          </div>

          <button type="submit" class="btn-submit">
            <span>Daftar & Langsung Masuk ✨</span>
          </button>

          <p style="text-align:center;font-size:13px;color:var(--muted);margin-top:1.25rem;">
            Sudah punya akun?
            <a href="javascript:void(0)" onclick="switchAuthTab('login')" style="color:var(--brand);font-weight:700;text-decoration:none;">Masuk di sini</a>
          </p>
        </form>
      </div>

    </div>

    <!-- Back to landing -->
    <a href="{{ route('landing') }}" class="back-home">
      ← Kembali ke Beranda
    </a>

  </div>

  <script>
    function switchAuthTab(tab) {
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

      const targetPane = document.getElementById('pane-' + tab);
      if (targetPane) targetPane.classList.add('active');

      const activeBtn = Array.from(document.querySelectorAll('.tab-btn')).find(b => b.getAttribute('onclick')?.includes(tab));
      if (activeBtn) activeBtn.classList.add('active');
    }

    function togglePass(inputId, btn) {
      const input = document.getElementById(inputId);
      if (!input) return;
      if (input.type === 'password') {
        input.type = 'text';
        btn.style.color = 'var(--brand)';
      } else {
        input.type = 'password';
        btn.style.color = 'var(--muted)';
      }
    }

    /* Synchronize Theme with Landing Page & Dashboard */
    function initTheme() {
      const savedTheme = localStorage.getItem('perpusku_theme');
      if (savedTheme === 'dark' || (!savedTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.body.classList.add('dark-mode');
        document.documentElement.classList.add('dark-mode');
      } else {
        document.body.classList.remove('dark-mode');
        document.documentElement.classList.remove('dark-mode');
      }
    }

    function toggleTheme() {
      const isDark = document.body.classList.toggle('dark-mode');
      document.documentElement.classList.toggle('dark-mode', isDark);
      localStorage.setItem('perpusku_theme', isDark ? 'dark' : 'light');
    }

    const themeToggleBtn = document.getElementById('themeToggleBtn');
    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', toggleTheme);
    }
    initTheme();
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>Admin Hub - PerpusKu Digital</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #060b0a;
      --bg-card: rgba(13, 24, 21, 0.72);
      --surface: #0a1411;
      --surface2: rgba(255, 255, 255, 0.04);
      --border: rgba(63, 191, 168, 0.22);
      --border-hover: rgba(63, 191, 168, 0.5);
      --brand: #3fbfa8;
      --brand-glow: rgba(63, 191, 168, 0.4);
      --cyan: #38bdf8;
      --accent: #f59e0b;
      --danger: #ef4444;
      --danger-bg: rgba(239, 68, 68, 0.15);
      --success: #10b981;
      --success-bg: rgba(16, 185, 129, 0.15);
      --ink: #e8faf5;
      --muted: #8ea8a2;
      --sw: 260px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg);
      color: var(--ink);
      font-family: 'Plus Jakarta Sans', sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Ambient background glows */
    .ambient-glow {
      position: fixed;
      border-radius: 50%;
      filter: blur(140px);
      pointer-events: none;
      z-index: 0;
      opacity: 0.25;
    }
    .glow-top { width: 500px; height: 500px; background: radial-gradient(circle, var(--brand), transparent 70%); top: -150px; left: 100px; }
    .glow-bot { width: 600px; height: 600px; background: radial-gradient(circle, #0284c7, transparent 70%); bottom: -200px; right: -150px; }

    /* Layout with Sidebar */
    .app-admin {
      display: flex;
      min-height: 100vh;
      position: relative;
      z-index: 1;
    }

    /* Sidebar */
    aside.admin-sidebar {
      width: var(--sw);
      background: rgba(10, 20, 17, 0.88);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-right: 1px solid var(--border);
      position: fixed;
      inset: 0 auto 0 0;
      z-index: 50;
      display: flex;
      flex-direction: column;
      padding: 18px 14px;
      transition: transform 0.25s ease, width 0.25s ease;
      overflow-y: auto;
    }

    .brand-area {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 6px 8px 18px;
      text-decoration: none;
      color: inherit;
      border-bottom: 1px solid var(--border);
      margin-bottom: 12px;
    }
    .logo-box {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: var(--brand);
      color: #06110e;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      box-shadow: 0 0 16px var(--brand-glow);
    }
    .logo-box svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      fill: none;
      stroke-width: 1.8;
      stroke-linecap: round;
      stroke-linejoin: round;
    }
    .brand-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 19px;
      font-weight: 700;
      letter-spacing: -0.3px;
    }
    .admin-pill {
      font-size: 10px;
      font-weight: 800;
      text-transform: uppercase;
      padding: 2px 7px;
      border-radius: 6px;
      background: rgba(245, 158, 11, 0.2);
      color: #fbbf24;
      border: 1px solid rgba(245, 158, 11, 0.4);
    }

    /* Sidebar Navigation Links */
    nav.side-nav {
      display: flex;
      flex-direction: column;
      gap: 3px;
      flex: 1;
    }
    .nav-group-title {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      color: var(--muted);
      padding: 12px 10px 4px;
    }
    .side-nav-btn {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 12px;
      color: var(--muted);
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 600;
      background: none;
      border: none;
      width: 100%;
      cursor: pointer;
      text-align: left;
      transition: all 0.2s ease;
    }
    .side-nav-btn:hover {
      background: var(--surface2);
      color: #fff;
    }
    .side-nav-btn.active {
      background: rgba(63, 191, 168, 0.16);
      color: var(--brand);
      font-weight: 700;
      border-left: 3px solid var(--brand);
    }
    .side-nav-btn-inner {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .side-badge {
      font-size: 11px;
      font-weight: 800;
      padding: 2px 7px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.1);
      color: inherit;
    }
    .side-badge.alert-badge {
      background: #f59e0b;
      color: #06110e;
    }

    /* Sidebar Footer */
    .sidebar-footer {
      border-top: 1px solid var(--border);
      padding-top: 14px;
      margin-top: 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
    }
    .admin-profile {
      display: flex;
      align-items: center;
      gap: 10px;
      min-width: 0;
      overflow: hidden;
    }
    .admin-ava {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--brand), var(--cyan));
      color: #06110e;
      font-weight: 800;
      display: grid;
      place-items: center;
      font-size: 13px;
      flex-shrink: 0;
    }
    .admin-meta {
      display: flex;
      flex-direction: column;
      line-height: 1.25;
      min-width: 0;
    }
    .admin-name {
      font-size: 13px;
      font-weight: 700;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .admin-role {
      font-size: 11px;
      color: #fbbf24;
      font-weight: 600;
    }

    .btn-side-logout {
      width: 34px;
      height: 34px;
      border-radius: 10px;
      background: var(--danger-bg);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #fca5a5;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }
    .btn-side-logout:hover {
      background: rgba(239, 68, 68, 0.35);
      color: #fff;
    }

    /* Main Content Area */
    .admin-main {
      flex: 1;
      margin-left: var(--sw);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      transition: margin-left 0.25s ease;
    }

    /* Top Navigation Bar */
    header.admin-topbar {
      height: 68px;
      padding: 0 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--border);
      background: rgba(6, 11, 10, 0.85);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      position: sticky;
      top: 0;
      z-index: 40;
    }

    .topbar-left {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .btn-toggle-sidebar {
      display: none;
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid var(--border);
      color: #fff;
      cursor: pointer;
      align-items: center;
      justify-content: center;
    }
    .topbar-page-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 18px;
      font-weight: 700;
      color: #fff;
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .btn-header-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: var(--ink);
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-header-link:hover {
      background: rgba(63, 191, 168, 0.15);
      border-color: var(--brand);
    }

    /* Content Body */
    .content-area {
      flex: 1;
      max-width: 1280px;
      width: 100%;
      margin: 0 auto;
      padding: 1.75rem 2rem;
    }

    /* Flash Alerts */
    .flash-alert {
      padding: 1rem 1.25rem;
      border-radius: 14px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 14px;
      line-height: 1.5;
    }
    .flash-success {
      background: var(--success-bg);
      border: 1px solid rgba(16, 185, 129, 0.4);
      color: #6ee7b7;
    }
    .flash-error {
      background: var(--danger-bg);
      border: 1px solid rgba(239, 68, 68, 0.4);
      color: #fca5a5;
    }

    /* Stats Grid (4 cards now - Anggota removed) */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 1.25rem;
      margin-bottom: 2rem;
    }
    .stat-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 1.25rem;
      backdrop-filter: blur(14px);
      display: flex;
      flex-direction: column;
      gap: 6px;
      transition: all 0.25s ease;
      position: relative;
      overflow: hidden;
    }
    .stat-card:hover {
      border-color: var(--brand);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    .stat-card::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--brand), transparent);
      opacity: 0.7;
    }
    .stat-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted); }
    .stat-value { font-family: 'Bricolage Grotesque', sans-serif; font-size: 32px; font-weight: 800; color: #fff; }
    .stat-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      font-size: 11px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 6px;
      width: fit-content;
    }

    /* Content Panes */
    .tab-pane { display: none; }
    .tab-pane.active { display: block; animation: fadeIn 0.25s ease; }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Controls Bar */
    .controls-bar {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    .filter-group {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
      flex: 1;
    }
    .search-input {
      background: rgba(13, 24, 21, 0.8);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 10px 16px;
      color: #fff;
      font-size: 14px;
      min-width: 260px;
      outline: none;
      transition: all 0.2s;
    }
    .search-input:focus { border-color: var(--brand); box-shadow: 0 0 15px var(--brand-glow); }
    .category-select {
      background: #0d1815;
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 10px 14px;
      color: #fff;
      font-size: 14px;
      outline: none;
      cursor: pointer;
    }
    .btn-filter {
      padding: 10px 16px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #fff;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-add-book {
      background: linear-gradient(135deg, var(--brand), #00d2ff);
      color: #06110e;
      border: none;
      font-weight: 800;
      font-size: 14px;
      padding: 11px 20px;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 0 20px var(--brand-glow);
      transition: all 0.25s ease;
    }
    .btn-add-book:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 30px var(--brand-glow);
    }

    /* Books Grid Cards */
    .books-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.25rem;
    }
    .book-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 1.2rem;
      backdrop-filter: blur(12px);
      display: flex;
      flex-direction: column;
      gap: 12px;
      transition: all 0.25s ease;
      position: relative;
    }
    .book-card:hover {
      border-color: var(--brand);
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
    }
    .book-thumb-row {
      display: flex;
      gap: 14px;
    }
    .book-cover-img {
      width: 76px;
      height: 108px;
      border-radius: 10px;
      object-fit: cover;
      flex-shrink: 0;
      background: #11211d;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    }
    .book-details {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 4px;
      min-width: 0;
    }
    .book-code {
      font-size: 11px;
      font-weight: 800;
      color: var(--brand);
      background: rgba(63, 191, 168, 0.12);
      padding: 2px 7px;
      border-radius: 6px;
      width: fit-content;
    }
    .book-title {
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-top: 2px;
    }
    .book-author { font-size: 13px; color: var(--muted); }
    .book-cat { font-size: 12px; color: #38bdf8; }

    .book-stock-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 8px 12px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.03);
      font-size: 13px;
    }
    .stock-badge {
      font-weight: 800;
      padding: 3px 9px;
      border-radius: 8px;
      font-size: 12px;
    }
    .stock-in { background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid rgba(16, 185, 129, 0.4); }
    .stock-out { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4); }

    .book-actions {
      display: flex;
      gap: 8px;
      margin-top: auto;
    }
    .btn-edit {
      flex: 1;
      background: rgba(56, 189, 248, 0.15);
      border: 1px solid rgba(56, 189, 248, 0.35);
      color: #7dd3fc;
      padding: 8px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: all 0.2s;
    }
    .btn-edit:hover { background: rgba(56, 189, 248, 0.3); color: #fff; }
    .btn-delete {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #fca5a5;
      padding: 8px 12px;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-delete:hover { background: rgba(239, 68, 68, 0.3); color: #fff; }

    /* Tables */
    .table-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 18px;
      overflow: hidden;
      backdrop-filter: blur(14px);
    }
    table.data-table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 14px;
    }
    table.data-table th {
      background: rgba(255, 255, 255, 0.04);
      padding: 14px 18px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: var(--muted);
      border-bottom: 1px solid var(--border);
    }
    table.data-table td {
      padding: 14px 18px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      vertical-align: middle;
    }
    table.data-table tr:last-child td { border-bottom: none; }
    table.data-table tr:hover td { background: rgba(255, 255, 255, 0.02); }

    .user-cell {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--brand), var(--cyan));
      color: #06110e;
      font-weight: 800;
      display: grid;
      place-items: center;
      font-size: 13px;
      flex-shrink: 0;
    }
    .user-avatar img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }

    .action-btn-group {
      display: flex;
      gap: 8px;
    }
    .btn-approve {
      background: #10b981;
      color: #042f2e;
      border: none;
      padding: 7px 14px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 800;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: all 0.2s;
    }
    .btn-approve:hover { box-shadow: 0 0 16px rgba(16, 185, 129, 0.5); transform: translateY(-1px); }

    .btn-reject {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #fca5a5;
      padding: 7px 12px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-reject:hover { background: rgba(239, 68, 68, 0.3); color: #fff; }

    .empty-state {
      padding: 3.5rem 1rem;
      text-align: center;
      color: var(--muted);
    }
    .empty-state svg { width: 48px; height: 48px; margin-bottom: 0.75rem; opacity: 0.4; }

    /* Modals */
    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      backdrop-filter: blur(8px);
      z-index: 100;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }
    .modal-backdrop.open { display: flex; }
    .modal-window {
      background: #0f1c19;
      border: 1px solid var(--border);
      border-radius: 20px;
      width: 100%;
      max-width: 540px;
      max-height: 90vh;
      overflow-y: auto;
      padding: 2rem;
      position: relative;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 40px var(--brand-glow);
      animation: modalSlide 0.25s ease;
    }
    @keyframes modalSlide {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    .modal-close-btn {
      position: absolute;
      top: 1.25rem;
      right: 1.25rem;
      background: rgba(255, 255, 255, 0.08);
      border: none;
      color: var(--muted);
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 1.1rem;
    }
    .modal-title { font-family: 'Bricolage Grotesque', sans-serif; font-size: 20px; font-weight: 700; color: #fff; margin-bottom: 1.25rem; }

    .form-row { margin-bottom: 1rem; }
    .form-label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 0.4rem; color: #cbd5e1; }
    .form-input, .form-textarea, .form-select-modal {
      width: 100%;
      background: rgba(6, 11, 10, 0.7);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 10px 14px;
      color: #fff;
      font-size: 14px;
      outline: none;
      font-family: inherit;
    }
    .form-input:focus, .form-textarea:focus, .form-select-modal:focus {
      border-color: var(--brand);
      box-shadow: 0 0 14px var(--brand-glow);
    }
    .form-hint { font-size: 12px; color: var(--muted); margin-top: 4px; }

    /* Mobile Scrim */
    .sidebar-scrim {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      z-index: 45;
      display: none;
    }

    /* Responsive */
    @media (max-width: 900px) {
      aside.admin-sidebar {
        transform: translateX(-100%);
      }
      aside.admin-sidebar.open {
        transform: translateX(0);
      }
      .sidebar-scrim.open {
        display: block;
      }
      .admin-main {
        margin-left: 0;
      }
      .btn-toggle-sidebar {
        display: inline-flex;
      }
    }
  </style>
</head>
<body>

  <!-- Background Ambient Glows -->
  <div class="ambient-glow glow-top"></div>
  <div class="ambient-glow glow-bot"></div>

  <!-- Mobile Scrim Overlay -->
  <div class="sidebar-scrim" id="sidebarScrim" onclick="closeSidebar()"></div>

  <div class="app-admin">

    <!-- ================= ADMIN SIDEBAR ================= -->
    <aside class="admin-sidebar" id="adminSidebar">
      <!-- Brand Area -->
      <a href="{{ route('admin.dashboard') }}" class="brand-area">
        <div class="logo-box">
          <svg viewBox="0 0 24 24"><path d="M4 5a2 2 0 012-2h12v16H6a2 2 0 00-2 2zM4 19a2 2 0 012-2h12"/></svg>
        </div>
        <div>
          <div class="brand-title">PerpusKu</div>
          <span class="admin-pill">Admin Hub</span>
        </div>
      </a>

      <!-- Navigation Menu -->
      <nav class="side-nav">
        <div class="nav-group-title">Menu Utama</div>

        <!-- 1. Kelola Buku -->
        <button class="side-nav-btn {{ request()->query('tab', 'buku') === 'buku' ? 'active' : '' }}" onclick="switchTab('buku')">
          <div class="side-nav-btn-inner">
            <span>📚</span>
            <span>Kelola Buku (CRUD)</span>
          </div>
          <span class="side-badge">{{ $stats['total_books'] }}</span>
        </button>

        <!-- 2. Persetujuan Peminjaman -->
        <button class="side-nav-btn {{ request()->query('tab') === 'pinjam' ? 'active' : '' }}" onclick="switchTab('pinjam')">
          <div class="side-nav-btn-inner">
            <span>⏳</span>
            <span>Persetujuan Pinjam</span>
          </div>
          @if ($stats['pending_loans'] > 0)
            <span class="side-badge alert-badge">{{ $stats['pending_loans'] }}</span>
          @else
            <span class="side-badge">0</span>
          @endif
        </button>

        <!-- 3. Persetujuan Pengembalian -->
        <button class="side-nav-btn {{ request()->query('tab') === 'kembali' ? 'active' : '' }}" onclick="switchTab('kembali')">
          <div class="side-nav-btn-inner">
            <span>🔄</span>
            <span>Persetujuan Kembali</span>
          </div>
          @if ($stats['pending_returns'] > 0)
            <span class="side-badge alert-badge" style="background:#38bdf8;color:#000;">{{ $stats['pending_returns'] }}</span>
          @else
            <span class="side-badge">0</span>
          @endif
        </button>

        <!-- 4. Sedang Dipinjam -->
        <button class="side-nav-btn {{ request()->query('tab') === 'aktif' ? 'active' : '' }}" onclick="switchTab('aktif')">
          <div class="side-nav-btn-inner">
            <span>📖</span>
            <span>Sedang Dipinjam</span>
          </div>
          <span class="side-badge">{{ $stats['active_loans'] }}</span>
        </button>

        <!-- 5. Riwayat Selesai -->
        <button class="side-nav-btn {{ request()->query('tab') === 'riwayat' ? 'active' : '' }}" onclick="switchTab('riwayat')">
          <div class="side-nav-btn-inner">
            <span>📜</span>
            <span>Riwayat Selesai</span>
          </div>
          <span class="side-badge">{{ $stats['returned_loans'] }}</span>
        </button>

        <div class="nav-group-title" style="margin-top: 10px;">Akses Halaman Lain</div>

        <!-- Link to Student View -->
        <a href="{{ route('dashboard') }}" class="side-nav-btn" title="Buka Dashboard Siswa">
          <div class="side-nav-btn-inner">
            <span>👀</span>
            <span>Tampilan Siswa</span>
          </div>
          <span>↗</span>
        </a>

        <!-- Link to Public Landing -->
        <a href="{{ route('landing') }}" class="side-nav-btn" title="Buka Beranda Publik">
          <div class="side-nav-btn-inner">
            <span>🏠</span>
            <span>Beranda Publik</span>
          </div>
          <span>↗</span>
        </a>
      </nav>

      <!-- Sidebar Footer (Admin Info & Logout) -->
      <div class="sidebar-footer">
        <div class="admin-profile">
          <div class="admin-ava">AD</div>
          <div class="admin-meta">
            <span class="admin-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
            <span class="admin-role">Super Admin</span>
          </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
          @csrf
          <button type="submit" class="btn-side-logout" title="Keluar / Logout">
            <svg style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
          </button>
        </form>
      </div>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="admin-main">

      <!-- Header Topbar -->
      <header class="admin-topbar">
        <div class="topbar-left">
          <button type="button" class="btn-toggle-sidebar" onclick="toggleSidebar()" aria-label="Buka Menu Sidebar">
            <svg style="width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:2;" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
          <h1 class="topbar-page-title" id="pageTitleText">Kelola Buku & Katalog</h1>
        </div>

        <div class="topbar-right">
          <a href="{{ route('dashboard') }}" class="btn-header-link" title="Lihat Tampilan Siswa">
            <span>👀 Tampilan Siswa</span>
          </a>

          <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="btn-header-link" style="background:var(--danger-bg);border-color:rgba(239,68,68,0.3);color:#fca5a5;cursor:pointer;">
              <span>Keluar</span>
            </button>
          </form>
        </div>
      </header>

      <!-- Content Area -->
      <div class="content-area">

        <!-- Flash Notifications -->
        @if (session('status'))
          <div class="flash-alert flash-success">
            <span>✓ {{ session('status') }}</span>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;">✕</button>
          </div>
        @endif

        @if (session('error'))
          <div class="flash-alert flash-error">
            <span>⚠️ {{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;">✕</button>
          </div>
        @endif

        @if (isset($errors) && $errors->any())
          <div class="flash-alert flash-error">
            <div>
              <strong>Terjadi kesalahan validasi:</strong>
              <ul style="margin-top: 4px; margin-left: 20px;">
                @foreach ($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            </div>
            <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;">✕</button>
          </div>
        @endif

        <!-- Stats Grid (4 Cards: Anggota removed) -->
        <div class="stats-grid">
          <div class="stat-card">
            <span class="stat-label">Total Judul Buku</span>
            <span class="stat-value">{{ $stats['total_books'] }}</span>
            <span class="stat-badge" style="background:rgba(63,191,168,0.15);color:var(--brand);">{{ $stats['total_stock'] }} total eksemplar</span>
          </div>

          <div class="stat-card">
            <span class="stat-label">Perlu Disetujui (Pinjam)</span>
            <span class="stat-value" style="color: {{ $stats['pending_loans'] > 0 ? '#f59e0b' : '#fff' }}">{{ $stats['pending_loans'] }}</span>
            <span class="stat-badge" style="background:rgba(245,158,11,0.15);color:#fbbf24;">Permintaan baru</span>
          </div>

          <div class="stat-card">
            <span class="stat-label">Perlu Disetujui (Kembali)</span>
            <span class="stat-value" style="color: {{ $stats['pending_returns'] > 0 ? '#38bdf8' : '#fff' }}">{{ $stats['pending_returns'] }}</span>
            <span class="stat-badge" style="background:rgba(56,189,248,0.15);color:#7dd3fc;">Siap dicek kembali</span>
          </div>

          <div class="stat-card">
            <span class="stat-label">Sedang Dipinjam</span>
            <span class="stat-value">{{ $stats['active_loans'] }}</span>
            <span class="stat-badge" style="background:rgba(16,185,129,0.15);color:#6ee7b7;">Buku di tangan siswa</span>
          </div>
        </div>

        <!-- ================= TAB 1: KELOLA BUKU (CRUD) ================= -->
        <div class="tab-pane {{ request()->query('tab', 'buku') === 'buku' ? 'active' : '' }}" id="pane-buku">

          <div class="controls-bar">
            <form method="GET" action="{{ route('admin.dashboard') }}" class="filter-group">
              <input type="hidden" name="tab" value="buku">
              <input type="search" name="q" value="{{ $searchQuery }}" placeholder="Cari judul, penulis, kode buku…" class="search-input">

              <select name="category" class="category-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                  <option value="{{ $cat }}" {{ $selectedCategory === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
              </select>

              <button type="submit" class="btn-filter">Cari</button>
              @if ($searchQuery || $selectedCategory)
                <a href="{{ route('admin.dashboard', ['tab' => 'buku']) }}" class="btn-filter" style="text-decoration:none;">Reset</a>
              @endif
            </form>

            <button type="button" class="btn-add-book" onclick="openAddBookModal()">
              <span>➕ Tambah Buku Baru</span>
            </button>
          </div>

          @if ($books->isEmpty())
            <div class="empty-state">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
              <h3>Belum ada buku yang cocok</h3>
              <p style="font-size: 13px; margin-top: 4px;">Klik tombol "+ Tambah Buku Baru" untuk mulai mengisi katalog perpustakaan.</p>
            </div>
          @else
            <div class="books-grid">
              @foreach ($books as $bk)
                <div class="book-card">
                  <div class="book-thumb-row">
                    <img src="{{ $bk->cover_url }}" alt="{{ $bk->title }}" class="book-cover-img" onerror="this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300'">
                    <div class="book-details">
                      <span class="book-code">{{ $bk->code }}</span>
                      <h3 class="book-title" title="{{ $bk->title }}">{{ $bk->title }}</h3>
                      <p class="book-author">{{ $bk->author }}</p>
                      <span class="book-cat">📁 {{ $bk->category }}</span>
                    </div>
                  </div>

                  <div class="book-stock-row">
                    <span>Stok Tersedia:</span>
                    @if ($bk->stock > 0)
                      <span class="stock-badge stock-in">{{ $bk->stock }} Buku</span>
                    @else
                      <span class="stock-badge stock-out">Habis (0)</span>
                    @endif
                  </div>

                  <div class="book-actions">
                    <button type="button" class="btn-edit" onclick='openEditBookModal(@json($bk))'>
                      <span>✏️ Edit</span>
                    </button>

                    <form action="{{ route('admin.books.destroy', $bk->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ $bk->title }}\'?');" style="margin:0;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-delete" title="Hapus Buku">🗑️</button>
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

        </div>

        <!-- ================= TAB 2: PERSETUJUAN PINJAM ================= -->
        <div class="tab-pane {{ request()->query('tab') === 'pinjam' ? 'active' : '' }}" id="pane-pinjam">
          <div class="table-card">
            @if ($pendingLoans->isEmpty())
              <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                <h3>Tidak ada antrean peminjaman</h3>
                <p style="font-size: 13px; margin-top: 4px;">Semua permintaan peminjaman telah disetujui atau diproses.</p>
              </div>
            @else
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Siswa Pemohon</th>
                    <th>Buku yang Diminta</th>
                    <th>Sisa Stok</th>
                    <th>Tanggal Pengajuan</th>
                    <th style="text-align: right;">Aksi Persetujuan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pendingLoans as $loan)
                    <tr>
                      <td>
                        <div class="user-cell">
                          <div class="user-avatar">
                            @if ($loan->user->avatar)
                              <img src="{{ $loan->user->avatar }}" alt="{{ $loan->user->name }}">
                            @else
                              {{ strtoupper(substr($loan->user->name, 0, 2)) }}
                            @endif
                          </div>
                          <div>
                            <strong>{{ $loan->user->name }}</strong>
                            <div style="font-size: 12px; color: var(--muted);">{{ $loan->user->email }}</div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                          <img src="{{ $loan->book->cover_url }}" style="width: 36px; height: 50px; border-radius: 6px; object-fit: cover;">
                          <div>
                            <strong>{{ $loan->book->title }}</strong>
                            <div style="font-size: 12px; color: var(--brand);">{{ $loan->book->code }} • {{ $loan->book->author }}</div>
                          </div>
                        </div>
                      </td>

                      <td>
                        @if ($loan->book->stock > 0)
                          <span class="stock-badge stock-in">{{ $loan->book->stock }} Tersedia</span>
                        @else
                          <span class="stock-badge stock-out">Stok Habis!</span>
                        @endif
                      </td>

                      <td>{{ $loan->created_at->format('d M Y, H:i') }}</td>

                      <td style="text-align: right;">
                        <div class="action-btn-group" style="justify-content: flex-end;">
                          <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="btn-approve" {{ $loan->book->stock <= 0 ? 'disabled' : '' }}>
                              ✓ Setujui Pinjam
                            </button>
                          </form>

                          <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST" onsubmit="return confirm('Tolak peminjaman ini?');" style="margin:0;">
                            @csrf
                            <button type="submit" class="btn-reject">
                              ✕ Tolak
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>

        <!-- ================= TAB 3: PERSETUJUAN KEMBALI ================= -->
        <div class="tab-pane {{ request()->query('tab') === 'kembali' ? 'active' : '' }}" id="pane-kembali">
          <div class="table-card">
            @if ($pendingReturns->isEmpty())
              <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                <h3>Tidak ada pengembalian yang menunggu persetujuan</h3>
                <p style="font-size: 13px; margin-top: 4px;">Saat siswa mengembalikan buku, daftarnya akan langsung muncul di sini.</p>
              </div>
            @else
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Siswa Pengembali</th>
                    <th>Buku yang Dikembalikan</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th style="text-align: right;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pendingReturns as $loan)
                    <tr>
                      <td>
                        <div class="user-cell">
                          <div class="user-avatar">
                            {{ strtoupper(substr($loan->user->name, 0, 2)) }}
                          </div>
                          <div>
                            <strong>{{ $loan->user->name }}</strong>
                            <div style="font-size: 12px; color: var(--muted);">{{ $loan->user->email }}</div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                          <img src="{{ $loan->book->cover_url }}" style="width: 36px; height: 50px; border-radius: 6px; object-fit: cover;">
                          <div>
                            <strong>{{ $loan->book->title }}</strong>
                            <div style="font-size: 12px; color: var(--brand);">{{ $loan->book->code }}</div>
                          </div>
                        </div>
                      </td>

                      <td>{{ $loan->borrow_date ? $loan->borrow_date->format('d M Y') : '-' }}</td>

                      <td>
                        <span class="stat-badge" style="background:rgba(56,189,248,0.2);color:#7dd3fc;">Menunggu Konfirmasi Admin</span>
                      </td>

                      <td style="text-align: right;">
                        <form action="{{ route('admin.loans.approve-return', $loan->id) }}" method="POST" style="margin:0;">
                          @csrf
                          <button type="submit" class="btn-approve" style="background:#0284c7;color:#fff;">
                            ✓ Terima Pengembalian (+1 Stok)
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>

        <!-- ================= TAB 4: SEDANG DIPINJAM ================= -->
        <div class="tab-pane {{ request()->query('tab') === 'aktif' ? 'active' : '' }}" id="pane-aktif">
          <div class="table-card">
            @if ($activeLoans->isEmpty())
              <div class="empty-state">
                <h3>Tidak ada buku yang sedang dipinjam saat ini</h3>
              </div>
            @else
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Mulai Pinjam</th>
                    <th>Batas Kembali</th>
                    <th style="text-align: right;">Opsi Cepat</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($activeLoans as $loan)
                    <tr>
                      <td>
                        <strong>{{ $loan->user->name }}</strong>
                        <div style="font-size: 12px; color: var(--muted);">{{ $loan->user->email }}</div>
                      </td>
                      <td>
                        <strong>{{ $loan->book->title }}</strong> ({{ $loan->book->code }})
                      </td>
                      <td>{{ $loan->borrow_date ? $loan->borrow_date->format('d M Y') : '-' }}</td>
                      <td>
                        <span style="color: #f59e0b; font-weight: 700;">{{ $loan->due_date ? $loan->due_date->format('d M Y') : '-' }}</span>
                      </td>
                      <td style="text-align: right;">
                        <form action="{{ route('admin.loans.approve-return', $loan->id) }}" method="POST" onsubmit="return confirm('Tandai buku ini sudah dikembalikan?');" style="margin:0;">
                          @csrf
                          <button type="submit" class="btn-approve" style="background:rgba(16,185,129,0.2);color:#6ee7b7;border:1px solid rgba(16,185,129,0.4);">
                            ✓ Konfirmasi Kembali
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>

        <!-- ================= TAB 5: RIWAYAT SELESAI ================= -->
        <div class="tab-pane {{ request()->query('tab') === 'riwayat' ? 'active' : '' }}" id="pane-riwayat">
          <div class="table-card">
            @if ($returnedLoans->isEmpty())
              <div class="empty-state">
                <h3>Belum ada riwayat pengembalian buku</h3>
              </div>
            @else
              <table class="data-table">
                <thead>
                  <tr>
                    <th>Siswa</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($returnedLoans as $loan)
                    <tr>
                      <td>{{ $loan->user->name }}</td>
                      <td><strong>{{ $loan->book->title }}</strong></td>
                      <td>{{ $loan->borrow_date ? $loan->borrow_date->format('d M Y') : '-' }}</td>
                      <td>{{ $loan->return_date ? $loan->return_date->format('d M Y, H:i') : '-' }}</td>
                      <td>
                        <span class="stat-badge" style="background:rgba(16,185,129,0.2);color:#6ee7b7;">Selesai Dikembalikan</span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- ================= MODAL: TAMBAH BUKU ================= -->
  <div class="modal-backdrop" id="addBookModal">
    <div class="modal-window">
      <button type="button" class="modal-close-btn" onclick="closeAddBookModal()">✕</button>
      <h2 class="modal-title">Tambah Koleksi Buku Baru</h2>

      <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
          <label class="form-label">Judul Buku *</label>
          <input type="text" name="title" class="form-input" placeholder="Contoh: Bumi Manusia" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
          <div class="form-row">
            <label class="form-label">Penulis / Pengarang *</label>
            <input type="text" name="author" class="form-input" placeholder="Nama penulis" required>
          </div>
          <div class="form-row">
            <label class="form-label">Kode Buku (Unik) *</label>
            <input type="text" name="code" class="form-input" placeholder="Contoh: NV-010" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
          <div class="form-row">
            <label class="form-label">Kategori *</label>
            <select name="category" class="form-select-modal" required>
              @foreach ($categories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-row">
            <label class="form-label">Jumlah Stok Buku *</label>
            <input type="number" name="stock" class="form-input" min="0" value="5" required>
          </div>
        </div>

        <!-- Cover Upload & Preview -->
        <div class="form-row" style="background: rgba(255,255,255,0.02); padding: 12px; border-radius: 12px; border: 1px dashed var(--border);">
          <label class="form-label">📷 Upload Foto / Cover Buku (Pilih Sendiri)</label>
          <input type="file" name="cover_image" class="form-input" accept="image/*" onchange="previewAddCover(this)" style="padding: 6px;">
          <div class="form-hint">Format didukung: JPG, PNG, WEBP (Maksimal 4MB).</div>

          <div style="margin-top: 10px;">
            <label class="form-label" style="font-size: 12px;">Atau Masukkan URL Gambar Eksternal (Opsional):</label>
            <input type="url" name="cover_url" class="form-input" placeholder="https://example.com/cover.jpg">
          </div>

          <div id="addPreviewBox" style="display: none; margin-top: 10px; text-align: center;">
            <img id="addPreviewImg" style="width: 80px; height: 110px; border-radius: 8px; object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.5);">
          </div>
        </div>

        <div class="form-row">
          <label class="form-label">Sinopsis / Deskripsi Buku (Opsional)</label>
          <textarea name="description" class="form-textarea" rows="3" placeholder="Ceritakan ringkasan buku ini..."></textarea>
        </div>

        <button type="submit" class="btn-add-book" style="width: 100%; justify-content: center; margin-top: 0.5rem;">
          💾 Simpan Koleksi Buku
        </button>
      </form>
    </div>
  </div>

  <!-- ================= MODAL: EDIT BUKU ================= -->
  <div class="modal-backdrop" id="editBookModal">
    <div class="modal-window">
      <button type="button" class="modal-close-btn" onclick="closeEditBookModal()">✕</button>
      <h2 class="modal-title">Edit Koleksi Buku</h2>

      <form id="editBookForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
          <label class="form-label">Judul Buku *</label>
          <input type="text" name="title" id="edit_title" class="form-input" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
          <div class="form-row">
            <label class="form-label">Penulis / Pengarang *</label>
            <input type="text" name="author" id="edit_author" class="form-input" required>
          </div>
          <div class="form-row">
            <label class="form-label">Kode Buku *</label>
            <input type="text" name="code" id="edit_code" class="form-input" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
          <div class="form-row">
            <label class="form-label">Kategori *</label>
            <select name="category" id="edit_category" class="form-select-modal" required>
              @foreach ($categories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-row">
            <label class="form-label">Jumlah Stok Buku *</label>
            <input type="number" name="stock" id="edit_stock" class="form-input" min="0" required>
          </div>
        </div>

        <!-- Cover Update -->
        <div class="form-row" style="background: rgba(255,255,255,0.02); padding: 12px; border-radius: 12px; border: 1px dashed var(--border);">
          <label class="form-label">📷 Ganti Foto / Cover Buku (Pilih Sendiri)</label>
          <input type="file" name="cover_image" class="form-input" accept="image/*" onchange="previewEditCover(this)" style="padding: 6px;">

          <div style="margin-top: 10px;">
            <label class="form-label" style="font-size: 12px;">Atau Ubah URL Gambar:</label>
            <input type="url" name="cover_url" id="edit_cover_url" class="form-input">
          </div>

          <div id="editPreviewBox" style="margin-top: 10px; display: flex; align-items: center; gap: 12px;">
            <img id="editPreviewImg" style="width: 60px; height: 85px; border-radius: 8px; object-fit: cover;">
            <span style="font-size: 12px; color: var(--muted);">Foto sampul yang sedang digunakan.</span>
          </div>
        </div>

        <div class="form-row">
          <label class="form-label">Sinopsis / Deskripsi Buku</label>
          <textarea name="description" id="edit_description" class="form-textarea" rows="3"></textarea>
        </div>

        <button type="submit" class="btn-add-book" style="width: 100%; justify-content: center; margin-top: 0.5rem;">
          💾 Simpan Perubahan Buku
        </button>
      </form>
    </div>
  </div>

  <script>
    // Tab titles map
    const tabTitles = {
      buku: 'Kelola Buku & Katalog',
      pinjam: 'Persetujuan Peminjaman Buku',
      kembali: 'Persetujuan Pengembalian Buku',
      aktif: 'Buku Sedang Dipinjam',
      riwayat: 'Riwayat Pengembalian Selesai'
    };

    // Tab Switching
    function switchTab(tabName) {
      document.querySelectorAll('.side-nav-btn').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

      const targetPane = document.getElementById('pane-' + tabName);
      if (targetPane) targetPane.classList.add('active');

      const activeBtn = Array.from(document.querySelectorAll('.side-nav-btn')).find(b => b.getAttribute('onclick')?.includes(tabName));
      if (activeBtn) activeBtn.classList.add('active');

      const pageTitle = document.getElementById('pageTitleText');
      if (pageTitle && tabTitles[tabName]) {
        pageTitle.textContent = tabTitles[tabName];
      }

      // Update URL query string without page reload
      const url = new URL(window.location);
      url.searchParams.set('tab', tabName);
      window.history.replaceState({}, '', url);

      // Close mobile sidebar if open
      closeSidebar();
    }

    // Sidebar Mobile Toggle
    const sidebar = document.getElementById('adminSidebar');
    const scrim = document.getElementById('sidebarScrim');

    function toggleSidebar() {
      sidebar.classList.toggle('open');
      scrim.classList.toggle('open');
    }
    function closeSidebar() {
      sidebar.classList.remove('open');
      scrim.classList.remove('open');
    }

    // Set initial title from query param
    const currentTab = new URLSearchParams(window.location.search).get('tab') || 'buku';
    if (tabTitles[currentTab]) {
      document.getElementById('pageTitleText').textContent = tabTitles[currentTab];
    }

    // Modal Add Book
    const addModal = document.getElementById('addBookModal');
    function openAddBookModal() { addModal.classList.add('open'); }
    function closeAddBookModal() { addModal.classList.remove('open'); }
    addModal.addEventListener('click', (e) => { if(e.target === addModal) closeAddBookModal(); });

    function previewAddCover(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('addPreviewImg').src = e.target.result;
          document.getElementById('addPreviewBox').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Modal Edit Book
    const editModal = document.getElementById('editBookModal');
    function openEditBookModal(book) {
      document.getElementById('editBookForm').action = '/admin/books/' + book.id;
      document.getElementById('edit_title').value = book.title;
      document.getElementById('edit_author').value = book.author;
      document.getElementById('edit_code').value = book.code;
      document.getElementById('edit_category').value = book.category;
      document.getElementById('edit_stock').value = book.stock;
      document.getElementById('edit_description').value = book.description || '';

      const editUrlInput = document.getElementById('edit_cover_url');
      if (book.cover && (book.cover.startsWith('http://') || book.cover.startsWith('https://'))) {
        editUrlInput.value = book.cover;
      } else {
        editUrlInput.value = '';
      }

      document.getElementById('editPreviewImg').src = book.cover_url || book.cover || 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300';
      editModal.classList.add('open');
    }
    function closeEditBookModal() { editModal.classList.remove('open'); }
    editModal.addEventListener('click', (e) => { if(e.target === editModal) closeEditBookModal(); });

    function previewEditCover(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('editPreviewImg').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>
</html>

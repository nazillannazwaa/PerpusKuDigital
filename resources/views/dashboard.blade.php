<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Dashboard - PerpusKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Bricolage+Grotesque:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --sidebar-bg: #0b1a30;
  --sidebar-hover: #162a4a;
  --sidebar-active: #19355e;
  --main-bg: #dbeafe;
  --main-bg-soft: #eaf2fd;
  --card-bg: #ffffff;
  --navy: #0b1a30;
  --navy-light: #1e3a5f;
  --blue-primary: #1d4ed8;
  --blue-accent: #2563eb;
  --text-main: #0f172a;
  --text-muted: #64748b;
  --border-line: rgba(15, 23, 42, 0.08);
  --border-card: rgba(186, 215, 245, 0.6);
  --sw: 240px;
}

* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background: var(--main-bg-soft);
  color: var(--text-main);
  min-height: 100vh;
  display: flex;
  overflow-x: hidden;
}

/* APP WRAPPER */
.app {
  display: flex;
  width: 100%;
  min-height: 100vh;
}

/* SIDEBAR */
aside.sidebar {
  width: var(--sw);
  background: var(--sidebar-bg);
  color: #fff;
  display: flex;
  flex-direction: column;
  position: fixed;
  inset: 0 auto 0 0;
  z-index: 40;
  padding: 24px 16px;
  transition: transform 0.25s ease;
}

body.sidebar-collapsed aside.sidebar {
  transform: translateX(-100%);
}

.brand {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 0 8px 32px 8px;
  text-decoration: none;
  color: #fff;
}
.brand-icon {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  background: linear-gradient(135deg, #38bdf8, #2563eb);
  color: #fff;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.brand-icon svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; }
.brand-text {
  font-family: 'Bricolage Grotesque', sans-serif;
  font-size: 20px;
  font-weight: 700;
  letter-spacing: -0.3px;
}
.brand-info {
  display: flex;
  flex-direction: column;
  justify-content: center;
  line-height: 1.15;
}
.brand-sub {
  font-size: 11.5px;
  font-weight: 700;
  color: #38bdf8;
  letter-spacing: 0.5px;
  margin-top: 2px;
}

nav.side-menu {
  display: flex;
  flex-direction: column;
  gap: 4px;
  flex: 1;
}
.nav-link {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 11px 14px;
  border-radius: 10px;
  color: rgba(255, 255, 255, 0.72);
  text-decoration: none;
  font-size: 13.5px;
  font-weight: 600;
  transition: all 0.15s ease;
}
.nav-link svg {
  width: 18px;
  height: 18px;
  stroke: currentColor;
  fill: none;
  stroke-width: 2;
  flex-shrink: 0;
}
.nav-link:hover {
  background: var(--sidebar-hover);
  color: #fff;
}
.nav-link.active {
  background: var(--sidebar-active);
  color: #fff;
  font-weight: 700;
}

.sidebar-foot {
  padding-top: 16px;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.btn-logout {
  width: 100%;
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.7);
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 14px;
  border-radius: 10px;
  font-family: inherit;
  font-size: 13.5px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.15s ease;
}
.btn-logout:hover {
  background: rgba(239, 68, 68, 0.15);
  color: #fca5a5;
}
.btn-logout svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; }

/* MAIN CONTENT */
main.main-viewport {
  flex: 1;
  margin-left: var(--sw);
  min-width: 0;
  background: var(--main-bg-soft);
  display: flex;
  flex-direction: column;
  transition: margin-left 0.25s ease, background 0.2s ease;
}

body.sidebar-collapsed main.main-viewport {
  margin-left: 0;
}

/* SIDEBAR BACKDROP */
.sidebar-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(2px);
  z-index: 38;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.25s ease;
}
.sidebar-backdrop.active {
  opacity: 1;
  pointer-events: auto;
}

/* TOP HEADER */
header.top-header {
  position: sticky;
  top: 0;
  z-index: 30;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  padding: 18px 40px;
  background: var(--main-bg-soft);
}
.header-search {
  flex: 1;
  max-width: 480px;
  position: relative;
  display: flex;
  align-items: center;
}
.header-search svg {
  position: absolute;
  left: 14px;
  width: 18px;
  height: 18px;
  color: var(--text-muted);
  pointer-events: none;
  stroke: currentColor;
  fill: none;
  stroke-width: 2;
}
.header-search input {
  width: 100%;
  height: 42px;
  padding: 0 16px 0 42px;
  border-radius: 10px;
  border: 1px solid rgba(15, 23, 42, 0.1);
  background: #ffffff;
  color: var(--navy);
  font-family: inherit;
  font-size: 13.5px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.header-search input:focus {
  border-color: var(--blue-accent);
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
}

.header-actions {
  display: flex;
  align-items: center;
  gap: 14px;
}
.btn-icon-head {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  border: none;
  background: transparent;
  color: var(--navy);
  display: grid;
  place-items: center;
  cursor: pointer;
  position: relative;
  transition: background 0.15s;
}
.btn-icon-head:hover {
  background: rgba(15, 23, 42, 0.05);
}
.btn-icon-head svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; }
.avatar-head {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--navy);
  color: #fff;
  display: grid;
  place-items: center;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
}
.avatar-head img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }

/* CONTENT CONTAINER */
.content-body {
  padding: 0 40px 48px 40px;
  max-width: 1280px;
  width: 100%;
  margin: 0 auto;
}

/* FLASH NOTIFICATIONS */
.flash-msg {
  padding: 12px 18px;
  border-radius: 12px;
  font-size: 13.5px;
  font-weight: 600;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  transition: opacity 0.4s ease, transform 0.4s ease, max-height 0.4s ease, margin 0.4s ease, padding 0.4s ease;
  overflow: hidden;
}
.flash-msg.fade-out {
  opacity: 0;
  transform: translateY(-8px);
  max-height: 0;
  margin-bottom: 0;
  padding-top: 0;
  padding-bottom: 0;
  border-width: 0;
}
.flash-ok {
  background: #dcfce7;
  color: #15803d;
  border: 1px solid #bbf7d0;
}
.flash-err {
  background: #fee2e2;
  color: #b91c1c;
  border: 1px solid #fecaca;
}

/* HERO WELCOME BANNER (MATCHING SCREENSHOT) */
.hero-banner {
  background: #ffffff;
  border: 1px solid var(--border-card);
  border-radius: 20px;
  padding: 36px 42px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  margin-bottom: 32px;
  box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
}
.hero-text {
  flex: 1;
  max-width: 580px;
}
.hero-badge {
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 1.5px;
  color: #64748b;
  text-transform: uppercase;
  margin-bottom: 8px;
  display: block;
}
.hero-title {
  font-family: 'Bricolage Grotesque', sans-serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--navy);
  letter-spacing: -0.6px;
  margin-bottom: 10px;
  line-height: 1.2;
}
.hero-subtitle {
  font-size: 14.5px;
  color: var(--text-muted);
  line-height: 1.6;
}

.hero-illus {
  width: 280px;
  flex-shrink: 0;
  background: #bfdbfe;
  border-radius: 16px;
  padding: 24px 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.hero-illus svg {
  width: 100%;
  height: auto;
  max-height: 160px;
}

/* 4 METRICS BAR WITH VERTICAL DIVIDERS */
.metrics-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 0 32px 0;
  margin-bottom: 28px;
  border-bottom: 1px solid rgba(15, 23, 42, 0.08);
}
.metric-col {
  flex: 1;
  text-align: left;
  padding: 0 16px;
  position: relative;
}
.metric-col:first-child { padding-left: 0; }
.metric-col:not(:last-child)::after {
  content: '';
  position: absolute;
  top: 10%;
  right: 0;
  height: 80%;
  width: 1px;
  background: rgba(15, 23, 42, 0.15);
}
.metric-number {
  font-family: 'Bricolage Grotesque', sans-serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--navy);
  line-height: 1.1;
  margin-bottom: 4px;
}
.metric-label {
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: #64748b;
}

/* SECTION COMMON STYLES */
.dashboard-section {
  margin-bottom: 40px;
}
.section-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 18px;
}
.section-title {
  font-family: 'Bricolage Grotesque', sans-serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--navy);
  letter-spacing: -0.3px;
}
.section-link {
  font-size: 13px;
  font-weight: 600;
  color: #1e3a8a;
  text-decoration: underline;
  cursor: pointer;
}
.section-link:hover {
  color: var(--blue-accent);
}

/* HORIZONTAL BOOK CARDS ROW */
.books-cards-row {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 18px;
}
.book-show-card {
  background: var(--card-bg);
  border: 1px solid var(--border-card);
  border-radius: 14px;
  padding: 16px;
  display: flex;
  flex-direction: column;
  transition: transform 0.2s, box-shadow 0.2s;
  box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
  text-decoration: none;
  color: inherit;
}
.book-show-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
}
.book-cover-frame {
  width: 100%;
  aspect-ratio: 120/165;
  border-radius: 8px;
  overflow: hidden;
  background: #e2e8f0;
  margin-bottom: 14px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
  display: grid;
  place-items: center;
}
.book-cover-frame img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.book-card-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 2px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.book-card-author {
  font-size: 12px;
  color: var(--text-muted);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.book-card-cat {
  font-size: 11px;
  color: #94a3b8;
  margin-bottom: 8px;
}
.book-card-action {
  font-size: 12px;
  font-weight: 700;
  color: var(--blue-accent);
  text-decoration: underline;
  cursor: pointer;
  margin-top: auto;
  padding-top: 4px;
}

/* AKTIVITAS TERBARU LIST */
.activity-list-card {
  background: var(--card-bg);
  border: 1px solid var(--border-card);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
}
.activity-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid rgba(15, 23, 42, 0.06);
  font-size: 13.5px;
  color: var(--navy);
  transition: background 0.15s;
}
.activity-row:last-child { border-bottom: none; }
.activity-row:hover { background: #f8fafc; }
.activity-left {
  display: flex;
  align-items: center;
  gap: 14px;
}
.activity-icon {
  width: 24px;
  height: 24px;
  color: #2563eb;
  display: grid;
  place-items: center;
  flex-shrink: 0;
}
.activity-icon svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; }
.activity-date {
  font-size: 12px;
  color: var(--text-muted);
  flex-shrink: 0;
}

/* VIEW SECTIONS */
.sec-tab { display: none; }
body.view-dashboard #tab-dashboard { display: block; }
body.view-katalog #tab-katalog { display: block; }
body.view-peminjaman #tab-peminjaman { display: block; }
body.view-pengembalian #tab-pengembalian { display: block; }
body.view-riwayat #tab-riwayat { display: block; }
body.view-profil #tab-profil { display: block; }

/* SHARED TABLE STYLES */
.data-card {
  background: #ffffff;
  border: 1px solid var(--border-card);
  border-radius: 16px;
  padding: 24px;
  box-shadow: 0 2px 12px rgba(15, 23, 42, 0.03);
  margin-bottom: 24px;
}
.data-card h2 {
  font-family: 'Bricolage Grotesque', sans-serif;
  font-size: 20px;
  color: var(--navy);
  margin-bottom: 4px;
}
.data-card p.sub {
  color: var(--text-muted);
  font-size: 13px;
  margin-bottom: 18px;
}
.tw { overflow-x: auto; }
table.app-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 640px;
}
table.app-table th {
  text-align: left;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #64748b;
  padding: 12px 14px;
  border-bottom: 1px solid rgba(15, 23, 42, 0.1);
  background: #f8fafc;
}
table.app-table td {
  padding: 14px;
  border-bottom: 1px solid rgba(15, 23, 42, 0.06);
  font-size: 13.5px;
  color: var(--navy);
  vertical-align: middle;
}
table.app-table tr:last-child td { border-bottom: none; }
table.app-table tr:hover td { background: #f8fafc; }

.badge-st {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 99px;
  font-size: 11.5px;
  font-weight: 700;
}
.badge-ok { background: #dcfce7; color: #166534; }
.badge-warn { background: #fef3c7; color: #92400e; }
.badge-danger { background: #fee2e2; color: #991b1b; }

.btn-sm-action {
  background: var(--blue-accent);
  color: #fff;
  border: none;
  padding: 6px 14px;
  border-radius: 8px;
  font-size: 12.5px;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  transition: opacity 0.15s;
}
.btn-sm-action:hover { opacity: 0.9; }
.btn-sm-action:disabled { opacity: 0.5; cursor: not-allowed; }

/* KATALOG CHIPS */
.chips-row {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-bottom: 20px;
}
.chip-btn {
  border: 1px solid rgba(15, 23, 42, 0.12);
  background: #ffffff;
  border-radius: 99px;
  padding: 6px 16px;
  font-size: 13px;
  font-weight: 600;
  color: #64748b;
  cursor: pointer;
  transition: all 0.15s;
}
.chip-btn.active, .chip-btn:hover {
  background: var(--navy);
  color: #fff;
  border-color: var(--navy);
}

/* MODAL STYLES */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(11, 26, 48, 0.6);
  backdrop-filter: blur(4px);
  z-index: 100;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
}
.modal-overlay.open { display: flex; }
.modal-box {
  background: #ffffff;
  border-radius: 18px;
  width: 100%;
  max-width: 520px;
  max-height: 90vh;
  overflow-y: auto;
  padding: 24px;
  position: relative;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
}
.modal-box-lg {
  max-width: 660px;
}
.book-detail-grid {
  display: grid;
  grid-template-columns: 200px 1fr;
  gap: 26px;
  align-items: start;
}
.book-detail-cover-wrap {
  width: 100%;
  aspect-ratio: 120/165;
  border-radius: 14px;
  overflow: hidden;
  background: #e2e8f0;
  box-shadow: 0 10px 24px rgba(15, 23, 42, 0.16);
}
.book-detail-cover-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.book-detail-synopsis {
  font-size: 13.5px;
  line-height: 1.65;
  color: var(--navy);
  background: rgba(15, 23, 42, 0.03);
  padding: 12px 14px;
  border-radius: 12px;
  border: 1px solid var(--border-line);
  max-height: 160px;
  overflow-y: auto;
}
body.dark-mode .book-detail-synopsis {
  background: rgba(255, 255, 255, 0.04);
  border-color: rgba(255, 255, 255, 0.08);
  color: #e2e8f0;
}
@media (max-width: 620px) {
  .book-detail-grid {
    grid-template-columns: 1fr;
    gap: 18px;
    text-align: center;
  }
  .book-detail-cover-wrap {
    max-width: 160px;
    margin: 0 auto;
  }
}
.modal-close {
  position: absolute;
  top: 16px;
  right: 16px;
  background: #f1f5f9;
  border: none;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  display: grid;
  place-items: center;
}
.form-grp { margin-bottom: 14px; }
.form-grp label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 4px; color: var(--navy); }
.form-ctrl {
  width: 100%;
  border: 1px solid rgba(15, 23, 42, 0.15);
  border-radius: 10px;
  padding: 10px 14px;
  font-family: inherit;
  font-size: 13.5px;
  outline: none;
}
.form-ctrl:focus { border-color: var(--blue-accent); }

/* TOAST */
.toast-box {
  position: fixed;
  left: 50%;
  bottom: 24px;
  transform: translate(-50%, 20px);
  background: var(--navy);
  color: #fff;
  padding: 10px 20px;
  border-radius: 10px;
  opacity: 0;
  pointer-events: none;
  transition: 0.25s;
  z-index: 99;
  font-size: 13.5px;
  font-weight: 600;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}
.toast-box.show { opacity: 1; transform: translate(-50%, 0); }

/* ================= DARK THEME ================= */
body.dark-mode {
  --main-bg: #090e17;
  --main-bg-soft: #0b1322;
  --sidebar-bg: #080d18;
  --sidebar-hover: #131e33;
  --sidebar-active: #192a47;
  --card-bg: #111d33;
  --navy: #f8fafc;
  --navy-light: #cbd5e1;
  --blue-primary: #38bdf8;
  --blue-accent: #3b82f6;
  --text-main: #f8fafc;
  --text-muted: #94a3b8;
  --border-line: rgba(255, 255, 255, 0.08);
  --border-card: rgba(255, 255, 255, 0.08);
}
body.dark-mode header.top-header {
  background: #0b1322;
}
body.dark-mode .btn-icon-head {
  color: #cbd5e1;
}
body.dark-mode .btn-icon-head:hover {
  background: rgba(255, 255, 255, 0.08);
}
body.dark-mode .data-card,
body.dark-mode .hero-banner,
body.dark-mode .modal-box {
  background: #111d33;
  border-color: rgba(255, 255, 255, 0.08);
  color: #f8fafc;
}
body.dark-mode .header-search input {
  background: #111d33;
  border-color: rgba(255, 255, 255, 0.12);
  color: #f8fafc;
}
body.dark-mode .header-search input::placeholder {
  color: #64748b;
}
body.dark-mode .book-show-card,
body.dark-mode .book-card-item {
  background: #111d33;
  border-color: rgba(255, 255, 255, 0.08);
  color: #f8fafc;
}
body.dark-mode .book-show-card:hover {
  border-color: var(--blue-accent);
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.4);
}
body.dark-mode .book-card-action {
  color: #60a5fa;
}
body.dark-mode .book-card-cat {
  color: #94a3b8;
}
body.dark-mode .section-link {
  color: #38bdf8;
}
body.dark-mode .book-cover-frame {
  background: #0d1627;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);
}
body.dark-mode .book-card-title {
  color: #f8fafc;
}
body.dark-mode .book-card-author {
  color: #94a3b8;
}
body.dark-mode .metric-number,
body.dark-mode .metric-num {
  color: #f8fafc;
}
body.dark-mode .metric-label,
body.dark-mode .metric-lbl {
  color: #94a3b8;
}
body.dark-mode .metric-col:not(:last-child)::after {
  background: rgba(255, 255, 255, 0.08);
}
body.dark-mode .hero-illus {
  background: #16243f;
}
body.dark-mode .activity-list-card,
body.dark-mode .activity-item {
  background: #111d33;
  border-color: rgba(255, 255, 255, 0.08);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
}
body.dark-mode .activity-row {
  color: #f1f5f9;
  border-bottom-color: rgba(255, 255, 255, 0.06);
}
body.dark-mode .activity-row:hover {
  background: #16243f;
}
body.dark-mode .activity-date {
  color: #94a3b8;
}
body.dark-mode .activity-icon {
  color: #60a5fa;
}
body.dark-mode table.app-table th {
  background: #0d1627;
  color: #94a3b8;
  border-color: rgba(255, 255, 255, 0.08);
}
body.dark-mode table.app-table td {
  color: #f1f5f9;
  border-color: rgba(255, 255, 255, 0.06);
}
body.dark-mode table.app-table tr:hover td {
  background: #16243f;
}
body.dark-mode .chip-btn {
  background: #111d33;
  border-color: rgba(255, 255, 255, 0.12);
  color: #94a3b8;
}
body.dark-mode .chip-btn:hover {
  background: #1a2a47;
  color: #f8fafc;
}
body.dark-mode .chip-btn.active {
  background: #2563eb;
  color: #ffffff;
  border-color: #2563eb;
}
body.dark-mode .form-ctrl {
  background: #0d1627;
  border-color: rgba(255, 255, 255, 0.12);
  color: #f8fafc;
}
body.dark-mode .form-ctrl:focus {
  border-color: #3b82f6;
}
body.dark-mode .form-ctrl:disabled,
body.dark-mode .form-ctrl[readonly] {
  background: #080d18 !important;
  color: #64748b !important;
  border-color: rgba(255, 255, 255, 0.05) !important;
}
body.dark-mode .form-grp label,
body.dark-mode .data-card h2,
body.dark-mode .modal-box h3,
body.dark-mode .dash-sec-head h3 {
  color: #f8fafc;
}
body.dark-mode .modal-close {
  background: #1a2a47;
  color: #94a3b8;
}
body.dark-mode .toast-box {
  background: #1e293b;
  color: #f8fafc;
  border: 1px solid rgba(255, 255, 255, 0.1);
}
body.dark-mode .icon-sun {
  display: block !important;
}
body.dark-mode .icon-moon {
  display: none !important;
}

/* RESPONSIVE */
@media (max-width: 900px) {
  aside.sidebar { transform: translateX(-100%); }
  aside.sidebar.open { transform: translateX(0); }
  main.main-viewport { margin-left: 0; }
  header.top-header { padding: 14px 20px; }
  .content-body { padding: 0 20px 36px 20px; }
  .hero-banner { flex-direction: column; align-items: flex-start; padding: 28px 24px; gap: 20px; }
  .hero-illus { width: 100%; max-height: 140px; }
  .metrics-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px 16px; padding: 10px 0 24px 0; }
  .metric-col { padding: 0; }
  .metric-col:not(:last-child)::after { display: none; }
  .books-cards-row { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 14px; }
}

@media (max-width: 640px) {
  header.top-header {
    padding: 10px 14px;
    gap: 8px;
  }
  .header-search {
    max-width: none;
  }
  .header-search input {
    height: 38px;
    padding: 0 12px 0 36px;
    font-size: 12.5px;
  }
  .header-search svg {
    left: 10px;
    width: 16px;
    height: 16px;
  }
  .header-actions {
    gap: 8px;
  }
  .btn-icon-head {
    width: 34px;
    height: 34px;
  }
  .btn-icon-head svg {
    width: 18px;
    height: 18px;
  }
  .avatar-head {
    width: 32px;
    height: 32px;
    font-size: 12px;
  }
  .content-body {
    padding: 0 12px 32px 12px;
  }
  .hero-banner {
    padding: 20px 16px;
    border-radius: 16px;
    margin-bottom: 20px;
  }
  .hero-badge {
    font-size: 10px;
  }
  .hero-title {
    font-size: 22px;
    letter-spacing: -0.4px;
    margin-bottom: 6px;
  }
  .hero-subtitle {
    font-size: 13px;
    line-height: 1.5;
  }
  .hero-illus {
    padding: 14px;
    max-height: 110px;
    border-radius: 12px;
  }
  .metrics-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px 12px;
    padding: 4px 0 20px 0;
    margin-bottom: 20px;
  }
  .metric-number {
    font-size: 24px;
  }
  .metric-label {
    font-size: 10.5px;
  }
  .section-head {
    margin-bottom: 12px;
  }
  .section-title {
    font-size: 18px;
  }
  .section-link {
    font-size: 12px;
  }
  .books-cards-row {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
  }
  .book-show-card {
    padding: 10px;
    border-radius: 12px;
  }
  .book-cover-frame {
    margin-bottom: 8px;
    border-radius: 6px;
  }
  .book-card-title {
    font-size: 13px;
  }
  .book-card-author {
    font-size: 11px;
  }
  .book-card-cat {
    font-size: 10.5px;
    margin-bottom: 6px;
  }
  .book-card-action {
    font-size: 11.5px;
  }
  .chips-row {
    display: flex;
    gap: 8px;
    flex-wrap: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 6px;
    scrollbar-width: none;
    margin-bottom: 14px;
  }
  .chips-row::-webkit-scrollbar {
    display: none;
  }
  .chip-btn {
    white-space: nowrap;
    flex-shrink: 0;
    padding: 5px 12px;
    font-size: 12px;
  }
  .activity-list-card {
    border-radius: 14px;
  }
  .activity-row {
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
    padding: 12px 14px;
  }
  .activity-left {
    gap: 10px;
    font-size: 12.5px;
  }
  .activity-date {
    font-size: 11px;
    padding-left: 34px;
  }
  .data-card {
    padding: 16px 12px;
    border-radius: 14px;
    margin-bottom: 16px;
  }
  .data-card h2 {
    font-size: 17px;
  }
  .data-card p.sub {
    font-size: 12px;
    margin-bottom: 12px;
  }
  .modal-overlay {
    padding: 10px;
  }
  .modal-box {
    padding: 18px 14px;
    border-radius: 16px;
  }
  .profile-head-wrap {
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 14px;
  }
  .password-grid {
    grid-template-columns: 1fr !important;
  }
}
</style>
</head>
<body class="view-dashboard">

<div class="app">

  <!-- BACKDROP FOR MOBILE SIDEBAR -->
  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

  <!-- ================= SIDEBAR ================= -->
  <aside class="sidebar" id="sidebar">
    <a href="#dashboard" class="brand">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"/></svg>
      </div>
      <div class="brand-info">
        <span class="brand-text">PerpusKu</span>
        @if ($isAdmin)
          <span class="brand-sub">AdminHub</span>
        @endif
      </div>
    </a>

    <nav class="side-menu">
      <a href="#dashboard" class="nav-link active" data-tab="dashboard">
        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
        <span>Dashboard</span>
      </a>

      <a href="#katalog" class="nav-link" data-tab="katalog">
        <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"/></svg>
        <span>Katalog Buku</span>
      </a>

      <a href="#peminjaman" class="nav-link" data-tab="peminjaman">
        <svg viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
        <span>Peminjaman</span>
      </a>

      <a href="#pengembalian" class="nav-link" data-tab="pengembalian">
        <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
        <span>Pengembalian</span>
      </a>

      <a href="#riwayat" class="nav-link" data-tab="riwayat">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Riwayat</span>
      </a>

      <a href="#profil" class="nav-link" data-tab="profil">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        <span>Profil</span>
      </a>
    </nav>

    <div class="sidebar-foot">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout" title="Keluar dari akun">
          <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- ================= MAIN VIEWPORT ================= -->
  <main class="main-viewport">

    <!-- TOP HEADER -->
    <header class="top-header">
      <div style="display:flex;align-items:center;gap:12px;flex:1;max-width:540px;">
        <!-- TOGGLE SIDEBAR BUTTON -->
        <button type="button" class="btn-icon-head" id="sidebarToggleBtn" title="Buka / Tutup Menu Sidebar" aria-label="Toggle Sidebar">
          <svg viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>

        <!-- SEARCH INPUT -->
        <div class="header-search" style="flex:1;">
          <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="search" id="globalSearch" placeholder="Cari buku, penulis, atau kategori...">
        </div>
      </div>

      <div class="header-actions">
        <!-- THEME TOGGLE (TERANG / GELAP) -->
        <button type="button" class="btn-icon-head" id="themeToggleBtn" title="Ganti Tema (Terang / Gelap)" aria-label="Toggle Theme">
          <!-- Sun icon (shown in dark mode) -->
          <svg class="icon-sun" viewBox="0 0 24 24" style="display:none;"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
          <!-- Moon icon (shown in light mode) -->
          <svg class="icon-moon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </button>

        <button type="button" class="btn-icon-head" title="Notifikasi" onclick="showToast('Semua peminjaman dan pengembalian Anda terdata rapi')">
          <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </button>

        <a href="#profil" class="avatar-head" title="Lihat profil" style="overflow:hidden;padding:0;display:flex;align-items:center;justify-content:center;">
          <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        </a>
      </div>
    </header>

    <!-- CONTENT BODY -->
    <div class="content-body">

      <!-- FLASH ALERTS -->
      @if (session('status'))
        <div class="flash-msg flash-ok">
          <span>✓ {{ session('status') }}</span>
          <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;">✕</button>
        </div>
      @endif
      @if (session('error') || $errors->any())
        <div class="flash-msg flash-err" style="align-items:flex-start;">
          <div>
            @if (session('error'))
              <div>⚠️ {{ session('error') }}</div>
            @endif
            @if ($errors->any())
              <div style="font-weight:700;margin-bottom:2px;">⚠️ Terjadi kesalahan:</div>
              <ul style="margin:2px 0 0 16px;padding:0;font-size:12.5px;">
                @foreach ($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            @endif
          </div>
          <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;">✕</button>
        </div>
      @endif

      <!-- ================= 1. TAB: DASHBOARD (EXACT SCREENSHOT LAYOUT) ================= -->
      <div class="sec-tab" id="tab-dashboard">

        <!-- HERO WELCOME BANNER -->
        <div class="hero-banner">
          <div class="hero-text">
            <span class="hero-badge">{{ $isAdmin ? 'PANEL ADMINISTRATOR' : 'PERPUSTAKAAN DIGITAL' }}</span>
            <h1 class="hero-title">{{ $isAdmin ? 'Selamat Datang Admin PerpusKu' : 'Selamat Datang di PerpusKu!' }}</h1>
            <p class="hero-subtitle">{{ $isAdmin ? 'Kelola koleksi buku, pantau sirkulasi peminjaman, dan data anggota dengan mudah.' : 'Temukan buku favoritmu dan mulai petualangan membaca hari ini.' }}</p>
          </div>

          <!-- VECTOR BOOK ILLUSTRATION (MATCHING SCREENSHOT) -->
          <div class="hero-illus" aria-hidden="true">
            <svg viewBox="0 0 320 180" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- Book Base Stack -->
              <rect x="50" y="125" width="160" height="20" rx="3" fill="#1e3a5f"/>
              <rect x="54" y="127" width="152" height="16" rx="2" fill="#e2e8f0"/>
              <rect x="46" y="105" width="168" height="20" rx="3" fill="#2563eb"/>
              <rect x="50" y="107" width="160" height="16" rx="2" fill="#f8fafc"/>
              
              <!-- Open Book in Front -->
              <path d="M120 120 C140 115 155 118 160 124 C165 118 180 115 200 120 L205 140 C185 135 170 138 160 144 C150 138 135 135 115 140 Z" fill="#0b1a30"/>
              <path d="M122 122 C140 117 154 120 159 125 L159 143 C154 138 140 135 122 139 Z" fill="#ffffff"/>
              <path d="M198 122 C180 117 166 120 161 125 L161 143 C166 138 180 135 198 139 Z" fill="#ffffff"/>
              
              <!-- Spine Center -->
              <line x1="160" y1="125" x2="160" y2="144" stroke="#94a3b8" stroke-width="2"/>

              <!-- Flying Pages / Floating Geometrics (Navy and Light Blue) -->
              <polygon points="180,65 195,50 205,65 190,80" fill="#1e3a5f" opacity="0.9"/>
              <polygon points="210,85 225,75 235,90 220,100" fill="#2563eb" opacity="0.85"/>
              <polygon points="160,80 170,72 178,82 168,90" fill="#38bdf8" opacity="0.75"/>
              <polygon points="200,40 212,32 218,44 206,52" fill="#0b1a30"/>
              <polygon points="175,95 185,88 190,98 180,105" fill="#93c5fd"/>
            </svg>
          </div>
        </div>

        <!-- 4 METRICS BAR -->
        <div class="metrics-row">
          <div class="metric-col">
            <div class="metric-number">{{ number_format($overviewStats['total_books'], 0, ',', '.') }}</div>
            <div class="metric-label">TOTAL BUKU</div>
          </div>
          <div class="metric-col">
            <div class="metric-number">{{ number_format($overviewStats['borrowed_books'], 0, ',', '.') }}</div>
            <div class="metric-label">BUKU DIPINJAM</div>
          </div>
          <div class="metric-col">
            <div class="metric-number">{{ number_format($overviewStats['available_books'], 0, ',', '.') }}</div>
            <div class="metric-label">BUKU TERSEDIA</div>
          </div>
          <div class="metric-col">
            <div class="metric-number">{{ number_format($overviewStats['total_members'], 0, ',', '.') }}</div>
            <div class="metric-label">TOTAL ANGGOTA</div>
          </div>
        </div>

        <!-- SECTION: BUKU POPULER -->
        <section class="dashboard-section">
          <div class="section-head">
            <h2 class="section-title">Buku Populer</h2>
            <a href="#katalog" class="section-link">Lihat Semua</a>
          </div>

          <div class="books-cards-row">
            @forelse ($popularBooks as $pb)
              <div class="book-show-card" onclick="openBookDetailModal({{ $pb->id }})" style="cursor:pointer;" title="Klik untuk melihat detail buku {{ $pb->title }}">
                <div class="book-cover-frame">
                  <img src="{{ $pb->cover_url }}" alt="{{ $pb->title }}" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80';">
                </div>
                <div class="book-card-title" title="{{ $pb->title }}">{{ $pb->title }}</div>
                <div class="book-card-author">{{ $pb->author }}</div>
                <div class="book-card-cat">{{ $pb->category }}</div>
                <div class="book-card-action" onclick="event.stopPropagation();openBookDetailModal({{ $pb->id }})">Detail Buku</div>
              </div>
            @empty
              <p style="color:var(--text-muted);font-size:13px;">Belum ada buku di katalog.</p>
            @endforelse
          </div>
        </section>

        <!-- SECTION: BUKU TERBARU -->
        <section class="dashboard-section">
          <div class="section-head">
            <h2 class="section-title">Buku Terbaru</h2>
            <a href="#katalog" class="section-link">Jelajahi Katalog</a>
          </div>

          <div class="books-cards-row">
            @forelse ($recentBooks as $rb)
              <div class="book-show-card" onclick="openBookDetailModal({{ $rb->id }})" style="cursor:pointer;" title="Klik untuk melihat detail buku {{ $rb->title }}">
                <div class="book-cover-frame">
                  <img src="{{ $rb->cover_url }}" alt="{{ $rb->title }}" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80';">
                </div>
                <div class="book-card-title" title="{{ $rb->title }}">{{ $rb->title }}</div>
                <div class="book-card-author">{{ $rb->author }}</div>
                <div class="book-card-cat">{{ $rb->category }}</div>
                <div class="book-card-action" onclick="event.stopPropagation();openBookDetailModal({{ $rb->id }})">Detail Buku</div>
              </div>
            @empty
              <p style="color:var(--text-muted);font-size:13px;">Belum ada koleksi buku terbaru.</p>
            @endforelse
          </div>
        </section>

        <!-- SECTION: AKTIVITAS TERBARU -->
        <section class="dashboard-section">
          <div class="section-head">
            <h2 class="section-title">Aktivitas Terbaru</h2>
          </div>

          <div class="activity-list-card">
            @forelse ($recentActivities as $act)
              @php
                $isReturn = in_array($act->status, ['returned', 'pending_return']);
                $actText = $isReturn 
                  ? 'Mengembalikan buku ' . $act->book->title . ' tepat waktu'
                  : 'Meminjam buku ' . $act->book->title . ' oleh ' . $act->book->author;
                $actDate = $act->created_at ? $act->created_at->format('d M Y') : now()->format('d M Y');
              @endphp
              <div class="activity-row">
                <div class="activity-left">
                  <div class="activity-icon">
                    @if ($isReturn)
                      <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                    @else
                      <svg viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
                    @endif
                  </div>
                  <div>{{ $actText }}</div>
                </div>
                <div class="activity-date">{{ $actDate }}</div>
              </div>
            @empty
              <!-- Static Clean Fallback Samples if fresh database -->
              <div class="activity-row">
                <div class="activity-left">
                  <div class="activity-icon"><svg viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg></div>
                  <div>Meminjam buku Laskar Pelangi oleh Andrea Hirata</div>
                </div>
                <div class="activity-date">12 Mei 2026</div>
              </div>
              <div class="activity-row">
                <div class="activity-left">
                  <div class="activity-icon"><svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg></div>
                  <div>Mengembalikan buku Filosofi Teras tepat waktu</div>
                </div>
                <div class="activity-date">10 Mei 2026</div>
              </div>
              <div class="activity-row">
                <div class="activity-left">
                  <div class="activity-icon"><svg viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg></div>
                  <div>Meminjam buku Atomic Habits oleh James Clear</div>
                </div>
                <div class="activity-date">08 Mei 2026</div>
              </div>
              <div class="activity-row">
                <div class="activity-left">
                  <div class="activity-icon"><svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"/></svg></div>
                  <div>Menambahkan Laut Bercerita ke daftar bacaan</div>
                </div>
                <div class="activity-date">05 Mei 2026</div>
              </div>
            @endforelse
          </div>
        </section>

      </div>

      <!-- ================= 2. TAB: KATALOG BUKU ================= -->
      <div class="sec-tab" id="tab-katalog">
        <div class="data-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:12px;">
            <div>
              <h2>Katalog Buku Perpustakaan</h2>
              <p class="sub" style="margin:0;">Jelajahi dan temukan seluruh koleksi buku yang tersedia</p>
            </div>
            @if ($isAdmin)
              <button type="button" class="btn-sm-action" onclick="openAddBookModal()" style="padding:9px 18px;font-size:13.5px;">
                + Tambah Buku Baru
              </button>
            @endif
          </div>

          <div class="chips-row" id="katalogChips"></div>
          <div class="books-cards-row" id="katalogBooksGrid"></div>
        </div>
      </div>

      <!-- ================= 3. TAB: PEMINJAMAN ================= -->
      <div class="sec-tab" id="tab-peminjaman">
        @if ($isAdmin)
          <!-- Admin: Persetujuan Pinjam -->
          <div class="data-card">
            <h2>Persetujuan Peminjaman Siswa</h2>
            <p class="sub">Tinjau permohonan peminjaman buku yang diajukan oleh siswa</p>
            @if ($pendingLoans->isEmpty())
              <p style="color:var(--text-muted);font-size:13px;padding:12px 0;">Tidak ada antrean peminjaman buku saat ini.</p>
            @else
              <div class="tw">
                <table class="app-table">
                  <thead>
                    <tr><th>Siswa</th><th>Buku</th><th>Stok</th><th>Tanggal Pengajuan</th><th>Aksi</th></tr>
                  </thead>
                  <tbody>
                    @foreach ($pendingLoans as $pl)
                      <tr>
                        <td><strong>{{ $pl->user->name }}</strong><div style="font-size:12px;color:var(--text-muted);">{{ $pl->user->email }}</div></td>
                        <td><strong>{{ $pl->book->title }}</strong><div style="font-size:12px;color:var(--text-muted);">{{ $pl->book->code }}</div></td>
                        <td><span class="badge-st {{ $pl->book->stock > 0 ? 'badge-ok' : 'badge-danger' }}">{{ $pl->book->stock }} buku</span></td>
                        <td>{{ $pl->created_at->format('d M Y, H:i') }}</td>
                        <td>
                          <div style="display:flex;gap:6px;">
                            <form action="{{ route('loans.approve', $pl->id) }}" method="POST" style="margin:0;">
                              @csrf
                              <button type="submit" class="btn-sm-action" style="background:#15803d;">✓ Setujui</button>
                            </form>
                            <form action="{{ route('loans.reject', $pl->id) }}" method="POST" style="margin:0;">
                              @csrf
                              <button type="submit" class="btn-sm-action" style="background:#b91c1c;" onclick="return confirm('Tolak permohonan ini?')">✕ Tolak</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          </div>
        @endif

        <!-- Student & Admin: Buku Sedang Dipinjam -->
        <div class="data-card">
          <h2>Buku Sedang Dipinjam</h2>
          <p class="sub">Daftar buku yang saat ini sedang aktif dalam masa peminjaman</p>
          <div class="tw">
            <table class="app-table">
              <thead>
                <tr>
                  <th>Buku</th>
                  <th>Peminjam</th>
                  <th>Tgl Pinjam</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
                  @if (!$isAdmin)
                    <th>Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody id="activeLoansRows"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ================= 4. TAB: PENGEMBALIAN ================= -->
      <div class="sec-tab" id="tab-pengembalian">
        @if ($isAdmin)
          <!-- Admin: Persetujuan Pengembalian -->
          <div class="data-card">
            <h2>Persetujuan Pengembalian Buku</h2>
            <p class="sub">Konfirmasi penerimaan buku yang dikembalikan siswa untuk mengembalikan stok buku</p>
            @if ($pendingReturns->isEmpty())
              <p style="color:var(--text-muted);font-size:13px;padding:12px 0;">Tidak ada buku menunggu konfirmasi pengembalian.</p>
            @else
              <div class="tw">
                <table class="app-table">
                  <thead>
                    <tr><th>Siswa</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali Diajukan</th><th>Aksi</th></tr>
                  </thead>
                  <tbody>
                    @foreach ($pendingReturns as $pr)
                      <tr>
                        <td><strong>{{ $pr->user->name }}</strong></td>
                        <td><strong>{{ $pr->book->title }}</strong><div style="font-size:12px;color:var(--text-muted);">{{ $pr->book->code }}</div></td>
                        <td>{{ $pr->borrow_date ? $pr->borrow_date->format('d M Y') : '-' }}</td>
                        <td>{{ $pr->updated_at ? $pr->updated_at->format('d M Y, H:i') : '-' }}</td>
                        <td>
                          <form action="{{ route('loans.approve-return', $pr->id) }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="btn-sm-action" style="background:#15803d;">✓ Terima (+1 Stok)</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
          </div>
        @endif

        <div class="data-card">
          <h2>Konfirmasi Pengembalian</h2>
          <p class="sub">Buku yang sudah atau sedang dalam proses verifikasi pengembalian</p>
          <div class="tw">
            <table class="app-table">
              <thead>
                <tr><th>Buku</th><th>Peminjam / Pengembali</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th></tr>
              </thead>
              <tbody id="returnedLoansRows"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ================= 5. TAB: RIWAYAT ================= -->
      <div class="sec-tab" id="tab-riwayat">
        <div class="data-card">
          <h2>Riwayat Peminjaman & Pengembalian</h2>
          <p class="sub">Catatan seluruh transaksi peminjaman dan pengembalian literasi</p>
          <div class="tw">
            <table class="app-table">
              <thead>
                <tr><th>Buku</th><th>User / Peminjam</th><th>Tgl Pinjam</th><th>Tgl Selesai / Kembali</th><th>Status</th></tr>
              </thead>
              <tbody id="fullHistoryRows"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ================= 6. TAB: PROFIL ================= -->
      <div class="sec-tab" id="tab-profil">
        <div class="data-card" style="max-width:680px;margin:0 auto;">
          <h2>Profil Pengguna</h2>
          <p class="sub">Kelola informasi akun, foto profil, dan kata sandi perpustakaan Anda</p>

          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            @method('PUT')

            <!-- Avatar Header & Quick Photo Changer -->
            <div class="profile-head-wrap" style="display:flex;align-items:center;gap:20px;padding-bottom:22px;margin-bottom:22px;border-bottom:1px solid var(--border-line);">
              <div style="position:relative;width:82px;height:82px;flex-shrink:0;">
                <img id="formPreviewImg" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" style="width:82px;height:82px;border-radius:50%;object-fit:cover;border:3px solid var(--blue-accent);background:#f1f5f9;box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                <label for="profileAvatarFileInput" title="Ganti foto profil" style="position:absolute;bottom:-2px;right:-2px;width:28px;height:28px;border-radius:50%;background:var(--blue-accent);color:#fff;display:grid;place-items:center;cursor:pointer;border:2px solid #fff;box-shadow:0 2px 5px rgba(0,0,0,0.2);">
                  <svg style="width:14px;height:14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                </label>
              </div>

              <div>
                <div style="font-size:17px;font-weight:700;color:var(--navy);margin-bottom:3px;">{{ $user->name }}</div>
                <div style="font-size:13px;color:var(--text-muted);margin-bottom:10px;">
                  {{ $user->email }} &bull; <span class="badge-st badge-ok" style="font-size:11px;padding:2px 8px;">{{ $isAdmin ? 'Administrator' : 'Siswa / Pembaca' }}</span>
                </div>
                <div style="display:flex;gap:10px;align-items:center;">
                  <button type="button" onclick="document.getElementById('profileAvatarFileInput').click()" class="btn-sm-action" style="padding:5px 14px;font-size:12px;">
                    Ganti Foto
                  </button>
                  <button type="button" onclick="toggleUrlInput()" style="background:none;border:none;color:var(--blue-accent);font-size:12.5px;font-weight:600;cursor:pointer;padding:0;">
                    Atau via Link URL
                  </button>
                </div>
              </div>
            </div>

            <!-- Hidden file input -->
            <input type="file" name="avatar_file" id="profileAvatarFileInput" accept="image/*" style="display:none;" onchange="previewProfileImage(this)">

            <!-- Optional URL input -->
            <div id="urlInputContainer" style="display:none;margin-bottom:16px;" class="form-grp">
              <label>Link Foto Profil (URL Gambar Web):</label>
              <input type="url" name="avatar_url" id="avatarUrlInput" class="form-ctrl" placeholder="https://example.com/foto.jpg" oninput="previewUrlImage(this.value)">
            </div>

            <!-- Nama Lengkap / Username -->
            <div class="form-grp">
              <label>Nama Pengguna / Nama Lengkap <span style="color:#ef4444;">*</span></label>
              <input type="text" name="name" class="form-ctrl" value="{{ old('name', $user->name) }}" required placeholder="Nama lengkap Anda">
            </div>

            <!-- Email (Permanen / Tidak dapat diubah) -->
            <div class="form-grp">
              <label>Alamat Email <span style="font-size:11.5px;font-weight:600;color:var(--text-muted);">(Permanen / Tidak dapat diubah)</span></label>
              <input type="email" class="form-ctrl" value="{{ $user->email }}" readonly style="background:#f1f5f9;color:#64748b;cursor:not-allowed;">
            </div>

            <!-- Peran / Hak Akses (Readonly) -->
            <div class="form-grp">
              <label>Hak Akses Akun</label>
              <input type="text" class="form-ctrl" value="{{ $isAdmin ? 'Administrator Perpustakaan (Pengelola)' : 'Anggota Perpustakaan (Siswa / Pembaca)' }}" disabled style="background:#f1f5f9;color:#64748b;cursor:not-allowed;">
            </div>

            <!-- Ganti Password -->
            <div style="margin-top:22px;padding-top:16px;border-top:1px solid var(--border-line);">
              <h3 style="font-family:'Bricolage Grotesque',sans-serif;font-size:15.5px;color:var(--navy);margin-bottom:2px;">Ganti Kata Sandi (Opsional)</h3>
              <p style="font-size:12px;color:var(--text-muted);margin-bottom:12px;">Kosongkan bila tidak ingin mengubah kata sandi.</p>

              <div class="password-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-grp" style="margin-bottom:0;">
                  <label>Kata Sandi Baru</label>
                  <input type="password" name="password" class="form-ctrl" placeholder="Minimal 4 karakter">
                </div>
                <div class="form-grp" style="margin-bottom:0;">
                  <label>Konfirmasi Kata Sandi</label>
                  <input type="password" name="password_confirmation" class="form-ctrl" placeholder="Ulangi kata sandi baru">
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div style="margin-top:24px;display:flex;justify-content:flex-end;">
              <button type="submit" class="btn-sm-action" style="padding:10px 24px;font-size:13.5px;background:var(--blue-accent);">
                <svg style="width:16px;height:16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </main>

  <!-- TOAST NOTIFICATION -->
  <div class="toast-box" id="appToast"></div>

  <!-- HIDDEN FORMS -->
  <form id="borrowForm" action="{{ route('loans.borrow') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="book_id" id="borrowBookId">
  </form>
  <form id="returnForm" method="POST" style="display:none;">
    @csrf
  </form>
  <form id="deleteBookForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
  </form>

</div>

<!-- ================= USER / GENERAL MODAL: DETAIL BUKU ================= -->
<div class="modal-overlay" id="bookDetailModal">
  <div class="modal-box modal-box-lg">
    <button type="button" class="modal-close" onclick="closeBookDetailModal()" title="Tutup detail buku">✕</button>

    <div class="book-detail-grid">
      <!-- Left: Cover & Stock Badge -->
      <div>
        <div class="book-detail-cover-wrap">
          <img id="detailBookCover" src="" alt="Cover Buku">
        </div>
        <div style="margin-top: 14px; text-align: center;">
          <span id="detailBookStockBadge" class="badge-st badge-ok" style="font-size: 12.5px; padding: 5px 14px;">Stok: 5 buku</span>
        </div>
      </div>

      <!-- Right: Metadata & Synopsis -->
      <div style="display: flex; flex-direction: column; min-height: 100%;">
        <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 10px; flex-wrap: wrap;">
          <span id="detailBookCategory" style="font-size: 11.5px; font-weight: 700; color: #2563eb; background: rgba(37,99,235,0.08); padding: 3px 10px; border-radius: 99px;">Kategori</span>
          <span id="detailBookCode" style="font-size: 11.5px; font-weight: 700; color: #64748b; background: rgba(15,23,42,0.06); padding: 3px 8px; border-radius: 6px;">KODE</span>
        </div>

        <h2 id="detailBookTitle" style="font-family: 'Bricolage Grotesque', sans-serif; font-size: 22px; font-weight: 800; color: var(--navy); line-height: 1.25; margin-bottom: 4px;">Judul Buku</h2>
        
        <div style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 16px;">
          Penulis: <strong id="detailBookAuthor" style="color: var(--navy);">Penulis</strong>
        </div>

        <div style="margin-bottom: 18px;">
          <div style="font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.8px; color: #64748b; margin-bottom: 6px;">Sinopsis & Deskripsi</div>
          <div id="detailBookDesc" class="book-detail-synopsis">
            Ringkasan cerita...
          </div>
        </div>

        <!-- Action / CTA Area -->
        <div id="detailBookActionArea" style="margin-top: auto; padding-top: 10px;">
          <!-- Dynamically populated button/badge based on role & loan status -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ================= ADMIN MODAL: TAMBAH BUKU ================= -->
@if ($isAdmin)
<div class="modal-overlay" id="addBookModal">
  <div class="modal-box">
    <button type="button" class="modal-close" onclick="closeAddBookModal()">✕</button>
    <h2 style="font-family:'Bricolage Grotesque',sans-serif;font-size:20px;color:var(--navy);margin-bottom:16px;">Tambah Koleksi Buku Baru</h2>

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-grp">
        <label>Judul Buku *</label>
        <input type="text" name="title" class="form-ctrl" placeholder="Contoh: Bumi Manusia" required>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-grp">
          <label>Penulis / Pengarang *</label>
          <input type="text" name="author" class="form-ctrl" placeholder="Nama penulis" required>
        </div>
        <div class="form-grp">
          <label>Kode Buku (Unik) *</label>
          <input type="text" name="code" class="form-ctrl" placeholder="Contoh: NV-010" required>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-grp">
          <label>Kategori *</label>
          <select name="category" class="form-ctrl" required>
            @foreach ($categories as $cat)
              <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-grp">
          <label>Jumlah Stok Buku *</label>
          <input type="number" name="stock" class="form-ctrl" min="0" value="5" required>
        </div>
      </div>

      <div class="form-grp" style="background:#f8fafc;padding:12px;border-radius:10px;">
        <label>📷 Foto Cover Buku (Upload Sendiri)</label>
        <input type="file" name="cover_image" class="form-ctrl" accept="image/*" style="background:#fff;">
        <div style="font-size:11px;color:var(--text-muted);margin-top:4px;">Format: JPG, PNG, WEBP (Maks 4MB)</div>
        <div style="margin-top:8px;">
          <label style="font-size:11px;">Atau URL Foto Eksternal:</label>
          <input type="url" name="cover_url" class="form-ctrl" placeholder="https://..." style="background:#fff;">
        </div>
      </div>

      <div class="form-grp">
        <label>Sinopsis / Deskripsi</label>
        <textarea name="description" class="form-ctrl" rows="3" placeholder="Ringkasan cerita..."></textarea>
      </div>

      <button type="submit" class="btn-sm-action" style="width:100%;justify-content:center;padding:12px;font-size:14px;background:var(--navy);">
        💾 Simpan Buku ke Katalog
      </button>
    </form>
  </div>
</div>

<!-- ================= ADMIN MODAL: EDIT BUKU ================= -->
<div class="modal-overlay" id="editBookModal">
  <div class="modal-box">
    <button type="button" class="modal-close" onclick="closeEditBookModal()">✕</button>
    <h2 style="font-family:'Bricolage Grotesque',sans-serif;font-size:20px;color:var(--navy);margin-bottom:16px;">Edit Data Buku</h2>

    <form id="editBookForm" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-grp">
        <label>Judul Buku *</label>
        <input type="text" name="title" id="edit_title" class="form-ctrl" required>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-grp">
          <label>Penulis / Pengarang *</label>
          <input type="text" name="author" id="edit_author" class="form-ctrl" required>
        </div>
        <div class="form-grp">
          <label>Kode Buku *</label>
          <input type="text" name="code" id="edit_code" class="form-ctrl" required>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="form-grp">
          <label>Kategori *</label>
          <select name="category" id="edit_category" class="form-ctrl" required>
            @foreach ($categories as $cat)
              <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-grp">
          <label>Jumlah Stok Buku *</label>
          <input type="number" name="stock" id="edit_stock" class="form-ctrl" min="0" required>
        </div>
      </div>

      <div class="form-grp" style="background:#f8fafc;padding:12px;border-radius:10px;">
        <label>📷 Ganti Foto Cover</label>
        <input type="file" name="cover_image" class="form-ctrl" accept="image/*" style="background:#fff;">
        <div style="margin-top:8px;">
          <label style="font-size:11px;">Atau Ubah URL Gambar:</label>
          <input type="url" name="cover_url" id="edit_cover_url" class="form-ctrl" style="background:#fff;">
        </div>
      </div>

      <div class="form-grp">
        <label>Sinopsis / Deskripsi</label>
        <textarea name="description" id="edit_description" class="form-ctrl" rows="3"></textarea>
      </div>

      <button type="submit" class="btn-sm-action" style="width:100%;justify-content:center;padding:12px;font-size:14px;background:var(--navy);">
        💾 Simpan Perubahan Buku
      </button>
    </form>
  </div>
</div>
@endif

<!-- ================= JAVASCRIPT LOGIC ================= -->
<script>
/* Auto-dismiss success flash alerts (e.g. Selamat Datang) after 3 seconds */
document.querySelectorAll('.flash-msg.flash-ok').forEach(el => {
  setTimeout(() => {
    el.classList.add('fade-out');
    setTimeout(() => el.remove(), 450);
  }, 3000);
});

const user = {
  name: @json($user->name ?? 'Pengguna'),
  email: @json($user->email ?? ''),
  role: @json($user->role ?? 'user'),
  isAdmin: @json($isAdmin)
};

const books = @json($dbBooks ?? []);
const loans = @json($dbLoans ?? []);
const history = @json($dbHistory ?? []);

/* Tab Navigation */
const navLinks = document.querySelectorAll('.nav-link');
function updateTab(){
  const hash = location.hash.slice(1);
  const activeTab = ['dashboard', 'katalog', 'peminjaman', 'pengembalian', 'riwayat', 'profil'].includes(hash) ? hash : 'dashboard';

  document.body.className = document.body.className.replace(/view-\S+/g, '').trim() + ' view-' + activeTab;
  navLinks.forEach(link => {
    link.classList.toggle('active', link.dataset.tab === activeTab);
  });
}
window.addEventListener('hashchange', updateTab);
updateTab();

/* Toast helper */
let toastTimer;
function showToast(msg) {
  const toast = document.getElementById('appToast');
  if (!toast) return;
  toast.textContent = msg;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
}

/* Book Action (Detail / Pinjam) */
function handleBookAction(bookId) {
  openBookDetailModal(bookId);
}

/* Render Katalog Grid with Filter & Search */
let activeCategory = 'Semua';
const searchInput = document.getElementById('globalSearch');

function renderKatalog() {
  const query = (searchInput ? searchInput.value : '').trim().toLowerCase();
  const filterHit = b => !query || (b.title + ' ' + (b.author || '') + ' ' + (b.code || '')).toLowerCase().includes(query);

  // Chips
  const cats = ['Semua', ...new Set(books.map(b => b.category).filter(Boolean))];
  const chipsContainer = document.getElementById('katalogChips');
  if (chipsContainer) {
    chipsContainer.innerHTML = cats.map(c => `
      <button type="button" class="chip-btn ${c === activeCategory ? 'active' : ''}" data-cat="${c}">${c}</button>
    `).join('');
  }

  // Cards
  const filtered = books.filter(b => (activeCategory === 'Semua' || b.category === activeCategory) && filterHit(b));
  const gridContainer = document.getElementById('katalogBooksGrid');
  if (gridContainer) {
    gridContainer.innerHTML = filtered.length ? filtered.map(b => {
      let actionHtml = '';
      if (user.isAdmin) {
        actionHtml = `
          <div style="display:flex;gap:6px;margin-top:auto;padding-top:6px;">
            <button type="button" class="btn-sm-action" style="padding:4px 8px;font-size:11.5px;background:#0284c7;" onclick="event.stopPropagation();openEditBookModalById(${b.id})">Edit</button>
            <button type="button" class="btn-sm-action" style="padding:4px 8px;font-size:11.5px;background:#dc2626;" onclick="event.stopPropagation();deleteBookConfirm(${b.id}, '${b.title.replace(/'/g, "\\'")}')">Hapus</button>
          </div>
        `;
      } else {
        const has = loans.some(l => l.bookId === b.id);
        actionHtml = has
          ? '<span style="font-size:11.5px;color:var(--text-muted);font-weight:700;margin-top:auto;">Sedang dipinjam</span>'
          : `
            <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:6px;">
              <span style="font-size:11.5px;color:${b.stock > 0 ? '#16a34a' : '#ef4444'};font-weight:700;">${b.stock > 0 ? 'Tersedia' : 'Habis'}</span>
              <div class="book-card-action" onclick="event.stopPropagation();openBookDetailModal(${b.id})">Detail Buku</div>
            </div>
          `;
      }

      return `
        <div class="book-show-card" onclick="openBookDetailModal(${b.id})" style="cursor:pointer;" title="Lihat detail buku ${b.title}">
          <div class="book-cover-frame">
            <img src="${b.cover}" alt="${b.title}" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80';">
          </div>
          <div class="book-card-title" title="${b.title}">${b.title}</div>
          <div class="book-card-author">${b.author}</div>
          <div class="book-card-cat">${b.category} &middot; Stok: ${b.stock}</div>
          ${actionHtml}
        </div>
      `;
    }).join('') : '<p style="color:var(--text-muted);font-size:13px;grid-column:1/-1;">Tidak ada buku yang cocok dengan pencarian.</p>';
  }
}

// Chips Click Event
const chipsEl = document.getElementById('katalogChips');
if (chipsEl) {
  chipsEl.addEventListener('click', e => {
    const btn = e.target.closest('.chip-btn');
    if (btn) {
      activeCategory = btn.dataset.cat;
      renderKatalog();
    }
  });
}
if (searchInput) searchInput.addEventListener('input', () => {
  renderKatalog();
  if (location.hash !== '#katalog') {
    location.hash = '#katalog';
  }
});

/* Render Active Loans Table */
function renderActiveLoans() {
  const rowsContainer = document.getElementById('activeLoansRows');
  if (!rowsContainer) return;

  rowsContainer.innerHTML = loans.length ? loans.map(l => {
    let actTd = '';
    if (!user.isAdmin) {
      let actBtn = '';
      if (l.status === 'pending') {
        actBtn = '<span class="badge-st badge-warn">⏳ Menunggu Verifikasi</span>';
      } else if (l.status === 'pending_return') {
        actBtn = '<span class="badge-st badge-ok">🔄 Verifikasi Pengembalian</span>';
      } else {
        actBtn = `<button type="button" class="btn-sm-action" onclick="returnBookReq(${l.id})">Kembalikan</button>`;
      }
      actTd = `<td>${actBtn}</td>`;
    }

    const borrowerInfo = l.userName 
      ? `<strong>${l.userName}</strong>${l.userEmail ? `<div style="font-size:12px;color:var(--text-muted);">${l.userEmail}</div>` : ''}` 
      : `<strong>${user.name}</strong>`;

    const statusBadge = l.status === 'active' 
      ? '<span class="badge-st badge-ok">Aktif Dipinjam</span>' 
      : (l.status === 'pending_return' ? '<span class="badge-st badge-warn">Proses Pengembalian</span>' : '<span class="badge-st badge-warn">Menunggu Persetujuan</span>');

    return `
      <tr>
        <td><strong>${l.title}</strong><div style="font-size:12px;color:var(--text-muted);">${l.code}</div></td>
        <td>${borrowerInfo}</td>
        <td>${l.borrow_date || '-'}</td>
        <td>${l.due_date || '-'}</td>
        <td>${statusBadge}</td>
        ${actTd}
      </tr>
    `;
  }).join('') : `<tr><td colspan="${user.isAdmin ? 5 : 6}" style="text-align:center;color:var(--text-muted);padding:20px;">${user.isAdmin ? 'Saat ini belum ada buku yang sedang dipinjam oleh siswa.' : 'Kamu tidak sedang meminjam buku. Buka Katalog untuk memilih buku.'}</td></tr>`;
}

function returnBookReq(loanId) {
  if (confirm('Ajukan pengembalian buku ini?')) {
    const f = document.getElementById('returnForm');
    f.action = '/loans/' + loanId + '/return-request';
    f.submit();
  }
}

/* Render Returned Loans Table */
function renderReturnedLoans() {
  const container = document.getElementById('returnedLoansRows');
  if (!container) return;

  container.innerHTML = history.length ? history.map(h => {
    const borrowerInfo = h.userName 
      ? `<strong>${h.userName}</strong>${h.userEmail ? `<div style="font-size:12px;color:var(--text-muted);">${h.userEmail}</div>` : ''}` 
      : `<strong>${user.name}</strong>`;

    const statusBadge = h.status === 'returned' 
      ? '<span class="badge-st badge-ok">Selesai Dikembalikan</span>' 
      : '<span class="badge-st badge-danger">Ditolak</span>';

    return `
      <tr>
        <td><strong>${h.title}</strong><div style="font-size:12px;color:var(--text-muted);">${h.code}</div></td>
        <td>${borrowerInfo}</td>
        <td>${h.from || '-'}</td>
        <td>${h.to || '-'}</td>
        <td>${statusBadge}</td>
      </tr>
    `;
  }).join('') : `<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:20px;">${user.isAdmin ? 'Belum ada data riwayat pengembalian buku.' : 'Belum ada riwayat pengembalian.'}</td></tr>`;
}

/* Render Full History */
function renderFullHistory() {
  const container = document.getElementById('fullHistoryRows');
  if (!container) return;

  const allHist = [...loans, ...history];
  container.innerHTML = allHist.length ? allHist.map(item => {
    const borrowerInfo = item.userName 
      ? `<strong>${item.userName}</strong>${item.userEmail ? `<div style="font-size:12px;color:var(--text-muted);">${item.userEmail}</div>` : ''}` 
      : `<strong>${user.name}</strong>`;

    let statusBadge = '';
    let tglSelesai = item.to || item.due_date || '-';
    if (item.status === 'returned') {
      statusBadge = '<span class="badge-st badge-ok">Sudah Dikembalikan</span>';
    } else if (item.status === 'active') {
      statusBadge = '<span class="badge-st badge-warn">Sedang Dipinjam</span>';
    } else if (item.status === 'pending_return') {
      statusBadge = '<span class="badge-st badge-warn">Pengajuan Kembali</span>';
    } else if (item.status === 'rejected') {
      statusBadge = '<span class="badge-st badge-danger">Ditolak</span>';
    } else {
      statusBadge = '<span class="badge-st badge-warn">Menunggu Persetujuan</span>';
    }

    return `
      <tr>
        <td><strong>${item.title}</strong><div style="font-size:12px;color:var(--text-muted);">${item.code}</div></td>
        <td>${borrowerInfo}</td>
        <td>${item.borrow_date || item.from || '-'}</td>
        <td>${tglSelesai}</td>
        <td>${statusBadge}</td>
      </tr>
    `;
  }).join('') : `<tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:20px;">${user.isAdmin ? 'Belum ada transaksi peminjaman atau pengembalian tercatat.' : 'Belum ada riwayat tercatat.'}</td></tr>`;
}

// Initial renders
renderKatalog();
renderActiveLoans();
renderReturnedLoans();
renderFullHistory();

/* Book Detail Modal Functions (For User & All Roles) */
const bookDetailModal = document.getElementById('bookDetailModal');

function openBookDetailModal(bookId) {
  const bk = books.find(b => b.id === Number(bookId));
  if (!bk || !bookDetailModal) return;

  const coverImg = document.getElementById('detailBookCover');
  coverImg.src = bk.cover || '';
  coverImg.alt = bk.title || 'Cover Buku';

  document.getElementById('detailBookTitle').textContent = bk.title || '-';
  document.getElementById('detailBookAuthor').textContent = bk.author || '-';
  document.getElementById('detailBookCategory').textContent = bk.category || 'Umum';
  document.getElementById('detailBookCode').textContent = bk.code || '-';

  const descEl = document.getElementById('detailBookDesc');
  if (bk.description && bk.description.trim().length > 0) {
    descEl.textContent = bk.description;
    descEl.style.fontStyle = 'normal';
    descEl.style.color = 'inherit';
  } else {
    descEl.textContent = 'Sinopsis lengkap belum ditambahkan untuk buku ini, namun buku fisik tersedia dan siap dipinjam di PerpusKu.';
    descEl.style.fontStyle = 'italic';
    descEl.style.color = 'var(--text-muted)';
  }

  const stockBadge = document.getElementById('detailBookStockBadge');
  if (bk.stock > 0) {
    stockBadge.textContent = `Tersedia: ${bk.stock} buku`;
    stockBadge.className = 'badge-st badge-ok';
  } else {
    stockBadge.textContent = 'Stok Habis (0)';
    stockBadge.className = 'badge-st badge-danger';
  }

  const actionArea = document.getElementById('detailBookActionArea');
  if (user.isAdmin) {
    actionArea.innerHTML = `
      <div style="display:flex;gap:10px;">
        <button type="button" class="btn-sm-action" style="flex:1;justify-content:center;padding:11px;background:#0284c7;font-size:13.5px;" onclick="closeBookDetailModal();openEditBookModalById(${bk.id})">
          ✏️ Edit Data Buku Ini
        </button>
      </div>
    `;
  } else {
    const hasBorrowed = loans.some(l => l.bookId === bk.id);
    if (hasBorrowed) {
      actionArea.innerHTML = `
        <div style="background:rgba(37,99,235,0.08);border:1px solid rgba(37,99,235,0.2);border-radius:12px;padding:12px;text-align:center;">
          <div style="font-weight:700;color:var(--blue-accent);font-size:13.5px;">✓ Buku Ini Sedang Anda Pinjam</div>
          <div style="font-size:12px;color:var(--text-muted);margin-top:3px;">Cek tanggal jatuh tempo atau kembalikan buku di menu <strong>Peminjaman</strong>.</div>
        </div>
      `;
    } else if (bk.stock < 1) {
      actionArea.innerHTML = `
        <button type="button" class="btn-sm-action" style="width:100%;justify-content:center;padding:12px;background:#94a3b8;cursor:not-allowed;font-size:13.5px;" disabled>
          ⚠️ Stok Buku Sedang Habis
        </button>
      `;
    } else {
      actionArea.innerHTML = `
        <button type="button" class="btn-sm-action" style="width:100%;justify-content:center;padding:12px;font-size:14px;background:#2563eb;" onclick="confirmBorrowFromDetail(${bk.id})">
          📖 Ajukan Pinjam Buku Ini
        </button>
      `;
    }
  }

  bookDetailModal.classList.add('open');
}

function closeBookDetailModal() {
  if (bookDetailModal) bookDetailModal.classList.remove('open');
}

if (bookDetailModal) {
  bookDetailModal.addEventListener('click', e => {
    if (e.target === bookDetailModal) closeBookDetailModal();
  });
}

function confirmBorrowFromDetail(bookId) {
  const bk = books.find(b => b.id === Number(bookId));
  if (!bk) return;

  if (confirm(`Ajukan peminjaman buku "${bk.title}" oleh ${bk.author}? Batas peminjaman adalah 7 hari.`)) {
    closeBookDetailModal();
    document.getElementById('borrowBookId').value = bk.id;
    document.getElementById('borrowForm').submit();
  }
}

/* Admin Modal Functions */
@if ($isAdmin)
const addModal = document.getElementById('addBookModal');
function openAddBookModal() { if (addModal) addModal.classList.add('open'); }
function closeAddBookModal() { if (addModal) addModal.classList.remove('open'); }
if (addModal) addModal.addEventListener('click', e => { if (e.target === addModal) closeAddBookModal(); });

const editModal = document.getElementById('editBookModal');
function openEditBookModalById(bookId) {
  const bk = books.find(b => b.id === bookId);
  if (bk) openEditBookModal(bk);
}
function openEditBookModal(book) {
  if (!editModal) return;
  document.getElementById('editBookForm').action = '/books/' + book.id;
  document.getElementById('edit_title').value = book.title || '';
  document.getElementById('edit_author').value = book.author || '';
  document.getElementById('edit_code').value = book.code || '';
  document.getElementById('edit_category').value = book.category || '';
  document.getElementById('edit_stock').value = book.stock || 0;
  document.getElementById('edit_description').value = book.description || '';
  document.getElementById('edit_cover_url').value = (book.cover && book.cover.startsWith('http')) ? book.cover : '';
  editModal.classList.add('open');
}
function closeEditBookModal() { if (editModal) editModal.classList.remove('open'); }
if (editModal) editModal.addEventListener('click', e => { if (e.target === editModal) closeEditBookModal(); });

function deleteBookConfirm(bookId, title) {
  if (confirm(`Yakin ingin menghapus buku "${title}" dari katalog?`)) {
    const f = document.getElementById('deleteBookForm');
    f.action = '/books/' + bookId;
    f.submit();
  }
}
@endif

/* Profile Avatar Preview & URL Toggle */
function previewProfileImage(input) {
  if (input.files && input.files[0]) {
    const file = input.files[0];
    if (file.size > 5 * 1024 * 1024) {
      alert('Ukuran file maksimal 5MB.');
      input.value = '';
      return;
    }
    const reader = new FileReader();
    reader.onload = function(e) {
      const src = e.target.result;
      const cardImg = document.getElementById('cardAvatarImg');
      const formImg = document.getElementById('formPreviewImg');
      if (cardImg) cardImg.src = src;
      if (formImg) formImg.src = src;
      showToast('Foto profil dipilih! Klik "Simpan Perubahan Profil" untuk menyimpan.');
    };
    reader.readAsDataURL(file);
  }
}

function previewUrlImage(url) {
  if (url && (url.startsWith('http://') || url.startsWith('https://'))) {
    const formImg = document.getElementById('formPreviewImg');
    if (formImg) formImg.src = url;
  }
}

function toggleUrlInput() {
  const container = document.getElementById('urlInputContainer');
  if (container) {
    const isHidden = container.style.display === 'none';
    container.style.display = isHidden ? 'block' : 'none';
    if (isHidden) {
      const input = document.getElementById('avatarUrlInput');
      if (input) input.focus();
    }
  }
}

/* ================= TEMA TERANG / GELAP (DARK MODE) ================= */
function initTheme() {
  const saved = localStorage.getItem('perpusku_theme');
  if (saved === 'dark' || (!saved && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
}
function toggleTheme() {
  const isDark = document.body.classList.toggle('dark-mode');
  localStorage.setItem('perpusku_theme', isDark ? 'dark' : 'light');
  showToast(isDark ? '🌙 Mode Gelap diaktifkan' : '☀️ Mode Terang diaktifkan');
}
const themeBtn = document.getElementById('themeToggleBtn');
if (themeBtn) {
  themeBtn.addEventListener('click', toggleTheme);
}
initTheme();

/* ================= TOGGLE SIDEBAR (COLLAPSE & EXPAND) ================= */
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const backdrop = document.getElementById('sidebarBackdrop');
  const isMobile = window.innerWidth <= 900;

  if (isMobile) {
    const isOpen = sidebar.classList.toggle('open');
    if (backdrop) backdrop.classList.toggle('active', isOpen);
  } else {
    const isCollapsed = document.body.classList.toggle('sidebar-collapsed');
    localStorage.setItem('perpusku_sidebar_collapsed', isCollapsed ? 'true' : 'false');
  }
}
function initSidebarState() {
  if (window.innerWidth > 900) {
    const saved = localStorage.getItem('perpusku_sidebar_collapsed');
    if (saved === 'true') {
      document.body.classList.add('sidebar-collapsed');
    }
  }
}
const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
if (sidebarToggleBtn) {
  sidebarToggleBtn.addEventListener('click', toggleSidebar);
}
window.addEventListener('resize', () => {
  if (window.innerWidth > 900) {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    if (sidebar) sidebar.classList.remove('open');
    if (backdrop) backdrop.classList.remove('active');
  }
});
initSidebarState();
</script>
</body>
</html>

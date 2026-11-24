<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>PerpusKu - Perpustakaan Digital Modern Indonesia</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #eaf2fd;
      --bg-card: #ffffff;
      --navy: #0b1a30;
      --navy-light: #162a4a;
      --blue-primary: #1d4ed8;
      --blue-accent: #2563eb;
      --sky: #38bdf8;
      --sky-light: #e0f2fe;
      --text-main: #0f172a;
      --text-muted: #64748b;
      --border-card: rgba(186, 215, 245, 0.6);
      --border-subtle: rgba(15, 23, 42, 0.08);
      --shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.04);
      --shadow-md: 0 10px 30px rgba(15, 23, 42, 0.08);
      --shadow-lg: 0 20px 45px rgba(15, 23, 42, 0.12);
    }

    /* DARK MODE PALETTE */
    body.dark-mode {
      --bg: #0b1322;
      --bg-card: #111d33;
      --navy: #f8fafc;
      --navy-light: #cbd5e1;
      --blue-primary: #38bdf8;
      --blue-accent: #3b82f6;
      --sky: #38bdf8;
      --sky-light: #1e293b;
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --border-card: rgba(255, 255, 255, 0.08);
      --border-subtle: rgba(255, 255, 255, 0.06);
      --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.2);
      --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.35);
      --shadow-lg: 0 20px 45px rgba(0, 0, 0, 0.5);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--bg);
      color: var(--text-main);
      min-height: 100vh;
      line-height: 1.6;
      overflow-x: hidden;
      transition: background 0.3s ease, color 0.3s ease;
      position: relative;
    }

    /* AMBIENT BACKGROUND GLOW */
    .ambient-glow {
      position: fixed;
      border-radius: 50%;
      filter: blur(140px);
      pointer-events: none;
      z-index: 0;
      opacity: 0.45;
    }
    .glow-1 {
      width: 550px;
      height: 550px;
      background: radial-gradient(circle, #93c5fd, transparent 70%);
      top: -100px;
      left: -100px;
    }
    .glow-2 {
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, #bfdbfe, transparent 70%);
      top: 40%;
      right: -150px;
    }
    body.dark-mode .glow-1 {
      background: radial-gradient(circle, #1e3a8a, transparent 70%);
      opacity: 0.25;
    }
    body.dark-mode .glow-2 {
      background: radial-gradient(circle, #172554, transparent 70%);
      opacity: 0.25;
    }

    .container {
      width: 100%;
      max-width: 1220px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    /* ================= NAVBAR ================= */
    header.site-header {
      position: sticky;
      top: 0;
      z-index: 50;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      background: rgba(234, 242, 253, 0.85);
      border-bottom: 1px solid var(--border-subtle);
      transition: background 0.3s ease, border-color 0.3s ease;
    }
    body.dark-mode header.site-header {
      background: rgba(11, 19, 34, 0.85);
    }
    .nav-wrap {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 74px;
    }
    .brand-logo {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      color: inherit;
    }
    .logo-badge {
      width: 40px;
      height: 40px;
      border-radius: 11px;
      background: linear-gradient(135deg, #38bdf8, #2563eb);
      color: #fff;
      display: grid;
      place-items: center;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }
    .logo-badge svg {
      width: 22px;
      height: 22px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }
    .brand-text {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 22px;
      font-weight: 800;
      letter-spacing: -0.4px;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 32px;
      list-style: none;
    }
    .nav-links a {
      text-decoration: none;
      color: var(--text-muted);
      font-size: 14.5px;
      font-weight: 600;
      transition: color 0.2s;
    }
    .nav-links a:hover {
      color: var(--blue-accent);
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .theme-toggle-btn {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      border: 1px solid var(--border-card);
      background: var(--bg-card);
      color: var(--text-main);
      display: grid;
      place-items: center;
      cursor: pointer;
      transition: all 0.2s;
    }
    .theme-toggle-btn:hover {
      border-color: var(--blue-accent);
      color: var(--blue-accent);
    }
    .theme-toggle-btn svg {
      width: 19px;
      height: 19px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }
    .icon-sun { display: none; }
    body.dark-mode .icon-sun { display: block; }
    body.dark-mode .icon-moon { display: none; }

    .btn-login {
      text-decoration: none;
      font-size: 14px;
      font-weight: 700;
      color: var(--text-main);
      padding: 9px 18px;
      border-radius: 10px;
      transition: all 0.2s;
    }
    .btn-login:hover {
      color: var(--blue-accent);
      background: rgba(37, 99, 235, 0.08);
    }

    .btn-cta-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: #ffffff !important;
      font-size: 14px;
      font-weight: 700;
      padding: 10px 22px;
      border-radius: 11px;
      box-shadow: 0 4px 16px rgba(37, 99, 235, 0.28);
      transition: all 0.25s ease;
    }
    .btn-cta-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
      background: linear-gradient(135deg, #1d4ed8, #1e40af);
    }

    /* ================= HERO SECTION ================= */
    .hero-section {
      padding: 64px 0 54px 0;
    }
    .hero-grid {
      display: grid;
      grid-template-columns: 1.15fr 0.85fr;
      align-items: center;
      gap: 56px;
    }
    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 14px;
      background: rgba(37, 99, 235, 0.1);
      border: 1px solid rgba(37, 99, 235, 0.2);
      border-radius: 99px;
      font-size: 12.5px;
      font-weight: 700;
      color: var(--blue-accent);
      margin-bottom: 20px;
    }
    .hero-tag span.dot {
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #2563eb;
      box-shadow: 0 0 8px #2563eb;
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.5; transform: scale(1.3); }
    }

    .hero-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 52px;
      line-height: 1.12;
      font-weight: 800;
      letter-spacing: -1.2px;
      margin-bottom: 22px;
    }
    .hero-title .gradient-text {
      background: linear-gradient(135deg, #2563eb 0%, #38bdf8 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-desc {
      font-size: 16.5px;
      color: var(--text-muted);
      line-height: 1.7;
      margin-bottom: 34px;
      max-width: 540px;
    }

    .hero-btn-group {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }
    .btn-secondary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      color: var(--text-main);
      font-size: 14.5px;
      font-weight: 700;
      padding: 11px 24px;
      border-radius: 11px;
      transition: all 0.2s;
    }
    .btn-secondary:hover {
      background: var(--bg);
      border-color: var(--blue-accent);
      color: var(--blue-accent);
      transform: translateY(-2px);
    }

    /* HERO VISUAL CARD SHOWCASE */
    .hero-visual {
      position: relative;
    }
    .hero-main-card {
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 28px;
      padding: 34px;
      box-shadow: var(--shadow-lg);
      position: relative;
      overflow: hidden;
    }
    .hero-illus-box {
      width: 100%;
      height: 220px;
      background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
      margin-bottom: 22px;
    }
    body.dark-mode .hero-illus-box {
      background: linear-gradient(135deg, #1e3a5f 0%, #0f2744 100%);
    }
    .hero-illus-box svg {
      width: 100%;
      height: 100%;
      max-height: 170px;
    }

    .floating-pill {
      position: absolute;
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 16px;
      padding: 12px 18px;
      box-shadow: var(--shadow-md);
      display: flex;
      align-items: center;
      gap: 12px;
      z-index: 3;
      animation: floatMotion 6s ease-in-out infinite alternate;
    }
    .floating-top-right {
      top: -14px;
      right: -16px;
    }
    .floating-bottom-left {
      bottom: -16px;
      left: -20px;
      animation-delay: -3s;
    }
    @keyframes floatMotion {
      0% { transform: translateY(0); }
      100% { transform: translateY(-10px); }
    }
    .pill-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: #dcfce7;
      color: #16a34a;
      display: grid;
      place-items: center;
      font-size: 16px;
    }
    .pill-icon.blue {
      background: #dbeafe;
      color: #2563eb;
    }
    .pill-text strong {
      display: block;
      font-size: 13.5px;
      font-weight: 800;
      line-height: 1.2;
    }
    .pill-text span {
      font-size: 11.5px;
      color: var(--text-muted);
    }

    /* ================= STATS BAR ================= */
    .stats-section {
      padding: 24px 0 64px 0;
    }
    .stats-card {
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 22px;
      padding: 32px 42px;
      box-shadow: var(--shadow-sm);
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 32px;
    }
    .stat-item {
      position: relative;
    }
    .stat-item:not(:last-child)::after {
      content: '';
      position: absolute;
      right: -16px;
      top: 15%;
      height: 70%;
      width: 1px;
      background: var(--border-subtle);
    }
    .stat-val {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 38px;
      font-weight: 800;
      color: var(--navy);
      line-height: 1.1;
      margin-bottom: 4px;
    }
    .stat-label {
      font-size: 12px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--text-muted);
    }

    /* ================= FEATURES SECTION ================= */
    .features-section {
      padding: 60px 0;
    }
    .section-header-center {
      text-align: center;
      max-width: 680px;
      margin: 0 auto 52px auto;
    }
    .section-badge {
      font-size: 11.5px;
      font-weight: 800;
      letter-spacing: 1.5px;
      color: var(--blue-accent);
      text-transform: uppercase;
      margin-bottom: 8px;
      display: block;
    }
    .section-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 36px;
      font-weight: 800;
      letter-spacing: -0.6px;
      margin-bottom: 14px;
      line-height: 1.2;
    }
    .section-subtitle {
      font-size: 15px;
      color: var(--text-muted);
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }
    .feature-card {
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 20px;
      padding: 32px 28px;
      box-shadow: var(--shadow-sm);
      transition: all 0.25s ease;
      display: flex;
      flex-direction: column;
    }
    .feature-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-md);
      border-color: var(--blue-accent);
    }
    .feature-icon-box {
      width: 52px;
      height: 52px;
      border-radius: 14px;
      background: var(--sky-light);
      color: var(--blue-accent);
      display: grid;
      place-items: center;
      margin-bottom: 22px;
    }
    .feature-icon-box svg {
      width: 26px;
      height: 26px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }
    .feature-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 19px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .feature-desc {
      font-size: 14px;
      color: var(--text-muted);
      line-height: 1.6;
    }

    /* ================= POPULAR BOOKS SECTION ================= */
    .books-section {
      padding: 60px 0;
    }
    .books-showcase-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 22px;
      align-items: stretch;
    }
    .book-item-card {
      min-width: 0;
      width: 100%;
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 18px;
      padding: 18px;
      box-shadow: var(--shadow-sm);
      transition: all 0.25s ease;
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
      overflow: hidden;
    }
    .book-item-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-md);
      border-color: var(--blue-accent);
    }
    .book-cover-frame {
      width: 100%;
      aspect-ratio: 120/165;
      border-radius: 12px;
      overflow: hidden;
      background: #e2e8f0;
      margin-bottom: 14px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .book-cover-frame img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      transition: transform 0.3s ease;
    }
    .book-item-card:hover .book-cover-frame img {
      transform: scale(1.05);
    }
    .book-tag {
      font-size: 11px;
      font-weight: 700;
      color: var(--blue-accent);
      background: rgba(37, 99, 235, 0.08);
      padding: 3px 8px;
      border-radius: 6px;
      align-self: flex-start;
      margin-bottom: 8px;
      max-width: 100%;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .book-item-title {
      font-size: 15px;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 4px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      min-height: 42px;
      line-height: 1.4;
      width: 100%;
    }
    .book-item-author {
      font-size: 12.5px;
      color: var(--text-muted);
      margin-bottom: 12px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 100%;
      display: block;
    }
    .book-item-foot {
      margin-top: auto;
      padding-top: 10px;
      border-top: 1px solid var(--border-subtle);
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }
    .stock-badge {
      font-size: 11.5px;
      font-weight: 700;
      color: #16a34a;
    }
    .link-detail {
      font-size: 12.5px;
      font-weight: 700;
      color: var(--blue-accent);
      display: flex;
      align-items: center;
      gap: 4px;
    }

    /* ================= HOW IT WORKS (3 STEPS) ================= */
    .steps-section {
      padding: 60px 0;
    }
    .steps-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 32px;
      position: relative;
    }
    .step-card {
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 20px;
      padding: 34px 28px;
      box-shadow: var(--shadow-sm);
      position: relative;
    }
    .step-num {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: linear-gradient(135deg, #2563eb, #38bdf8);
      color: #fff;
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 20px;
      font-weight: 800;
      display: grid;
      place-items: center;
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    .step-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 19px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .step-desc {
      font-size: 14px;
      color: var(--text-muted);
      line-height: 1.6;
    }

    /* ================= CALL TO ACTION BANNER ================= */
    .cta-section {
      padding: 60px 0 90px 0;
    }
    .cta-banner {
      background: linear-gradient(135deg, #0b1a30 0%, #1e3a5f 50%, #2563eb 100%);
      border-radius: 28px;
      padding: 64px 48px;
      color: #ffffff;
      text-align: center;
      box-shadow: 0 20px 50px rgba(11, 26, 48, 0.25);
      position: relative;
      overflow: hidden;
    }
    .cta-banner::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -20%;
      width: 600px;
      height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(56, 189, 248, 0.25), transparent 70%);
      pointer-events: none;
    }
    .cta-content {
      position: relative;
      z-index: 2;
      max-width: 640px;
      margin: 0 auto;
    }
    .cta-badge {
      display: inline-block;
      padding: 5px 14px;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 99px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 18px;
    }
    .cta-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 42px;
      font-weight: 800;
      line-height: 1.15;
      letter-spacing: -0.8px;
      margin-bottom: 16px;
    }
    .cta-desc {
      font-size: 16px;
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.6;
      margin-bottom: 32px;
    }
    .cta-btn-white {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      background: #ffffff;
      color: #0b1a30;
      font-size: 15px;
      font-weight: 800;
      padding: 13px 32px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      transition: all 0.25s ease;
    }
    .cta-btn-white:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
      background: #f8fafc;
    }

    /* ================= FOOTER ================= */
    footer.site-footer {
      background: #ffffff;
      border-top: 1px solid var(--border-subtle);
      padding: 50px 0 32px 0;
      transition: background 0.3s ease;
    }
    body.dark-mode footer.site-footer {
      background: #080d18;
      border-top-color: rgba(255, 255, 255, 0.06);
    }
    .footer-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr;
      gap: 48px;
      margin-bottom: 40px;
    }
    .footer-desc {
      font-size: 14px;
      color: var(--text-muted);
      margin-top: 14px;
      max-width: 360px;
      line-height: 1.6;
    }
    .footer-title {
      font-family: 'Bricolage Grotesque', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 16px;
    }
    .footer-links {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .footer-links a {
      text-decoration: none;
      color: var(--text-muted);
      font-size: 13.5px;
      transition: color 0.2s;
    }
    .footer-links a:hover {
      color: var(--blue-accent);
    }
    .footer-bottom {
      padding-top: 24px;
      border-top: 1px solid var(--border-subtle);
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 13px;
      color: var(--text-muted);
      flex-wrap: wrap;
      gap: 12px;
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 1024px) {
      .hero-grid { grid-template-columns: 1fr; gap: 40px; text-align: center; }
      .hero-desc { margin-left: auto; margin-right: auto; }
      .hero-btn-group { justify-content: center; }
      .features-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .books-showcase-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .stats-card { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
      .stat-item:nth-child(2)::after { display: none; }
      .steps-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
      .container { padding: 0 18px; }
      .site-header { padding: 0; }
      .nav-wrap { height: 66px; }
      .nav-links { display: none; }
      .brand-text { font-size: 20px; }
      .hero-section { padding: 36px 0 32px 0; }
      .hero-title { font-size: 34px; letter-spacing: -0.5px; }
      .hero-desc { font-size: 14.5px; margin-bottom: 24px; }
      .features-grid { grid-template-columns: 1fr; }
      .books-showcase-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
      .book-item-card { padding: 12px; border-radius: 14px; }
      .book-item-title { font-size: 13.5px; min-height: 38px; }
      .book-item-author { font-size: 11.5px; margin-bottom: 8px; }
      .book-tag { font-size: 10px; padding: 2px 6px; }
      .stock-badge { font-size: 10.5px; }
      .link-detail { font-size: 11.5px; }
      .stats-card { grid-template-columns: 1fr; padding: 20px; }
      .stat-item::after { display: none !important; }
      .footer-grid { grid-template-columns: 1fr; gap: 28px; }
      .cta-title { font-size: 26px; }
      .cta-banner { padding: 32px 20px; border-radius: 20px; }
      .hero-main-card { padding: 20px 16px; border-radius: 20px; }
      .hero-illus-box { height: 180px; margin-bottom: 16px; }
      .floating-pill { padding: 8px 12px; border-radius: 12px; gap: 8px; font-size: 12px; }
      .floating-top-right { top: -8px; right: 0; }
      .floating-bottom-left { bottom: -8px; left: 0; }
    }
    @media (max-width: 480px) {
      .container { padding: 0 14px; }
      .hero-title { font-size: 28px; }
      .hero-btn-group { flex-direction: column; width: 100%; gap: 10px; }
      .hero-btn-group .btn-cta-primary,
      .hero-btn-group .btn-secondary { width: 100%; justify-content: center; }
      .books-showcase-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
      .book-item-card { padding: 10px; }
      .book-item-title { font-size: 12.5px; min-height: 35px; }
      .book-item-author { font-size: 11px; }
      .floating-pill { display: none; }
      .cta-btn-group { flex-direction: column; width: 100%; }
      .cta-btn-group a { width: 100%; justify-content: center; }
    }
  </style>
</head>
<body>

  <!-- Ambient Glow Effects -->
  <div class="ambient-glow glow-1"></div>
  <div class="ambient-glow glow-2"></div>

  <!-- ================= NAVBAR ================= -->
  <header class="site-header">
    <div class="container">
      <div class="nav-wrap">
        <a href="{{ route('landing') }}" class="brand-logo">
          <div class="logo-badge">
            <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"/></svg>
          </div>
          <span class="brand-text">PerpusKu</span>
        </a>

        <ul class="nav-links">
          <li><a href="#fitur">Fitur Unggulan</a></li>
          <li><a href="#koleksi">Buku Populer</a></li>
          <li><a href="#cara-kerja">Cara Kerja</a></li>
          <li><a href="#tentang">Tentang</a></li>
        </ul>

        <div class="nav-actions">
          <!-- Theme Toggle Button -->
          <button type="button" class="theme-toggle-btn" id="themeToggleBtn" title="Ganti Tema (Terang / Gelap)" aria-label="Toggle Theme">
            <!-- Sun icon (shown in dark mode) -->
            <svg class="icon-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            <!-- Moon icon (shown in light mode) -->
            <svg class="icon-moon" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
          </button>

          @auth
            <a href="{{ route('dashboard') }}" class="btn-cta-primary">
              <span>Buka Dashboard</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          @else
            <a href="{{ route('login') }}" class="btn-login">Masuk</a>
            <a href="{{ route('login') }}#daftar" class="btn-cta-primary">
              <span>Mulai Membaca</span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          @endauth
        </div>
      </div>
    </div>
  </header>

  <!-- ================= HERO SECTION ================= -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-grid">
        <div class="hero-left">
          <div class="hero-tag">
            <span class="dot"></span>
            <span>Perpustakaan Digital Generasi Baru</span>
          </div>

          <h1 class="hero-title">
            Jelajahi Ribuan <span class="gradient-text">Cakrawala Ilmu</span> dalam Satu Sentuhan
          </h1>

          <p class="hero-desc">
            PerpusKu menghadirkan pengalaman literasi digital tanpa batas. Temukan buku pelajaran, fiksi terbaik, sains, hingga pengembangan diri dengan sistem peminjaman instan dan pelacakan riwayat yang rapi.
          </p>

          <div class="hero-btn-group">
            @auth
              <a href="{{ route('dashboard') }}#katalog" class="btn-cta-primary" style="padding:13px 28px;font-size:15px;">
                <span>Jelajahi Katalog Buku</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            @else
              <a href="{{ route('login') }}" class="btn-cta-primary" style="padding:13px 28px;font-size:15px;">
                <span>Pinjam Buku Sekarang</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            @endauth

            <a href="#koleksi" class="btn-secondary">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"/></svg>
              <span>Lihat Koleksi Populer</span>
            </a>
          </div>
        </div>

        <!-- HERO RIGHT VISUAL -->
        <div class="hero-visual">
          <div class="floating-pill floating-top-right">
            <div class="pill-icon">✓</div>
            <div class="pill-text">
              <strong>Peminjaman Mudah</strong>
              <span>Verifikasi cepat admin</span>
            </div>
          </div>

          <div class="hero-main-card">
            <!-- Vector Illustration from Dashboard -->
            <div class="hero-illus-box">
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

                <!-- Flying Pages Geometrics -->
                <polygon points="180,65 195,50 205,65 190,80" fill="#1e3a5f" opacity="0.9"/>
                <polygon points="210,85 225,75 235,90 220,100" fill="#2563eb" opacity="0.85"/>
                <polygon points="160,80 170,72 178,82 168,90" fill="#38bdf8" opacity="0.75"/>
                <polygon points="200,40 212,32 218,44 206,52" fill="#0b1a30"/>
                <polygon points="175,95 185,88 190,98 180,105" fill="#93c5fd"/>
              </svg>
            </div>

            <div style="display:flex;align-items:center;justify-content:space-between;">
              <div>
                <h3 style="font-family:'Bricolage Grotesque',sans-serif;font-size:18px;font-weight:700;color:var(--navy);">PerpusKu Explorer</h3>
                <p style="font-size:13px;color:var(--text-muted);">Sistem manajemen perpustakaan terintegrasi</p>
              </div>
              <span style="display:inline-block;padding:6px 14px;background:#dcfce7;color:#15803d;border-radius:99px;font-size:12px;font-weight:700;">● Online 24/7</span>
            </div>
          </div>

          <div class="floating-pill floating-bottom-left">
            <div class="pill-icon blue">📖</div>
            <div class="pill-text">
              <strong>{{ number_format($totalBooks ?? 6, 0, ',', '.') }}+ Buku Pilihan</strong>
              <span>Siap dibaca kapan saja</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= STATS SECTION ================= -->
  <section class="stats-section">
    <div class="container">
      <div class="stats-card">
        <div class="stat-item">
          <div class="stat-val">{{ number_format($totalBooks ?? 6, 0, ',', '.') }}</div>
          <div class="stat-label">Total Judul Buku</div>
        </div>
        <div class="stat-item">
          <div class="stat-val">{{ number_format($totalStock ?? 33, 0, ',', '.') }}</div>
          <div class="stat-label">Stok Buku Tersedia</div>
        </div>
        <div class="stat-item">
          <div class="stat-val">{{ number_format($totalMembers ?? 4, 0, ',', '.') }}+</div>
          <div class="stat-label">Anggota Terdaftar</div>
        </div>
        <div class="stat-item">
          <div class="stat-val">100%</div>
          <div class="stat-label">Layanan Digital Bebas Ribet</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FITUR UNGGULAN ================= -->
  <section class="features-section" id="fitur">
    <div class="container">
      <div class="section-header-center">
        <span class="section-badge">KEUNGGULAN KAMI</span>
        <h2 class="section-title">Solusi Membaca Cerdas & Modern</h2>
        <p class="section-subtitle">Dirancang khusus untuk menghadirkan kemudahan mencari, meminjam, dan mencatat riwayat buku secara terstruktur dan transparan.</p>
      </div>

      <div class="features-grid">
        <!-- Feature 1 -->
        <div class="feature-card">
          <div class="feature-icon-box">
            <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </div>
          <h3 class="feature-title">Pencarian & Katalog Pintar</h3>
          <p class="feature-desc">Temukan buku impian berdasarkan judul, penulis, kategori, atau kode buku dalam hitungan detik dengan filter interaktif.</p>
        </div>

        <!-- Feature 2 -->
        <div class="feature-card">
          <div class="feature-icon-box" style="background:#e0e7ff;color:#4f46e5;">
            <svg viewBox="0 0 24 24"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
          </div>
          <h3 class="feature-title">Peminjaman 1-Klik</h3>
          <p class="feature-desc">Ajukan peminjaman buku langsung dari gadget Anda tanpa antre manual. Notifikasi otomatis saat disetujui petugas perpustakaan.</p>
        </div>

        <!-- Feature 3 -->
        <div class="feature-card">
          <div class="feature-icon-box" style="background:#fef3c7;color:#d97706;">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <h3 class="feature-title">Riwayat Transparan</h3>
          <p class="feature-desc">Lacak seluruh tanggal pinjam, batas waktu jatuh tempo, dan tanggal pengembalian secara rapi dan akurat kapan saja.</p>
        </div>

        <!-- Feature 4 -->
        <div class="feature-card">
          <div class="feature-icon-box" style="background:#dcfce7;color:#16a34a;">
            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
          </div>
          <h3 class="feature-title">Pengembalian Terverifikasi</h3>
          <p class="feature-desc">Proses verifikasi pengembalian buku yang transparan dan otomatis mengembalikan ketersediaan stok buku secara real-time.</p>
        </div>

        <!-- Feature 5 -->
        <div class="feature-card">
          <div class="feature-icon-box" style="background:#fae8ff;color:#a855f7;">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </div>
          <h3 class="feature-title">Profil & Foto Kustom</h3>
          <p class="feature-desc">Sesuaikan nama akun dan unggah foto profil asli Anda sendiri untuk pengalaman membaca yang lebih personal.</p>
        </div>

        <!-- Feature 6 -->
        <div class="feature-card">
          <div class="feature-icon-box" style="background:#f1f5f9;color:#0b1a30;">
            <svg viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
          </div>
          <h3 class="feature-title">Mode Gelap Nyaman</h3>
          <p class="feature-desc">Dukungan dark mode yang ramah di mata untuk pengalaman berselancar buku di malam hari dengan pencahayaan minim.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= POPULAR BOOKS SECTION ================= -->
  <section class="books-section" id="koleksi">
    <div class="container">
      <div class="section-header-center">
        <span class="section-badge">KOLEKSI PILIHAN</span>
        <h2 class="section-title">Buku Terpopuler di PerpusKu</h2>
        <p class="section-subtitle">Daftar bacaan yang paling diminati dan paling sering dipinjam oleh para pembaca setia kami.</p>
      </div>

      <div class="books-showcase-grid">
        @forelse ($popularBooks as $b)
          <div class="book-item-card">
            <div class="book-cover-frame">
              <img src="{{ $b->cover_url }}" alt="{{ $b->title }}" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80';">
            </div>
            <span class="book-tag">{{ $b->category }}</span>
            <div class="book-item-title" title="{{ $b->title }}">{{ $b->title }}</div>
            <div class="book-item-author">{{ $b->author }}</div>
            
            <div class="book-item-foot">
              <span class="stock-badge">Stok: {{ $b->stock }} eks</span>
              @auth
                <a href="{{ route('dashboard') }}#katalog" class="link-detail">
                  <span>Pinjam</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
              @else
                <a href="{{ route('login') }}" class="link-detail">
                  <span>Detail</span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
              @endauth
            </div>
          </div>
        @empty
          <p style="grid-column: 1/-1; text-align:center; color: var(--text-muted);">Belum ada buku di katalog.</p>
        @endforelse
      </div>

      <div style="text-align: center; margin-top: 40px;">
        @auth
          <a href="{{ route('dashboard') }}#katalog" class="btn-secondary" style="padding: 12px 28px;">
            <span>Lihat Semua Katalog Buku ({{ $totalBooks ?? 0 }})</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        @else
          <a href="{{ route('login') }}" class="btn-secondary" style="padding: 12px 28px;">
            <span>Lihat Semua Katalog Buku ({{ $totalBooks ?? 0 }})</span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        @endauth
      </div>
    </div>
  </section>

  <!-- ================= CARA KERJA SECTION ================= -->
  <section class="steps-section" id="cara-kerja">
    <div class="container">
      <div class="section-header-center">
        <span class="section-badge">LANGKAH MUDAH</span>
        <h2 class="section-title">Cara Meminjam Buku di PerpusKu</h2>
        <p class="section-subtitle">Hanya butuh tiga langkah simpel untuk mulai membaca buku favoritmu hari ini.</p>
      </div>

      <div class="steps-grid">
        <div class="step-card">
          <div class="step-num">1</div>
          <h3 class="step-title">Daftar Akun & Pilih Buku</h3>
          <p class="step-desc">Masuk atau daftarkan akun siswa Anda secara gratis, lalu telusuri koleksi buku berkualitas di katalog kami.</p>
        </div>

        <div class="step-card">
          <div class="step-num">2</div>
          <h3 class="step-title">Ajukan Peminjaman 1-Klik</h3>
          <p class="step-desc">Klik tombol pinjam pada buku yang stoknya tersedia. Permintaan Anda akan segera disetujui oleh admin perpustakaan.</p>
        </div>

        <div class="step-card">
          <div class="step-num">3</div>
          <h3 class="step-title">Baca & Kembalikan Tepat Waktu</h3>
          <p class="step-desc">Nikmati buku bacaan Anda hingga masa jatuh tempo, dan ajukan pengembalian dengan mudah melalui dashboard.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= CTA BANNER ================= -->
  <section class="cta-section" id="tentang">
    <div class="container">
      <div class="cta-banner">
        <div class="cta-content">
          <span class="cta-badge">PERPUSTAKAAN DIGITAL UNTUK SEMUA</span>
          <h2 class="cta-title">Siap Memulai Petualangan Membaca Hari Ini?</h2>
          <p class="cta-desc">Bergabunglah dengan para pembaca aktif lainnya. Akses ilmu pengetahuan, kisah inspiratif, dan buku favorit Anda sekarang juga.</p>
          
          @auth
            <a href="{{ route('dashboard') }}" class="cta-btn-white">
              <span>Masuk ke Dashboard PerpusKu</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          @else
            <a href="{{ route('login') }}#daftar" class="cta-btn-white">
              <span>Daftar Sekarang - Gratis</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
          @endauth
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-col">
          <a href="{{ route('landing') }}" class="brand-logo">
            <div class="logo-badge">
              <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"/></svg>
            </div>
            <span class="brand-text">PerpusKu</span>
          </a>
          <p class="footer-desc">
            Platform perpustakaan digital cerdas untuk mendukung budaya literasi modern di lingkungan pendidikan dan masyarakat luas.
          </p>
        </div>

        <div class="footer-col">
          <h4 class="footer-title">Navigasi Cepat</h4>
          <ul class="footer-links">
            <li><a href="#fitur">Fitur Unggulan</a></li>
            <li><a href="#koleksi">Koleksi Populer</a></li>
            <li><a href="#cara-kerja">Cara Peminjaman</a></li>
            <li><a href="{{ route('login') }}">Masuk Perpustakaan</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4 class="footer-title">Kategori Buku</h4>
          <ul class="footer-links">
            <li><a href="{{ route('login') }}">Fiksi & Sastra</a></li>
            <li><a href="{{ route('login') }}">Filsafat & Pemikiran</a></li>
            <li><a href="{{ route('login') }}">Sejarah & Budaya</a></li>
            <li><a href="{{ route('login') }}">Pengembangan Diri</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <div>&copy; {{ date('Y') }} PerpusKu Digital. Hak Cipta Dilindungi.</div>
        <div>Membaca Membuka Jendela Dunia ✨</div>
      </div>
    </div>
  </footer>

  <!-- ================= SCRIPT LOGIC ================= -->
  <script>
    /* Dark Mode Toggle with LocalStorage Sync */
    function initTheme() {
      const savedTheme = localStorage.getItem('perpusku_theme');
      if (savedTheme === 'dark' || (!savedTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.body.classList.add('dark-mode');
      } else {
        document.body.classList.remove('dark-mode');
      }
    }

    function toggleTheme() {
      const isDark = document.body.classList.toggle('dark-mode');
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

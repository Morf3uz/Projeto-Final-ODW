<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Portal de Gestão — Viaggio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Crimson+Pro:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
<style>
:root {
    --ink:        #0c0f1a;
    --ink-soft:   #1c2235;
    --ink-muted:  #2e3550;
    --gold:       #c49a3c;
    --gold-pale:  #e2c06a;
    --gold-dim:   rgba(196,154,60,0.15);
    --gold-line:  rgba(196,154,60,0.25);
    --cream:      #f7f2e9;
    --parchment:  #ede5d4;
    --parch-dark: #ddd0bb;
    --smoke:      #7a7060;
    --smoke-lt:   #a89f90;
    --paper:      #faf7f2;
    --teal:       #1a3a4a;
    --teal-lt:    #244e62;

    --stat-1: #c49a3c;
    --stat-2: #4a8fa8;
    --stat-3: #6b8f5e;
    --stat-4: #a86b4a;
    --stat-5: #7a5ea8;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
    font-family: 'Crimson Pro', Georgia, serif;
    background: var(--paper);
    color: var(--ink);
    min-height: 100vh;
}

.navbar {
    background: var(--ink);
    height: 68px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 48px;
    position: sticky;
    top: 0;
    z-index: 200;
    border-bottom: 1px solid rgba(196,154,60,0.14);
}

.nav-brand {
    font-family: 'Playfair Display', serif;
    font-size: 19px;
    font-weight: 700;
    color: var(--cream);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 14px;
    letter-spacing: 0.3px;
}

.nav-brand-mark {
    width: 38px;
    height: 38px;
    border: 1px solid var(--gold-line);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
    color: var(--gold);
    font-family: 'Playfair Display', serif;
    font-weight: 700;
}

.nav-brand small {
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    font-weight: 400;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.35);
    display: block;
    margin-top: 2px;
}

.nav-links {
    display: flex;
    gap: 2px;
    align-items: center;
}

.nav-links a {
    font-family: 'Crimson Pro', serif;
    font-size: 14px;
    letter-spacing: 0.2px;
    color: rgba(247,242,233,0.55);
    text-decoration: none;
    padding: 6px 13px;
    border-radius: 3px;
    transition: color 0.2s, background 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}

.nav-links a:hover,
.nav-links a.active {
    color: var(--cream);
    background: rgba(255,255,255,0.06);
}

.nav-links a.active { color: var(--gold-pale); }

.nav-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-area-cliente {
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    letter-spacing: 0.5px;
    color: var(--gold);
    border: 1px solid var(--gold-line);
    padding: 6px 14px;
    border-radius: 3px;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
}

.btn-area-cliente:hover {
    background: var(--gold);
    color: var(--ink);
}

.btn-sair {
    font-family: 'Crimson Pro', serif;
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.45);
    border: 1px solid rgba(247,242,233,0.12);
    padding: 6px 14px;
    border-radius: 3px;
    text-decoration: none;
    transition: color 0.2s, border-color 0.2s, background 0.2s;
}

.btn-sair:hover {
    color: var(--cream);
    border-color: rgba(247,242,233,0.3);
    background: rgba(255,255,255,0.05);
}

.agent-bar {
    background: var(--ink-soft);
    border-bottom: 1px solid rgba(196,154,60,0.1);
    padding: 0 48px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.agent-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.agent-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--gold);
    flex-shrink: 0;
    box-shadow: 0 0 8px rgba(196,154,60,0.5);
}

.agent-text {
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    color: rgba(247,242,233,0.5);
}

.agent-text strong {
    color: var(--gold-pale);
    font-weight: 400;
}

.agent-pill {
    background: var(--gold-dim);
    border: 1px solid var(--gold-line);
    color: var(--gold-pale);
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    letter-spacing: 1px;
    padding: 2px 10px;
    border-radius: 20px;
}

.agent-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.agent-meta {
    font-family: 'Crimson Pro', serif;
    font-size: 12px;
    color: rgba(247,242,233,0.3);
    display: flex;
    align-items: center;
    gap: 6px;
}

.agent-meta strong {
    color: rgba(247,242,233,0.55);
    font-weight: 400;
}

.agent-code {
    font-family: 'Courier New', monospace;
    font-size: 11px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    padding: 1px 7px;
    border-radius: 3px;
    color: rgba(247,242,233,0.4);
}

.hero {
    background: var(--ink);
    position: relative;
    overflow: hidden;
    padding: 64px 48px 72px;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 55% 70% at 5% 50%, rgba(26,58,74,0.7) 0%, transparent 55%),
        radial-gradient(ellipse 40% 50% at 95% 20%, rgba(196,154,60,0.08) 0%, transparent 50%),
        radial-gradient(ellipse 50% 60% at 80% 100%, rgba(44,26,74,0.3) 0%, transparent 55%);
    pointer-events: none;
}

.hero-grain {
    position: absolute;
    inset: 0;
    opacity: 0.035;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 200px;
    pointer-events: none;
}

.hero-rule {
    position: absolute;
    top: 0; left: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(to bottom, transparent, var(--gold) 30%, var(--gold) 70%, transparent);
    opacity: 0.4;
}

.hero-content {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 40px;
}

.hero-eyebrow {
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    animation: fadeUp 0.9s ease 0.1s both;
}

.hero-eyebrow::before {
    content: '';
    width: 28px;
    height: 1px;
    background: var(--gold);
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: clamp(38px, 4.5vw, 58px);
    line-height: 1.05;
    color: var(--cream);
    margin-bottom: 18px;
    animation: fadeUp 0.9s ease 0.22s both;
}

.hero-title em { font-style: italic; color: var(--gold-pale); }

.hero-sub {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 18px;
    font-weight: 300;
    color: rgba(247,242,233,0.45);
    max-width: 500px;
    line-height: 1.65;
    animation: fadeUp 0.9s ease 0.36s both;
}

.hero-right { flex-shrink: 0; animation: fadeIn 1s ease 0.5s both; }

.hero-emblem {
    width: 120px;
    height: 120px;
    border: 1px solid var(--gold-line);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    opacity: 0.6;
    position: relative;
}

.hero-emblem::before {
    content: '';
    position: absolute;
    inset: 8px;
    border: 1px solid rgba(196,154,60,0.15);
    border-radius: 50%;
}

.hero-emblem-icon { font-size: 32px; }

.hero-emblem-label {
    font-family: 'Playfair Display', serif;
    font-size: 8px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--gold);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

.main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 56px 48px 80px;
}

.sec-label {
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--smoke);
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.sec-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--parch-dark);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
    margin-bottom: 52px;
}

.stat-card {
    background: var(--cream);
    border: 1px solid var(--parch-dark);
    border-radius: 3px;
    padding: 26px 20px 22px;
    position: relative;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    animation: fadeUp 0.7s ease both;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.12s; }
.stat-card:nth-child(3) { animation-delay: 0.19s; }
.stat-card:nth-child(4) { animation-delay: 0.26s; }
.stat-card:nth-child(5) { animation-delay: 0.33s; }

.stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(12,15,26,0.1); }

.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
}

.stat-card:nth-child(1)::before { background: var(--stat-1); }
.stat-card:nth-child(2)::before { background: var(--stat-2); }
.stat-card:nth-child(3)::before { background: var(--stat-3); }
.stat-card:nth-child(4)::before { background: var(--stat-4); }
.stat-card:nth-child(5)::before { background: var(--stat-5); }

.stat-bg-num {
    position: absolute;
    bottom: -12px; right: 10px;
    font-family: 'Playfair Display', serif;
    font-size: 80px;
    font-weight: 900;
    color: rgba(12,15,26,0.04);
    line-height: 1;
    pointer-events: none;
    user-select: none;
}

.stat-num {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: 42px;
    line-height: 1;
    color: var(--ink);
    margin-bottom: 8px;
}

.stat-lbl {
    font-family: 'Crimson Pro', serif;
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--smoke);
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 52px;
}

.action-card {
    background: var(--cream);
    border: 1px solid var(--parch-dark);
    border-radius: 3px;
    padding: 32px 28px 26px;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    gap: 0;
    position: relative;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    animation: fadeUp 0.7s ease both;
}

.action-card:nth-child(1) { animation-delay: 0.08s; }
.action-card:nth-child(2) { animation-delay: 0.16s; }
.action-card:nth-child(3) { animation-delay: 0.24s; }
.action-card:nth-child(4) { animation-delay: 0.32s; }
.action-card:nth-child(5) { animation-delay: 0.40s; }

.action-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(12,15,26,0.1); }
.action-card:hover .ac-rule { width: 100%; }

.ac-rule {
    position: absolute;
    top: 0; left: 0;
    height: 2px;
    width: 36px;
    background: var(--gold);
    transition: width 0.4s ease;
}

.ac-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px; }
.ac-icon { font-family: 'Playfair Display', serif; font-size: 13px; letter-spacing: 3px; text-transform: uppercase; color: var(--smoke-lt); }
.ac-num  { font-family: 'Playfair Display', serif; font-size: 13px; color: var(--parch-dark); font-weight: 700; }
.ac-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 20px; color: var(--ink); margin-bottom: 10px; line-height: 1.2; }
.ac-desc { font-family: 'Crimson Pro', serif; font-size: 15px; color: var(--smoke); line-height: 1.6; font-style: italic; flex-grow: 1; margin-bottom: 24px; }
.ac-btns { display: flex; gap: 10px; }

.btn-ac {
    font-family: 'Crimson Pro', serif;
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 2px;
    transition: background 0.2s, color 0.2s;
}

.btn-listar { background: var(--ink); color: var(--gold-pale); }
.btn-listar:hover { background: var(--ink-soft); }
.btn-novo { background: transparent; color: var(--smoke); border: 1px solid var(--parch-dark); }
.btn-novo:hover { background: var(--parchment); color: var(--ink); }

.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

.info-card {
    background: var(--cream);
    border: 1px solid var(--parch-dark);
    border-radius: 3px;
    padding: 30px 28px;
    animation: fadeUp 0.7s ease 0.2s both;
}

.info-card-head {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--parch-dark);
}

.info-card-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 17px; color: var(--ink); }
.info-card-sub   { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 13px; color: var(--smoke-lt); }

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(196,154,60,0.08);
}

.info-row:last-child { border-bottom: none; }
.info-lbl { font-family: 'Crimson Pro', serif; font-size: 14px; color: var(--smoke); }
.info-val { font-family: 'Crimson Pro', serif; font-size: 14px; color: var(--ink); font-weight: 600; text-align: right; }
.info-mono { font-family: 'Courier New', monospace; font-size: 12px; color: var(--smoke); background: var(--parchment); padding: 2px 8px; border-radius: 2px; }

.badge { display: inline-block; font-family: 'Crimson Pro', serif; font-size: 11px; letter-spacing: 1px; padding: 3px 10px; border-radius: 2px; }
.badge-ok   { background: rgba(107,143,94,0.15); color: #3d6b30; border: 1px solid rgba(107,143,94,0.3); }
.badge-info { background: rgba(74,143,168,0.12); color: #1f5c75; border: 1px solid rgba(74,143,168,0.3); }
.badge-warn { background: rgba(168,107,74,0.12); color: #7a3e1a; border: 1px solid rgba(168,107,74,0.3); }

.prog-item { margin-bottom: 18px; }
.prog-item:last-child { margin-bottom: 0; }
.prog-header { display: flex; justify-content: space-between; margin-bottom: 7px; }
.prog-name  { font-family: 'Crimson Pro', serif; font-size: 14px; color: var(--ink); }
.prog-count { font-family: 'Crimson Pro', serif; font-size: 13px; color: var(--smoke-lt); font-style: italic; }
.prog-track { background: var(--parchment); border-radius: 2px; height: 4px; overflow: hidden; }
.prog-fill  { height: 100%; border-radius: 2px; transition: width 1s cubic-bezier(0.25, 0.46, 0.45, 0.94); }

.fill-1 { background: var(--stat-1); }
.fill-2 { background: var(--stat-2); }
.fill-3 { background: var(--stat-3); }
.fill-4 { background: var(--stat-4); }
.fill-5 { background: var(--stat-5); }

.endpoint-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(196,154,60,0.08);
    gap: 12px;
}

.endpoint-row:last-child { border-bottom: none; }

.endpoint-method { font-family: 'Crimson Pro', serif; font-size: 10px; letter-spacing: 1.5px; font-weight: 700; padding: 2px 8px; border-radius: 2px; flex-shrink: 0; }
.method-get    { background: rgba(107,143,94,0.15); color: #3d6b30; }
.method-post   { background: rgba(74,143,168,0.12); color: #1f5c75; }
.method-put    { background: rgba(168,107,74,0.12); color: #7a3e1a; }
.method-delete { background: rgba(180,50,40,0.1);   color: #8b2020; }

.endpoint-path { font-family: 'Courier New', monospace; font-size: 12px; color: var(--smoke); flex: 1; }

.footer {
    background: var(--ink);
    border-top: 1px solid rgba(196,154,60,0.1);
    padding: 32px 48px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.footer-brand { font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 700; color: var(--cream); letter-spacing: 0.5px; }
.footer-brand small { display: block; font-family: 'Crimson Pro', serif; font-size: 11px; font-weight: 400; letter-spacing: 2.5px; text-transform: uppercase; color: rgba(247,242,233,0.3); margin-top: 3px; }
.footer-rule { width: 1px; height: 28px; background: rgba(196,154,60,0.2); }
.footer-copy { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 13px; color: rgba(247,242,233,0.25); }
</style>
</head>
<body>

<nav class="navbar">
    <a href="<?= BASE_URL ?>/portal" class="nav-brand">
        <div class="nav-brand-mark">V</div>
        <div>
            Viaggio
            <small>Painel de Gestão</small>
        </div>
    </a>

    <div class="nav-links">
        <a href="<?= BASE_URL ?>/portal" class="active">Portal</a>
        <a href="<?= BASE_URL ?>/destinos">Destinos</a>
        <a href="<?= BASE_URL ?>/pacotes">Pacotes</a>
        <a href="<?= BASE_URL ?>/cronogramas">Cronogramas</a>
        <a href="<?= BASE_URL ?>/clientes">Clientes</a>
        <a href="<?= BASE_URL ?>/reservas">Reservas</a>
    </div>

    <div class="nav-right">
        <a href="<?= BASE_URL ?>/home" class="btn-area-cliente">Área do Cliente</a>
        <a href="<?= BASE_URL ?>/logout" class="btn-sair">Sair</a>
    </div>
</nav>

<div class="agent-bar">
    <div class="agent-left">
        <div class="agent-dot"></div>
        <div class="agent-text">
            Agente: <strong><?= htmlspecialchars($nomeAgente) ?></strong>
        </div>
        <div class="agent-pill">cookie · 1h</div>
        <div class="agent-code">agente_turismo</div>
    </div>

    <div class="agent-right">
        <div class="agent-meta">
            Último acesso: <strong><?= htmlspecialchars($ultimoAcesso) ?></strong>
        </div>
        <div class="agent-meta">
            Session ID: <span class="agent-code"><?= htmlspecialchars(substr(session_id(), 0, 18)) ?>…</span>
        </div>
        <div class="agent-meta">
            <span class="agent-code">sslmode=require</span>
        </div>
    </div>
</div>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grain"></div>
    <div class="hero-rule"></div>

    <div class="hero-content">
        <div class="hero-left">
            <p class="hero-eyebrow">Portal Administrativo — Sistema de Gestão</p>
            <h1 class="hero-title">
                Controle total<br>da sua <em>agência.</em>
            </h1>
            <p class="hero-sub">
                Gerencie destinos, pacotes, cronogramas, clientes e reservas
                em uma única plataforma integrada ao Supabase PostgreSQL.
            </p>
        </div>

        <div class="hero-right">
            <div class="hero-emblem">
                <div class="hero-emblem-icon">✈</div>
                <div class="hero-emblem-label">Admin</div>
            </div>
        </div>
    </div>
</section>

<main class="main">

    <p class="sec-label">Painel de Totais — Contagem em tempo real do Supabase</p>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-bg-num"><?= $totalDestinos ?></div>
            <div class="stat-num"><?= $totalDestinos ?></div>
            <div class="stat-lbl">Destinos</div>
        </div>
        <div class="stat-card">
            <div class="stat-bg-num"><?= $totalPacotes ?></div>
            <div class="stat-num"><?= $totalPacotes ?></div>
            <div class="stat-lbl">Pacotes</div>
        </div>
        <div class="stat-card">
            <div class="stat-bg-num"><?= $totalClientes ?></div>
            <div class="stat-num"><?= $totalClientes ?></div>
            <div class="stat-lbl">Clientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-bg-num"><?= $totalReservas ?></div>
            <div class="stat-num"><?= $totalReservas ?></div>
            <div class="stat-lbl">Reservas</div>
        </div>
        <div class="stat-card">
            <div class="stat-bg-num"><?= $totalCronogramas ?></div>
            <div class="stat-num"><?= $totalCronogramas ?></div>
            <div class="stat-lbl">Cronogramas</div>
        </div>
    </div>

    <p class="sec-label">Acesso Rápido — Gerencie todos os recursos</p>
    <div class="actions-grid">

        <div class="action-card">
            <div class="ac-rule"></div>
            <div class="ac-header">
                <span class="ac-icon">Destinos</span>
                <span class="ac-num">01</span>
            </div>
            <div class="ac-title">Destinos Turísticos</div>
            <div class="ac-desc">Cadastre e edite destinos com país, categoria e duração. Agora com suporte a imagens via Cloudinary.</div>
            <div class="ac-btns">
                <a class="btn-ac btn-listar" href="<?= BASE_URL ?>/destinos">Listar</a>
                <a class="btn-ac btn-novo"   href="<?= BASE_URL ?>/destinos/novo">+ Novo</a>
            </div>
        </div>

        <div class="action-card">
            <div class="ac-rule"></div>
            <div class="ac-header">
                <span class="ac-icon">Pacotes</span>
                <span class="ac-num">02</span>
            </div>
            <div class="ac-title">Pacotes de Turismo</div>
            <div class="ac-desc">Monte pacotes vinculando destinos e definindo o preço. Os pacotes são o produto central da agência.</div>
            <div class="ac-btns">
                <a class="btn-ac btn-listar" href="<?= BASE_URL ?>/pacotes">Listar</a>
                <a class="btn-ac btn-novo"   href="<?= BASE_URL ?>/pacotes/novo">+ Novo</a>
            </div>
        </div>

        <div class="action-card">
            <div class="ac-rule"></div>
            <div class="ac-header">
                <span class="ac-icon">Cronogramas</span>
                <span class="ac-num">03</span>
            </div>
            <div class="ac-title">Cronogramas</div>
            <div class="ac-desc">Defina atividades e horários de cada pacote. Cada item descreve uma etapa do roteiro da viagem.</div>
            <div class="ac-btns">
                <a class="btn-ac btn-listar" href="<?= BASE_URL ?>/cronogramas">Listar</a>
                <a class="btn-ac btn-novo"   href="<?= BASE_URL ?>/cronogramas/novo">+ Novo</a>
            </div>
        </div>

        <div class="action-card">
            <div class="ac-rule"></div>
            <div class="ac-header">
                <span class="ac-icon">Clientes</span>
                <span class="ac-num">04</span>
            </div>
            <div class="ac-title">Clientes</div>
            <div class="ac-desc">Gerencie a base de clientes da agência. Nome, e-mail, CPF e vínculo direto com as reservas.</div>
            <div class="ac-btns">
                <a class="btn-ac btn-listar" href="<?= BASE_URL ?>/clientes">Listar</a>
                <a class="btn-ac btn-novo"   href="<?= BASE_URL ?>/clientes/novo">+ Novo</a>
            </div>
        </div>

        <div class="action-card">
            <div class="ac-rule"></div>
            <div class="ac-header">
                <span class="ac-icon">Reservas</span>
                <span class="ac-num">05</span>
            </div>
            <div class="ac-title">Reservas</div>
            <div class="ac-desc">Registre e cancele reservas. Cada uma vincula um cliente a um pacote com data de saída definida.</div>
            <div class="ac-btns">
                <a class="btn-ac btn-listar" href="<?= BASE_URL ?>/reservas">Listar</a>
                <a class="btn-ac btn-novo"   href="<?= BASE_URL ?>/reservas/novo">+ Nova</a>
            </div>
        </div>

    </div>

    <p class="sec-label">Informações Técnicas e Status do Sistema</p>
    <div class="info-grid">

        <div class="info-card">
            <div class="info-card-head">
                <span class="info-card-title">Sessão PHP &amp; Cookie do Agente</span>
                <span class="info-card-sub">em tempo real</span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Agente (Cookie)</span>
                <span class="info-val"><?= htmlspecialchars($nomeAgente) ?></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Último Acesso (Sessão)</span>
                <span class="info-val"><?= htmlspecialchars($ultimoAcesso) ?></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">ID da Sessão</span>
                <span class="info-val">
                    <span class="info-mono"><?= htmlspecialchars(substr(session_id(), 0, 22)) ?>…</span>
                </span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Validade do Cookie</span>
                <span class="info-val"><span class="badge badge-info">1 hora</span></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Variáveis na Sessão</span>
                <span class="info-val"><?= count($_SESSION) ?> item(ns)</span>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-head">
                <span class="info-card-title">Stack Tecnológica</span>
                <span class="info-card-sub">projeto final</span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Backend PHP</span>
                <span class="info-val"><span class="badge badge-ok">MVC + Doctrine + FastRoute</span></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Backend Java</span>
                <span class="info-val"><span class="badge badge-ok">Spring Boot REST API</span></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Banco de Dados</span>
                <span class="info-val"><span class="badge badge-info">Supabase PostgreSQL</span></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Segurança</span>
                <span class="info-val"><span class="badge badge-ok">SSL (sslmode=require)</span></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Upload de Imagens</span>
                <span class="info-val"><span class="badge badge-ok">Cloudinary SDK</span></span>
            </div>
            <div class="info-row">
                <span class="info-lbl">Padrão Java</span>
                <span class="info-val"><span class="badge badge-ok">Controller → Service → Repo</span></span>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-head">
                <span class="info-card-title">Volume de Dados por Entidade</span>
                <span class="info-card-sub">Supabase</span>
            </div>
            <?php
            $totalGeral = max(1, $totalDestinos + $totalPacotes + $totalClientes + $totalReservas + $totalCronogramas);
            $itens = [
                ['Destinos',    $totalDestinos,    'fill-1'],
                ['Pacotes',     $totalPacotes,     'fill-2'],
                ['Clientes',    $totalClientes,    'fill-3'],
                ['Reservas',    $totalReservas,    'fill-4'],
                ['Cronogramas', $totalCronogramas, 'fill-5'],
            ];
            foreach ($itens as $item):
                $pct = max(4, round(($item[1] / $totalGeral) * 100));
            ?>
            <div class="prog-item">
                <div class="prog-header">
                    <span class="prog-name"><?= $item[0] ?></span>
                    <span class="prog-count"><?= $item[1] ?> registro(s)</span>
                </div>
                <div class="prog-track">
                    <div class="prog-fill <?= $item[2] ?>" style="width:<?= $pct ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="info-card">
            <div class="info-card-head">
                <span class="info-card-title">Endpoints da API Java</span>
                <span class="info-card-sub">Spring Boot</span>
            </div>
            <div class="endpoint-row">
                <span class="endpoint-method method-get">GET</span>
                <span class="endpoint-path">/api/destinos</span>
                <span class="badge badge-ok">Listar todos</span>
            </div>
            <div class="endpoint-row">
                <span class="endpoint-method method-post">POST</span>
                <span class="endpoint-path">/api/destinos</span>
                <span class="badge badge-info">Criar</span>
            </div>
            <div class="endpoint-row">
                <span class="endpoint-method method-put">PUT</span>
                <span class="endpoint-path">/api/destinos/{id}</span>
                <span class="badge badge-warn">Atualizar</span>
            </div>
            <div class="endpoint-row">
                <span class="endpoint-method method-delete">DELETE</span>
                <span class="endpoint-path">/api/destinos/{id}</span>
                <span class="badge badge-warn">Excluir + 404</span>
            </div>
            <div class="endpoint-row">
                <span class="endpoint-method method-get">GET</span>
                <span class="endpoint-path">/api/pacotes + /clientes</span>
                <span class="badge badge-ok">Todos os CRUD</span>
            </div>
            <div class="endpoint-row">
                <span class="endpoint-method method-get">GET</span>
                <span class="endpoint-path">/api/cronogramas</span>
                <span class="badge badge-ok">Controller ativo</span>
            </div>
        </div>

    </div>

</main>

<footer class="footer">
    <div class="footer-brand">
        ✦ Viaggio
        <small>Douglas &amp; Antonio Everton — Projeto Final</small>
    </div>
    <div class="footer-rule"></div>
    <p class="footer-copy">PSA (Java Spring Boot) &amp; ODW (PHP MVC) — Supabase PostgreSQL — <?= date('Y') ?></p>
</footer>

</body>
</html>
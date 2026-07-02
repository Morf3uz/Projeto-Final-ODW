<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $tituloPagina ?? 'Viaggio — Agência de Turismo' ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Crimson+Pro:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root {
    --ink:        #0c0f1a;
    --ink-soft:   #1c2235;
    --gold:       #c49a3c;
    --gold-pale:  #e2c06a;
    --gold-line:  rgba(196,154,60,0.22);
    --gold-dim:   rgba(196,154,60,0.1);
    --cream:      #f7f2e9;
    --parchment:  #ede5d4;
    --parch-dark: #ddd0bb;
    --smoke:      #7a7060;
    --smoke-lt:   #a89f90;
    --paper:      #faf7f2;
    --teal:       #1a3a4a;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
    font-family: 'Crimson Pro', Georgia, serif;
    background: var(--paper);
    color: var(--ink);
    min-height: 100vh;
}

/* ══ NAVBAR ══ */
.navbar {
    background: var(--ink);
    height: 66px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 48px;
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid var(--gold-line);
}

.nav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: var(--cream);
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.nav-brand-mark {
    width: 32px;
    height: 32px;
    border: 1px solid var(--gold-line);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: var(--gold);
}

.nav-brand small {
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    font-weight: 400;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.3);
    display: block;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 28px;
}

.nav-links a {
    font-family: 'Crimson Pro', serif;
    font-size: 14px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.55);
    text-decoration: none;
    transition: color 0.2s;
}

.nav-links a:hover { color: var(--cream); }

/* ══ CONTAINER ══ */
.container {
    max-width: 1120px;
    margin: 0 auto;
    padding: 40px 32px;
    flex: 1;
}

h1 {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--parch-dark);
}

/* ══ BOTÃO NOVO ══ */
.btn-novo {
    display: inline-block;
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gold);
    border: 1px solid var(--gold-line);
    padding: 8px 20px;
    text-decoration: none;
    border-radius: 3px;
    margin-bottom: 24px;
    transition: background 0.2s, color 0.2s;
}

.btn-novo:hover {
    background: var(--gold);
    color: var(--ink);
}

/* ══ TABELA ══ */
.table-wrap {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
}

thead th {
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--smoke);
    padding: 10px 14px;
    border-bottom: 1px solid var(--parch-dark);
    text-align: left;
}

tbody tr {
    border-bottom: 1px solid var(--parchment);
    transition: background 0.15s;
}

tbody tr:hover { background: rgba(196,154,60,0.04); }

tbody td {
    padding: 12px 14px;
    color: var(--ink);
    vertical-align: middle;
}

.td-id {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    color: var(--smoke-lt);
    width: 48px;
}

.msg-vazio {
    text-align: center;
    color: var(--smoke-lt);
    font-style: italic;
    padding: 32px;
}

.msg-erro {
    background: #fdf0f0;
    border: 1px solid #e0b0b0;
    color: #8b2020;
    padding: 12px 16px;
    border-radius: 3px;
    font-size: 14px;
    margin-bottom: 20px;
}

/* ══ BOTÕES DE AÇÃO ══ */
.btn {
    font-family: 'Crimson Pro', serif;
    font-size: 12px;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    padding: 5px 13px;
    border-radius: 3px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: opacity 0.2s;
}

.btn:hover { opacity: 0.75; }

.btn-editar {
    background: var(--teal);
    color: var(--cream);
}

.btn-excluir {
    background: #7a2020;
    color: var(--cream);
}

/* ══ FORMULÁRIOS ══ */
.card-form {
    background: #fff;
    border: 1px solid var(--parch-dark);
    border-radius: 4px;
    padding: 36px 40px;
    max-width: 640px;
}

.form-grupo {
    margin-bottom: 22px;
}

.form-grupo label {
    display: block;
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--smoke);
    margin-bottom: 7px;
}

.form-grupo input,
.form-grupo select,
.form-grupo textarea {
    width: 100%;
    padding: 10px 13px;
    border: 1px solid var(--parch-dark);
    border-radius: 3px;
    font-family: 'Crimson Pro', serif;
    font-size: 16px;
    color: var(--ink);
    background: var(--paper);
    transition: border-color 0.2s;
}

.form-grupo input:focus,
.form-grupo select:focus,
.form-grupo textarea:focus {
    outline: none;
    border-color: var(--gold);
}

.form-grupo textarea {
    min-height: 90px;
    resize: vertical;
}

.form-grupo .preview-img {
    display: block;
    width: 120px;
    height: 80px;
    object-fit: cover;
    border-radius: 3px;
    border: 1px solid var(--parch-dark);
    margin-bottom: 8px;
}

.form-actions {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 28px;
}

.btn-salvar {
    font-family: 'Playfair Display', serif;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: var(--cream);
    background: var(--ink);
    border: none;
    padding: 12px 28px;
    cursor: pointer;
    border-radius: 3px;
    position: relative;
    overflow: hidden;
    transition: color 0.3s;
}

.btn-salvar::after {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--gold);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
    z-index: 0;
}

.btn-salvar:hover::after { transform: scaleX(1); }
.btn-salvar:hover { color: var(--ink); }
.btn-salvar span { position: relative; z-index: 1; }

.btn-voltar {
    font-family: 'Crimson Pro', serif;
    font-size: 14px;
    color: var(--smoke);
    text-decoration: none;
    transition: color 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
}

.btn-voltar:hover { color: var(--ink); }

/* ══ FOOTER ══ */
footer {
    background: var(--ink);
    border-top: 1px solid var(--gold-line);
    padding: 28px 48px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: auto;
}

.footer-brand {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--cream);
    letter-spacing: 0.3px;
}

.footer-brand small {
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    font-weight: 400;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.25);
    display: block;
    margin-top: 3px;
}

.footer-copy {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 13px;
    color: rgba(247,242,233,0.25);
}
</style>
</head>
<body>

<nav class="navbar">
    <a href="<?= BASE_URL ?>/portal" class="nav-brand">
        <div class="nav-brand-mark">V</div>
        <div>
            Viaggio
            <small>Gestão · Agência de Turismo</small>
        </div>
    </a>
    <div class="nav-links">
        <a href="<?= BASE_URL ?>/portal">Portal</a>
        <a href="<?= BASE_URL ?>/destinos">Destinos</a>
        <a href="<?= BASE_URL ?>/pacotes">Pacotes</a>
        <a href="<?= BASE_URL ?>/cronogramas">Cronogramas</a>
        <a href="<?= BASE_URL ?>/clientes">Clientes</a>
        <a href="<?= BASE_URL ?>/reservas">Reservas</a>
        <a href="<?= BASE_URL ?>/home" style="margin-left:8px;color:var(--gold);border:1px solid var(--gold-line);padding:5px 13px;border-radius:3px;">Área do Cliente</a>
    </div>
</nav>

<div class="container">
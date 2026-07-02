<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Entrar — Viaggio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Crimson+Pro:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
<style>
:root {
    --ink:       #0c0f1a;
    --ink-soft:  #1c2235;
    --gold:      #c49a3c;
    --gold-pale: #e2c06a;
    --cream:     #f7f2e9;
    --parchment: #ede5d4;
    --smoke:     #7a7060;
    --teal:      #1a3a4a;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
    height: 100%;
    font-family: 'Crimson Pro', Georgia, serif;
    background: var(--ink);
}

.wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 100vh;
}

.panel-visual {
    background: var(--ink);
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 52px 56px;
    overflow: hidden;
}

.panel-visual::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 80% 60% at 30% 40%, rgba(26,58,74,0.7) 0%, transparent 70%),
        radial-gradient(ellipse 60% 80% at 80% 80%, rgba(196,154,60,0.12) 0%, transparent 60%);
    pointer-events: none;
}

.grain {
    position: absolute;
    inset: 0;
    opacity: 0.045;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 180px;
    pointer-events: none;
}

.compass {
    position: absolute;
    top: 52px;
    right: 48px;
    width: 140px;
    height: 140px;
    opacity: 0.18;
}

.compass-ring       { position: absolute; inset: 0; border: 1px solid var(--gold); border-radius: 50%; }
.compass-ring-inner { position: absolute; inset: 18px; border: 1px solid var(--gold); border-radius: 50%; }

.compass-cross {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.compass-cross::before,
.compass-cross::after {
    content: '';
    position: absolute;
    background: var(--gold);
}

.compass-cross::before { width: 1px; height: 100%; }
.compass-cross::after  { width: 100%; height: 1px; }

.compass-dirs {
    position: absolute;
    inset: 0;
    font-family: 'Playfair Display', serif;
    font-size: 10px;
    color: var(--gold);
    letter-spacing: 2px;
}

.compass-dirs span { position: absolute; transform: translateX(-50%); }
.dir-n { top: 4px; left: 50%; }
.dir-s { bottom: 4px; left: 50%; transform: translateX(-50%); }
.dir-e { right: 4px; top: 50%; transform: translateY(-50%); }
.dir-w { left: 4px;  top: 50%; transform: translateY(-50%); }

.decorative-line {
    width: 48px;
    height: 1px;
    background: var(--gold);
    margin-bottom: 28px;
    animation: lineGrow 1.2s ease forwards;
    transform-origin: left;
}

@keyframes lineGrow {
    from { transform: scaleX(0); opacity: 0; }
    to   { transform: scaleX(1); opacity: 1; }
}

.destinations-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
    margin-bottom: 40px;
    animation: fadeUp 1s ease 0.2s both;
}

.destinations-list .dest-item {
    font-family: 'Playfair Display', serif;
    color: rgba(255,255,255,0.12);
    font-size: 13px;
    letter-spacing: 4px;
    text-transform: uppercase;
    transition: color 0.3s;
}

.destinations-list .dest-item.active {
    color: var(--gold-pale);
    font-size: 14px;
}

.panel-headline {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: clamp(36px, 4vw, 52px);
    line-height: 1.08;
    color: var(--cream);
    margin-bottom: 20px;
    animation: fadeUp 1s ease 0.35s both;
}

.panel-headline em { font-style: italic; color: var(--gold-pale); }

.panel-tagline {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-weight: 300;
    font-size: 17px;
    color: rgba(247,242,233,0.55);
    letter-spacing: 0.3px;
    margin-bottom: 48px;
    animation: fadeUp 1s ease 0.5s both;
}

.panel-brand {
    font-family: 'Playfair Display', serif;
    font-size: 11px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    animation: fadeUp 1s ease 0.65s both;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

.panel-form {
    background: var(--cream);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 64px 72px;
    position: relative;
}

.panel-form::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10%;
    bottom: 10%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, var(--gold) 30%, var(--gold) 70%, transparent);
}

.form-logo {
    font-family: 'Playfair Display', serif;
    font-size: 13px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--smoke);
    margin-bottom: 48px;
    animation: fadeIn 0.8s ease 0.4s both;
}

.form-logo span { color: var(--gold); }

.form-heading {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 34px;
    color: var(--ink);
    line-height: 1.15;
    margin-bottom: 8px;
    animation: fadeIn 0.8s ease 0.5s both;
}

.form-subheading {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 17px;
    color: var(--smoke);
    margin-bottom: 44px;
    animation: fadeIn 0.8s ease 0.6s both;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

.msg-erro {
    background: rgba(180,60,40,0.08);
    border-left: 3px solid #c0392b;
    padding: 12px 16px;
    font-family: 'Crimson Pro', serif;
    font-size: 15px;
    color: #7b2218;
    margin-bottom: 28px;
    border-radius: 0 6px 6px 0;
}

.form-grupo {
    position: relative;
    margin-bottom: 32px;
    animation: fadeIn 0.8s ease 0.65s both;
}

.form-grupo + .form-grupo { animation-delay: 0.75s; }

.form-grupo label {
    display: block;
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--smoke);
    margin-bottom: 10px;
}

.form-grupo input[type="email"],
.form-grupo input[type="password"],
.form-grupo input[type="text"] {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 1.5px solid var(--parchment);
    padding: 8px 0 10px;
    font-family: 'Crimson Pro', serif;
    font-size: 18px;
    color: var(--ink);
    outline: none;
    transition: border-color 0.3s;
    -webkit-appearance: none;
}

.form-grupo input::placeholder { color: #c8bfad; font-style: italic; }
.form-grupo input:focus { border-bottom-color: var(--gold); }

.focus-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 1.5px;
    width: 0;
    background: var(--gold);
    transition: width 0.4s ease;
    pointer-events: none;
}

.form-grupo input:focus ~ .focus-bar { width: 100%; }

.mostrar-senha-wrap {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.mostrar-senha-wrap input[type="checkbox"] {
    cursor: pointer;
    accent-color: var(--gold);
    width: 15px;
    height: 15px;
}

.mostrar-senha-wrap label {
    font-size: 13px;
    font-family: 'Crimson Pro', serif;
    color: var(--smoke);
    letter-spacing: 0;
    text-transform: none;
    cursor: pointer;
    margin: 0;
}

.btn-entrar {
    width: 100%;
    padding: 16px 0;
    background: var(--ink);
    color: var(--gold-pale);
    border: none;
    font-family: 'Playfair Display', serif;
    font-size: 14px;
    letter-spacing: 4px;
    text-transform: uppercase;
    cursor: pointer;
    margin-top: 8px;
    position: relative;
    overflow: hidden;
    transition: background 0.3s;
    animation: fadeIn 0.8s ease 0.9s both;
}

.btn-entrar::after {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--gold);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
    z-index: 0;
}

.btn-entrar:not(:disabled):hover::after { transform: scaleX(1); }
.btn-entrar:not(:disabled):hover { color: var(--ink); }
.btn-entrar span { position: relative; z-index: 1; }
.btn-entrar:disabled { opacity: 0.6; cursor: not-allowed; }

.form-links {
    margin-top: 36px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    animation: fadeIn 0.8s ease 1s both;
}

.form-links a {
    font-family: 'Crimson Pro', serif;
    font-size: 15px;
    color: var(--smoke);
    text-decoration: none;
    transition: color 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-links a::before { content: '—'; color: var(--gold); font-size: 12px; }
.form-links a:hover { color: var(--ink); }

.form-links a.admin-link {
    padding-top: 12px;
    border-top: 1px solid var(--parchment);
    font-size: 13px;
    letter-spacing: 0.5px;
}
</style>
</head>
<body>

<div class="wrapper">
    <div class="panel-visual">
        <div class="grain"></div>

        <div class="compass">
            <div class="compass-ring"></div>
            <div class="compass-ring-inner"></div>
            <div class="compass-cross"></div>
            <div class="compass-dirs">
                <span class="dir-n">N</span>
                <span class="dir-s">S</span>
                <span class="dir-e">E</span>
                <span class="dir-w">O</span>
            </div>
        </div>

        <div class="destinations-list">
            <div class="dest-item">Santorini</div>
            <div class="dest-item active">Paris</div>
            <div class="dest-item">Tóquio</div>
            <div class="dest-item">Dubai</div>
            <div class="dest-item">Roma</div>
        </div>

        <div class="decorative-line"></div>

        <h1 class="panel-headline">
            O mundo<br>te <em>aguarda.</em>
        </h1>

        <p class="panel-tagline">
            Descubra destinos extraordinários, curados para você.
        </p>

        <div class="panel-brand">Viaggio &nbsp;·&nbsp; Agência de Turismo</div>
    </div>

    <div class="panel-form">
        <div class="form-logo">✦ <span>Viaggio</span></div>

        <h2 class="form-heading">Bem-vindo<br>de volta.</h2>
        <p class="form-subheading">Sua próxima aventura começa aqui.</p>

        <?php if (!empty($erro)): ?>
            <div class="msg-erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form id="formLogin" method="POST" action="<?= BASE_URL ?>/login" novalidate>
            <div class="form-grupo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                <div class="focus-bar"></div>
            </div>

            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>
                <div class="focus-bar"></div>
                <div class="mostrar-senha-wrap">
                    <input type="checkbox" id="mostrarSenha">
                    <label for="mostrarSenha">Mostrar senha</label>
                </div>
            </div>

            <button type="submit" id="btnEntrar" class="btn-entrar">
                <span>Entrar &nbsp;→</span>
            </button>
        </form>

        <div class="form-links">
            <a href="<?= BASE_URL ?>/cadastro">Não tem conta? Criar uma agora</a>
            <a href="<?= BASE_URL ?>/portal" class="admin-link">Acessar Portal Administrativo</a>
        </div>
    </div>
</div>

<script>
// mostrar / ocultar senha
document.getElementById('mostrarSenha').addEventListener('change', function() {
    var campo = document.getElementById('senha');
    campo.type = this.checked ? 'text' : 'password';
});

// proteção de duplo clique
document.getElementById('formLogin').addEventListener('submit', function() {
    var btn = document.getElementById('btnEntrar');
    btn.disabled = true;
    btn.querySelector('span').textContent = 'Entrando...';
});
</script>

</body>
</html>
<?php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criar Conta — Viaggio</title>
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

/* ── PAINEL ESQUERDO ── */
.panel-visual {
    background: var(--teal);
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 52px 56px;
    overflow: hidden;
}

.panel-visual::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 100% 60% at 50% 0%, rgba(196,154,60,0.15) 0%, transparent 55%),
        radial-gradient(ellipse 70% 70% at 0% 100%, rgba(12,15,26,0.5) 0%, transparent 60%);
    pointer-events: none;
}

.grain {
    position: absolute;
    inset: 0;
    opacity: 0.04;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 180px;
    pointer-events: none;
}

.panel-top {
    position: relative;
    animation: fadeUp 1s ease 0.1s both;
}

.panel-number {
    font-family: 'Playfair Display', serif;
    font-size: 120px;
    font-weight: 900;
    color: rgba(255,255,255,0.04);
    line-height: 1;
    position: absolute;
    top: -20px;
    right: -10px;
    pointer-events: none;
    user-select: none;
}

.panel-top-label {
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
}

.steps {
    display: flex;
    flex-direction: column;
    gap: 20px;
    position: relative;
    animation: fadeUp 1s ease 0.3s both;
}

.step {
    display: flex;
    align-items: flex-start;
    gap: 18px;
}

.step-num {
    width: 28px;
    height: 28px;
    border: 1px solid rgba(196,154,60,0.4);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 12px;
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 2px;
}

.step-num.active {
    background: var(--gold);
    color: var(--ink);
    border-color: var(--gold);
}

.step-text h4 {
    font-family: 'Crimson Pro', serif;
    font-size: 16px;
    font-weight: 600;
    color: rgba(247,242,233,0.9);
    margin-bottom: 2px;
}

.step-text p {
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    font-style: italic;
    color: rgba(247,242,233,0.45);
}

.panel-bottom {
    position: relative;
    animation: fadeUp 1s ease 0.5s both;
}

.panel-bottom-rule {
    width: 48px;
    height: 1px;
    background: var(--gold);
    margin-bottom: 24px;
}

.panel-headline {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: clamp(30px, 3.5vw, 44px);
    line-height: 1.12;
    color: var(--cream);
    margin-bottom: 16px;
}

.panel-headline em {
    font-style: italic;
    color: var(--gold-pale);
}

.panel-quote {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 16px;
    color: rgba(247,242,233,0.5);
    line-height: 1.6;
    border-left: 2px solid rgba(196,154,60,0.3);
    padding-left: 16px;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── PAINEL DIREITO ── */
.panel-form {
    background: var(--cream);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 52px 72px;
    position: relative;
    overflow-y: auto;
}

.panel-form::before {
    content: '';
    position: absolute;
    left: 0;
    top: 8%;
    bottom: 8%;
    width: 1px;
    background: linear-gradient(to bottom, transparent, var(--gold) 30%, var(--gold) 70%, transparent);
}

.form-logo {
    font-family: 'Playfair Display', serif;
    font-size: 13px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--smoke);
    margin-bottom: 40px;
    animation: fadeIn 0.8s ease 0.4s both;
}

.form-logo span { color: var(--gold); }

.form-heading {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 32px;
    color: var(--ink);
    line-height: 1.2;
    margin-bottom: 6px;
    animation: fadeIn 0.8s ease 0.5s both;
}

.form-subheading {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 17px;
    color: var(--smoke);
    margin-bottom: 40px;
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
    margin-bottom: 24px;
    border-radius: 0 6px 6px 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0 28px;
}

.form-grupo {
    position: relative;
    margin-bottom: 28px;
    animation: fadeIn 0.8s ease 0.65s both;
}

.form-grupo.full { grid-column: 1 / -1; }
.form-grupo:nth-child(2) { animation-delay: 0.72s; }
.form-grupo:nth-child(3) { animation-delay: 0.79s; }
.form-grupo:nth-child(4) { animation-delay: 0.86s; }

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

.label-opt {
    letter-spacing: 1px;
    font-size: 10px;
    color: #bbb0a0;
    font-weight: 400;
    text-transform: none;
    margin-left: 4px;
}

.form-grupo input {
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

.btn-cadastrar {
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
    margin-top: 4px;
    position: relative;
    overflow: hidden;
    transition: color 0.3s;
    animation: fadeIn 0.8s ease 1s both;
}

.btn-cadastrar::after {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--gold);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
    z-index: 0;
}

.btn-cadastrar:hover::after { transform: scaleX(1); }
.btn-cadastrar:hover { color: var(--ink); }
.btn-cadastrar span { position: relative; z-index: 1; }

.form-links {
    margin-top: 28px;
    animation: fadeIn 0.8s ease 1.1s both;
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
.form-links a:hover   { color: var(--ink); }
</style>
</head>
<body>

<div class="wrapper">
    <div class="panel-visual">
        <div class="grain"></div>
        <div class="panel-number">01</div>

        <div class="panel-top">
            <p class="panel-top-label">✦ Sua jornada começa aqui</p>
            <div class="steps">
                <div class="step">
                    <div class="step-num active">1</div>
                    <div class="step-text">
                        <h4>Crie sua conta</h4>
                        <p>Rápido, gratuito e sem complicações.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="step-text">
                        <h4>Explore destinos</h4>
                        <p>Pacotes curados para todos os perfis.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="step-text">
                        <h4>Faça sua reserva</h4>
                        <p>Confirmação imediata e segura.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-bottom">
            <div class="panel-bottom-rule"></div>
            <h2 class="panel-headline">
                Cada viagem é<br>uma <em>história</em><br>que merece<br>ser <em>vivida.</em>
            </h2>
            <p class="panel-quote">
                "Viajar é a única coisa que compramos<br>
                que nos torna mais ricos."
            </p>
        </div>
    </div>

    <div class="panel-form">
        <div class="form-logo">✦ <span>Viaggio</span></div>

        <h2 class="form-heading">Criar sua conta.</h2>
        <p class="form-subheading">Junte-se a nós e explore o mundo.</p>

        <?php if (!empty($erro)): ?>
            <div class="msg-erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/cadastro" id="formCadastro">
            <div class="form-row">
                <div class="form-grupo full">
                    <label for="nome">Nome completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Como prefere ser chamado" required>
                    <div class="focus-bar"></div>
                </div>

                <div class="form-grupo full">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                    <div class="focus-bar"></div>
                </div>

                <div class="form-grupo">
                    <label for="cpf">CPF <span class="label-opt">(opcional)</span></label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14">
                    <div class="focus-bar"></div>
                </div>

                <div class="form-grupo">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Mín. 6 caracteres" required minlength="6">
                    <div class="focus-bar"></div>
                    
                    <div style="margin-top: 12px; display: flex; align-items: center; gap: 6px;">
                        <input type="checkbox" id="mostrarSenha" style="width: auto; margin: 0; padding: 0; border: none; -webkit-appearance: checkbox; appearance: checkbox; display: inline-block;">
                        <label for="mostrarSenha" style="margin: 0; font-size: 12px; letter-spacing: 1px; text-transform: none; cursor: pointer; color: var(--smoke);">Mostrar senha</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-cadastrar" id="btnSubmit">
                <span id="btnSpan">Criar conta &nbsp;→</span>
            </button>
        </form>

        <div class="form-links">
            <a href="<?= BASE_URL ?>/login">Já tem conta? Entrar</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Mostrar/Ocultar Senha
    var inputSenha = document.getElementById('senha');
    var checkMostrar = document.getElementById('mostrarSenha');
    
    if (inputSenha && checkMostrar) {
        checkMostrar.addEventListener('change', function() {
            inputSenha.type = this.checked ? 'text' : 'password';
        });
    }

    // 2. Máscara de CPF Dinâmica (000.000.000-00)
    var inputCpf = document.getElementById('cpf');
    
    if (inputCpf) {
        inputCpf.addEventListener('input', function() {
            var value = this.value;
            
            // Remove tudo o que não for número
            value = value.replace(/\D/g, "");
            
            // Aplica a máscara dinamicamente
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            
            this.value = value;
        });
    }

    // 3. Prevenção de Duplo Clique (Feedback visual de "Salvando...")
    var formCadastro = document.getElementById('formCadastro');
    var btnSubmit = document.getElementById('btnSubmit');
    var btnSpan = document.getElementById('btnSpan');

    if (formCadastro && btnSubmit) {
        formCadastro.addEventListener('submit', function() {
            btnSubmit.disabled = true;
            btnSubmit.style.opacity = '0.7';
            btnSubmit.style.cursor = 'not-allowed';
            btnSpan.innerHTML = 'Salvando...';
        });
    }
});
</script>

</body>
</html>
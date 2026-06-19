<?php
$nomeCliente = e($_SESSION['cliente_nome'] ?? 'Viajante');
$gradientes  = [
    ['#1a3a4a', '#2e6b7a'],
    ['#2c1a4a', '#5e3a7a'],
    ['#4a2a1a', '#8c5a2e'],
    ['#1a4a2a', '#2e7a4e'],
    ['#4a1a2a', '#8c2e4e'],
    ['#1a2a4a', '#2e4e8c'],
];
$emojis = ['🗼', '🏛️', '🌋', '🏯', '⛩️', '🕌', '🗽', '🏔️', '🌊', '🏖️'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Minhas Viagens — Viaggio</title>
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
    --cream:      #f7f2e9;
    --parchment:  #ede5d4;
    --parch-dark: #ddd0bb;
    --smoke:      #7a7060;
    --smoke-lt:   #a89f90;
    --paper:      #faf7f2;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: 'Crimson Pro', Georgia, serif; background: var(--paper); color: var(--ink); }

.navbar {
    background: var(--ink);
    height: 68px;
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
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--cream);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
}
.nav-brand small {
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    font-weight: 400;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.3);
    display: block;
    margin-top: 2px;
}
.nav-links { display: flex; gap: 4px; align-items: center; }
.nav-links a {
    font-family: 'Crimson Pro', serif;
    font-size: 14px;
    color: rgba(247,242,233,0.55);
    text-decoration: none;
    padding: 6px 13px;
    border-radius: 3px;
    transition: color 0.2s, background 0.2s;
}
.nav-links a:hover, .nav-links a.active { color: var(--cream); background: rgba(255,255,255,0.06); }
.nav-links a.active { color: var(--gold-pale); }
.nav-user { display: flex; align-items: center; gap: 14px; }
.nav-user-name { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 15px; color: rgba(247,242,233,0.55); }
.nav-user-name strong { font-style: normal; color: var(--gold-pale); font-weight: 400; }
.btn-logout {
    font-family: 'Crimson Pro', serif;
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--smoke);
    text-decoration: none;
    border: 1px solid rgba(122,112,96,0.3);
    padding: 6px 14px;
    border-radius: 3px;
    transition: all 0.2s;
}
.btn-logout:hover { color: var(--cream); border-color: rgba(247,242,233,0.3); background: rgba(255,255,255,0.05); }

.hero {
    background: var(--ink);
    padding: 56px 48px 64px;
    position: relative;
    overflow: hidden;
}
.hero-bg {
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 50% 70% at 5% 50%, rgba(26,58,74,0.7) 0%, transparent 55%),
        radial-gradient(ellipse 40% 40% at 90% 20%, rgba(196,154,60,0.08) 0%, transparent 50%);
    pointer-events: none;
}
.hero-grain {
    position: absolute; inset: 0;
    opacity: 0.03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    background-size: 200px;
    pointer-events: none;
}
.hero-content { position: relative; max-width: 1200px; margin: 0 auto; }
.hero-eyebrow {
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.hero-eyebrow::before { content: ''; width: 28px; height: 1px; background: var(--gold); }
.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: clamp(36px, 4vw, 52px);
    line-height: 1.05;
    color: var(--cream);
    margin-bottom: 14px;
}
.hero-title em { font-style: italic; color: var(--gold-pale); }
.hero-sub {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 17px;
    font-weight: 300;
    color: rgba(247,242,233,0.45);
    max-width: 440px;
}

.section {
    max-width: 1200px;
    margin: 56px auto;
    padding: 0 48px;
}
.section-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--parch-dark);
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 26px;
    color: var(--ink);
}
.section-title em { font-style: italic; color: var(--gold); }
.section-meta { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 15px; color: var(--smoke); }

.reservas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px;
}

.card-reserva {
    background: var(--cream);
    border: 1px solid var(--parch-dark);
    border-radius: 3px;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.card-reserva:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 36px rgba(12,15,26,0.1);
}
.card-reserva-thumb {
    height: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 44px;
    position: relative;
    opacity: 0.9;
}
.card-reserva-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(12,15,26,0.55);
    backdrop-filter: blur(4px);
    color: var(--gold-pale);
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 3px 10px;
    border-radius: 2px;
    border: 1px solid var(--gold-line);
}
.card-reserva-body { padding: 18px 20px 20px; }
.card-reserva-id {
    font-family: 'Courier New', monospace;
    font-size: 10px;
    color: var(--smoke-lt);
    margin-bottom: 6px;
}
.card-reserva-pacote {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 17px;
    color: var(--ink);
    margin-bottom: 4px;
    line-height: 1.25;
}
.card-reserva-destino {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 14px;
    color: var(--smoke);
    margin-bottom: 16px;
}
.card-reserva-foot {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid rgba(196,154,60,0.1);
    gap: 8px;
}
.card-reserva-data-lbl {
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--smoke-lt);
    margin-bottom: 2px;
}
.card-reserva-data {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--ink);
}
.card-reserva-preco {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 800;
    color: var(--gold);
    text-align: right;
}
.card-reserva-preco small {
    display: block;
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    font-weight: 400;
    color: var(--smoke-lt);
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    border: 1px dashed var(--parch-dark);
    border-radius: 3px;
    background: var(--cream);
}
.empty-state-icon { font-size: 48px; margin-bottom: 20px; opacity: 0.4; }
.empty-state-title {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    font-size: 22px;
    color: var(--smoke);
    margin-bottom: 10px;
}
.empty-state-sub {
    font-family: 'Crimson Pro', serif;
    font-size: 16px;
    color: var(--smoke-lt);
    margin-bottom: 28px;
}
.btn-explorar {
    display: inline-block;
    background: var(--ink);
    color: var(--gold-pale);
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 12px 28px;
    border-radius: 3px;
    text-decoration: none;
    transition: background 0.2s;
}
.btn-explorar:hover { background: var(--ink-soft); }

.footer {
    background: var(--ink);
    border-top: 1px solid var(--gold-line);
    padding: 28px 48px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 80px;
}
.footer-brand { font-family: 'Playfair Display', serif; font-size: 15px; font-weight: 700; color: var(--cream); }
.footer-brand small { display: block; font-family: 'Crimson Pro', serif; font-size: 11px; font-weight: 400; letter-spacing: 2px; text-transform: uppercase; color: rgba(247,242,233,0.25); margin-top: 3px; }
.footer-copy { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 13px; color: rgba(247,242,233,0.25); }
</style>
</head>
<body>

<nav class="navbar">
    <a href="<?= BASE_URL ?>/home" class="nav-brand">
        ✦ Viaggio
        <small>Agência de Turismo</small>
    </a>
    <div class="nav-links">
        <a href="<?= BASE_URL ?>/home">Início</a>
        <a href="<?= BASE_URL ?>/minhas-viagens" class="active">Minhas Viagens</a>
    </div>
    <div class="nav-user">
        <span class="nav-user-name">Olá, <strong><?= $nomeCliente ?></strong></span>
            <?php if (isset($_SESSION['cliente_is_admin']) && $_SESSION['cliente_is_admin'] === true): ?>
                <a href="<?= BASE_URL ?>/portal" class="btn-logout" style="color:var(--gold);border-color:rgba(196,154,60,0.3);">✦ Portal Admin</a>
            <?php endif; ?>
                <a href="<?= BASE_URL ?>/logout" class="btn-logout">Sair</a>
    </div>
</nav>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grain"></div>
    <div class="hero-content">
        <p class="hero-eyebrow">Área do Viajante</p>
        <h1 class="hero-title">Minhas <em>Viagens</em></h1>
        <p class="hero-sub">Todas as suas aventuras reservadas em um só lugar.</p>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">Suas <em>Reservas</em></h2>
        <span class="section-meta"><?= count($reservas) ?> reserva(s)</span>
    </div>

    <?php if (empty($reservas)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">✈️</div>
            <p class="empty-state-title">Nenhuma viagem reservada ainda.</p>
            <p class="empty-state-sub">Explore nossos pacotes e planeje sua próxima aventura.</p>
            <a href="<?= BASE_URL ?>/home" class="btn-explorar">Explorar Pacotes →</a>
        </div>
    <?php else: ?>
        <div class="reservas-grid">
            <?php foreach ($reservas as $i => $reserva):
                $pacote  = $reserva->getPacote();
                $destino = $pacote?->getDestino();
                $grad    = $gradientes[$i % count($gradientes)];
                $emoji   = $emojis[$i % count($emojis)];

                $dataFormatada = '';
                $d = $reserva->getDataReserva();
                if ($d instanceof \DateTime) {
                    $dataFormatada = $d->format('d/m/Y');
                } elseif (is_string($d) && $d !== '') {
                    $dataFormatada = $d;
                }
            ?>
                <div class="card-reserva">
                    <div class="card-reserva-thumb" style="background: linear-gradient(145deg, <?= $grad[0] ?> 0%, <?= $grad[1] ?> 100%);">
                        <?= $emoji ?>
                        <span class="card-reserva-badge">Reserva #<?= e((string) $reserva->getId()) ?></span>
                    </div>
                    <div class="card-reserva-body">
                        <div class="card-reserva-id">ID <?= e((string) $reserva->getId()) ?></div>
                        <div class="card-reserva-pacote"><?= e($pacote?->getNome()) ?></div>
                        <div class="card-reserva-destino">
                            <?php if ($destino): ?>
                                <?= e($destino->getNome()) ?><?= $destino->getPais() ? ' — ' . e($destino->getPais()) : '' ?>
                            <?php endif; ?>
                        </div>
                        <div class="card-reserva-foot">
                            <div>
                                <div class="card-reserva-data-lbl">Data da reserva</div>
                                <div class="card-reserva-data"><?= $dataFormatada ?: '—' ?></div>
                            </div>
                            <?php if ($pacote?->getPreco() !== null): ?>
                                <div class="card-reserva-preco">
                                    <?= moeda($pacote->getPreco()) ?>
                                    <small>por pessoa</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<footer class="footer">
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

</body>
</html>
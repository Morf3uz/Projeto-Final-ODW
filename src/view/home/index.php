<?php
$nomeCliente   = htmlspecialchars($_SESSION['cliente_nome'] ?? '');
$termoBusca    = htmlspecialchars($_GET['destino'] ?? '');
$clienteLogado = $clienteLogado ?? false;

$paletas = [
    ['#1a3a4a', '#2e6b7a'],
    ['#2c1a4a', '#5e3a7a'],
    ['#4a2a1a', '#8c5a2e'],
    ['#1a4a2a', '#2e7a4e'],
    ['#4a1a2a', '#8c2e4e'],
    ['#1a2a4a', '#2e4e8c'],
];

$emojis = ['🗼', '🏛️', '🗿', '🌋', '🏯', '⛩️', '🕌', '🗽', '🏔️', '🌊'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Viaggio — Descubra o Mundo</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Crimson+Pro:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root {
    --ink:       #0c0f1a;
    --ink-soft:  #1c2235;
    --gold:      #c49a3c;
    --gold-pale: #e2c06a;
    --gold-dim:  rgba(196,154,60,0.15);
    --cream:     #f7f2e9;
    --parchment: #ede5d4;
    --smoke:     #7a7060;
    --teal:      #1a3a4a;
    --paper:     #faf7f2;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: 'Crimson Pro', Georgia, serif; background: var(--paper); color: var(--ink); min-height: 100vh; }

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
    border-bottom: 1px solid rgba(196,154,60,0.15);
}

.nav-brand {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--cream);
    text-decoration: none;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.nav-brand .brand-mark { color: var(--gold); font-size: 16px; }

.nav-brand small {
    font-family: 'Crimson Pro', serif;
    font-size: 10px;
    font-weight: 400;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.4);
    display: block;
    margin-top: 1px;
}

.nav-links { display: flex; gap: 4px; align-items: center; }

.nav-links a {
    font-family: 'Crimson Pro', serif;
    font-size: 15px;
    color: rgba(247,242,233,0.6);
    text-decoration: none;
    padding: 6px 14px;
    border-radius: 4px;
    transition: color 0.2s, background 0.2s;
    letter-spacing: 0.3px;
}

.nav-links a:hover { color: var(--cream); background: rgba(255,255,255,0.05); }

.nav-user { display: flex; align-items: center; gap: 16px; }

.nav-user-name {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 15px;
    color: rgba(247,242,233,0.55);
}

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

.btn-nav-entrar {
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: rgba(247,242,233,0.7);
    text-decoration: none;
    padding: 7px 16px;
    border-radius: 3px;
    border: 1px solid rgba(247,242,233,0.15);
    transition: all 0.2s;
}

.btn-nav-entrar:hover { color: var(--cream); border-color: rgba(247,242,233,0.35); background: rgba(255,255,255,0.05); }

.btn-nav-cadastro {
    font-family: 'Crimson Pro', serif;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--ink);
    background: var(--gold);
    text-decoration: none;
    padding: 7px 18px;
    border-radius: 3px;
    transition: background 0.2s;
}

.btn-nav-cadastro:hover { background: var(--gold-pale); }

.hero {
    background: var(--ink);
    position: relative;
    overflow: hidden;
    padding: 88px 48px 100px;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 70% 80% at 15% 50%, rgba(26,58,74,0.8) 0%, transparent 60%),
        radial-gradient(ellipse 50% 50% at 85% 20%, rgba(196,154,60,0.1) 0%, transparent 50%),
        radial-gradient(ellipse 60% 60% at 80% 90%, rgba(44,26,74,0.5) 0%, transparent 55%);
}

.hero-grain {
    position: absolute;
    inset: 0;
    opacity: 0.04;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-size: 200px;
    pointer-events: none;
}

.hero-diagonal {
    position: absolute;
    top: 0;
    right: 0;
    width: 40%;
    height: 100%;
    background: linear-gradient(135deg, transparent 0%, rgba(196,154,60,0.04) 50%, transparent 100%);
    border-left: 1px solid rgba(196,154,60,0.08);
    transform: skewX(-8deg) translateX(10%);
}

.hero-content { position: relative; max-width: 1200px; margin: 0 auto; }

.hero-label {
    font-family: 'Crimson Pro', serif;
    font-size: 11px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    animation: heroFadeUp 1s ease 0.1s both;
}

.hero-label::before { content: ''; width: 32px; height: 1px; background: var(--gold); display: inline-block; }

.hero-title {
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: clamp(44px, 6vw, 80px);
    line-height: 1.02;
    color: var(--cream);
    margin-bottom: 24px;
    animation: heroFadeUp 1s ease 0.25s both;
}

.hero-title em { font-style: italic; color: var(--gold-pale); display: block; }

.hero-sub {
    font-family: 'Crimson Pro', serif;
    font-style: italic;
    font-size: 20px;
    font-weight: 300;
    color: rgba(247,242,233,0.5);
    margin-bottom: 52px;
    max-width: 480px;
    line-height: 1.6;
    animation: heroFadeUp 1s ease 0.4s both;
}

@keyframes heroFadeUp {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0); }
}

.search-wrap { animation: heroFadeUp 1s ease 0.55s both; }

.search-bar {
    background: rgba(247,242,233,0.06);
    border: 1px solid rgba(196,154,60,0.2);
    backdrop-filter: blur(12px);
    border-radius: 6px;
    padding: 20px 24px;
    display: flex;
    gap: 0;
    align-items: flex-end;
    max-width: 780px;
}

.search-divider { width: 1px; height: 36px; background: rgba(196,154,60,0.2); margin: 0 20px; flex-shrink: 0; align-self: flex-end; margin-bottom: 10px; }

.search-field { flex: 1; display: flex; flex-direction: column; gap: 6px; }

.search-field label { font-family: 'Crimson Pro', serif; font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: var(--gold); }

.search-field input {
    background: transparent;
    border: none;
    padding: 6px 0 8px;
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    color: var(--cream);
    outline: none;
    width: 100%;
}

.search-field input::placeholder { color: rgba(247,242,233,0.25); font-style: italic; font-family: 'Crimson Pro', serif; font-size: 15px; }

.btn-buscar {
    background: var(--gold);
    color: var(--ink);
    border: none;
    font-family: 'Playfair Display', serif;
    font-size: 13px;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 14px 28px;
    cursor: pointer;
    border-radius: 4px;
    transition: background 0.2s, transform 0.1s;
    flex-shrink: 0;
    align-self: flex-end;
    margin-bottom: 2px;
}

.btn-buscar:hover { background: var(--gold-pale); transform: translateY(-1px); }

.section { max-width: 1200px; margin: 72px auto; padding: 0 48px; }

.section-header { display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 36px; padding-bottom: 20px; border-bottom: 1px solid var(--parchment); }

.section-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 30px; color: var(--ink); line-height: 1.2; }

.section-title em { font-style: italic; color: var(--gold); }

.section-meta { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 15px; color: var(--smoke); }

.search-notice { background: rgba(196,154,60,0.08); border: 1px solid rgba(196,154,60,0.25); border-radius: 4px; padding: 14px 20px; font-family: 'Crimson Pro', serif; font-size: 16px; font-style: italic; color: var(--smoke); margin-bottom: 32px; display: flex; justify-content: space-between; align-items: center; }

.search-notice a { font-style: normal; font-size: 13px; letter-spacing: 1px; text-transform: uppercase; color: var(--gold); text-decoration: none; }

.search-notice a:hover { text-decoration: underline; }

.msg-vazio { text-align: center; padding: 80px 20px; }
.msg-vazio p { font-family: 'Playfair Display', serif; font-style: italic; font-size: 22px; color: var(--smoke); }

.pacotes-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; }
.pacotes-grid .card-pacote:first-child { grid-column: 1 / 2; grid-row: 1 / 3; }

.card-pacote { position: relative; overflow: hidden; cursor: pointer; background: var(--ink-soft); }
.card-pacote:hover .card-visual { transform: scale(1.04); }
.card-pacote:hover .card-overlay { opacity: 1; }

.card-visual { width: 100%; height: 100%; min-height: 260px; display: flex; align-items: center; justify-content: center; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); position: relative; }
.card-pacote:first-child .card-visual { min-height: 524px; }

.card-emoji { font-size: 52px; opacity: 0.25; position: absolute; bottom: 50%; left: 50%; transform: translate(-50%, 50%); pointer-events: none; }
.card-pacote:first-child .card-emoji { font-size: 80px; }

.card-overlay { position: absolute; inset: 0; background: rgba(12,15,26,0.25); opacity: 0; transition: opacity 0.4s; }

.card-info { position: absolute; bottom: 0; left: 0; right: 0; padding: 28px 24px 24px; background: linear-gradient(to top, rgba(12,15,26,0.92) 0%, rgba(12,15,26,0.5) 60%, transparent 100%); }
.card-pacote:first-child .card-info { padding: 36px 32px 32px; }

.card-categoria { font-family: 'Crimson Pro', serif; font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: var(--gold); margin-bottom: 6px; }
.card-nome { font-family: 'Playfair Display', serif; font-weight: 700; color: var(--cream); font-size: 18px; line-height: 1.2; margin-bottom: 4px; }
.card-pacote:first-child .card-nome { font-size: 26px; }
.card-destino-nome { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 14px; color: rgba(247,242,233,0.6); margin-bottom: 14px; }
.card-pacote:first-child .card-destino-nome { font-size: 16px; }

.card-bottom { display: flex; align-items: flex-end; justify-content: space-between; gap: 12px; }
.card-price-label { font-family: 'Crimson Pro', serif; font-size: 10px; letter-spacing: 2px; text-transform: uppercase; color: rgba(247,242,233,0.4); margin-bottom: 2px; }
.card-price { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 22px; color: var(--gold-pale); }
.card-pacote:first-child .card-price { font-size: 30px; }
.card-price small { font-family: 'Crimson Pro', serif; font-size: 13px; font-weight: 400; color: rgba(247,242,233,0.4); }

.card-btn { font-family: 'Crimson Pro', serif; font-size: 13px; letter-spacing: 2px; text-transform: uppercase; color: var(--ink); background: var(--gold); padding: 8px 16px; text-decoration: none; border-radius: 3px; transition: background 0.2s; white-space: nowrap; }
.card-btn:hover { background: var(--gold-pale); }

.card-dias { position: absolute; top: 16px; right: 16px; background: rgba(12,15,26,0.7); backdrop-filter: blur(4px); border: 1px solid rgba(196,154,60,0.3); color: var(--gold-pale); font-family: 'Crimson Pro', serif; font-size: 12px; letter-spacing: 1px; padding: 5px 10px; border-radius: 2px; }

.destinos-scroll { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; }

.card-destino-item { position: relative; overflow: hidden; border-radius: 3px; height: 160px; cursor: pointer; }
.card-destino-item:hover .dest-bg { transform: scale(1.06); }

.dest-bg { position: absolute; inset: 0; transition: transform 0.5s ease; }
.dest-cover { position: absolute; inset: 0; background: linear-gradient(to top, rgba(12,15,26,0.85) 0%, rgba(12,15,26,0.2) 60%, transparent 100%); }
.dest-emoji { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -60%); font-size: 34px; opacity: 0.3; }
.dest-info { position: absolute; bottom: 0; left: 0; right: 0; padding: 14px 16px; }
.dest-nome { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 17px; color: var(--cream); display: block; margin-bottom: 2px; }
.dest-sub { font-family: 'Crimson Pro', serif; font-style: italic; font-size: 13px; color: rgba(247,242,233,0.55); }

.footer { background: var(--ink); border-top: 1px solid rgba(196,154,60,0.12); padding: 40px 48px; display: flex; align-items: center; justify-content: space-between; margin-top: 80px; }
.footer-brand { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: var(--cream); letter-spacing: 1px; }
.footer-brand small { display: block; font-family: 'Crimson Pro', serif; font-size: 12px; font-weight: 400; letter-spacing: 3px; text-transform: uppercase; color: rgba(247,242,233,0.3); margin-top: 4px; }
.footer-copy { font-family: 'Crimson Pro', serif; font-size: 14px; color: rgba(247,242,233,0.3); font-style: italic; }
.footer-gold { width: 32px; height: 1px; background: var(--gold); opacity: 0.4; }
</style>
</head>
<body>

<nav class="navbar">
    <a href="<?= BASE_URL ?>/home" class="nav-brand">
        <span class="brand-mark">✦</span>
        <div>
            Viaggio
            <small>Agência de Turismo</small>
        </div>
    </a>

    <div class="nav-links">
        <a href="<?= BASE_URL ?>/home">Início</a>
        <?php if ($clienteLogado): ?>
            <a href="<?= BASE_URL ?>/minhas-viagens">Minhas Viagens</a>
        <?php endif; ?>
    </div>

    <div class="nav-user">
        <?php if ($clienteLogado): ?>
            <span class="nav-user-name">Olá, <strong><?= $nomeCliente ?></strong></span>
        <?php if (isset($_SESSION['cliente_is_admin']) && $_SESSION['cliente_is_admin'] === true): ?>
            <a href="<?= BASE_URL ?>/portal" class="btn-nav-entrar" style="color:var(--gold);border-color:var(--gold-line);">✦ Portal Admin</a>
        <?php endif; ?>
            <a href="<?= BASE_URL ?>/logout" class="btn-logout">Sair</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/login" class="btn-nav-entrar">Entrar</a>
            <a href="<?= BASE_URL ?>/cadastro" class="btn-nav-cadastro">Criar conta</a>
        <?php endif; ?>
    </div>
</nav>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grain"></div>
    <div class="hero-diagonal"></div>

    <div class="hero-content">
        <p class="hero-label">Agência de Turismo — Destinos Exclusivos</p>

        <h1 class="hero-title">
            Para onde você<br>
            <em>quer ir?</em>
        </h1>

        <p class="hero-sub">
            Descubra pacotes cuidadosamente curados para cada tipo de viajante.
        </p>

        <div class="search-wrap">
            <form class="search-bar" method="GET" action="<?= BASE_URL ?>/home">
                <div class="search-field">
                    <label>Destino</label>
                    <input type="text" name="destino" value="<?= $termoBusca ?>" placeholder="Paris, Tóquio, Santorini...">
                </div>

                <div class="search-divider"></div>

                <div class="search-field">
                    <label>Data de ida</label>
                    <input type="date" name="data_ida">
                </div>

                <div class="search-divider"></div>

                <div class="search-field">
                    <label>Data de volta</label>
                    <input type="date" name="data_volta">
                </div>

                <div style="margin-left: 20px; align-self: flex-end; padding-bottom: 2px;">
                    <button type="submit" class="btn-buscar">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-header">
        <h2 class="section-title">
            <?php if (!empty($termoBusca)): ?>
                Resultados para <em>"<?= $termoBusca ?>"</em>
            <?php else: ?>
                Pacotes em <em>Destaque</em>
            <?php endif; ?>
        </h2>
        <span class="section-meta"><?= count($pacotes) ?> pacote(s) disponível(is)</span>
    </div>

    <?php if (!empty($termoBusca) && count($pacotes) === 0): ?>
        <div class="search-notice">
            <span>Nenhum pacote encontrado para "<?= $termoBusca ?>".</span>
            <a href="<?= BASE_URL ?>/home">Ver todos</a>
        </div>
    <?php endif; ?>

    <?php if (count($pacotes) > 0): ?>
        <div class="pacotes-grid">
            <?php foreach ($pacotes as $i => $pacote):
                $destObj = $pacote->getDestino();
                $nomeD   = $destObj ? htmlspecialchars($destObj->getNome()) : 'Destino';
                $pais    = $destObj ? htmlspecialchars($destObj->getPais() ?? '') : '';
                $dias    = $destObj ? ($destObj->getDuracaoDeDias() ?? 0) : 0;
                $cat     = $destObj ? htmlspecialchars($destObj->getCategoria() ?? 'Turismo') : 'Turismo';
                $paleta  = $paletas[$i % count($paletas)];
                $emoji   = $emojis[$i % count($emojis)];
            ?>
                <div class="card-pacote">
                    <div class="card-visual" style="background: linear-gradient(145deg, <?= $paleta[0] ?> 0%, <?= $paleta[1] ?> 100%);">
                        <div class="card-emoji"><?= $emoji ?></div>
                    </div>
                    <div class="card-overlay"></div>
                    <?php if ($dias > 0): ?>
                        <div class="card-dias"><?= $dias ?> dias</div>
                    <?php endif; ?>
                    <div class="card-info">
                        <div class="card-categoria"><?= $cat ?></div>
                        <div class="card-nome"><?= htmlspecialchars($pacote->getNome()) ?></div>
                        <div class="card-destino-nome">
                            <?= $nomeD ?><?= $pais ? ' — ' . $pais : '' ?>
                        </div>
                        <div class="card-bottom">
                            <?php if ($pacote->getPreco() !== null): ?>
                                <div class="card-price-block">
                                    <div class="card-price-label">A partir de</div>
                                    <div class="card-price">
                                        R$ <?= number_format((float) $pacote->getPreco(), 2, ',', '.') ?>
                                        <small>/ pessoa</small>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>
                            <a href="<?= BASE_URL ?>/reservas/novo?pacote_id=<?= $pacote->getId() ?>" class="card-btn">
                                Reservar →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php elseif (empty($termoBusca)): ?>
        <div class="msg-vazio">
            <p>Nenhum pacote cadastrado ainda.</p>
        </div>
    <?php endif; ?>
</section>

<?php if (count($destinos) > 0): ?>
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Destinos <em>Disponíveis</em></h2>
        <span class="section-meta"><?= count($destinos) ?> destino(s)</span>
    </div>
    <div class="destinos-scroll">
        <?php foreach ($destinos as $i => $dest):
            $paleta = $paletas[$i % count($paletas)];
            $emoji  = $emojis[$i % count($emojis)];
        ?>
            <div class="card-destino-item">
                <div class="dest-bg" style="background: linear-gradient(145deg, <?= $paleta[0] ?> 0%, <?= $paleta[1] ?> 100%);"></div>
                <div class="dest-cover"></div>
                <div class="dest-emoji"><?= $emoji ?></div>
                <div class="dest-info">
                    <span class="dest-nome"><?= htmlspecialchars($dest->getNome()) ?></span>
                    <span class="dest-sub">
                        <?= htmlspecialchars($dest->getPais() ?? '') ?>
                        <?= $dest->getDuracaoDeDias() ? ' · ' . $dest->getDuracaoDeDias() . ' dias' : '' ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<footer class="footer">
    <div class="footer-brand">
        ✦ Viaggio
        <small>Douglas &amp; Antonio Everton</small>
    </div>
    <div class="footer-gold"></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

</body>
</html>
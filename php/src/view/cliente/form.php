<?php
/** @var \model\Cliente $cliente */
$tituloPagina = ($cliente->getId() ? 'Editar' : 'Novo') . ' Cliente — Viaggio';
require __DIR__ . '/../_layout.php';
?>

<nav aria-label="breadcrumb" style="margin-bottom:20px;">
    <ol class="breadcrumb" style="background:transparent;padding:0;margin:0;font-family:'Crimson Pro',serif;font-size:14px;">
        <li class="breadcrumb-item">
            <a href="<?= BASE_URL ?>/portal" style="color:var(--smoke);text-decoration:none;">Portal</a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?= BASE_URL ?>/clientes" style="color:var(--smoke);text-decoration:none;">Clientes</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" style="color:var(--gold);">
            <?= $cliente->getId() ? 'Editar Cliente' : 'Novo Cliente' ?>
        </li>
    </ol>
</nav>

<h1><?= $cliente->getId() ? 'Editar Cliente' : 'Novo Cliente' ?></h1>

<div class="card-form">
    <form id="formCliente" action="<?= BASE_URL ?>/clientes/cadastrar" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= e((string) ($cliente->getId() ?? '')) ?>">

        <div class="form-grupo">
            <label for="nome">Nome Completo *</label>
            <input type="text" id="nome" name="nome" required placeholder="Nome do viajante"
                   value="<?= e($cliente->getNome()) ?>">
        </div>

        <div class="form-grupo">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" required placeholder="email@exemplo.com"
                   value="<?= e($cliente->getEmail()) ?>">
        </div>

        <div class="form-grupo">
            <label for="cpf">CPF <span style="font-size:10px;color:var(--smoke-lt);text-transform:none;letter-spacing:0;">(opcional)</span></label>
            <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00"
                   value="<?= e($cliente->getCpf()) ?>">
        </div>

        <div class="form-grupo">
            <label for="senha">
                Senha
                <?php if ($cliente->getId()): ?>
                    <span style="font-size:10px;color:var(--smoke-lt);text-transform:none;letter-spacing:0;">(deixe em branco para não alterar)</span>
                <?php endif; ?>
            </label>
            <input type="password" id="senha" name="senha"
                   placeholder="Mínimo 6 caracteres" minlength="6"
                   <?= $cliente->getId() ? '' : 'required' ?>>
            <div style="margin-top:8px;display:flex;align-items:center;gap:8px;">
                <input type="checkbox" id="mostrarSenha" style="cursor:pointer;accent-color:var(--gold);width:15px;height:15px;">
                <label for="mostrarSenha" style="font-size:13px;font-family:'Crimson Pro',serif;color:var(--smoke);letter-spacing:0;text-transform:none;cursor:pointer;margin:0;">
                    Mostrar senha
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" id="btnSalvar" class="btn-salvar"><span>Salvar →</span></button>
            <a href="<?= BASE_URL ?>/clientes" class="btn-voltar">← Voltar</a>
        </div>
    </form>
</div>

</div>

<footer>
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

<script>
// máscara de CPF
document.getElementById('cpf').addEventListener('input', function() {
    var v = this.value.replace(/\D/g, '');
    if (v.length > 9) {
        v = v.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
    } else if (v.length > 6) {
        v = v.replace(/^(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
    } else if (v.length > 3) {
        v = v.replace(/^(\d{3})(\d{0,3})/, '$1.$2');
    }
    this.value = v;
});

// mostrar / ocultar senha
document.getElementById('mostrarSenha').addEventListener('change', function() {
    var campo = document.getElementById('senha');
    campo.type = this.checked ? 'text' : 'password';
});

// proteção de duplo clique
document.getElementById('formCliente').addEventListener('submit', function() {
    var btn = document.getElementById('btnSalvar');
    btn.disabled = true;
    btn.querySelector('span').textContent = 'Salvando...';
});
</script>

</body></html>
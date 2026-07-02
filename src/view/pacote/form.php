<?php
/**
 * @var \model\PacoteDeTurismo $pacote
 * @var \model\Destino[]        $destinos
 */
$tituloPagina = ($pacote->getId() ? 'Editar' : 'Novo') . ' Pacote — Viaggio';
require __DIR__ . '/../_layout.php';
?>

<h1><?= $pacote->getId() ? 'Editar Pacote' : 'Novo Pacote de Turismo' ?></h1>

<div class="card-form">
    <form action="<?= BASE_URL ?>/pacotes/cadastrar" method="POST">
        <input type="hidden" name="id" value="<?= e((string) ($pacote->getId() ?? '')) ?>">

        <div class="form-grupo">
            <label for="nome">Nome do Pacote *</label>
            <input type="text" id="nome" name="nome" required placeholder="ex: Europa Clássica 10 dias"
                   value="<?= e($pacote->getNome()) ?>">
        </div>

        <div class="form-grupo">
            <label for="preco">Preço (R$)</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" placeholder="0.00"
                   value="<?= e((string) ($pacote->getPreco() ?? '')) ?>">
        </div>

        <div class="form-grupo">
            <label for="destino_id">Destino *</label>
            <select id="destino_id" name="destino_id" required>
                <option value="">— Selecione um destino —</option>
                <?php foreach ($destinos as $destino): ?>
                    <?php $sel = ($pacote->getDestino()?->getId() == $destino->getId()) ? 'selected' : ''; ?>
                    <option value="<?= e((string) $destino->getId()) ?>" <?= $sel ?>>
                        <?= e($destino->getNome() . ($destino->getPais() ? ' — ' . $destino->getPais() : '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-salvar"><span>Salvar →</span></button>
            <a href="<?= BASE_URL ?>/pacotes" class="btn-voltar">← Voltar</a>
        </div>
    </form>
</div>

</div>

<footer>
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

</body></html>
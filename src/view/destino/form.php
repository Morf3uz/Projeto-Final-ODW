<?php
/** @var \model\Destino $destino */
$tituloPagina = ($destino->getId() ? 'Editar' : 'Novo') . ' Destino — Viaggio';
require __DIR__ . '/../_layout.php';
?>

<h1><?= $destino->getId() ? 'Editar Destino' : 'Novo Destino' ?></h1>

<div class="card-form">
    <form action="<?= BASE_URL ?>/destinos/cadastrar" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= e((string) ($destino->getId() ?? '')) ?>">

        <div class="form-grupo">
            <label for="nome">Nome do Destino *</label>
            <input type="text" id="nome" name="nome" required placeholder="ex: Paris"
                   value="<?= e($destino->getNome()) ?>">
        </div>

        <div class="form-grupo">
            <label for="pais">País</label>
            <input type="text" id="pais" name="pais" placeholder="ex: França"
                   value="<?= e($destino->getPais()) ?>">
        </div>

        <div class="form-grupo">
            <label for="categoria">Categoria</label>
            <input type="text" id="categoria" name="categoria" placeholder="ex: Cultural, Praia, Neve…"
                   value="<?= e($destino->getCategoria()) ?>">
        </div>

        <div class="form-grupo">
            <label for="duracao_de_dias">Duração (dias)</label>
            <input type="number" id="duracao_de_dias" name="duracao_de_dias" min="1"
                   value="<?= e((string) ($destino->getDuracaoDeDias() ?? '')) ?>">
        </div>

        <div class="form-grupo">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao"><?= e($destino->getDescricao()) ?></textarea>
        </div>

        <div class="form-grupo">
            <label for="imagem">Imagem do Destino</label>
            <?php if ($destino->getImagemUrl()): ?>
                <img src="<?= e($destino->getImagemUrl()) ?>"
                     alt="Imagem atual" class="preview-img">
            <?php endif; ?>
            <input type="file" id="imagem" name="imagem" accept="image/*">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-salvar"><span>Salvar →</span></button>
            <a href="<?= BASE_URL ?>/destinos" class="btn-voltar">← Voltar</a>
        </div>
    </form>
</div>

</div>

<footer>
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

</body></html>
<?php
/** @var \model\Destino[] $destinos */
$tituloPagina = 'Destinos — Viaggio';
$rota = BASE_URL . "/destinos";
require __DIR__ . '/../_layout.php';
?>

<h1>Destinos</h1>

<?php if (isset($erro)): ?>
    <div class="msg-erro"><?= e($erro) ?></div>
<?php endif; ?>

<a class="btn-novo" href="<?= $rota ?>/novo">+ Novo Destino</a>

<div class="row g-3 mb-4">
    <?php if (empty($destinos)): ?>
        <div class="col-12">
            <p style="color:var(--smoke-lt);font-style:italic;">Nenhum destino cadastrado ainda.</p>
        </div>
    <?php else: ?>
        <?php foreach ($destinos as $destino): ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100" style="border:1px solid var(--parch-dark);border-radius:4px;background:#fff;">
                <?php if ($destino->getImagemUrl()): ?>
                    <img src="<?= e($destino->getImagemUrl()) ?>"
                         class="card-img-top"
                         alt="<?= e($destino->getNome()) ?>"
                         style="height:160px;object-fit:cover;">
                <?php else: ?>
                    <div style="height:80px;background:var(--parchment);display:flex;align-items:center;justify-content:center;">
                        <span style="color:var(--smoke-lt);font-style:italic;font-size:13px;">Sem imagem</span>
                    </div>
                <?php endif; ?>
                <div class="card-body" style="padding:16px 18px;">
                    <h5 class="card-title" style="font-family:'Playfair Display',serif;font-size:17px;margin-bottom:4px;">
                        <?= e($destino->getNome()) ?>
                    </h5>
                    <p class="card-text" style="font-size:13px;color:var(--smoke);margin-bottom:2px;">
                        <?= e($destino->getPais()) ?>
                        <?php if ($destino->getCategoria()): ?>
                            · <?= e($destino->getCategoria()) ?>
                        <?php endif; ?>
                    </p>
                    <?php if ($destino->getDuracaoDeDias()): ?>
                        <p class="card-text" style="font-size:12px;color:var(--smoke-lt);">
                            <?= e((string) $destino->getDuracaoDeDias()) ?> dias
                        </p>
                    <?php endif; ?>
                </div>
                <div class="card-footer" style="background:transparent;border-top:1px solid var(--parchment);padding:10px 18px;display:flex;gap:8px;">
                    <a class="btn btn-editar"
                       href="<?= $rota ?>/<?= e((string) $destino->getId()) ?>/editar">Editar</a>
                    <button class="btn btn-excluir"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#modalExcluir"
                            data-id="<?= e((string) $destino->getId()) ?>"
                            data-nome="<?= e($destino->getNome()) ?>">
                        Remover
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="modalExcluirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border:1px solid var(--parch-dark);border-radius:4px;">
            <div class="modal-header" style="border-bottom:1px solid var(--parchment);">
                <h5 class="modal-title" id="modalExcluirLabel"
                    style="font-family:'Playfair Display',serif;font-size:18px;">
                    Confirmar exclusão
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" style="font-size:16px;padding:20px 24px;">
                Tem certeza que deseja remover o destino <strong id="nomeDestino"></strong>?
                Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--parchment);">
                <button type="button" class="btn btn-editar" data-bs-dismiss="modal">Cancelar</button>
                <form id="formExcluir" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-excluir">Confirmar exclusão</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<footer>
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
var modalExcluir = document.getElementById('modalExcluir');
modalExcluir.addEventListener('show.bs.modal', function(event) {
    var botao     = event.relatedTarget;
    var id        = botao.getAttribute('data-id');
    var nome      = botao.getAttribute('data-nome');
    var form      = document.getElementById('formExcluir');
    var nomeSpan  = document.getElementById('nomeDestino');

    nomeSpan.textContent = nome;
    form.action = '<?= BASE_URL ?>/destinos/' + id + '/remover';
});
</script>

</body></html>
<?php
/** @var \model\Cronograma[] $cronogramas */
$tituloPagina = 'Cronogramas — Viaggio';
$rota = BASE_URL . "/cronogramas";
require __DIR__ . '/../_layout.php';
?>

<h1>Cronogramas</h1>

<?php if (isset($erro)): ?>
    <div class="msg-erro"><?= e($erro) ?></div>
<?php endif; ?>

<a class="btn-novo" href="<?= $rota ?>/novo">+ Novo Cronograma</a>

<div class="table-wrap">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Atividade</th>
            <th>Horário</th>
            <th>Pacote Vinculado</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($cronogramas)): ?>
            <tr><td colspan="5" class="msg-vazio">Nenhum cronograma cadastrado ainda.</td></tr>
        <?php else: ?>
            <?php foreach ($cronogramas as $cronograma): ?>
                <tr>
                    <td class="td-id"><?= e((string) $cronograma->getId()) ?></td>
                    <td><?= e($cronograma->getDescricao()) ?></td>
                    <td>
                        <?php
                        $horario = $cronograma->getHorario();
                        if ($horario instanceof \DateTime): ?>
                            <span style="font-family:'Courier New',monospace;font-size:13px;"><?= e($horario->format('H:i')) ?></span>
                        <?php elseif (is_string($horario) && $horario !== ''): ?>
                            <span style="font-family:'Courier New',monospace;font-size:13px;"><?= e($horario) ?></span>
                        <?php else: ?>
                            <span style="color:var(--smoke-lt);font-style:italic;font-size:13px;">—</span>
                        <?php endif; ?>
                    </td>
                    <td><?= e($cronograma->getPacote()?->getNome()) ?></td>
                    <td>
                        <a class="btn btn-editar"
                           href="<?= $rota ?>/<?= e((string) $cronograma->getId()) ?>/editar">Editar</a>
                        <button class="btn btn-excluir"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalExcluir"
                                data-id="<?= e((string) $cronograma->getId()) ?>"
                                data-descricao="<?= e($cronograma->getDescricao()) ?>">
                            Remover
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
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
                Tem certeza que deseja remover a atividade <strong id="descricaoCronograma"></strong>?
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
    var botao       = event.relatedTarget;
    var id          = botao.getAttribute('data-id');
    var descricao   = botao.getAttribute('data-descricao');
    var form        = document.getElementById('formExcluir');
    var descSpan    = document.getElementById('descricaoCronograma');

    descSpan.textContent = descricao;
    form.action = '<?= $rota ?>/' + id + '/remover';
});
</script>

</body></html>
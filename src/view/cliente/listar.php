<?php
/** @var \model\Cliente[] $clientes */
$tituloPagina = 'Clientes — Viaggio';
$rota = BASE_URL . "/clientes";
require __DIR__ . '/../_layout.php';
?>

<h1>Clientes</h1>

<?php if (isset($_SESSION['erro'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <?= $_SESSION['erro'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['erro']); ?>
<?php endif; ?>

<a class="btn-novo" href="<?= $rota ?>/novo">+ Novo Cliente</a>

<div class="table-wrap">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>CPF</th>
            <th>Senha</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($clientes)): ?>
            <tr><td colspan="6" class="msg-vazio">Nenhum cliente cadastrado ainda.</td></tr>
        <?php else: ?>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td class="td-id"><?= e((string) $cliente->getId()) ?></td>
                    <td><?= e($cliente->getNome()) ?></td>
                    <td><?= e($cliente->getEmail()) ?></td>
                    <td>
                        <?php if ($cliente->getCpf()): ?>
                            <span style="font-family:'Courier New',monospace;font-size:13px;"><?= e($cliente->getCpf()) ?></span>
                        <?php else: ?>
                            <span style="color:var(--smoke-lt);font-style:italic;font-size:13px;">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($cliente->getSenha()): ?>
                            <span style="font-family:'Courier New',monospace;font-size:11px;color:var(--smoke-lt);">••••••••</span>
                        <?php else: ?>
                            <span style="color:#c0392b;font-style:italic;font-size:13px;">Sem senha</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-editar"
                           href="<?= $rota ?>/<?= e((string) $cliente->getId()) ?>/editar">Editar</a>
                        <button class="btn btn-excluir"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalExcluir"
                                data-id="<?= e((string) $cliente->getId()) ?>"
                                data-nome="<?= e($cliente->getNome()) ?>">
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
                Tem certeza que deseja remover o cliente <strong id="nomeCliente"></strong>?
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
    var botao    = event.relatedTarget;
    var id       = botao.getAttribute('data-id');
    var nome     = botao.getAttribute('data-nome');
    var form     = document.getElementById('formExcluir');
    var nomeSpan = document.getElementById('nomeCliente');

    nomeSpan.textContent = nome;
    form.action = '<?= $rota ?>/' + id + '/remover';
});
</script>

</body></html>
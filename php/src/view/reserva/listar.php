<?php
/** @var \model\Reserva[] $reservas */
$tituloPagina = 'Reservas — Viaggio';
$rota = BASE_URL . "/reservas";
require __DIR__ . '/../_layout.php';
?>

<h1>Reservas</h1>

<?php if (isset($erro)): ?>
    <div class="msg-erro"><?= e($erro) ?></div>
<?php endif; ?>

<a class="btn-novo" href="<?= $rota ?>/novo">+ Nova Reserva</a>

<div class="table-wrap">
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Data da Reserva</th>
            <th>Cliente</th>
            <th>Pacote de Turismo</th>
            <th>Preço</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($reservas)): ?>
            <tr><td colspan="6" class="msg-vazio">Nenhuma reserva cadastrada ainda.</td></tr>
        <?php else: ?>
            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td class="td-id"><?= e((string) $reserva->getId()) ?></td>
                    <td>
                        <?php
                        $data = $reserva->getDataReserva();
                        if ($data instanceof \DateTime) {
                            echo e($data->format('d/m/Y'));
                        } elseif (is_string($data) && $data !== '') {
                            echo e($data);
                        } else {
                            echo '<span style="color:var(--smoke-lt);font-style:italic;font-size:13px;">—</span>';
                        }
                        ?>
                    </td>
                    <td><?= e($reserva->getCliente()?->getNome()) ?></td>
                    <td><?= e($reserva->getPacote()?->getNome()) ?></td>
                    <td>
                        <?php if ($reserva->getPacote()?->getPreco() !== null): ?>
                            <span style="font-family:'Playfair Display',serif;font-weight:700;">
                                <?= moeda($reserva->getPacote()->getPreco()) ?>
                            </span>
                        <?php else: ?>
                            <span style="color:var(--smoke-lt);font-style:italic;font-size:13px;">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-editar"
                           href="<?= $rota ?>/<?= e((string) $reserva->getId()) ?>/editar">Editar</a>
                        <button class="btn btn-excluir"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalExcluir"
                                data-id="<?= e((string) $reserva->getId()) ?>"
                                data-cliente="<?= e($reserva->getCliente()?->getNome() ?? '—') ?>"
                                data-pacote="<?= e($reserva->getPacote()?->getNome() ?? '—') ?>">
                            Cancelar
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
                    Confirmar cancelamento
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" style="font-size:16px;padding:20px 24px;line-height:1.7;">
                Tem certeza que deseja cancelar a reserva de
                <strong id="nomeClienteReserva"></strong>
                para o pacote
                <strong id="nomePacoteReserva"></strong>?
                Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--parchment);">
                <button type="button" class="btn btn-editar" data-bs-dismiss="modal">Voltar</button>
                <form id="formExcluir" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-excluir">Confirmar cancelamento</button>
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
    var cliente  = botao.getAttribute('data-cliente');
    var pacote   = botao.getAttribute('data-pacote');
    var form     = document.getElementById('formExcluir');

    document.getElementById('nomeClienteReserva').textContent = cliente;
    document.getElementById('nomePacoteReserva').textContent  = pacote;
    form.action = '<?= $rota ?>/' + id + '/remover';
});
</script>

</body></html>
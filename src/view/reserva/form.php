<?php
/**
 * @var \model\Reserva            $reserva
 * @var \model\Cliente[]          $clientes
 * @var \model\PacoteDeTurismo[]  $pacotes
 */
$tituloPagina = ($reserva->getId() ? 'Editar' : 'Nova') . ' Reserva — Viaggio';
require __DIR__ . '/../_layout.php';
?>

<h1><?= $reserva->getId() ? 'Editar Reserva' : 'Nova Reserva' ?></h1>

<div class="card-form">
    <form id="formReserva" action="<?= BASE_URL ?>/reservas/cadastrar" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= e((string) ($reserva->getId() ?? '')) ?>">

        <div class="form-grupo">
            <label for="data_reserva">Data da Reserva *</label>
            <?php
            $dataVal = '';
            $d = $reserva->getDataReserva();
            if ($d instanceof \DateTime) {
                $dataVal = $d->format('Y-m-d');
            }
            ?>
            <input type="date" id="data_reserva" name="data_reserva"
                   value="<?= e($dataVal) ?>">
            <span id="erro-data" style="display:none;color:#8b2020;font-size:13px;margin-top:4px;"></span>
        </div>

        <div class="form-grupo">
            <label for="cliente_id">Cliente *</label>
            <?php if (isset($_SESSION['cliente_is_admin']) && $_SESSION['cliente_is_admin'] === true): ?>
                <select id="cliente_id" name="cliente_id" required>
                    <option value="">— Selecione um cliente —</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <?php $sel = ($reserva->getCliente()?->getId() == $cliente->getId()) ? 'selected' : ''; ?>
                        <option value="<?= e((string) $cliente->getId()) ?>" <?= $sel ?>>
                            <?= e($cliente->getNome() . ($cliente->getCpf() ? ' — CPF: ' . $cliente->getCpf() : '')) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <input type="text" value="<?= e($_SESSION['cliente_nome'] ?? 'Meu Usuário') ?>" style="color: #7a7060; font-style: italic;" disabled>
                <input type="hidden" name="cliente_id" value="<?= e((string) ($_SESSION['cliente_id'] ?? '')) ?>">
            <?php endif; ?>
        </div>

        <div class="form-grupo">
            <label for="pacote_id">Pacote de Turismo *</label>
            <select id="pacote_id" name="pacote_id" required>
                <option value="">— Selecione um pacote —</option>
                <?php foreach ($pacotes as $pacote): ?>
                    <?php $sel = ($reserva->getPacote()?->getId() == $pacote->getId()) ? 'selected' : ''; ?>
                    <option value="<?= e((string) $pacote->getId()) ?>" <?= $sel ?>>
                        <?= e($pacote->getNome()) ?>
                        <?= $pacote->getPreco() ? ' — ' . moeda($pacote->getPreco()) : '' ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-salvar"><span>Salvar →</span></button>
            <a href="<?= BASE_URL ?>/reservas" class="btn-voltar">← Voltar</a>
        </div>
    </form>
</div>

</div>

<footer>
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

<script>
document.getElementById('formReserva').addEventListener('submit', function(event) {
    var valido    = true;
    var campo     = document.getElementById('data_reserva');
    var erroData  = document.getElementById('erro-data');
    var valor     = campo.value;

    if (valor === '') {
        erroData.textContent = 'Informe a data da reserva.';
        erroData.style.display = 'block';
        campo.style.borderColor = '#c0392b';
        valido = false;
    } else {
        var dataSelecionada = new Date(valor + 'T00:00:00');
        var hoje            = new Date();
        hoje.setHours(0, 0, 0, 0);

        if (dataSelecionada < hoje) {
            erroData.textContent = 'A data da reserva não pode ser anterior à data de hoje.';
            erroData.style.display = 'block';
            campo.style.borderColor = '#c0392b';
            valido = false;
        } else {
            erroData.style.display = 'none';
            campo.style.borderColor = '';
        }
    }

    if (!valido) {
        event.preventDefault();
    } else {
        var btnSalvar = document.querySelector('.btn-salvar');
        if (btnSalvar) {
            btnSalvar.disabled = true;
            btnSalvar.style.opacity = '0.7';
            btnSalvar.style.cursor = 'not-allowed';
            var span = btnSalvar.querySelector('span');
            if (span) {
                span.innerHTML = 'Salvando...';
            }
        }
    }
});
</script>

</body></html>
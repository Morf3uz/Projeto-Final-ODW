<?php
/**
 * @var \model\Cronograma         $cronograma
 * @var \model\PacoteDeTurismo[]  $pacotes
 */
$tituloPagina = ($cronograma->getId() ? 'Editar' : 'Novo') . ' Cronograma — Viaggio';
require __DIR__ . '/../_layout.php';
?>

<h1><?= $cronograma->getId() ? 'Editar Cronograma' : 'Novo Cronograma' ?></h1>

<div class="card-form">
    <form id="formCronograma" action="<?= BASE_URL ?>/cronogramas/cadastrar" method="POST" novalidate>
        <input type="hidden" name="id" value="<?= e((string) ($cronograma->getId() ?? '')) ?>">

        <div class="form-grupo" id="grupo-descricao">
            <label for="descricao">Descrição da Atividade *</label>
            <textarea id="descricao" name="descricao"
                      placeholder="Descreva a atividade do roteiro…"><?= e($cronograma->getDescricao()) ?></textarea>
            <span id="erro-descricao" style="display:none;color:#8b2020;font-size:13px;margin-top:4px;"></span>
        </div>

        <div class="form-grupo" id="grupo-horario">
            <label for="horario">Horário</label>
            <?php
            $horarioVal = '';
            $h = $cronograma->getHorario();
            if ($h instanceof \DateTime) {
                $horarioVal = $h->format('H:i');
            } elseif (is_string($h)) {
                $horarioVal = $h;
            }
            ?>
            <input type="time" id="horario" name="horario" value="<?= e($horarioVal) ?>">
            <span id="erro-horario" style="display:none;color:#8b2020;font-size:13px;margin-top:4px;"></span>
        </div>

        <div class="form-grupo">
            <label for="pacote_id">Pacote de Turismo *</label>
            <select id="pacote_id" name="pacote_id" required>
                <option value="">— Selecione um pacote —</option>
                <?php foreach ($pacotes as $pacote): ?>
                    <?php $sel = ($cronograma->getPacote()?->getId() == $pacote->getId()) ? 'selected' : ''; ?>
                    <option value="<?= e((string) $pacote->getId()) ?>" <?= $sel ?>>
                        <?= e($pacote->getNome()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-salvar"><span>Salvar →</span></button>
            <a href="<?= BASE_URL ?>/cronogramas" class="btn-voltar">← Voltar</a>
        </div>
    </form>
</div>

</div>

<footer>
    <div class="footer-brand">✦ Viaggio <small>Douglas &amp; Antonio Everton</small></div>
    <p class="footer-copy">© <?= date('Y') ?> — Agência de Turismo</p>
</footer>

<script>
document.getElementById('formCronograma').addEventListener('submit', function(event) {
    var valido = true;

    var descricao     = document.getElementById('descricao');
    var erroDescricao = document.getElementById('erro-descricao');

    if (descricao.value.trim() === '') {
        erroDescricao.textContent = 'A descrição da atividade é obrigatória.';
        erroDescricao.style.display = 'block';
        descricao.style.borderColor = '#c0392b';
        valido = false;
    } else {
        erroDescricao.style.display = 'none';
        descricao.style.borderColor = '';
    }

    var horario     = document.getElementById('horario');
    var erroHorario = document.getElementById('erro-horario');
    var regexHora   = /^([01]\d|2[0-3]):([0-5]\d)$/;

    if (horario.value !== '' && !regexHora.test(horario.value)) {
        erroHorario.textContent = 'Informe o horário no formato HH:MM (ex: 09:00).';
        erroHorario.style.display = 'block';
        horario.style.borderColor = '#c0392b';
        valido = false;
    } else {
        erroHorario.style.display = 'none';
        horario.style.borderColor = '';
    }

    if (!valido) {
        event.preventDefault();
    }
});
</script>

</body></html>
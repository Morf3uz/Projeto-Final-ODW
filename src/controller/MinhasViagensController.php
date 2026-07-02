<?php

namespace controller;

use Exception;
use model\Reserva;
use utils\Autorizacao;
use utils\Conexao;

class MinhasViagensController
{
    public function index(array $params = []): void
    {
        Autorizacao::exigirSessao();

        $reservas = [];

        try {
            $em       = Conexao::getEntityManager();
            $reservas = $em->createQuery(
                'SELECT r FROM model\Reserva r JOIN r.cliente c WHERE c.id = :id'
            )->setParameter('id', $_SESSION['cliente_id'])->getResult();
        } catch (Exception $ex) {
            $reservas = [];
        } finally {
            require __DIR__ . '/../view/minhas_viagens/index.php';
        }
    }
}
<?php

namespace controller;

use Exception;
use model\Destino;
use model\PacoteDeTurismo;
use utils\Conexao;

class HomeController
{
    public function index(array $params = []): void
    {
        $clienteLogado = isset($_SESSION['cliente_id']);

        $pacotes    = [];
        $destinos   = [];
        $termoBusca = trim(filter_input(INPUT_GET, 'destino', FILTER_SANITIZE_SPECIAL_CHARS) ?? '');

        try {
            $em = Conexao::getEntityManager();

            if (!empty($termoBusca)) {
                $pacotes = $em->createQuery(
                    'SELECT p FROM model\PacoteDeTurismo p JOIN p.destino d
                     WHERE d.nome LIKE :termo OR d.pais LIKE :termo
                     ORDER BY p.preco ASC'
                )->setParameter('termo', '%' . $termoBusca . '%')->getResult();
            } else {
                $pacotes = $em->getRepository(PacoteDeTurismo::class)->findAll();
            }

            $destinos = $em->getRepository(Destino::class)->findAll();
        } catch (Exception $ex) {
            $pacotes  = [];
            $destinos = [];
        } finally {
            require __DIR__ . '/../view/home/index.php';
        }
    }
}
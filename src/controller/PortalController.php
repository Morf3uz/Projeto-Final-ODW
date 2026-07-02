<?php

namespace controller;

use Exception;
use model\Cliente;
use model\Cronograma;
use model\Destino;
use model\PacoteDeTurismo;
use model\Reserva;
use utils\Autorizacao;
use utils\Conexao;

class PortalController
{
    public function listar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        if (!isset($_COOKIE['agente_turismo'])) {
            setcookie('agente_turismo', 'Douglas & Antonio Everton', time() + 3600, '/');
            $_COOKIE['agente_turismo'] = 'Douglas & Antonio Everton';
        }

        $nomeAgente = $_COOKIE['agente_turismo'];

        $_SESSION['ultimo_acesso'] = date('d/m/Y \às H:i:s');
        $ultimoAcesso              = $_SESSION['ultimo_acesso'];

        $em = Conexao::getEntityManager();

        try { $totalDestinos    = count($em->getRepository(Destino::class)->findAll());         } catch (Exception $e) { $totalDestinos    = 0; }
        try { $totalPacotes     = count($em->getRepository(PacoteDeTurismo::class)->findAll()); } catch (Exception $e) { $totalPacotes     = 0; }
        try { $totalClientes    = count($em->getRepository(Cliente::class)->findAll());         } catch (Exception $e) { $totalClientes    = 0; }
        try { $totalReservas    = count($em->getRepository(Reserva::class)->findAll());         } catch (Exception $e) { $totalReservas    = 0; }
        try { $totalCronogramas = count($em->getRepository(Cronograma::class)->findAll());      } catch (Exception $e) { $totalCronogramas = 0; }

        require __DIR__ . '/../view/portal_agencia.php';
    }
}
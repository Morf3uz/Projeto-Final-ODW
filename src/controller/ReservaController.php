<?php

namespace controller;

use DateTime;
use Exception;
use model\Cliente;
use model\PacoteDeTurismo;
use model\Reserva;
use utils\Autorizacao;
use utils\Conexao;

class ReservaController
{
    public function listar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $em       = Conexao::getEntityManager();
            $reservas = $em->getRepository(Reserva::class)->findAll();
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao buscar a lista de reservas.";
        } finally {
            require __DIR__ . '/../view/reserva/listar.php';
        }
    }

    public function novo(array $params = []): void
    {
        if (!isset($_SESSION['cliente_id'])) {
            $pacoteId    = filter_input(INPUT_GET, 'pacote_id', FILTER_SANITIZE_NUMBER_INT);
            $redirectUrl = '/reservas/novo' . ($pacoteId ? '?pacote_id=' . $pacoteId : '');
            $_SESSION['auth_redirect'] = $redirectUrl;
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $pacoteIdGet = filter_input(INPUT_GET, 'pacote_id', FILTER_SANITIZE_NUMBER_INT);

        $reserva  = new Reserva();
        $em       = Conexao::getEntityManager();
        $clientes = $em->getRepository(Cliente::class)->findAll();
        $pacotes  = $em->getRepository(PacoteDeTurismo::class)->findAll();

        if ($pacoteIdGet) {
            $pacoteSelecionado = $em->find(PacoteDeTurismo::class, (int) $pacoteIdGet);
            if ($pacoteSelecionado) {
                $reserva->setPacote($pacoteSelecionado);
            }
        }

        if (isset($_SESSION['cliente_is_admin']) && $_SESSION['cliente_is_admin'] === true) {
            require __DIR__ . '/../view/reserva/form.php';
        } else {
            $clienteLogado = $em->find(Cliente::class, (int) $_SESSION['cliente_id']);
            if ($clienteLogado) {
                $reserva->setCliente($clienteLogado);
            }
            require __DIR__ . '/../view/reserva/form.php';
        }
    }

    public function cadastrar(array $params = []): void
    {
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        try {
            $id          = filter_input(INPUT_POST, 'id',           FILTER_SANITIZE_NUMBER_INT);
            $dataReserva = filter_input(INPUT_POST, 'data_reserva', FILTER_SANITIZE_SPECIAL_CHARS);
            $pacoteId    = filter_input(INPUT_POST, 'pacote_id',    FILTER_SANITIZE_NUMBER_INT);

            $em      = Conexao::getEntityManager();
            $reserva = $id ? $em->find(Reserva::class, (int) $id) : new Reserva();

            if (empty($reserva)) {
                throw new Exception('Reserva não encontrada.');
            }

            // TRAVA DE SEGURANÇA: Define de quem é a reserva
            if (isset($_SESSION['cliente_is_admin']) && $_SESSION['cliente_is_admin'] === true) {
                // Se for Admin, confia no ID que veio do formulário
                $clienteId = filter_input(INPUT_POST, 'cliente_id', FILTER_SANITIZE_NUMBER_INT);
            } else {
                // Se for usuário comum, IGNORA o formulário e força o ID da sessão
                $clienteId = $_SESSION['cliente_id'];
            }

            $cliente = $clienteId ? $em->find(Cliente::class, (int) $clienteId) : null;
            $pacote  = $pacoteId ? $em->find(PacoteDeTurismo::class, (int) $pacoteId) : null;

            if (empty($cliente) || empty($pacote)) {
                throw new Exception('Cliente ou pacote inválido.');
            }

            $reserva->setDataReserva($dataReserva ? new DateTime($dataReserva) : null);
            $reserva->setCliente($cliente);
            $reserva->setPacote($pacote);

            $em->persist($reserva);
            $em->flush();

            $destino = (isset($_SESSION['cliente_is_admin']) && $_SESSION['cliente_is_admin'] === true) ? '/reservas' : '/minhas_viagens';
            header('Location: ' . BASE_URL . $destino);
        } catch (Exception $ex) {
            $_SESSION['erro'] = $ex->getMessage();
            header('Location: ' . BASE_URL . '/reservas/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id       = (int) $params['id'];
            $em       = Conexao::getEntityManager();
            $reserva  = $em->find(Reserva::class, $id);
            $clientes = $em->getRepository(Cliente::class)->findAll();
            $pacotes  = $em->getRepository(PacoteDeTurismo::class)->findAll();

            if (empty($reserva)) {
                throw new Exception('Reserva não encontrada.');
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao carregar a reserva.";
        } finally {
            require __DIR__ . '/../view/reserva/form.php';
        }
    }

    public function buscar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $reserva = $em->find(Reserva::class, $id);

            if (empty($reserva)) {
                throw new Exception('Reserva não encontrada.');
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao buscar a reserva.";
        } finally {
            require __DIR__ . '/../view/reserva/listar.php';
        }
    }

    public function remover(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $reserva = $em->find(Reserva::class, $id);

            if (empty($reserva)) {
                throw new Exception('Reserva não encontrada.');
            }

            $em->remove($reserva);
            $em->flush();
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao remover a reserva.";
        } finally {
            header('Location: ' . BASE_URL . '/reservas');
            exit;
        }
    }
}
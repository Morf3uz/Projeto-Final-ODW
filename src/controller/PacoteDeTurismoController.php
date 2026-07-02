<?php

namespace controller;

use Exception;
use model\Destino;
use model\PacoteDeTurismo;
use utils\Autorizacao;
use utils\Conexao;

class PacoteDeTurismoController
{
    public function listar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $em      = Conexao::getEntityManager();
            $pacotes = $em->getRepository(PacoteDeTurismo::class)->findAll();
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/pacote/listar.php';
        }
    }

    public function novo(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        $pacote   = new PacoteDeTurismo();
        $em       = Conexao::getEntityManager();
        $destinos = $em->getRepository(Destino::class)->findAll();
        require __DIR__ . '/../view/pacote/form.php';
    }

    public function cadastrar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id        = filter_input(INPUT_POST, 'id',         FILTER_SANITIZE_NUMBER_INT);
            $nome      = filter_input(INPUT_POST, 'nome',       FILTER_SANITIZE_SPECIAL_CHARS);
            $preco     = filter_input(INPUT_POST, 'preco',      FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $destinoId = filter_input(INPUT_POST, 'destino_id', FILTER_SANITIZE_NUMBER_INT);

            $em     = Conexao::getEntityManager();
            $pacote = $id ? $em->find(PacoteDeTurismo::class, (int) $id) : new PacoteDeTurismo();

            if (empty($pacote)) {
                throw new Exception('Pacote não encontrado.');
            }

            $destino = $destinoId ? $em->find(Destino::class, (int) $destinoId) : null;

            $pacote->setNome($nome);
            $pacote->setPreco($preco ? (float) $preco : null);
            $pacote->setDestino($destino);

            $em->persist($pacote);
            $em->flush();

            header('Location: ' . BASE_URL . '/pacotes');
        } catch (Exception $ex) {
            echo e($ex->getMessage());
            header('Location: ' . BASE_URL . '/pacotes/novo');
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
            $pacote   = $em->find(PacoteDeTurismo::class, $id);
            $destinos = $em->getRepository(Destino::class)->findAll();

            if (empty($pacote)) {
                throw new Exception('Pacote não encontrado.');
            }
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/pacote/form.php';
        }
    }

    public function buscar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id     = (int) $params['id'];
            $em     = Conexao::getEntityManager();
            $pacote = $em->find(PacoteDeTurismo::class, $id);

            if (empty($pacote)) {
                throw new Exception('Pacote não encontrado.');
            }
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/pacote/listar.php';
        }
    }

    public function remover(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id     = (int) $params['id'];
            $em     = Conexao::getEntityManager();
            $pacote = $em->find(PacoteDeTurismo::class, $id);

            if (empty($pacote)) {
                throw new Exception('Pacote não encontrado.');
            }

            $em->remove($pacote);
            $em->flush();
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            header('Location: ' . BASE_URL . '/pacotes');
            exit;
        }
    }
}
<?php

namespace controller;

use DateTime;
use Exception;
use Throwable;
use model\Cronograma;
use model\PacoteDeTurismo;
use utils\Autorizacao;
use utils\Conexao;

class CronogramaController
{
    public function listar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $em          = Conexao::getEntityManager();
            $cronogramas = $em->getRepository(Cronograma::class)->findAll();
        } catch (Throwable $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/cronograma/listar.php';
        }
    }

    public function novo(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        $cronograma = new Cronograma();
        $em         = Conexao::getEntityManager();
        $pacotes    = $em->getRepository(PacoteDeTurismo::class)->findAll();
        require __DIR__ . '/../view/cronograma/form.php';
    }

    public function cadastrar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id        = filter_input(INPUT_POST, 'id',        FILTER_SANITIZE_NUMBER_INT);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $horario   = filter_input(INPUT_POST, 'horario',   FILTER_SANITIZE_SPECIAL_CHARS);
            $pacoteId  = filter_input(INPUT_POST, 'pacote_id', FILTER_SANITIZE_NUMBER_INT);

            $em         = Conexao::getEntityManager();
            $cronograma = $id ? $em->find(Cronograma::class, (int) $id) : new Cronograma();

            if (empty($cronograma)) {
                throw new Exception('Cronograma não encontrado.');
            }

            $pacote = $pacoteId ? $em->find(PacoteDeTurismo::class, (int) $pacoteId) : null;

            $cronograma->setDescricao($descricao);
            $cronograma->setHorario(empty($horario) ? null : $horario);
            $cronograma->setPacote($pacote);

            $em->persist($cronograma);
            $em->flush();

            header('Location: ' . BASE_URL . '/cronogramas');
            exit;
        } catch (Throwable $ex) {
            die("Erro ao salvar o cronograma: " . $ex->getMessage());
        }
    }

    public function editar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id         = (int) $params['id'];
            $em         = Conexao::getEntityManager();
            $cronograma = $em->find(Cronograma::class, $id);
            $pacotes    = $em->getRepository(PacoteDeTurismo::class)->findAll();

            if (empty($cronograma)) {
                throw new Exception('Cronograma não encontrado.');
            }
        } catch (Throwable $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/cronograma/form.php';
        }
    }

    public function buscar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id         = (int) $params['id'];
            $em         = Conexao::getEntityManager();
            $cronograma = $em->find(Cronograma::class, $id);

            if (empty($cronograma)) {
                throw new Exception('Cronograma não encontrado.');
            }
        } catch (Throwable $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/cronograma/listar.php';
        }
    }

    public function remover(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id         = (int) $params['id'];
            $em         = Conexao::getEntityManager();
            $cronograma = $em->find(Cronograma::class, $id);

            if (empty($cronograma)) {
                throw new Exception('Cronograma não encontrado.');
            }

            $em->remove($cronograma);
            $em->flush();
            
            header('Location: ' . BASE_URL . '/cronogramas');
            exit;
        } catch (Throwable $ex) {
            die("Erro ao remover: " . $ex->getMessage());
        }
    }
}
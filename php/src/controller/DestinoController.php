<?php

namespace controller;

use Exception;
use model\Destino;
use utils\Autorizacao;
use utils\Cloudinary;
use utils\Conexao;

class DestinoController
{
    public function listar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $em       = Conexao::getEntityManager();
            $destinos = $em->getRepository(Destino::class)->findAll();
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/destino/listar.php';
        }
    }

    public function novo(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        $destino = new Destino();
        require __DIR__ . '/../view/destino/form.php';
    }

    public function cadastrar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id          = filter_input(INPUT_POST, 'id',              FILTER_SANITIZE_NUMBER_INT);
            $nome        = filter_input(INPUT_POST, 'nome',            FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao   = filter_input(INPUT_POST, 'descricao',       FILTER_SANITIZE_SPECIAL_CHARS);
            $duracaoDias = filter_input(INPUT_POST, 'duracao_de_dias', FILTER_SANITIZE_NUMBER_INT);
            $categoria   = filter_input(INPUT_POST, 'categoria',       FILTER_SANITIZE_SPECIAL_CHARS);
            $pais        = filter_input(INPUT_POST, 'pais',            FILTER_SANITIZE_SPECIAL_CHARS);

            $em      = Conexao::getEntityManager();
            $destino = $id ? $em->find(Destino::class, (int) $id) : new Destino();

            if (empty($destino)) {
                throw new Exception('Destino não encontrado.');
            }

            $destino->setNome($nome);
            $destino->setDescricao($descricao);
            $destino->setDuracaoDeDias($duracaoDias ? (int) $duracaoDias : null);
            $destino->setCategoria($categoria);
            $destino->setPais($pais);

            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $cloudinary = Cloudinary::getInstance();
                $resultado  = $cloudinary->uploadApi()->upload(
                    $_FILES['imagem']['tmp_name'],
                    ['folder' => 'viaggio/destinos']
                );
                $destino->setImagemUrl($resultado['secure_url']);
            }

            $em->persist($destino);
            $em->flush();

            header('Location: ' . BASE_URL . '/destinos');
        } catch (Exception $ex) {
            echo e($ex->getMessage());
            header('Location: ' . BASE_URL . '/destinos/novo');
        } finally {
            exit;
        }
    }

    public function editar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $destino = $em->find(Destino::class, $id);

            if (empty($destino)) {
                throw new Exception('Destino não encontrado.');
            }
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/destino/form.php';
        }
    }

    public function buscar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $destino = $em->find(Destino::class, $id);

            if (empty($destino)) {
                throw new Exception('Destino não encontrado.');
            }
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            require __DIR__ . '/../view/destino/listar.php';
        }
    }

    public function remover(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $destino = $em->find(Destino::class, $id);

            if (empty($destino)) {
                throw new Exception('Destino não encontrado.');
            }

            $em->remove($destino);
            $em->flush();
        } catch (Exception $ex) {
            echo e($ex->getMessage());
        } finally {
            header('Location: ' . BASE_URL . '/destinos');
            exit;
        }
    }
}
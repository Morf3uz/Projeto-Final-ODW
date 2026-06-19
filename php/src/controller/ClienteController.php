<?php

namespace controller;

use Exception;
use model\Cliente;
use utils\Autorizacao;
use utils\Conexao;

class ClienteController
{
    public function listar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $em       = Conexao::getEntityManager();
            $clientes = $em->getRepository(Cliente::class)->findAll();
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao buscar a lista de clientes.";
        } finally {
            require __DIR__ . '/../view/cliente/listar.php';
        }
    }

    public function novo(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        $cliente = new Cliente();
        require __DIR__ . '/../view/cliente/form.php';
    }

    public function cadastrar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id    = filter_input(INPUT_POST, 'id',    FILTER_SANITIZE_NUMBER_INT);
            $nome  = filter_input(INPUT_POST, 'nome',  FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $cpf   = filter_input(INPUT_POST, 'cpf',   FILTER_SANITIZE_SPECIAL_CHARS);

            $em      = Conexao::getEntityManager();
            $cliente = $id ? $em->find(Cliente::class, (int) $id) : new Cliente();

            if (empty($cliente)) {
                throw new Exception('Cliente não encontrado.');
            }

            $senha = $_POST['senha'] ?? '';

            $cliente->setNome($nome);
            $cliente->setEmail($email);
            $cliente->setCpf(!empty($cpf) ? $cpf : null);

            if (!empty($senha)) {
                $cliente->setSenha(password_hash($senha, PASSWORD_BCRYPT));
            }

            $em->persist($cliente);
            $em->flush();

            header('Location: ' . BASE_URL . '/clientes');
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao salvar os dados do cliente.";
            header('Location: ' . BASE_URL . '/clientes/novo');
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
            $cliente = $em->find(Cliente::class, $id);

            if (empty($cliente)) {
                throw new Exception('Cliente não encontrado.');
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao carregar o cliente.";
        } finally {
            require __DIR__ . '/../view/cliente/form.php';
        }
    }

    public function buscar(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $cliente = $em->find(Cliente::class, $id);

            if (empty($cliente)) {
                throw new Exception('Cliente não encontrado.');
            }
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro ao buscar o cliente.";
        } finally {
            require __DIR__ . '/../view/cliente/listar.php';
        }
    }

    public function remover(array $params = []): void
    {
        Autorizacao::exigirAdmin();

        try {
            $id      = (int) $params['id'];
            $em      = Conexao::getEntityManager();
            $cliente = $em->find(Cliente::class, $id);

            if (empty($cliente)) {
                throw new Exception('Cliente não encontrado.');
            }

            $em->remove($cliente);
            $em->flush();
        } catch (Exception $ex) {
            $_SESSION['erro'] = "Erro: Este cliente possui reservas vinculadas e não pode ser excluído.";
        } finally {
            header('Location: ' . BASE_URL . '/clientes');
            exit;
        }
    }
}
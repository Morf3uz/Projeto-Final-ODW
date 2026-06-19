<?php

namespace controller;

use Exception;
use model\Cliente;
use utils\Conexao;

class AuthController
{
    public function login(array $params = []): void
    {
        if (isset($_SESSION['cliente_id'])) {
            $destino = !empty($_SESSION['cliente_is_admin']) ? '/portal' : '/home';
            header('Location: ' . BASE_URL . $destino);
            exit;
        }

        $erro     = $_SESSION['auth_erro'] ?? null;
        $redirect = $_GET['redirect'] ?? $_SESSION['auth_redirect'] ?? null;

        unset($_SESSION['auth_erro']);

        if ($redirect) {
            $_SESSION['auth_redirect'] = $redirect;
        }

        require __DIR__ . '/../view/auth/login.php';
    }

    public function processarLogin(array $params = []): void
    {
        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            if (empty($email) || empty($senha)) {
                throw new Exception('Preencha e-mail e senha.');
            }

            $em      = Conexao::getEntityManager();
            $cliente = $em->getRepository(Cliente::class)->findOneBy(['email' => $email]);

            if (empty($cliente) || !password_verify($senha, $cliente->getSenha())) {
                throw new Exception('E-mail ou senha inválidos.');
            }

            $_SESSION['cliente_id']       = $cliente->getId();
            $_SESSION['cliente_nome']     = $cliente->getNome();
            $_SESSION['cliente_is_admin'] = $cliente->getIsAdmin();

            $redirect = $_SESSION['auth_redirect'] ?? null;
            unset($_SESSION['auth_redirect']);

            if ($redirect) {
                header('Location: ' . BASE_URL . $redirect);
            } else {
                $destino = $cliente->getIsAdmin() ? '/portal' : '/home';
                header('Location: ' . BASE_URL . $destino);
            }
        } catch (Exception $ex) {
            $_SESSION['auth_erro'] = $ex->getMessage();
            header('Location: ' . BASE_URL . '/login');
        } finally {
            exit;
        }
    }

    public function cadastro(array $params = []): void
    {
        if (isset($_SESSION['cliente_id'])) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        $erro     = $_SESSION['auth_erro'] ?? null;
        $redirect = $_GET['redirect'] ?? $_SESSION['auth_redirect'] ?? null;

        unset($_SESSION['auth_erro']);

        if ($redirect) {
            $_SESSION['auth_redirect'] = $redirect;
        }

        require __DIR__ . '/../view/auth/cadastro.php';
    }

    public function processarCadastro(array $params = []): void
    {
        try {
            $nome  = filter_input(INPUT_POST, 'nome',  FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $cpf   = filter_input(INPUT_POST, 'cpf',   FILTER_SANITIZE_SPECIAL_CHARS);
            $senha = $_POST['senha'] ?? '';

            if (empty($nome) || empty($email) || empty($senha)) {
                throw new Exception('Nome, e-mail e senha são obrigatórios.');
            }

            if (strlen($senha) < 6) {
                throw new Exception('A senha deve ter no mínimo 6 caracteres.');
            }

            $em        = Conexao::getEntityManager();
            $existente = $em->getRepository(Cliente::class)->findOneBy(['email' => $email]);

            if (!empty($existente)) {
                throw new Exception('Este e-mail já está cadastrado.');
            }

            $cliente = new Cliente();
            $cliente->setNome($nome);
            $cliente->setEmail($email);
            $cliente->setCpf(!empty($cpf) ? $cpf : null);
            $cliente->setSenha(password_hash($senha, PASSWORD_BCRYPT));
            $cliente->setIsAdmin(false);

            $em->persist($cliente);
            $em->flush();

            header('Location: ' . BASE_URL . '/login');
        } catch (Exception $ex) {
            $_SESSION['auth_erro'] = $ex->getMessage();
            header('Location: ' . BASE_URL . '/cadastro');
        } finally {
            exit;
        }
    }

    public function logout(array $params = []): void
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/home');
        exit;
    }
}
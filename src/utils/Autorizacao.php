<?php

namespace utils;

class Autorizacao
{
    public static function exigirSessao(): void
    {
        if (empty($_SESSION['cliente_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    public static function exigirAdmin(): void
    {
        if (empty($_SESSION['cliente_id']) || empty($_SESSION['cliente_is_admin'])) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }
    }
}
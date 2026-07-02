<?php

if (!function_exists('e')) {
    function e(?string $valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}

if (!function_exists('moeda')) {
    function moeda(float|int|null $valor): string
    {
        if ($valor === null) {
            return '—';
        }
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }
}
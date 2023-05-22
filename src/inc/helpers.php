<?php
/**
 * Gera o JSON com base nos parâmetros
 *
 * @param array $data dados da resposta.
 * @param int $status Codigo HTTP
 * @return void
 */
function jsonResponse(array $data, int $status): void {
    http_response_code($status);
    header('Content-Type: application/json');

    echo json_encode($data);
    exit;
}
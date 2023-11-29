<?php

include_once './config/constantes.php';
include_once './config/conexao.php';
include_once './func/dashboard.php';

$acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_STRING);

switch ($acao) {

    case 'Home':
        session_destroy();
        echo 'Home';
        break;

    // ações da parte de usuarios 
    case 'listarPedidos':
        // chamar variável
        $_SESSION["page"] = 'listarPedidos';  
        include_once './php/listarPedidos.php';
        break;

    // ações da parte de vendedores/artistas
    // case 'ativarVendedor':
    //     include_once './vendedor/ativarProduto.php';
    //     break;


}



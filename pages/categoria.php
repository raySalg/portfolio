<?php
require_once ("../controller/categoria.php");
require_once ("../view/categoria.php"); 

$controller = new CategoriaController();
$acao = $_GET['acao'] ?? 'categoria';

switch ($acao) {
    case 'inserir':
        $controller->inserir($_POST['nomeCategoria']);
        break;

    case 'atualizar':
        $controller->atualizar($_POST['id'], $_POST['nomeCategoria']);
        break;

    case 'excluir':
        $controller->excluir($_GET['id']);
        break;

    default:
        $controller->categoria();
        break;
}
?>
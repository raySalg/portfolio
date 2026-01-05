<?php

require_once("../controller/projeto.php");
require_once("../model/projeto.php");
require_once("../model/conexao.php"); 

$controller = new ProjetoController();
$acao = $_GET['acao'] ?? 'listar';


$upload_dir = __DIR__ . "/../assets/img/projetos/"; 

switch ($acao) {
    case 'inserirProjeto': 
        $imagem_nome = '';
        
      
        if (isset($_FILES['projeto_imagem']) && $_FILES['projeto_imagem']['error'] == UPLOAD_ERR_OK) {
            $imagem_tmp = $_FILES['projeto_imagem']['tmp_name'];
            $imagem_nome = uniqid() . '_' . basename($_FILES['projeto_imagem']['name']); 
            

            if (move_uploaded_file($imagem_tmp, $upload_dir . $imagem_nome)) {
              
            } else {
              
                $imagem_nome = '';
            }
        }
        
        $controller->inserir(
            $_POST['projeto_titulo'],
            $_POST['projeto_descricao'],
            $_POST['projeto_demo'],
            $imagem_nome, 
            $_POST['projeto_data']
        );
        break;

    case 'atualizarProjeto':
        $imagem_nome = $_POST['projeto_imagem_atual']; 


        if (isset($_FILES['projeto_imagem_nova']) && $_FILES['projeto_imagem_nova']['error'] == UPLOAD_ERR_OK) {
            $imagem_tmp = $_FILES['projeto_imagem_nova']['tmp_name'];
            $nova_imagem_nome = uniqid() . '_' . basename($_FILES['projeto_imagem_nova']['name']);
            
            if (move_uploaded_file($imagem_tmp, $upload_dir . $nova_imagem_nome)) {
              
                $imagem_nome = $nova_imagem_nome;
                
                
                $imagem_antiga = $_POST['projeto_imagem_atual'];
                if (!empty($imagem_antiga) && file_exists($upload_dir . $imagem_antiga)) {
                    unlink($upload_dir . $imagem_antiga);
                }
            }
        }
        
        $controller->atualizar(
            $_POST['projeto_id'],
            $_POST['projeto_titulo'],
            $_POST['projeto_descricao'],
            $_POST['projeto_demo'],
            $imagem_nome, 
            $_POST['projeto_data']
        );
        break;

    case 'excluirProjeto':
        $conecta = new Conexao();
        $projetoModel = new Projeto($conecta->getConexao());
        $projetoParaExcluir = $projetoModel->buscarPorId($_GET['id']); 

        if ($projetoParaExcluir && !empty($projetoParaExcluir->projeto_imagem)) {
            if (file_exists($upload_dir . $projetoParaExcluir->projeto_imagem)) {
                unlink($upload_dir . $projetoParaExcluir->projeto_imagem);
            }
        }
        
        $controller->excluir($_GET['id']);
        break;

    case 'formEditarProjeto':
    case 'listar':
    default:
        $projetos = $controller->listarProjetos();
        require_once("../view/projeto.php");
        break;
}
?>
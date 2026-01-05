<?php
require_once("../model/conexao.php");
require_once("../model/projeto.php");

class ProjetoController {
    
    public function listarProjetos() {
        $conecta = new Conexao();
        $projetoModel = new Projeto($conecta->getConexao());
        $projetos = $projetoModel->listar();
        return $projetos;
    }

    public function inserir($titulo, $descricao, $demo, $imagem, $data) {
        $conecta = new Conexao();
        $projetoModel = new Projeto($conecta->getConexao());
        $projetoModel->inserir($titulo, $descricao, $demo, $imagem, $data);
        header("Location: projeto.php"); 
        die;
    }

    public function atualizar($id, $titulo, $descricao, $demo, $imagem, $data) {
        $conecta = new Conexao();
        $projetoModel = new Projeto($conecta->getConexao());
        $projetoModel->atualizar($id, $titulo, $descricao, $demo, $imagem, $data);
        header("Location: projeto.php"); 
        die;
    }

    public function excluir($id) {
        $conecta = new Conexao();
        $projetoModel = new Projeto($conecta->getConexao());
        $projetoModel->excluir($id);
        header("Location: projeto.php"); 
        die;
    }
}
?>
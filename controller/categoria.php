<?php
require_once("../model/conexao.php");
require_once("../model/categoria.php");

class CategoriaController {
    public function categoria() {
        $conecta = new Conexao();
        $categoriaModel = new Categoria ($conecta->getConexao());
        $categorias = $categoriaModel->listar();
    }

    public function inserir($nomeCategoria) {
        $conecta = new Conexao();
        $categoriaModel = new Categoria ($conecta->getConexao());
        $categoriaModel->inserir($nomeCategoria);
        header("Location: categoria.php");
        die;
    }

    public function atualizar($id, $nomeCategoria) {
        $conecta = new Conexao();
        $categoriaModel = new Categoria ($conecta->getConexao());
        $categoriaModel->atualizar($id, $nomeCategoria);
        header("Location: categoria.php");
        die;
    }

    public function excluir($id) {
        $conecta = new Conexao();
        $categoriaModel = new Categoria ($conecta->getConexao());
        $categoriaModel->excluir($id);
        header("Location: categoria.php");
        die;
    }
}
?>
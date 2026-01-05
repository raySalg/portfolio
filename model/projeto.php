<?php

class Projeto { 
    private $conecta;
    public function __construct($conexao) { 
        $this->conecta = $conexao;
    } 
    public function listar() { 
        $puxa = "SELECT projeto_id, projeto_titulo, projeto_descricao, projeto_demo, projeto_imagem, projeto_data FROM projeto ORDER BY projeto_id DESC"; // Adicionado ORDER BY
        $result = $this->conecta->query($puxa); 
        $projetos = [];
        if ($result->num_rows > 0) { 
            while ($mostra = $result->fetch_object()) { 
                $projetos[] = $mostra;
            } 
        }
        return $projetos;
    } 

    public function buscarPorId($id) {
        $sql = "SELECT projeto_id, projeto_imagem FROM projeto WHERE projeto_id = $id";
        $result = $this->conecta->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_object();
        }
        return null;
    }

    public function inserir($titulo, $descricao, $demo, $imagem, $data) {
        $sql = "INSERT INTO projeto (projeto_titulo, projeto_descricao, projeto_demo, projeto_imagem, projeto_data) 
                 VALUES ('$titulo', '$descricao', '$demo', '$imagem', '$data')";
        return $this->conecta->query($sql);
    }

    public function atualizar($id, $titulo, $descricao, $demo, $imagem, $data) {
        $sql = "UPDATE projeto SET 
                 projeto_titulo = '$titulo', 
                 projeto_descricao = '$descricao', 
                 projeto_demo = '$demo', 
                 projeto_imagem = '$imagem', 
                 projeto_data = '$data' 
                 WHERE projeto_id = $id";
        return $this->conecta->query($sql);
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM projeto WHERE projeto_id = $id";
        return $this->conecta->query($sql);
    }
}
?>
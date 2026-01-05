<?php

class Categoria {
    private $conecta;

    public function __construct($conexao) {
        $this->conecta = $conexao;
    }

    public function listar() {
        $sql = "SELECT categoria_id, categoria_nome FROM categoria";
        $result = $this->conecta->query($sql);

        $categorias = [];
        if ($result->num_rows > 0) {
            while ($mostra = $result->fetch_object()) {
                $categorias[] = $mostra;
            }
        }
        return $categorias;
    }

    public function inserir($nomeCategoria) {
        $sql = "INSERT INTO categoria (categoria_nome) VALUES ('$nomeCategoria')";
        return $this->conecta->query($sql);
        header("Refresh: 0");
        
    }

    public function atualizar($id, $nomeCategoria) {
        $sql = "UPDATE categoria SET categoria_nome='$nomeCategoria' WHERE categoria_id=$id";
        return $this->conecta->query($sql);
    }

    public function excluir($id) {
        $sql = "DELETE FROM categoria WHERE categoria_id=$id";
        return $this->conecta->query($sql);
    }
}
?>
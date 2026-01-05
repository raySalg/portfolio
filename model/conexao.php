<?php
class Conexao {
    private $host    = "sql103.infinityfree.com";
    private $usuario = "if0_40480375";
    private $senha   = "RuuKe4YVuW3m";
    private $banco   = "if0_40480375_portfolio";
    private $conecta;

    public function __construct() {
        $this->conecta = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);

        if ($this->conecta->connect_error) {
            die("Erro na conexão: " . $this->conecta->connect_error);
        }
    }

    public function getConexao() {
        return $this->conecta;
    }
}
?>

    
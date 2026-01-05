<?php
require_once("../include/header.php"); 

$conecta = new Conexao();
$conexaoAtiva = $conecta->getConexao();
$categoriaModel = new Categoria($conexaoAtiva);
$categorias = $categoriaModel->listar();
?>

<div class="mt-5 col-md-12">
    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-lg-6 mb-5">
                <a class="btn btn-primary btn-sm" href="../pages/admin.php"> Voltar </a>
                <h2 class="mb-4 text-purple3">Insira Nova Categoria</h2>
                <form action="categoria.php?acao=inserir" method="POST">
                    <div class="mb-3 text-purple3">
                        <label for="nomeCategoriaInput" class="form-label">Nome da Categoria</label>
                        <input type="text" class="form-control" id="nomeCategoriaInput" name="nomeCategoria" required>
                    </div>
                    <input type="submit" class="btn btn-primary" name="Inserir Categoria">
                </form>
            </div>
            
            <div class="col-12"><hr class="my-4"></div>

            <div class="col-lg-6">
                <h3 class="mb-4 text-purple3">Lista de Categorias</h3>
                
                <?php
                if (!empty($categorias)) {
                    echo '<ul class="list-group">';
                    foreach ($categorias as $mostra) {
                        echo "
                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                            #{$mostra->categoria_id} - {$mostra->categoria_nome}
                            <div>
                                <a href='categoria.php?acao=formEditar&id={$mostra->categoria_id}&nomeCategoria={$mostra->categoria_nome}' class='btn btn-sm btn-warning me-2'>
                                    Editar
                                </a>
                                <a href='categoria.php?acao=excluir&id={$mostra->categoria_id}' class='btn btn-sm btn-danger'>
                                    Excluir
                                </a>
                            </div>
                        </li>";
                    }
                    echo '</ul>';
                } else {
                    echo "<div class='alert alert-warning' role='alert'>Nenhuma categoria de tecnologia encontrada.</div>";
                }
                ?>
            </div>

            <?php
            if (isset($_GET['acao']) && $_GET['acao'] == 'formEditar') {
                $id = htmlspecialchars($_GET['id']);
                $nomeCategoria = htmlspecialchars($_GET['nomeCategoria']);
                
                echo "
                <div class='col-12'><hr class='my-4'></div>
                <div class='col-lg-6 mt-4'>
                    <h3 class='mb-4 text-purple2'> Editar Categoria #{$id}</h3>
                    <form action='categoria.php?acao=atualizar' method='POST'>
                        <input type='hidden' name='id' value='{$id}'>
                        <div class='mb-3'>
                            <label for='editarNomeCategoria' class='form-label text-purple3'>Novo Nome da Categoria</label>
                            <input type='text' class='form-control' id='editarNomeCategoria' name='nomeCategoria' value='{$nomeCategoria}' required>
                        </div>
                        <input type='submit' class='btn btn-success' name='Atualizar Categoria'>
                    </form>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</div>   

<?php require_once("../include/footer.php"); ?>
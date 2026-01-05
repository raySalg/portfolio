<?php

require_once("../model/conexao.php");
require_once("../model/projeto.php");
require_once("../include/header.php"); 
?>

<div class="mt-5 col-md-12">
    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-lg-10 mb-5">
                <a class="btn btn-primary btn-sm" href="../pages/admin.php"> Voltar </a>
                <h2 class="mb-4 text-purple3">Cadastro de Novo Projeto</h2>
                
                <form action="projeto.php?acao=inserirProjeto" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="projetoTitulo" class="form-label text-purple3">Título do Projeto</label>
                                <input type="text" class="form-control text-purple3" id="projetoTitulo" name="projeto_titulo" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="projetoData" class="form-label text-purple3">Data de Conclusão</label>
                                <input type="date" class="form-control" id="projetoData" name="projeto_data" required>
                            </div>

                            <div class="mb-3">
                                <label for="projetoDescricao" class="form-label text-purple3">Descrição</label>
                                <textarea class="form-control" id="projetoDescricao" name="projeto_descricao" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="projetoDemo" class="form-label text-purple3">Link da Demonstração (Demo)</label>
                                <input type="url" class="form-control" id="projetoDemo" name="projeto_demo" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="projetoImagem" class="form-label text-purple3">Arquivo de Imagem (Upload)</label>
                                <input type="file" class="form-control" id="projetoImagem" name="projeto_imagem" required>
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                       <i class="bi bi-plus-circle"></i> Inserir Projeto
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-12"><hr class="my-4"></div>

            <div class="col-lg-10">
                <h3 class="mb-4 text-purple3">Lista de Projetos Cadastrados</h3>
                
                <?php 
                if (!empty($projetos)) {
                    echo '<ul class="list-group">';
                    foreach ($projetos as $mostra) {

                        $edit_params = http_build_query([
                            'acao' => 'formEditarProjeto',
                            'id' => $mostra->projeto_id,
                            'titulo' => $mostra->projeto_titulo,
                            'descricao' => $mostra->projeto_descricao,
                            'demo' => $mostra->projeto_demo,
                            'imagem' => $mostra->projeto_imagem, 
                            'data' => $mostra->projeto_data,
                        ]);
                        $link_edicao = 'projeto.php?' . $edit_params;


                        echo "
                        <li class='list-group-item d-flex justify-content-between align-items-start'>
                            <div>
                                <strong>#{$mostra->projeto_id} - " . htmlspecialchars($mostra->projeto_titulo) . "</strong> 
                                <span class='badge bg-secondary'>({$mostra->projeto_data})</span><br>
                                <small>" . htmlspecialchars($mostra->projeto_descricao) . "</small>
                            </div>
                            <div>
                                <a href='{$link_edicao}' class='btn btn-sm btn-warning me-2'>
                                    <i class='bi bi-pencil'></i> Editar
                                </a>
                                <a href='projeto.php?acao=excluirProjeto&id={$mostra->projeto_id}' 
                                    class='btn btn-sm btn-danger'
                                    onclick=\"return confirm('ATENÇÃO: Deseja realmente excluir o projeto \\'" . addslashes($mostra->projeto_titulo) . "\\'?');\"
                                >
                                    <i class='bi bi-trash'></i> Excluir
                                </a>
                            </div>
                        </li>";
                    }
                    echo '</ul>';
                } else {
                    echo "<div class='alert alert-warning' role='alert'>Nenhum projeto encontrado.</div>";
                }
                ?>
            </div>

            <?php
            if (isset($_GET['acao']) && $_GET['acao'] == 'formEditarProjeto') {
                $id = htmlspecialchars($_GET['id']);
                $titulo = htmlspecialchars($_GET['titulo']);
                $descricao = htmlspecialchars($_GET['descricao']);
                $demo = htmlspecialchars($_GET['demo']);
                $imagem = htmlspecialchars($_GET['imagem']);
                $data = htmlspecialchars($_GET['data']);
                
                echo "
                <div class='col-12'><hr class='my-4'></div>
                <div class='col-lg-10 mt-4'>
                    <h3 class='mb-4 text-warning'> Editar Projeto #{$id} - {$titulo}</h3>
                    <form action='projeto.php?acao=atualizarProjeto' method='POST' enctype='multipart/form-data'>
                        <input type='hidden' name='projeto_id' value='{$id}'>
                        <input type='hidden' name='projeto_imagem_atual' value='{$imagem}'>
                        
                        <div class='row g-3'>
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                    <label for='editProjetoTitulo' class='form-label'>Título</label>
                                    <input type='text' class='form-control' id='editProjetoTitulo' name='projeto_titulo' value='{$titulo}' required>
                                </div>
                                <div class='mb-3'>
                                    <label for='editProjetoData' class='form-label'>Data</label>
                                    <input type='date' class='form-control' id='editProjetoData' name='projeto_data' value='{$data}' required>
                                </div>
                                <div class='mb-3'>
                                    <label for='editProjetoDescricao' class='form-label'>Descrição</label>
                                    <textarea class='form-control' id='editProjetoDescricao' name='projeto_descricao' rows='4' required>{$descricao}</textarea>
                                </div>
                            </div>
                            
                            <div class='col-md-6'>
                                <div class='mb-3'>
                                    <label for='editProjetoDemo' class='form-label'>Link Demo</label>
                                    <input type='url' class='form-control' id='editProjetoDemo' name='projeto_demo' value='{$demo}' required>
                                </div>
                                
                                <div class='mb-3'>
                                    <label class='form-label'>Imagem Atual:</label>
                                    <p><small>{$imagem}</small></p> 
                                    <label for='editProjetoImagem' class='form-label'>Nova Imagem (Opcional)</label>
                                    <input type='file' class='form-control' id='editProjetoImagem' name='projeto_imagem_nova'>
                                </div>
                                
                                <div class='mt-4 d-flex justify-content-between'>
                                    <a href='projeto.php' class='btn btn-secondary'>
                                        <i class='bi bi-arrow-left'></i> Voltar
                                    </a>
                                    <button type='submit' class='btn btn-success'>
                                        <i class='bi bi-check-circle'></i> Atualizar Projeto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</div>
<?php require_once("../include/footer.php"); ?>
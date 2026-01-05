<?php
require_once("../include/header.php");
require_once("../model/conexao.php");
require_once("../model/categoria.php");
require_once("../model/projeto.php");


$conecta = new Conexao();
$conexaoAtiva = $conecta->getConexao();

$projetoModel = new Projeto($conexaoAtiva);
$categoriaModel = new Categoria($conexaoAtiva);

$projetos = $projetoModel->listar(); 
$categorias = $categoriaModel->listar();
?>

<div class="mt-5 col-md-12">
</div>
<div class="container-fluid py-5">
    <div class="row">

        <aside class="col-md-3 col-lg-2 mb-4">
            <div class="list-group shadow-sm">
                <a href="#projetos" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Projetos</a>
                <a href="#categorias" class="list-group-item list-group-item-action" data-bs-toggle="tab">Categorias</a>
                <a href="#tecnologias" class="list-group-item list-group-item-action" data-bs-toggle="tab">Tecnologias</a>
            </div>
        </aside>

        <main class="col-md-9 col-lg-10">
            <div class="tab-content">

                <div class="tab-pane fade show active" id="projetos">
                    <h3 class="mb-3 text-purple3">Gerenciar Projetos</h3>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <?php if (!empty($projetos)): ?>
                                        <?php 
                                        foreach ($projetos as $mostra) {
                                            $link_editar = 'editar_projeto.php?id=' . $mostra->projeto_id;
                                            $link_excluir = 'excluir_projeto.php?id=' . $mostra->projeto_id;
                                            ?>
                                            <div class='card shadow-sm mb-3'>
                                                <div class='card-body'>
                                                    <h5 class='card-title text-purple3'>
                                                        <?= htmlspecialchars($mostra->projeto_titulo) ?> (ID: <?= $mostra->projeto_id ?>)
                                                    </h5>
                                                    <p class='card-text'><?= htmlspecialchars($mostra->projeto_descricao) ?></p>
                                                    <p class='card-text text-muted'><?= htmlspecialchars($mostra->projeto_data) ?></p>

                                                    <div class='d-flex justify-content-end'>
                                                        <a href='<?= $link_editar ?>' class='btn btn-sm btn-primary me-2'>
                                                            Editar
                                                        </a>
                                                        <a href='<?= $link_excluir ?>' class='btn btn-sm btn-danger' onclick="return confirm('Confirmar exclusão de <?= htmlspecialchars($mostra->projeto_titulo) ?>?');">
                                                            Excluir
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } 
                                        ?>
                                    <?php else: ?>
                                        <p class='alert alert-warning'>Nenhum projeto encontrado.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="../pages/projeto.php" class="btn btn-success mt-3">+ Novo Projeto</a>
                </div>

                <div class="tab-pane fade" id="categorias">
                    <h3 class="mb-3 text-purple3">Gerenciar Categorias</h3>
                    <ul class="list-group shadow-sm">
                        <?php if (!empty($categorias)): ?>
                            <?php foreach ($categorias as $item): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= htmlspecialchars($item->categoria_nome) ?>
                                    <span>
                                        <a href="categoria.php?acao=formEditar&id=<?= $item->categoria_id ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <a href="categoria.php?acao=excluir&id=<?= $item->categoria_id ?>" class="btn btn-sm btn-outline-danger">Excluir</a>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                             <li class="list-group-item">Nenhuma categoria encontrada.</li>
                        <?php endif; ?>
                    </ul>
                    <a href="categoria.php" class="btn btn-success mt-3">+ Nova Categoria</a>
                </div>


            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php require_once("../include/footer.php"); ?>
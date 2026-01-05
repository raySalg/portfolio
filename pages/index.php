<?php
    require_once("../include/header.php");

    require_once("../controller/projeto.php");
    require_once("../model/conexao.php"); 
    require_once("../model/projeto.php"); 

    $controller = new ProjetoController();
    $projetos = $controller->listarProjetos();
    $projetoCount = count($projetos);
    
    $image_base_path = 'assets/upload/';
?>

<style>
    .carousel-item img {
        height: 50vh;
        object-fit: cover; 
        filter: brightness(0.7);
    }
    .carousel-caption {
        bottom: 20px;
    }
    #projetos {
        min-height: 80vh;
    }
</style>

<main class="d-flex vh-100 align-items-center">
    <article class="text-start container">
        <header>
            <h4 class="mb-2 lh-1 text-purple3">Meu nome é</h4>
            <h1 class="fw-bold mb-3 lh-1 text-purple1 display-3 display-md-1">
                Rayssa Salgado.
            </h1>
        <h1 class="fw-bold mb-4 lh-1 text-purple2 h2 h1-md">
            Eu construo códigos para web.
        </h1>
        <p class="lh-sm lh-md-1 text-purple3 fs-6 fs-md-4">
            Eu sou uma estudante de curso técnico de Desenvolvimento de Sistemas e,<br>
            estou começando no mundo da programação web!
        </p>
        <a href="#projetos" class="btn btn-outline-light purple3 btn-lg mt-4 text-purple3">
            Meus Projetos
        </a>
        </header>
        <div class="d-flex justify-content-center mt-5">
            <a href="#sobre" class="btn btn-outline-light purple3 text-purple3 btn-lg scroll-btn">↓</a>
        </div>
    </article>
</main>

<section id="sobre" class="py-5 degradeb">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-5 text-center mb-4 mb-md-0">
            <img src="../img/praia.png" alt="Foto Praia" class="img-fluid rounded-3 shadow">
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold text-purple1 mb-3">Sobre mim</h2>
                <p class="fs-10 text-purple3"> 
                    a
                </p>
            <p class="fs-10 text-purple3">
                    a
            </p>
                <a href="#habilidades" class="btn btn-outline-light purple3 text-purple3 mt-3">Minhas Habilidades</a>
        </div>
        </div>
    </div>
</section>


<div class="divisor bg-black"></div>

<section id="habilidades" class="py-5 bg-black">
    <div class="container text-center">
        <h2 class="fw-bold text-purple1 mb-5">Minhas Habilidades</h2>
        <div class="row text-white">
            <div class="col-md-4">HTML5 & CSS</div>
            <div class="col-md-4">PHP & MySQL</div>
            <div class="col-md-4">JavaScript</div>
        </div>
    </div>
</section>

<div class="divisor bg-black"></div>

<section id="projetos" class="py-5 degradeb">
    <div class="container">
        <h2 class="fw-bold text-purple1 text-center mb-5">Projetos Recentes</h2>

        <?php if ($projetoCount > 0): ?>
            <div id="carouselProjetos" class="carousel slide shadow-lg rounded-3 overflow-hidden" data-bs-ride="carousel">
                
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < $projetoCount; $i++): ?>
                        <button type="button" data-bs-target="#carouselProjetos" data-bs-slide-to="<?php echo $i; ?>" 
                            class="<?php echo $i === 0 ? 'active' : ''; ?>" 
                            aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>" 
                            aria-label="Slide <?php echo $i + 1; ?>">
                        </button>
                    <?php endfor; ?>
                </div>
            
                <div class="carousel-inner">
                    <?php foreach ($projetos as $index => $projeto): ?>
                        <?php
                            $active = $index === 0 ? 'active' : '';
                            $imagePath = $image_base_path . htmlspecialchars($projeto->projeto_imagem);
                        ?>
                        <div class="carousel-item <?php echo $active; ?>">
                            <img src="<?php echo $imagePath; ?>" class="d-block w-100" 
                                alt="<?php echo htmlspecialchars($projeto->projeto_titulo); ?>"
                                onerror="this.onerror=null; this.src='https://placehold.co/1200x400/805ad5/ffffff?text=Projeto+Sem+Imagem';"
                            >
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded-3 p-3">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($projeto->projeto_titulo); ?></h5>
                                <p><?php echo htmlspecialchars($projeto->projeto_descricao); ?></p>
                                <a href="<?php echo htmlspecialchars($projeto->projeto_demo); ?>" target="_blank" class="btn btn-sm btn-info mt-2">
                                    Ver Demo <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                                <span class="badge bg-secondary ms-2"><?php echo htmlspecialchars($projeto->projeto_data); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProjetos" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselProjetos" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">Nenhum projeto cadastrado no momento.</div>
        <?php endif; ?>

    </div>
</section>

<?php require_once("../include/footer.php"); ?>
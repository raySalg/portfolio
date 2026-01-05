<?php
session_start();
require_once("../include/header.php");
require_once("../model/conexao.php");

$error_message = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conecta = new Conexao();
    $conexaoAtiva = $conecta->getConexao();

    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    $usuarioes = $conexaoAtiva->real_escape_string($usuario);
    
    $sql = "SELECT usuario_senha FROM usuario WHERE usuario_nome = '$usuarioes'";
    $result = $conexaoAtiva->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        $senha_db = $row['usuario_senha'];

        if ($senha === $senha_db) {
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario; 
            
            header("Location: ../pages/admin.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Usuário ou senha inválidos.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = "Usuário ou senha inválidos.";
        header("Location: login.php");
        exit;
    }
}
?>

<main class="d-flex vh-100 align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card bg-dark text-white shadow-lg border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="card-title text-center text-purple1 mb-4 fw-bold">Login</h2>
                        
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?php echo htmlspecialchars($error_message); ?>
                            </div>
                        <?php endif; ?>

                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label text-purple3">Usuário</label>
                                <input type="text" 
                                    class="form-control bg-secondary text-white border-0" 
                                    id="usuario" 
                                    name="usuario" 
                                    required
                                    placeholder="Digite seu usuário">
                            </div>
                            <div class="mb-4">
                                <label for="senha" class="form-label text-purple3">Senha</label>
                                <input type="password" 
                                    class="form-control bg-secondary text-white border-0" 
                                    id="senha" 
                                    name="senha" 
                                    required
                                    placeholder="Digite sua senha">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary purple-bg fw-bold">
                                    Entrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once("../include/footer.php"); ?>
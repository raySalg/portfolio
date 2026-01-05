<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        $_SESSION['login_error'] = "Acesso negado. Por favor, faça login.";
        
        header("Location: ../pages/login.php");
        exit;
    }
    
?>
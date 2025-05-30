<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'db_connect.php'; // $pdo já está definido aqui

$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

if (!$nome || !$email || !$senha) {
    $_SESSION['mensagem'] = 'Preencha todos os campos corretamente.';
    header('Location: ../cadastre-se.php');
    exit;
}

// Verifica se o email já está cadastrado
$sql = "SELECT id FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);

if ($stmt->rowCount() > 0) {
    $_SESSION['mensagem'] = 'E-mail já cadastrado.';
    header('Location: ../cadastre-se.php');
    exit;
}

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Insere novo usuário
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);
$executou = $stmt->execute([
    'nome' => $nome,
    'email' => $email,
    'senha' => $senhaHash
]);

if ($executou) {
    $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
} else {
    $_SESSION['mensagem'] = 'Erro ao cadastrar. Tente novamente.';
}

// Redireciona para cadastro
header('Location: ../cadastre-se.php');
exit;
?>
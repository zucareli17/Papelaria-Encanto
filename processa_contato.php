<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$nome     = trim($_POST['nome'] ?? '');
$email    = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$assunto  = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');


if ($nome === '' || $mensagem === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?status=erro#contato');
    exit;
}

try {
    $pdo = conectarBanco();
    $stmt = $pdo->prepare("
      INSERT INTO contatos (nome, email, telefone, assunto, mensagem)
      VALUES (:nome, :email, :telefone, :assunto, :mensagem)
    ");
    $stmt->execute([
        'nome'     => $nome,
        'email'    => $email,
        'telefone' => $telefone,
        'assunto'  => $assunto,
        'mensagem' => $mensagem,
    ]);

    header('Location: index.php?status=sucesso#contato');
    exit;
} catch (PDOException $e) {
    header('Location: index.php?status=erro#contato');
    exit;
}

<?php
$host = 'sql103.infinityfree.com';
$db   = 'if0_39088303_viajantelivre';
$user = 'if0_39088303';
$pass = 'Front1988'; // coloque a senha certa
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Erro na conexão: ' . $e->getMessage();
  exit;
}
?>
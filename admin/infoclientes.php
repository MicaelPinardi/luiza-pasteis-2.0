<?php
$email = $_GET['email'];
$nome = $_GET['nome'];
$nickname = $_GET['nickname'];
$password = $_GET['password'];
$endereco = $_GET['endereco'];
$uf = $_GET['uf'];
$fone = $_GET['fone'];

$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");

$sql = "INSERT INTO `login` (`id`, `nome`, `nickname`, `email`, `senha`, `endereco`, `uf`, `telefone`, `funcao`) VALUES (NULL, '$nome', '$nickname', '$email', '$password', '$endereco','$uf', '$fone','cliente')";

$resultado = mysqli_query($conexao, $sql);
mysqli_close($conexao);

header("Location: index.php");
?>
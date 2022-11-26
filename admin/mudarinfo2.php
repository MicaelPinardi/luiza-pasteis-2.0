<?php
session_start();
if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE)){
    header("Location: ../index.php");
}

if (($_GET['email']!=="")&&($_GET['nome']!=="")&&($_GET['nick']!=="")&&($_GET['endereco']!=="")&&($_GET['uf']!=="")&&($_GET['fone']!=="")){
    
    $email=$_GET['email'];
    $nome=$_GET['nome'];
    $nickname=$_GET['nick'];
    $endereco=$_GET['endereco'];
    $uf=$_GET['uf'];
    $fone=$_GET['fone'];

$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
$sql="UPDATE `login` SET `nome` = '$nome', `nickname` = '$nickname', `email` = '$email', `endereco` = '$endereco', `uf` = '$uf', `telefone` = '$fone' WHERE `login`.`id` = $_SESSION[id];";
$resultado = @mysqli_query($conexao, $sql);

$sql="SELECT * FROM `login` WHERE `id` = $_SESSION[id]";
$resultado = mysqli_query($conexao,$sql);
				while($linha = mysqli_fetch_array($resultado)){
					$_SESSION['nome']=$linha['nome'];
                    $_SESSION['nickname']=$linha['nickname'];
                    $_SESSION['email']=$linha['email'];
                    $_SESSION['endereco']=$linha['endereco'];
                    $_SESSION['uf']=$linha['uf'];
                    $_SESSION['fone']=$linha['telefone'];
          }

}

header("Location: infologin.php")
?>
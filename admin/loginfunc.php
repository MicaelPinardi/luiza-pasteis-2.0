<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style-login-admin.css">
  <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
	
<body>
	
<?php
	session_start();
	if ((isset($_SESSION["logado"]))&&($_SESSION["logado"]== TRUE)&&($_SESSION["funcao"]=='gerente')) {
		header("Location: index.php");
	} else if ((isset($_SESSION["logado"]))&&($_SESSION["logado"]== TRUE)&&($_SESSION["funcao"]=='cliente')) {
		//O funcionario ja efetuou o login então ele volta para a pagina administrativa
		header("Location: infologin.php");
	} else {
		// Verificando se o usário digitou email e  senha e clicou em "logar"
		if ((isset($_POST["email"]))&&(isset($_POST["senha"]))){
			
	
			$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
			$sql = "SELECT * FROM `tbFunc`;";
			$resultado = mysqli_query($conexao,$sql);

			if (!($linha = mysqli_fetch_array($resultado))) {
				//reiniciando a chave primaria
				$sql="ALTER TABLE `tbfunc` AUTO_INCREMENT = 0;";
				$resultado = mysqli_query($conexao,$sql);
								
				//criando o usuários supervidor
				$email="supervisor@supervisor.com";
				$senha="supervisor";
				
				$sql="INSERT INTO `tbfunc` (`idFunc`, `email`, `senha`, `nome`, `funcao`) VALUES (NULL, '$email', '$senha', 'supervisor', 'gerente');";
				$resultado = mysqli_query($conexao,$sql);
				
			}
		
			
			$email=$_POST["email"];
			$senha=$_POST["senha"];

			$sql = "SELECT * FROM `tbfunc` WHERE `email` = '$email' AND `senha` = '$senha'";
			$resultado = mysqli_query($conexao,$sql);

			if ($linha = mysqli_fetch_array($resultado)) {
				$_SESSION["id"] = $linha["idFunc"];				
				$_SESSION["logado"] = TRUE;
				$_SESSION["funcao"] = $linha["funcao"];
				$_SESSION["nome"] = $linha["nome"];
				$_SESSION['email'] = $linha['email'];
				$_SESSION['senha'] = $linha['senha'];
				$_SESSION["idFunc"] = $linha["id"];	
			header("Location: index.php");
				
                } else { ?>
						<script>document.getElementById('mensagem').innerHTML = "Email e/ou Senha inválidados!"</script>
	<?php 
	}
	}
    }

?>
	<img src="../logotipos/logo-transparente.png" alt="logo" height="200px">
	<div id="login">
		<h1>LOGIN - Funcionários</h1>
			<form action="loginfunc.php" method="post" class="infos">
				<input placeholder="Digite seu email" id="infos" type=email name="email" required onclick="document.getElementById('mensagem').innerHTML = ''"><br><br>
				<input placeholder="Digite sua senha" id="infos" type=password name="senha" autocomplete="off" required onclick="document.getElementById('mensagem').innerHTML = ''"><br><br>
				<input type=submit value="Logar" class="submit" width="90px">
			</form>
			<form action="../index.php" class="voltar">
			<input type=submit value="Voltar" class="back"> 
			</form>
	</div>
</body>
</html>

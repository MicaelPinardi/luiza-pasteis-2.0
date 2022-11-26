<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Funcionários </title>
  <link rel="stylesheet" href="style-admin.css">
  <link rel="shortcut icon" href="../imagens/favicon.png" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="inicio">
    <div class="header">
          <img src="../logotipos/logo-transparente-2.png" alt="Logotipo" height="100px">
    </div>
  </div>
<main>
	<div class="tabela">
	
		<?php
			session_start();
			if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] != "gerente")){
				header("Location: index.php");
			}
	
			if(isset($_POST["idFunc"])) {
				if (($_SESSION["funcao"]==="gerente")) {
					$idFunc = $_POST["idFunc"];
					$senhaNova = $_POST["senhaNova"];
	
					$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
					$sql =  "UPDATE `tbfunc` SET `senha` = '$senhaNova' WHERE `tbfunc`.`idFunc` = $idFunc;";
					echo $sql;
					// executando instrução SQL
					$resultado = @mysqli_query($conexao, $sql);
					if (!$resultado) {
						die('Query Inválida: ' . @mysqli_error($conexao));
						echo "<form action='listarFuncionario.php'> onsubmit='window.onsubmit = function() { return true; };'";
						echo "<button type='submit'>Voltar</button>";
						echo "</form>";
					}
					mysqli_close($conexao);
					if ($_SESSION["idFunc"]==$idFunc) {
						session_destroy();
						header("Location: login.php");
					}
					header("Location: listarFuncionario.php");
				} else {
					$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
	
					$idFunc = $_SESSION["idFunc"];
					$senhaNova = $_POST["senhaNova"];
					$senhaAntiga = $_POST["senhaAntiga"];
	
					$dados="idFunc=".$_POST["idFunc"].
							"&nome=".$_POST["nome"].
							"&email=".$_POST["email"];
	
					$sql = "SELECT * FROM `tbfunc` WHERE `tbfunc`.`idFunc` = '$idFunc' and `tbfunc`.`senha`='$senhaAntiga'";
	
					$resultado = @mysqli_query($conexao, $sql);
	
					if (!$linha = mysqli_fetch_array($resultado)) {
						$dados="idFunc=".$_POST["idFunc"].
						"&nome=".$POST["nome"].
						"&email=".$_POST["email"];
						mysqli_close($conexao);
						header("Location: trocarSenhaFuncionario.php?senhaAntigaInvalida=true&&$dados");
					} else {
						$sql =  "UPDATE `tbfunc` SET `senha` = '$senhaNova' WHERE `tbfunc`.`idFunc` = $idFunc;";
						$resultado = @mysqli_query($conexao, $sql);
						session_destroy();
						header("Location: login.php");
					}
	
				}
			}
		 ?>
	
	
		<br>
		<h1 align='center'> Alteração Senha de Funcionário </h1>
		<br>
		<h1 id="mensagem" style="color:red;"></h1>
		<div id="box2">
		<form  action="trocarSenhaFuncionario.php" method="post" onsubmit="verificarDados()">
	
			<input type="hidden" name="idFunc" value="<?php echo $_GET["idFunc"]; ?>">
			<input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
			<input type="hidden" name="nome" value="<?php echo $_GET["nome"]; ?>">
	
			Email: <?php echo $_GET["email"]; ?><br>
			Nome: <?php echo $_GET["nome"]; ?><br><br>
			<?php if ($_SESSION["funcao"]!=="gerente") { ?>
			Senha Antiga <input type="password" name="senhaAntiga"
						 id="input-senhaAntiga" onclick="document.getElementById('mensagem').innerHTML = ''"><br><br> <?php } ?>
			Nova Senha <input type="password" name="senhaNova" id="input-senhaNova"><br><br>
			Confirma Nova Senha <input type="password" name="confirmaSenhaNova" id="input-confirmaSenhaNova"><br><br>
	
			<center><button type="submit">Salvar</button><p></p>
		 </form>
		 <form action="listarFuncionario.php" onsubmit="window.onsubmit = function() { return true; };">
		<button type='submit'>Voltar</button></center>
		</form>
	
		 </div>
	
		<p></p>
	
		<script>
	
			function verificarDados() {
				var senhaNova = document.getElementById("input-senhaNova").value;
				var confirmaSenhaNova = document.getElementById("input-confirmaSenhaNova").value;
				if (senhaNova.length<6) {
					alert("A senha deve ter no mínimo 6 digitos!");
					// abortando submit
					document.getElementById("input-senhaNova").focus();
					window.onsubmit = function() { return false; }
	
				} else if (senhaNova!==confirmaSenhaNova) {
					alert("A Senha e Confirma Senha devem ser iguais!");
					// abortando submit
					document.getElementById("input-confirmaSenhaNova").focus();
					window.onsubmit = function() { return false; };
	
				} else {
					window.onsubmit = function() { return true; };
				}
			}
	
		<?php
			if(isset($_GET["senhaAntigaInvalida"])){ ?>
				var senhaAntigaInvalida =  <?php echo "\"".$_GET["senhaAntigaInvalida"]."\"";?>;
				document.getElementById('mensagem').innerHTML = "Senha Antiga inválida!";<?php
			} ?>
	
		</script>
	</div>
</main>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Produtos </title>
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
			if (!isset($_SESSION["logado"]) || ($_SESSION["logado"] != TRUE) || ($_SESSION["funcao"] != "gerente")) {
				header("Location: index.php");
			}
			if(isset($_POST["idFunc"])) {
				if (($_SESSION["funcao"]==="gerente")) {
					$idFunc = $_POST["idFunc"];
					$nomeNovo = $_POST["nomeNovo"];
					$emailNovo = $_POST["emailNovo"];
					if ($_SESSION["idFunc"]!=$idFunc) {
						$funcaoNovo = $_POST["funcaoNovo"];
						$sql =  "UPDATE `tbfunc` SET `nome` = '$nomeNovo', `email`='$emailNovo', `funcao`='$funcaoNovo' WHERE `tbfunc`.`idFunc` = $idFunc;";
						
					} else {
						$sql =  "UPDATE `tbfunc` SET `nome` = '$nomeNovo', `email`='$emailNovo' WHERE `tbfunc`.`idFunc` = $idFunc;";
					}	
					$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
					
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
					$idFunc = $_POST["idFunc"];
					$nomeNovo = $_POST["nomeNovo"];
					$emailNovo = $_POST["emailNovo"];
					
					$sql =  "UPDATE `tbfunc` SET `nome` = '$nomeNovo', `email`='$emailNovo' WHERE `tbfunc`.`idFunc` = $idFunc;";
					$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
					
				echo $sql;	
					$resultado = @mysqli_query($conexao, $sql);
					if (!$resultado) {
						die('Query Inválida: ' . @mysqli_error($conexao));
						echo "<form action='listarFuncionario.php'> onsubmit='window.onsubmit = function() { return true; };'";
						echo "<button type='submit'>Voltar</button>";
						echo "</form>";
					}
					mysqli_close($conexao);
					session_destroy();
					header("Location: login.php");
							
				}
			}
		 ?>
		
		<br><h1 align='center'> Alteração Dados de Funcionário </h1><br>
		<div id="box3">
		<h1 id="mensagem" style="color:red;"></h1>
		<form  action="alterarFuncionario.php" method="post" onsubmit="verificarDados()">
		  <input type="hidden" name="idFunc" value="<?php echo $_GET["idFunc"]; ?>">
			<input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
			<input type="hidden" name="nome" value="<?php echo $_GET["nome"]; ?>">
			
			email: <input type="email" name="emailNovo" value="<?php echo $_GET["email"]; ?>" id="input-email"><p></p>
			Nome: <input type="text" name="nomeNovo" value="<?php echo $_GET["nome"]; ?>" id="input-nome"><p></p><p></p><?php
			if (($_SESSION["funcao"]==="gerente")&&($_SESSION["idFunc"]!=$_GET["idFunc"])) {?>
				Função: <input type="radio" name="funcaoNovo" value="gerente" <?php if($_GET["funcao"]==="gerente"){ echo "checked";}?>>Gerente 
				<input type="radio" name="funcaoNovo" value="vendedor"  <?php if($_GET["funcao"]==="vendedor"){ echo "checked";}?>>Vendedor 
				<input type="radio" name="funcaoNovo" value="caixa" <?php if($_GET["funcao"]==="caixa"){ echo "checked";}?>>Caixa<p></p><?php
			} ?>
		
			<br>
			<center><button type="submit">Salvar</button></center>
		 </form>
		 <center>
			<form action="listarFuncionario.php">
			<button type='submit'>Voltar</button>
			</form>
		 </center>
		
		
		
		</div>
		
		<script>
		
			function verificarDados() {
				var email = document.getElementById("input-email").value;
				var nome = document.getElementById("input-nome").value;
				if (!validarEmail(email)) {
					alert("Digite um email válido!");
					// abortando submit
					document.getElementById("input-email").focus();
					window.onsubmit = function() { return false; };	
					
				} else if (nome.length<3) {
					alert("O nome deve ter no mínimo 3 caracteres!");
					// abortando submit
					document.getElementById("input-nome").focus();
					window.onsubmit = function() { return false; };
		
				} else {
					return true;
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

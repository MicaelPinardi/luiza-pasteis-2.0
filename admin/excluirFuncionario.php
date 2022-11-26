<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiza Pastéis - Funcionário </title>
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
					$sql =  "UPDATE `tbfunc` SET `ativo` = 'n' WHERE `tbfunc`.`idFunc` = $idFunc;";
					$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
					
					// executando instrução SQL
					$resultado = @mysqli_query($conexao, $sql);
					if (!$resultado) {
						die('Query Inválida: ' . @mysqli_error($conexao));
						echo "<form action='listarFuncionario.php'> onsubmit='window.onsubmit = function() { return true; };'";
						echo "<button type='submit'>Voltar</button>";
						echo "</form>";
					}
					header("Location: listarFuncionario.php");
				}
			}
		 ?>
		
		<br><h1 align='center'> Excluir Funcionário </h1>
		<h1 id="mensagem" style="color:red;"></h1><br>
		<div id="box4">
		<form  action="excluirFuncionario.php" method="post">
		  <input type="hidden" name="idFunc" value="<?php echo $_GET["idFunc"]; ?>">
			
			email: <?php echo $_GET["email"]; ?><br>
			Nome: <?php echo $_GET["nome"]; ?><br>
			Função: <?php echo $_GET["funcao"];?><br><br>
			
			<button type="submit">Excluir este Funcionário</button><p></p>
		 </form>
		
		<form action="listarFuncionario.php">
		<button type='submit'>Voltar</button>
		</form>
		</div>
	</div>
  </main>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Antiquário</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../styleindex.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">



	</head>
<body>
<?php
	session_start();
	if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] != "gerente")){
		header("Location: index.php");
	}
	if(isset($_POST["email"])&&($_POST["email"]!=="")){
		// Inclusão de funcionario
		$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
					
		$email = $_POST["email"];					
		$senha = $_POST["senha"];
		$nome = $_POST["nome"];
		$funcao = $_POST["funcao"];
		
		$sql = "SELECT * FROM `tbfunc` WHERE `email` = '$email'";

		$resultado = @mysqli_query($conexao, $sql);
		if ($linha = mysqli_fetch_array($resultado)) { 
			mysqli_close($conexao);
			header("Location: incluirFuncionario.php?emailJaCadastrado=".$linha["email"]);
		} else {		    
			// criando a linha de INSERT
			$sql =  "INSERT INTO `tbFunc` ".
					"(`idFunc`, `email`,".
					"`senha`, `nome`, ".
					"`funcao`) ".
					"VALUES (NULL, '$email', '$senha', ".
					"'$nome', '$funcao');";
					// executando instrução SQL
					$resultado = @mysqli_query($conexao, $sql);
					if (!$resultado) {
						die('Query Inválida: ' . @mysqli_error($conexao));
						echo "<form action='listarFuncionario.php' onsubmit='window.onsubmit = function() { return true; };'>";
						echo "<button type='submit'>Voltar</button>";
						echo "</form>";
					}
			mysqli_close($conexao);
			header("Location: listarFuncionario.php");
		}
	}
 ?>
<h1 align='center'> Incluir Funcionário </h1>
<h1 id="mensagem" style="color:red;"></h1>
<form  action="incluirFuncionario.php" method="post" onsubmit="verificarDados()">
	email <input type="text" name="email" id="input-email" onclick="document.getElementById('mensagem').innerHTML = ''"><p></p>
	Senha <input type="password" name="senha" id="input-senha"><p></p>
	Confirma senha <input type="password" name="confirmaSenha" id="input-confirmaSenha"><p></p>
	Nome <input type="text" name="nome" id="input-nome"><p></p>
	Função: <input type="radio" name="funcao" value="gerente">Gerente 
	<input type="radio" name="funcao" value="vendedor" checked>Vendedor 
	<input type="radio" name="funcao" value="caixa">Caixa
	<input type="radio" name="funcao" value="transportador">Transportador<p></p>
	<button type="submit">Salvar</button><p></p>
 </form>

<form action="listarFuncionario.php" onsubmit="window.onsubmit = function() { return true; };">
<button type='submit'>Voltar</button>
</form>
<p></p>

<script>

	function validarEmail(email) {
		var re = /\S+@\S+\.\S+/;
		return re.test(email);
	}

	function verificarDados() {
		var email = document.getElementById("input-email").value;
		var senha = document.getElementById("input-senha").value;
		var confirmaSenha = document.getElementById("input-confirmaSenha").value;
		var nome = document.getElementById("input-nome").value;
		if (!validarEmail(email)) {
			alert("Digite um email válido!");
			// abortando submit
			document.getElementById("input-email").focus();
			window.onsubmit = function() { return false; };	
			
		} else if (senha.length<6) {
			alert("A senha deve ter no mínimo 6 digitos!");
			// abortando submit
			document.getElementById("input-senha").focus();
			window.onsubmit = function() { return false; }
			
		} else if (senha!==confirmaSenha) {
			alert("A Senha e Confirma Senha devem ser iguais!");
			// abortando submit
			document.getElementById("input-confirmaSenha").focus();
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
	if(isset($_GET["emailJaCadastrado"])){ ?>
	    var emailJaCadastrado =  <?php echo "\"".$_GET["emailJaCadastrado"]."\"";?>;
		document.getElementById('mensagem').innerHTML = "Email: "+emailJaCadastrado+", já cadastrado!";<?php		
	} ?>

</script>
</body>
</html>

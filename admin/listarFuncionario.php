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
		
			//conectar com o banco de dados
			$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
			if ($_SESSION["funcao"]==="gerente") {
				$sql = "SELECT * FROM `tbFunc` order by nome";
			} else {
				$sql = "SELECT * FROM `tbFunc` where idFunc='".$_SESSION["idFunc"]."'";
			}
			$resultado = mysqli_query($conexao,$sql);
		?>
		
		<h1 align='center'>Lista de Produtos</h1>
		<table border=1 align=center width=90%>
		<thead>
		  <tr>
			<th>#ID</th>
			  <th>Nome</th>
			<th>email</th>
			<th>Função</th>
			  <th>Ação</th>
		  </tr>
		</thead>
		<tbody>
		
		<?php
			while($linha = mysqli_fetch_array($resultado)){
				echo "<tr align='center'>";
				echo "<td width='5%'>".$linha["idFunc"]."</td>";
				echo "<td width='20%'>".$linha["nome"]."</td>";
				echo "<td width='15%'>".$linha["email"]."</td>";
				echo "<td>".$linha["funcao"]."</td>";
				$dados="idFunc=".$linha["idFunc"].
					"&nome=".$linha["nome"].
					"&email=".$linha["email"].
					"&funcao=".$linha["funcao"];
		
				echo	"<td width=120>".
						"<a href=\"trocarSenhaFuncionario.php?$dados\"><img width=\"20%\" src=\"alterar_senha.png\"> </a>".
						"<a href=\"alterarFuncionario.php?$dados\"><img width=\"20%\" src=\"edit.png\"> </a>";
				if (($_SESSION["funcao"]==="gerente")&&($_SESSION["id"]!=$linha["idFunc"])) {
					echo "<a href=\"excluirFuncionario.php?$dados\"><img width=\"20%\" src=\"cancelar.png\"> </a>";
				}
				echo "</td>";
				echo "</tr>";
			}
		
			mysqli_close($conexao);
		?>
		
		</tbody>
		</table>
	</div>
	<?php
			if ($_SESSION["funcao"]==="gerente") { ?>
				<form action="incluirFuncionario.php">
				<button type='submit'>Novo Funcionário</button>
				</form><?php
			}?>

<a href="index.php" class="btn-voltar"><button type='submit'>Voltar</button></a>
  </main>


</body>
</html>

<?php
	session_start();
	if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] != "gerente") && ($_SESSION["funcao"] != "caixa")){
		header("Location: index.php");
	}
?>
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
		<ul>
            <li><a href="index.php" class="link">Voltar</a></li>
        </ul>
  </div>

    <br>

<main>
	<div class="tabela">
		<?php

		$total=0;
		$totala=0;
		$_SESSION['date1']=2000-01-01;
		$_SESSION['date2']=2000-01-01;
		
			if(isset($_GET['date1'])&&($_GET['date1']!=="")){
				$_SESSION['date1']= $_GET['date1'];
			}
		
			if(isset($_GET['date2'])&&($_GET['date2']!=="")){
				$_SESSION['date2']= $_GET['date2'];
			}
		
				?>
				<div class="table">
			<table width="80%" align="center">
				<h2>Relatório de Vendas</h2>
				<thead>
					<tr>
						<th width="80">ID do Pedido</th>
						<th width="80">ID do Cliente</th>
						<th width="80">ID do Produto</th>
						<th width="80">Preço Pago</th>
						<th width="80">Data</th>
					</tr>
				</thead>
				<tbody>
		
			 <?php
		
		
			$conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
			$sql   = "SELECT * FROM `tbpedido` WHERE `data` >= '$_SESSION[date1]' and `data` <= '$_SESSION[date2]' ORDER BY `idCliente` DESC";
			$resultado = mysqli_query($conexao,$sql);
				while($linha = mysqli_fetch_array($resultado)){
					echo "<tr>";
					echo "<td>".$linha['idPedido']."</td>";
					echo "<td>".$linha['idCliente']."</td>";
					echo "<td>".$linha['idProduto']."</td>";
					echo "<td>".$linha['precoPago']."</td>";
					echo "<td>".$linha["data"]."</td>";
		  }
		
		
		
		
		?>
		
		<center>
			<form action="relatorio.php" method="GET">
				De: <input type="date" name='date1'>
				até: <input type="date" name='date2'> <br>
				<button type="submit">Pesquisar</button>
			</form>
		</center>
		
	</div>
</main>



</body>
</html>
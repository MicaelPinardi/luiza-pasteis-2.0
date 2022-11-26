<?php
	session_start();
	if (!isset($_SESSION["logado"])||($_SESSION["logado"]!= TRUE) || ($_SESSION["funcao"] != "gerente") && ($_SESSION["funcao"] != "transportador")){
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

    <br><main>
        
        <div class="tabela">
            <table  width="90%" align="center">
                <h2>Área de transporte</h2>
                <thead>
                    <tr align="center">
                    <th width="80">ID do Pedido</th>
                        <th width="80">ID do Cliente</th>
                        <th width="80">ID do Produto</th>
                        <th width="80">Data</th>
                    <th width="80">Endereço</th>
                    <th width="80">uf</th>
                    <th width="80">Status</th>
                    <th width="80">Situação</th>
                    </tr>
                </thead>
                <tbody>
         <?php
                    $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
                    $sql   = "SELECT * FROM `tbpedido` WHERE `status` NOT LIKE 'Aguardando aprovação' AND `status` NOT LIKE 'Entregue' AND `status` NOT LIKE 'Falha na compra' ORDER BY `idCliente` DESC";
                    $resultado = mysqli_query($conexao,$sql);
                        while($linha = mysqli_fetch_array($resultado)){
                            echo "<tr>";
                            echo "<td align=center>".$linha['idPedido']."</td>";
                            echo "<td align=center>".$linha['idCliente']."</td>";
                            echo "<td align=center>".$linha['idProduto']."</td>";
                        echo "<td align=center>".$linha["data"]."</td>";
                        echo "<td align=center>".$linha["endereco"]."</td>";
                        echo "<td align=center>".$linha["uf"]."</td>";
                        echo "<td align=center>".$linha["status"]."</td>";
                        echo"<form action='status.php' method='get'>
                            <td align=center>
                                <button name='mudar' value=".$linha['idPedido'].">Alterar status</button>
                            </td>
                        </form>";
                    }
        ?>
        </div>
    </main>

</body>
</html>
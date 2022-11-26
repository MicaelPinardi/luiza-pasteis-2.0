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
  <title>Luiza Pastéis - Aprovar pedidos </title>
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
<main>
    
    <div class="tabela">
        <?php
        if(isset($_POST["aceitar"])&&($_POST["aceitar"]!=="")){
                $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
        
                $idped = $_POST["aceitar"];
        
                $sql = "UPDATE `tbpedido` SET `status` = 'Pronto para a entrega' WHERE `tbpedido`.`idPedido` = $idped;";
        
                $resultado = @mysqli_query($conexao, $sql);
                mysqli_close($conexao);
                header("Location: aprovar.php");
            }
        
            if(isset($_POST["recusar"])&&($_POST["recusar"]!=="")){
                $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
        
                $idped = $_POST["recusar"];
        
                $sql = "UPDATE `tbpedido` SET `status` = 'Falha na compra' WHERE `tbpedido`.`idPedido` = $idped;";
        
                $resultado = @mysqli_query($conexao, $sql);
                mysqli_close($conexao);
                header("Location: aprovar.php");
            }
        ?>
        
            <br>
        <div class="table">
            <table width="90%" align="center">
                <h2>Pedidos para Aprovação</h2>
                <br>
                <thead>
                    <tr align=center>
                        <th width="80">ID do Pedido</th>
                        <th width="80">ID do Cliente</th>
                        <th width="80">ID do Produto</th>
                        <th width="80">Preço Pago</th>
                        <th width="80">Data</th>
                        <th width="80">Endereço</th>
                        <th width="80">Pagamento</th>
                        <th width="40">Aprovar</th>
                        <th width="40">Recusar</th>
        
        
                    </tr>
                </thead>
                <tbody>
             <div class="aprovar">
                 <?php
                        $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
                        $sql   = "SELECT * FROM `tbpedido` WHERE `status` LIKE 'Aguardando aprovação' ORDER BY `idCliente` DESC";
                        $resultado = mysqli_query($conexao,$sql);
                            while($linha = mysqli_fetch_array($resultado)){
                                echo "<tr>";
                                echo "<td align=center>".$linha['idPedido']."</td>";
                                echo "<td align=center>".$linha['idCliente']."</td>";
                                echo "<td align=center>".$linha['idProduto']."</td>";
                                echo "<td align=center>".$linha['precoPago']."</td>";
                                echo "<td align=center>".$linha["data"]."</td>";
                                echo "<td align=center>".$linha["endereco"]."</td>";
                                echo "<td align=center>".$linha["pag"]."</td>";
                                echo"<form action='aprovar.php' method='post'>
                                        <td align=center>
                                            <button name='aceitar' value=".$linha['idPedido'].">&#10004;&#65039;</button>
                                        </td>
                                    </form>";
                                    echo"<form action='aprovar.php' method='post'>
                                    <td align=center>
                                        <button name='recusar' value=".$linha['idPedido'].">&#10060;</button>
                                    </td>
                                </form>";
                      }
                         ?>
             </div>
        </div>
    </div>
</main>

</body>
</html>
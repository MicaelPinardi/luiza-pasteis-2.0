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
  <title>Luiza Pastéis - Situação </title>
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

    <br>
<main>
<div class="tabela">
    
    <?php
    
    
    if(isset($_POST["status"])&&($_POST["status"]!=="")){
            $conexao = mysqli_connect("localhost", "root", "", "luiza-pasteis");
    
    
    
            $status = $_POST['status'];
    
            $sql = "UPDATE `tbpedido` SET `status` = '$status' WHERE `tbpedido`.`idPedido` = $_SESSION[idped];";
    
            $resultado = @mysqli_query($conexao, $sql);
            mysqli_close($conexao);
            header("Location: transporte.php");
        }
    
        $_SESSION['idped']= $_GET['mudar'];
    ?>
    
        <center>
        <h2>Alterar status</h2>
        <form action="status.php" method="POST">
            Novo status do produto: <input type="text" name='status'>
            <button type="submit">Alterar</button>
        </form>
        
        </center>
</div>
<a href="transporte.php"><button>Voltar</button></a>
</main>

</body>
</html>
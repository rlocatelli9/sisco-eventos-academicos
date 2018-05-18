<!DOCTYPE html>
<html>
<head>
 <link rel="icon" href="img/favicon.gif" />
<title>SISCO Eventos Acadêmicos</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

       <script type="text/javascript">
            <!--Selecione text campo cpf-->
            function selecionaTexto()
            {
                document.getElementById("cpf").select();
            }

            <!--setar foco no campo cpf-->
            function getfocus()
            {
                document.getElementById('cpf').focus();
            }

            <!--tirar foco no campo cpf-->
            function losefocus()
            {
                document.getElementById('cpf').blur();
            }

            <!--Seta foco e seleciona texto campo cpf-->
            function setFocoESelecionaTextoCampo(){
                document.getElementById('cpf').focus();
                document.getElementById("cpf").select();
            }

        </script>

</head>
<body>

<div class="container" >


<div padding-right: 15px;><p><a href="http://alegre.ifes.edu.br" target="_blank"><img src="img/background_cabecalho.jpg" ></a></div>
   <!--<header class="row-fluid">

   </header>-->
   <div class="row-fluid">
       <div role="main">
          <div class="container-fluid">
               <div class="row-fluid">
               <div class="span3">

    <!--<ul id="nav">
    <li><a href="#">Home</a></li>
    <li><a href="#">teste</a></li>
    <li><a href="#">Menu</a>
      <ul>
        <li><a href="#">submenu</a></li>
        <li><a href="#">submenu</a></li>
        <li><a href="#">submenu</a></li>
        <li><a href="#">submenu</a></li>
      </ul>
    </li>

    <li><a href="#">Contato</a></li>
  </ul>-->

            <div id="doc-esquerda" >
              <?php include "menu.php" ?>
			</div>

    </div>


       <div class="span9">
          <form method="POST">

           <select name="tipo_atividade" size="1">
             <option>Selecione...</option>
<?php
include 'conexao.php';

//$sql= "SELECT * FROM tipo_atividade ORDER by idtipo";
$sql= "SELECT titulo,comeco,fim FROM atividades";
$resultado = mysql_query($sql);
while ( $registro = mysql_fetch_array($resultado))
{?>

       <option value=?><?php echo $registro['titulo'].' Começo:'.$registro['comeco'].' Témino:'.$registro['fim'];?></option>


<?php } ?>
             </select>
           </form>

       </div>
  </div>
  </div>

</div>
<?php include "rodape.php" ?>

<!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

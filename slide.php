<!DOCTYPE html>
<html>
<head>

<title>SISCO Eventos Acad�micos</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
</style>
  
</head>
<body>

<div class="container" align="center">
 <div id="myCarousel" class="carousel slide" data-ride="carousel" >
  <!--indicadores -->
  <!--<ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>-->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/slides/img_1.jpg" alt="Chania">
      <div class="carousel-caption">
        <h3>Chania</h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
    </div>

    <div class="item">
      <img src="img/slides/img_2.jpg" alt="Chania">
      <div class="carousel-caption">
        <h3>Chania</h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
    </div>

    <div class="item">
      <img src="img/slides/img_3.jpg" alt="Flower">
      <div class="carousel-caption">
        <h3>Flowers</h3>
        <p>Beatiful flowers in Kolymbari, Crete.</p>
      </div>
    </div>

    <div class="item">
      <img src="img/slides/img_4.jpg" alt="Flower"></img>
            <div class="carousel-caption">
              <h3>Example headline.</h3>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.
              Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
    </div>
  </div>

  <!-- controles da esquerda e direita -->
  <a class="left carousel-control" data-slide="prev" href="#myCarousel">�  </a>
  <a class="right carousel-control" data-slide="next" href="#myCarousel">� </a>
</div>

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

            <div id="doc-esquerda">
              <?php include "menu.php" ?>
			</div>

    </div>
       <div class="span9">
       <br><br>
       P�gina Inicial
       <br>
       Fazendo um Teste, para saber como ir� ficar o texto que iremo colar na p�gina inical do sistema.
       <p>Lorem Ipsum � simplesmente uma simula��o de texto da ind�stria tipogr�fica e de impressos,
        e vem sendo utilizado desde o s�culo XVI, quando um impressor desconhecido pegou uma bandeja
         de tipos e os embaralhou para fazer um livro de modelos de tipos.</p>
        <p> Lorem Ipsum sobreviveu n�o s� a cinco s�culos, como tamb�m ao salto para a editora��o eletr�nica,
        permanecendo essencialmente inalterado. Se popularizou na d�cada de 60, quando a Letraset lan�ou decalques
        contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editora��o
        eletr�nica como Aldus PageMaker.</p>
         <div class="row-fluid">
               <div class="span4.5">
                 <div id="myCarousel" class="carousel slide" data-ride="carousel" >

                 <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                   <div class="item active">
                     <img src="img/slides/img_1.jpg" alt="Chania">
                     </div>

                     <div class="item">
                      <img src="img/slides/img_2.jpg" alt="Chania">
                      </div>

                      <div class="item">
                       <img src="img/slides/img_3.jpg" alt="Flower">
                         </div>

                         <div class="item">
                            <img src="img/slides/img_4.jpg" alt="Flower"></img>
                            </div>

                            <!-- controles da esquerda e direita -->
                             <a class="left carousel-control" data-slide="prev" href="#myCarousel">�  </a>
                             <a class="right carousel-control" data-slide="next" href="#myCarousel">� </a>
                     </div>
               </div>
               <div class="span4.5">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" >

                 <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                   <div class="item active">
                     <img src="img/slides/img_1.jpg" alt="Chania">
                     </div>

                     <div class="item">
                      <img src="img/slides/img_2.jpg" alt="Chania">
                      </div>

                      <div class="item">
                       <img src="img/slides/img_3.jpg" alt="Flower">
                         </div>

                         <div class="item">
                            <img src="img/slides/img_4.jpg" alt="Flower"></img>
                            </div>

                            <!-- controles da esquerda e direita -->
                             <a class="left carousel-control" data-slide="prev" href="#myCarousel">�  </a>
                             <a class="right carousel-control" data-slide="next" href="#myCarousel">� </a>
                     </div>
               </div>
        </div>

     </div>
  </div>
  </div>

</div>
<?php include "rodape.php" ?>

<script type="text/javascript">
  var $ = jQuery.noConflict();
  $(document).ready(function() {
      $('#myCarousel').carousel({ interval: 2000, cycle: true });
  });
</script>

</body>
</html>

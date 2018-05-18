<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Sisco Eventos - Verificar Certificado</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>
    </head>
    <body>
        <div class="container" >
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda" >
                                    <?php include "menu.php" ?>
                                </div>
                            </div>
                            <div class="span9">
                                <h3>Veracidade de certificados</h3>
                                <br>
                                <p style="font-size: 14px; text-align: left">Este página é destinada para verificar a veracidade dos certificados emitidos pelo SISCO Eventos Acadêmicos.                                    
                                <p style="font-size: 14px; text-align: left">Informe o nome corretamente impresso no certificado e o código do mesmo, para validação.</p>
                                <form name="verifica" method="POST" action="">
                                    <div class="form-group">
                                        <label for="InputDescricao">* Nome impresso no certificado:</label>
                                        <input id="nome" name="nome" type="text" class="form-control" maxlength="25" placeholder="Informe o nome" title="Informe o nome como está impresso no certificado"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputCodigo">* Código de Validação:</label>
                                        <input id="codigo" name="codigo" type="text" class="form-control" maxlength="25" placeholder="XXXXXXXXXX" title="Informe o código disponível no canto inferior esquerdo do certificado"/>
                                    </div>
                                    <input type="hidden" name="acao" value="pesquisar" />
                                    <button type="submit" class="btn btn-success" name="pesquisar" value="verificar">Verificar</button>
                                </form>
                                <?php
                                if (isset($_POST['acao']) && $_POST['acao'] == 'pesquisar') {
                                    $nome = filter_input(INPUT_POST, 'nome');
                                    $code = filter_input(INPUT_POST, 'codigo');

                                    require ('./conexao.php');
                                    $cod = mysql_query("SELECT idcertificado, participacao_Pessoa_idpessoa, ministrantes_Pessoa_idpessoa, comissao_Pessoa_idpessoa, comissao_evento_idevento, "
                                            . "participacao_atividades_idatividades, ministrantes_atividades_idatividades, codigo_validacao, pessoa.nome FROM certificado "
                                            . "INNER JOIN pessoa ON pessoa.idpessoa=participacao_Pessoa_idpessoa OR ministrantes_Pessoa_idpessoa OR comissao_Pessoa_idpessoa "
                                            . "WHERE codigo_validacao = '$code' AND nome= '$nome';") or die(mysql_error());
                                    $num=mysql_num_rows($cod);
                                    $cod2 = mysql_query("SELECT idcertificado_particip_evento, particip_evento_idparticipacao, particip_evento_idpessoa, particip_evento_idevento, "
                                            . "codigo_validacao, pessoa.nome FROM certificado_particip_evento "
                                            . "INNER JOIN pessoa ON pessoa.idpessoa=particip_evento_idpessoa "
                                            . "WHERE codigo_validacao = '$code' AND nome= '$nome';") or die(mysql_error());
                                    $number=mysql_num_rows($cod2);
                                    if ($num > 0) {
                                        $array_certificado = mysql_fetch_array($cod);
                                        echo '<b>Nome:</b> ' . $array_certificado['nome'] . '<br/>';
                                        echo '<b>Código:</b> ' . $array_certificado['codigo_validacao'] . '<br/>';
                                        ?>
                                        <div align = "center"><img src = "img/msg_valida.png" alt = "codigo_valido"></div>
                                        <?php
                                        exit();
                                    } elseif ($number > 0) {
                                        $array_certificado_evento = mysql_fetch_array($cod2);
                                        echo '<b>Nome:</b> ' . $array_certificado_evento['nome'] . '<br/>';
                                        echo '<b>Código:</b> ' . $array_certificado_evento['codigo_validacao'] . '<br/>';
                                        ?>
                                        <div align = "center"><img src = "img/msg_valida.png" alt = "codigo_valido"></div>
                                        <?php
                                        exit();
                                    } else {
                                        echo 'Informações inválidas!';
                                        ?>
                                        <div align = "center"><img src = "img/msg_nao_valida.png" alt = "codigo_invalido"></div>
                                        <?php
                                        exit();
                                    }
                                } else {
                                    ?>
                                    <div id = "image" style = "visibility: visible">
                                        <p style = "font-size: 14px; text-align: left">O código para verificação, encontra-se no canto inferior direito do certificado.
                                            <br/>
                                        <div align = "center"><img src = "img/valid_certificado1.png" onmouseover = "this.src = 'img/valid_certificado2.png'" onmouseout = "this.src = 'img/valid_certificado1.png'" alt = "certificado"></div>
                                        <br />
                                    </div>
                                <?php } ?>
                                <br/>
                            </div>
                        </div>
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


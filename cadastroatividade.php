<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
include 'conexao.php';
// A sess?o precisa ser iniciada em cada p?gina diferente
if (!isset($_SESSION)) {
    session_start();
}
// Verifica se n?o h? a vari?vel da sess?o que identifica o usu?rio
if (!isset($_SESSION['UsuarioNome']) && $_SESSION['UsuarioID']) {
    // Destr?i a sess?o por seguran?a
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: validacao.php");
    exit;
}
if (isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    require ('cadastraratividade.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Cadastro de Atividade</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>
        <script>
            $(function () {
                $("#from").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);
                    }
                });
                $("#to").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onClose: function (selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg"></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda">
                                    <?php include "./menu_usuario.php" ?>
                                </div>                             
                            </div>                          
                            <div class="span9">
                                <?php include './bar.php'; ?>
                                <br />
                                <form class="form-horizontal" id="cadastro" name="cadastro" method="POST" action="" onsubmit="return validaCampo();
                                        return false;">
                                    <table id="t01" style="margin-left: auto; margin-right: auto">
                                        <thead>
                                            <tr>
                                                <th>Cadastro de Atividade</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br/>
                                    <div class="form-group">
                                        <?php
                                        #chama o arquivo de configura��o com o banco
                                        require 'conexao.php';

                                        #seleciona os dados da tabela produto
                                        $queri = mysql_query("SELECT idevento, titulo FROM evento ORDER BY titulo ASC;");


                                        # abaixo montamos um formul�rio em html
                                        # e preenchemos o select com dados
                                        ?>
                                        <label for="SelectEvento">Qual evento será vinculado</label>
                                        <select id="evento" name="evento">
                                            <option>Selecione...</option>

                                            <?php while ($evento = mysql_fetch_array($queri)) { ?>
                                                <option value="<?php echo $evento['idevento'] ?>"><?php echo utf8_encode($evento['titulo']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        #chama o arquivo de configura��o com o banco
                                        require 'conexao.php';

                                        #seleciona os dados da tabela produto
                                        $query = mysql_query("SELECT idtipo, descricao FROM tipo_atividade ORDER BY descricao ASC;");


                                        # abaixo montamos um formul�rio em html
                                        # e preenchemos o select com dados
                                        ?>
                                        <label for="SelectAtividade">Selecione o tipo de atividade</label>
                                        <select id="atividade" name="atividade">
                                            <option>Selecione...</option>

                                            <?php while ($atividade = mysql_fetch_array($query)) { ?>
                                                <option value="<?php echo $atividade['idtipo'] ?>"><?php echo utf8_encode($atividade['descricao']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputTitulo">Título</label>
                                        <input id="titulo" name="titulo" type="text" class="form-control" placeholder="Titulo da atividade" title="Titulo da atividade" onkeyup="toUpper(this);">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDescricao">Descrição</label>
                                        <textarea id="descricao" name="descricao" class="form-control" placeholder="Descreva o que será abordado." title="Descreva o que será abordado"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputInicio">horário de início</label>
                                        <input type="text"  name="inicio" id="inicio" placeholder="00:00:00" title="00:00:00">

                                        <label for="InputFim">e fim</label>
                                        <input type="text"  name="fim" id="fim" placeholder="00:00:00" title="00:00:00">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputData">Data</label>
                                        <input type="date"  name="data" id="from" title="Informe a data que ocorrerá">

                                        <label for="InputCargahoraria">Carga Horária</label>
                                        <input type="text" id="cargahoraria" name="cargahoraria" placeholder="Informe somente número inteiro" title="Informe a duração da atividade em número inteiro"/>
                                    </div>
                                    <input type="hidden" name="acao" value="adicionar" />
                                    <button type="submit" class="btn btn-success" name="adicionar" title="adicionar">Adicionar atividade</button>
                                </form>
                                <br>
                                <div align="left">
                                    <span class="icon-backward"></span>
                                    <a class="link" href="all_eventos.php">EXIBIR TODOS EVENTOS</a>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <?php include "rodape.php" ?>
    </body>
</html>
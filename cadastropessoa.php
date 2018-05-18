<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
if (isset($_POST['acao']) && $_POST['acao'] == 'enviar') {
    require ('cadastrarpessoa.php');
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
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1900:+0'
                });
            });
        </script>
        <script language="Javascript">
            $(document).ready(function () {

                $('#Email').keyup(validacaoEmail);
            });
            function validacaoEmail(field) {
                usuario = field.value.substring(0, field.value.indexOf("@"));
                dominio = field.value.substring(field.value.indexOf("@") + 1, field.value.length);

                if ((usuario.length >= 1) &&
                        (dominio.length >= 3) &&
                        (usuario.search("@") === -1) &&
                        (dominio.search("@") === -1) &&
                        (usuario.search(" ") === -1) &&
                        (dominio.search(" ") === -1) &&
                        (dominio.search(".") !== -1) &&
                        (dominio.indexOf(".") >= 1) &&
                        (dominio.lastIndexOf(".") < dominio.length - 1)) {
                    $('#Email').css('border', '3px #090 solid');
                    document.getElementById("msgemail").innerHTML = '<img style="display: inline;" id="cross" src="img/tick.png" height="16" width="16"> E-mail válido';
                    //alert("E-mail valido");
                }
                else {
                    $('#Email').css('border', '3px #C33 solid');
                    document.getElementById("msgemail").innerHTML = '<img style="display: inline;" id="cross" src="img/cross.png" height="16" width="16"><font color="red"> E-mail não permitido. </font>';
//                    alert("E-mail invalido");
                }
            }
        </script>
        <style>
            #username{
                padding:3px;
                font-size:18px;
                border:3px #CCC solid;
            }
        </style>
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
<?php include "menu.php" ?>
                                </div>                             
                            </div>                          
                            <div class="span9">
                                <br>
                                <form id="cadastro" name="cadastro" method="POST" action="" onsubmit="return validaCampo();
                                        return false;">
                                    <table id="t01" style="margin-left: 40%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center" colspan="2">Cadastro de Usuário</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br/>
                                    <div class="form-group">
                                        <label for="InputDescricao">* Nome Completo:</label>
                                        <input id="Name" name="Nome" type="text" class="form-control" maxlength="25" placeholder="Insira seu nome" title="Insira seu nome Completo"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDescricao">* Sexo:</label>
                                        <input type="radio" name="Sexo" value="Masculino" /> Masculino 
                                        <input type="radio" name="Sexo" value="Feminino" /> Feminino
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDescricao">* CPF:</label>
                                        <input id="Cpf" name="Cpf" type="text" size="11" maxlength="11" onblur="return VerificaCPF();
                                                return false;">

                                        <label for="InputData">* Data de Nascimento: </label>
                                        <input type="date"  name="Data_Nasc" id="datepicker" title="Informe a data de nascimento">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="InputEmail">* Email válido:</label>
                                        <input id="Email" name="Email"  class="form-control" type="text" placeholder="exemplo@email.com" title="informe um email válido" oninput="validacaoEmail(cadastro.Email)">
                                        <div id="msgemail"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="InputOrigem">* Instituição de Origem:</label>
                                        <select id="Origem" name= "Origem" size="1">
                                            <option>Selecione...</option>
                                            <option value="Ifes">Instituições Ifes</option>
                                            <option value="Outra">Outra Instituição</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="InputTelefone">* Campus da Instituição:</label>
                                        <input id="Nome_inst" name="Nome_Instituicao" class="form-control" maxlength="23" type="text" title="Campus da Instituição" placeholder="Informe o Campus de origem">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="InputTelefone">* Telefone:</label>
                                        <input id="Tel" name="Telefone" type="tel" class="form-control" size="11" maxlength="11" title="Telefone" placeholder="Informe o telefone para contato">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="InputTelefone">* Cidade:</label>
                                        <input id="Cidade" name="Cidade" type="text" title="Cidade" placeholder="Informe a cidade de origem">

                                        <label class="control-label" for="InputTelefone">* Estado:</label>
                                        <input id="UF" name="Estado" type="text" size="2" maxlength="2" title="Estado" placeholder="Informe a sigla do estado">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="InputSenha">* Senha:</label>
                                        <input id="Senha" name="Senha" type="password" required placeholder="Digite uma Senha" title="Senha" />

                                        <label class="control-label" for="InputConfirma">* Confirma Senha:</label>
                                        <input id="ConfSenha" name="ConfSenha" type="password" required  placeholder="Repetir Senha" title="Repetir Senha" oninput="return ValidarSenha(this);" />

                                    </div>

                                    <input type="hidden" name="acao" value="enviar" />
                                    <button type="submit" class="btn btn-success" name="enviar" title="Cadastrar" onclick="alert('Seus dados serão verificados!');">Enviar Cadastro</button>
                                </form>                                
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
<?php include "rodape.php" ?>
            </div>
        </div>
    </body>
</html>
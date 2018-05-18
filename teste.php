<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CADASTRO DE CLIENTES COM BANCO DE DADOS E PHP</title>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-size: x-small;
}
.style3 {color: #0000FF; font-size: x-small; }
-->
</style>

<script type="text/javascript">
function validaCampo()
{
if(document.cadastro.nome.value=="")
	{
	alert("O Campo nome é obrigatório!");
	return false;
	}
else
	if(document.cadastro.email.value=="")
	{
	alert("O Campo email é obrigatório!");
	return false;
	}
else
	if(document.cadastro.endereco.value=="")
	{
	alert("O Campo endereço é obrigatório!");
	return false;
	}
else
	if(document.cadastro.cidade.value=="")
	{
	alert("O Campo Cidade é obrigatório!");
	return false;
	}
else
	if(document.cadastro.estado.value=="")
	{
	alert("O Campo Estado é obrigatório!");
	return false;
	}
else
	if(document.cadastro.bairro.value=="")
	{
	alert("O Campo Bairro é obrigatório!");
	return false;
	}
else
	if(document.cadastro.pais.value=="")
	{
	alert("O Campo país é obrigatório!");
	return false;
	}
else
	if(document.cadastro.login.value=="")
	{
	alert("O Campo Login é obrigatório!");
	return false;
	}
else
if(document.cadastro.senha.value=="")
	{
	alert("Digite uma senha!");
	return false;
	}
else
return true;
}
<!-- Fim do JavaScript que validará os campos obrigatórios! -->
</script>

<script>

var w=1
var h=1

if (document.getElementById || document.all)
document.write('<div id="trailimageid" style="position:absolute;visibility:hidden;left:0px;top:-1000px;width:1px;height:1px;border:1px solid #888888;background:#DDDDDD;"><img id="ttimg" src="img/s.gif" /></div>')

function gettrailobj()
{
    if (document.getElementById) return document.getElementById("trailimageid").style
    else if (document.all) return document.all.trailimagid.style
}

function truebody()
{
    return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function hidetrail()
{
    document.onmousemove=""
    document.getElementById('ttimg').src='/img/s.gif'
    gettrailobj().visibility="hidden"
    gettrailobj().left=-1000
    gettrailobj().top=0
}


function showtrail(width,height,file)
{
    if(navigator.userAgent.toLowerCase().indexOf('opera') == -1)
    {
        w=width
        h=height

        // followmouse()

        document.getElementById('ttimg').src=file
        document.onmousemove=followmouse
        gettrailobj().visibility="visible"
        gettrailobj().width=w+"px"
        gettrailobj().height=h+"px"


    }
}


function followmouse(e)
{

    if(navigator.userAgent.toLowerCase().indexOf('opera') == -1)
    {

        var xcoord=20
        var ycoord=20

        if (typeof e != "undefined")
        {
            xcoord+=e.pageX
            ycoord+=e.pageY
        }
        else if (typeof window.event !="undefined")
        {
            xcoord+=truebody().scrollLeft+event.clientX
            ycoord+=truebody().scrollTop+event.clientY
        }

        var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15
        var docheight=document.all? Math.max(truebody().scrollHeight, truebody().clientHeight) : Math.max(document.body.offsetHeight, window.innerHeight)

        if (xcoord+w+3>docwidth)
        xcoord=xcoord-w-(20*2)

        if (ycoord-truebody().scrollTop+h>truebody().clientHeight)
        ycoord=ycoord-h-20;

        gettrailobj().left=xcoord+"px"
        gettrailobj().top=ycoord+"px"

    }

}
</script>

</head>

<body>

<form id="cadastro" name="cadastro" method="post" action="cadastro.php" onsubmit="return validaCampo(); return false;">
  <table width="625" border="0">
    <tr>
      <td width="69">Nome:</td>
      <td width="546"><input name="nome" type="text" id="nome" size="70" maxlength="60" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input name="email" type="text" id="email" size="70" maxlength="60" />
      <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Sexo:</td>
      <td><input name="sexo" type="radio" value="Masculino" checked="checked" />
        Masculino
        <input name="sexo" type="radio" value="Feminino" />
        Feminino <span class="style1">*</span> </td>
    </tr>
    <tr>
      <td>DDD:</td>
      <td><input name="ddd" type="text" id="ddd" size="4" maxlength="2" />
      Telefone:
        <input name="telefone" type="text" id="telefone" />
        <span class="style3">Apenas n&uacute;meros</span> </td>
    </tr>
    <tr>
      <td>Endere&ccedil;o:</td>
      <td><input name="endereco" type="text" id="endereco" size="70" maxlength="70" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Cidade:</td>
      <td><input name="cidade" type="text" id="cidade" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Estado:</td>
      <td><select name="estado" id="estado">
        <option>Selecione...</option>
        <option value="AC">AC</option>
        <option value="AL">AL</option>
        <option value="AP">AP</option>
        <option value="AM">AM</option>
        <option value="BA">BA</option>
        <option value="CE">CE</option>
        <option value="ES">ES</option>
        <option value="DF">DF</option>
        <option value="MA">MA</option>
        <option value="MT">MT</option>
        <option value="MS">MS</option>
        <option value="MG">MG</option>
        <option value="PA">PA</option>
        <option value="PB">PB</option>
        <option value="PR">PR</option>
        <option value="PE">PE</option>
        <option value="PI">PI</option>
        <option value="RJ">RJ</option>
        <option value="RN">RN</option>
        <option value="RS">RS</option>
        <option value="RO">RO</option>
        <option value="RR">RR</option>
        <option value="SC">SC</option>
        <option value="SP">SP</option>
        <option value="SE">SE</option>
        <option value="TO">TO</option>
          </select>
        <span class="style1">*      </span></td>
    </tr>
    <tr>
      <td>Bairro:</td>
      <td><input name="bairro" type="text" id="bairro" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Pa&iacute;s:</td>
      <td><input name="pais" type="text" id="pais" maxlength="20" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Login:</td>
      <td><input name="login" type="text" id="login" maxlength="12" />
        <span class="style1">*</span></td>
    </tr>
    <tr>
      <td>Senha:</td>
      <td><input name="senha" type="password" id="senha" maxlength="12" />
          <span class="style1">*</span></td>
    </tr>
    <tr>
      <td colspan="2"><input name="news" type="checkbox" id="news" value="ATIVO" checked="checked" />
Desejo receber novidades e informa&ccedil;&otilde;es sobre o conte&uacute;do deste site. </td>
    </tr>
    <tr>
      <td colspan="2"><p>
        <input name="cadastrar" type="submit" id="cadastrar" value="Concluir meu Cadastro!" />
        <br />
          <input name="limpar" type="reset" id="limpar" value="Limpar Campos preenchidos!" />
          <br />
          <span class="style1">* Campos com * s&atilde;o obrigat&oacute;rios!          </span></p>
      <p>&nbsp; </p></td>
    </tr>
  </table>
</form>

      <div class="thumb_img">
<!-- o campo 600,200 � o tamanho da div. Configure-o para o tamanho da imagem real -->
    <span onmouseover="showtrail(469,159,'glyphicons-halflings.png');" onmouseout="hidetrail(469,159,'glyphicons-halflings.png');">
        <img src="glyphicons-halflings.png" border='0' />
<!-- N�o esque�a de adicionar Height e Width para faz�-la miniatura -->
    </span>
</div>

<!-- Para acrescentar mais uma imagem � s� copiar uma div inteira e modificar o caminho da imagem -->

<!-- Para acrescentar mais uma imagem � s� copiar uma div inteira e modificar o caminho da imagem -->
</body>
</html>

<div class="menu_fixo" >
    <h4 class="negrito">Menu Principal</h4>
    <fieldset class="scheduler-border">
        <!--<legend class="scheduler-border">SISCO - M�DULO WEB</legend>-->
        <div id="menu-institucional-cs" >
            <div id="menu-institucional-ci" class="moduletable tit_menu_institucional" >
                <h4>Menu_institucional</h4>
                <ul class="menu" ><li class="item30"><a href="./index.php" title="Página inicial"><span>Página Inicial</span></a></li>
                    <li class="item2" ><a href="./cadastropessoa.php" title="Cadastrar no sistema"><span>Cadastre-se</span></a></li>
                    <li class="item55"><a href="./ajuda.php" title="Perguntas frequentes"><span>Perguntas frequentes</span></a></li>
                    <li class="item55"><a href="./certificado.php" title="Verificar veracidade do certificado"><span>Validar certificado</span></a></li></ul> </div>
        </div>
    </fieldset>
    <br>
    <br>
    <fieldset class="scheduler-border">
        <form id="myForm" class="negrito" method="POST" action="validacao.php">
            <label>Email:</label>
            <br/>
            <input type="text" id="txEmail" name="email"  placeholder="email@exemplo.com" style="width:130px" title="Informe o email"/>
            <br/>
            <label>Senha:</label>
            <br/>
            <input type="password" id="txSenha" name="senha" placeholder="*******" style="width:130px" title="Informe a senha"/>
            <br/>
            <span style="font-size:0.7em"><a href="recuperar_senha.php">Recuperar senha</a></span>
            <br/>
            <button type="submit" class="btn btn-success" name="logar" value="Logar">Logar</button>
        </form>
    </fieldset>
</div>
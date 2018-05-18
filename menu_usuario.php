<div class="menu_fixo" >
    <div class="topo_menu">
        <p></p>
    </div>
    <fieldset class="scheduler-border">
        <!--<legend class="scheduler-border">SISCO - M?DULO WEB</legend>-->
        <div id="menu-institucional-cs" >
            <div id="menu-institucional-ci" class="moduletable tit_menu_institucional" >
                <h4>Menu_institucional</h4>
                <ul id="menu" >
                    <?php if ($_SESSION['UsuarioID'] == 3) { ?>
                    <li class="item30"><a href="administrador.php" title="Página inicial"><span>Página Inicial</span></a></li>
                    <li class="item34"><a href="alteraparticipante.php?id=3" title="Exibir informações pessais"><span>Meus dados</span></a></li>
                        <li class="item35"><a href="all_eventos.php" title="Eventos disponíveis"><span>Eventos cadastrados</span></a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Gerenciar informações">Cadastros <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="cadastroevento.php">Eventos</a></li>
                                <li ><a href="cadastrocomissao.php">Comissao</a></li>
                                <li><a href="cadastroatividade.php">Atividades</a></li>
                                <li ><a href="cadastroministrante.php">Ministrantes</a></li>
                                <li ><a href="cadastrousuario.php">Usuários</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Editar informações">Editar <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="alteraevento.php">Eventos</a></li>
                                <li ><a href="consultarparticipante.php">Usuários</a></li>
                            </ul>
                        </li>
                        <li><a href="relatorio.php" title="Relatórios">Relatórios</a></li>
                    <?php } else { ?>
                        <li class="item30"><a href="participante.php" title="Página inicial"><span>Página Inicial</span></a></li>
                        <li class="item33"><a href="all_eventos.php" title="Eventos disponíveis"><span>Eventos Disponíveis</span></a></li>
                    <?php } ?>

                </ul> 
            </div>
        </div>
    </fieldset>
    <br>
    <div id="login_user">
        <span class="f_texto_acesso"></span>
        <form name="login" id="login" method="post" action="" style="margin-top:15px;" onsubmit="javascript:Verifica_Form(email_Membro.value, senha_Membro.value);
                return false;">
            <div id="login_user_panel"><?php echo $_SESSION['UsuarioNome']; ?><br><br><?php if ($_SESSION['UsuarioID'] == 3) { ?>
                    <span Style="text-align: left"><a href="administrador.php" class="f_acesso_link"><i class="icon-user"></i> Área do Administrador</a>
                    <?php } else { ?> 
                        <i class="icon-user"></i><a href="participante.php" class="f_acesso_link"> Área do Usuário</a> 
                    <?php } ?><br><a href="logout.php" class="f_acesso_link"><i class="icon-off"></i> Sair</a></span></div>
        </form>
    </div>
</div>
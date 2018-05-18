<?php
// Faz o Select pegando o registro inicial até a quantidade de registros para página
$sql_minicurso = mysql_query("SELECT atividades.idatividades, atividades.titulo, atividades.data, atividades.inicio, tipo_atividade.descricao FROM atividades "
        . "INNER JOIN tipo_atividade ON tipo_atividade.idtipo=atividades.tipo_atividade_idtipo "
        . "WHERE ativo=1 AND evento_idevento=$idE AND tipo_atividade.descricao='Minicurso' ORDER BY data DESC");
$conta = mysql_num_rows($sql_minicurso);
if ($conta == 0) {
    ?>
<?php } else {
    ?>

    <table class = "table table-condensed">
        <tbody>
            <tr class = "info">
                <td colspan = "5"><div class = "negrito" align = "center"><strong>MINICURSO</strong></div></td>
            </tr>
            <tr style = "text-align: center">
                <td width = "100"><strong>Descrição</strong></td>
                <td width = "200"><strong>Titulo</strong></td>
                <td><strong>Data</strong></td>
                <td><strong>Hora</strong></td>
                <td><strong></strong></td>
            </tr>
            <tr>

                <?php
                while ($array_atividade = mysql_fetch_array($sql_minicurso)) {
                    ?>  
                    <td><font color="#000000"><?php echo utf8_encode($array_atividade['descricao']); ?></font></td>
                    <td><font color="#000000"><strong><?php echo utf8_encode($array_atividade['titulo']); ?></strong></font></td>
                    <td><font color="#000000"><?php echo $array_atividade['data']; ?></font></td>
                    <td><font color="#000000"><?php echo $array_atividade['inicio']; ?></font></td>
                    <td>
                        <?php
                        $idminicurso = $array_atividade['idatividades'];
                        $query = mysql_query("SELECT idparticipante, atividades_idatividades, Pessoa_idpessoa FROM participacao "
                                . "WHERE Pessoa_idpessoa=$idpessoa AND atividades_idatividades=$idminicurso;");
                        $select_array = mysql_fetch_array($query);
                        $conte = mysql_num_rows($query);
                        $idparticipante = $select_array['idparticipante'];
                        if ($conte > 0) {
                            ?>
                            <div align="center">
                                <form name="palestra" method="GET" action="">
                                    <?php $idparticipante = $select_array['idparticipante']; ?>
                                    <span><a class="btn btn-small btn-danger " href="cancel_parti_atividade.php?id=<?php echo $idparticipante; ?>&idE=<?php echo $idE; ?>"><i class="icon icon-remove-sign" title="Cancelar participação na atividade"></i></a></span>
                                    
                                </form>
                            </div>
                        <?php } else { ?>
                            <form name = "minicurso" method = "POST" action = "participaratividade.php">
                                <input type="hidden" name="idevento" value="<?php echo $idE; ?>">
                                <input type="hidden" name="idatividade" value="<?php echo $idminicurso; ?>">
                                <input type="hidden" name="acao" value="participar">
                                <input type="submit" name="participar" class="btn btn-success" value="Participar" title="Partcipar da atividade">
                            </form>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<br/>
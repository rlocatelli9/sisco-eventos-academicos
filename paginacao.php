<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>    
        <?php
        $quant_pg = ceil($quantreg / $numreg);
        $quant_pg++;
        // Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
        if (filter_input(INPUT_GET, 'pg')  > 0) {
            echo "<a href=" . filter_input(INPUT_SERVER, 'PHP_SELF') . "?pg=" . (filter_input(INPUT_GET, 'pg')  - 1) . "><b>&laquo; anterior</b></a>";
        } else {
            echo "<font color=#CCCCCC>&laquo; anterior</font>";
        }
        // Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
        for ($i_pg = 1; $i_pg < $quant_pg; $i_pg++) {
            // Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
            if (filter_input(INPUT_GET, 'pg')  == ($i_pg - 1)) {
                echo "&nbsp;<span class=pgoff>[$i_pg]</span>&nbsp;";
            } else {
                $p = $i_pg - 1;
                $i_pg2 = $i_pg;
                echo "&nbsp;<a href=" . filter_input(INPUT_SERVER, 'PHP_SELF') . "?pg=$p class=pg><b>$i_pg2</b></a>&nbsp;";
            }
        }
        // Verifica se está na ultima página, se nao estiver ele libera o link para próxima
        if ((filter_input(INPUT_GET, 'pg')  + 2) < $quant_pg) {
            echo "<a href=" . filter_input(INPUT_SERVER, 'PHP_SELF') . "?pg=" . (filter_input(INPUT_GET, 'pg')  + 1) . " class=pg><b>proximo &raquo;</b></a>";
        } else {
            echo "<font color=#CCCCCC>proximo &raquo;</font>";
        }
        ?>
    </body>
</html>
<!doctype html>
<html lang="pt-BR">
    <head>
            <meta charset="UTF-8">
            
            <?php
                //INSTANCIANDO A CLASSE MetodosExtras.php;
                //require 'util/MetodosExtras.php';//temporário
                $me = new MetodosExtras();
                
                //Fazendo a requisição do CSS dinamicamente.
                $me->addCSS('normalize');
                $me->addCSS('geral');
                $me->addCSS('shadowbox','shadowbox-3.0.3');
                
                //Fazendo a requisição do JS dinamicamente.
                $me->addJS('jquery');
                $me->addJS('pluguinsJQ');
                $me->addJS('validacoes');
                $me->addJS('shadowbox','css/shadowbox-3.0.3');
                $me->addJS('mascaras');
                $me->addJS('prototype');
                $me->addJS('localizacaoAjax');
            ?>    
            <title>Artifice</title>      
            
    </head>
    <body>
        <!-- FIM PRINCIPAL -->
        <section class="principal">
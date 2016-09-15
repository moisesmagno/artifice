<!-- CONTEÚDO -->
<article class="conteudo">
    <form name="form_desativarConta" class="form_desativarConta" action="<?php echo URLPH.DS;?>Usuario/DesativaConta" method="post">
        
        <h1>Deseja nos deixar ? :(</h1>
        <a href='<?php echo URLPH.DS;?>home/home'>Não</a>
        <input type="submit" value='Sim'>
        
        <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        <?php
            if(isset($_GET['op']) && !empty($_GET['op'])):
                $op = $_GET['op'];
                
                switch($op):
                    case 'um':
        ?>
                           <p class="merro">Ocorreu um erro ao tentar Excluir sua conta!</p>
        <?php
                          break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
    </form>    

</article><!-- FIM CONTEÚDO -->


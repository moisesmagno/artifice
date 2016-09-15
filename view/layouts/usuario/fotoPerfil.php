<!-- CONTEÚDO -->
<article class="conteudo">

    <section class="env_foto_perfil">
        <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        <?php
            if(isset($_GET['op']) && !empty($_GET['op'])):
                $op = $_GET['op'];
                
                switch($op):
                    case 'um':
        ?>
                           <p class="merro">Não foi Possivel fazer Upload da Imagem, contate a lenilson_pires@ig.com.br !</p>
        <?php
                          break;
                    case 'dois':
        ?>
                            <p class="malerta">Por favor, envie arquivo com as seguintes extensoes: jpg, jpeg, png ou gif !</p> 
        <?php                    
                        break;
                    case 'tres':
        ?> 
                            <p class="malerta">O arquivo e muito grande, envie um arquivo de até 15MB !</p>
        <?php
                        break;
                    case 'quatro':
        ?>
                            <p class="msucesso">O Upload da foto do seu perfil, foi um sucesso :)</p>     
        <?php                            
                        break;
                    case 'cinco':
       ?>
                        <p class="merro">Ocorreu um erro ao tentar fazer o Upload da imagem, por favor contate lenilson_pires@ig.com.br !</p>
       <?php
                         break;
                   case 'seis':
       ?>
                        <p class="merro">Por favor escolha uma imagem a ser inserida!</p>
       <?php     
                        break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        
        <h1>Editar a Foto do Perfil</h1>

        <figure class="imagem_perfil_editar">
            <img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu/'.DS.$dadosusuario['foto_perfil'];?>">
        </figure>

        <form name="form_foto_perfil" class="form_foto_perfil" action="<?php echo URLPH.DS;?>Usuario/InserirFotoPerfil" method="post" enctype="multipart/form-data">
            <input type="file" name="arquivo" required><br><br><br><br><br>
            <input type="hidden" name="Perfil">
            <input type="submit" value="Inserir Foto">
        </form>
    </section>

</article><!-- FIM CONTEÚDO -->

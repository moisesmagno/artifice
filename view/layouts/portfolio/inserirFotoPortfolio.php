<!-- CONTEÚDO -->
<article class="conteudo">

    <!-- INSERÇÃO DE IMAGEM E DESCRIÇÃO PARA O PORTFOLIO -->
    <div class="evl_add_foto_desc">
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
                                <p class="msucesso">Sua Foto, Título e Descrição foram adicionandos com sucesso :)</p>     
            <?php                            
                            break;
                        case 'cinco':
           ?>
                            <p class="merro">Ocorreu um erro ao tentar fazer o Upload da imagem, por favor contate lenilson_pires@ig.com.br !</p>
           <?php
                             break;
                       case 'seis':
           ?>
                            <p class="merro">Os campos titulo e descrição tem que que ser preenchidos obrigatoriamente!</p>
           <?php     
                            break;
                        case 'sete':
           ?>
                            <p class="merro">Os Campos da imagem, titulo e descrição tem que ser preenchido obrigatoriamente!</p>
           <?php     
                            break;
                        case 'oito':
           ?>
                            <p class="merro">Ocorreu um erro ao tentar inserir o titulo e descrição da imagem no banco, contate a lenilson_pires@ig.com.br!</p>
           <?php     
                            break;
                    endswitch;
                endif;
            ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        
        <form name="fotm_add_foto_desc" class="fotm_add_foto_desc" action="<?php echo URLPH.DS;?>Portfolio/InserirFotoPortfolio" method="post" enctype="multipart/form-data">
            <h2>Inserir uma foto e descrição para o Portfolio.</h2>
            <input type="file" name="arquivo" title="pasta" required><br>
            <input type="text" name="titulo" title="Titulo" placeholder="Título" required><br>    
            <textarea name="descricao" title="Descrição" placeholder="Descrição" required rows="10"></textarea><br>   
            <input type="hidden" name="Portfolio">
            <input type="submit" value="Inserir">
        </form>    

        <hr class="hr_separador">

    </div><!-- FIM INSERÇÃO DE IMAGEM E DESCRIÇÃO PARA O PORTFOLIO -->

    <!-- PORTFOLIO -->
     <section class="porfolio">
        <?php 
            //Recupera o portfolio completo do usuário.
            if(!empty($portfolio)):
                foreach($portfolio as $key):
        ?>
         <div class="fotodesc empurra_fotodesc">
            <figure class="foto_port">
                <img src="<?php echo URLPH.VWPH.IMGPH.DS.'portfolio'.DS.$key['foto'];?>" title="Foto do Portfolio">
            </figure>
            <div class="env_tt_desc">
                <span class="datahoraport"><?php echo $key['datahora'];?></span>
                <h4><?php echo utf8_encode($key['titulo'])?></h4>
                <p><?php echo utf8_encode($key['descricao']); ?></p>
            </div>
        </div>
       <?php 
                endforeach; 
            else:
       ?>
           <p class="portedin"> Insira um Portfolio e mostre ao mundo o seu talento :)</p>
       <?php  
            endif;
       ?>  

     </section><!-- PORTFOLIO -->   
</article><!-- FIM CONTEÚDO -->

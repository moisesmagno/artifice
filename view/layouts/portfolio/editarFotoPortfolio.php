<!-- CONTEÚDO -->
<article class="conteudo">

    <h1 class="tt_editar_foto_port">Editar Fotos e Descrições do Portfolio.</h1>

    <!-- PORTFOLIO -->
     <section class="porfolio">
         <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
            <?php
                if(isset($_GET['op']) && !empty($_GET['op'])):
                    $op = $_GET['op'];

                    switch($op):
                        case 'um':
            ?>
                               <p class="merro">Os campos Título e Descrição, não podem ser enviados vazios!</p>
            <?php
                              break;
                        case 'dois':
            ?>
                               <p class="msucesso">Atualização efetuada com sucesso :)</p> 
            <?php                    
                            break;
                        case 'tres':
            ?> 
                                <p class="malerta">Ocorreu um erro na hora de atualiza o portfolio, conta-te a lenilson_pires@ig.com.br!</p>
            <?php    
                            break;
                        case 'quatro':
            ?> 
                                <p class="msucesso">O Portfolio escolhido, foi Excluido com sucesso!</p>
            <?php    
                            break;
                        case 'cinco':
            ?> 
                                <p class="merro">Ocorreu um erro na hora da exclusão do Portfolio, conta-te a lenilson_pires@ig.com.br!</p>
            <?php    
                            break;
                    endswitch;
                endif;
            ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
         
         
         <?php
            //Recupera o portfolio completo do usuário.
            if(!empty($portfolio)):
                foreach($portfolio as $key):
         ?>
         <div class="fotodesc empurra_fotodesc">
            <figure class="foto_port">
                <img src="<?php echo URLPH.VWPH.IMGPH.DS.'portfolio'.DS.$key['foto'];?>" title="Foto do Portfolio">
            </figure>

             <form name="editar_foto_portfolio" class="editar_foto_portfolio" action="<?php echo URLPH.DS;?>Portfolio/EditaPortfolio" method="post">
                <input type="text" name="titulo" Title="Título" placeholder="Titulo" value="<?php echo utf8_encode($key['titulo']);?>" required>
                <textarea name="descricao" Title="Descrição" placeholder="Descrição" required><?php echo utf8_encode($key['descricao']);?></textarea>
                <a href="<?php echo URLPH.DS.'Portfolio/ExcluirPortfolio&idport='.$key['id'];?>"><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>delete.png" title="Excluir Foto e Descrição"></a>
                <input type="hidden" name="id" value="<?php echo $key['id'];?>">
                <input type="submit" value="Alterar">
            </form>    
        </div>
       <?php
                endforeach;
           else: 
       ?>
            <p class="portedin"> Desculpe, mais você ainda não adicionou um Portfolio.<br>Não perca tempo, <a href="<?php echo URLPH.DS;?>Portfolio/Inserir"><span>CLIQUE AQUI</span></a> e insira um.</p>
       <?php      
           endif;
       ?>  

     </section><!-- PORTFOLIO -->   
</article><!-- FIM CONTEÚDO -->

<!-- CONTEÚDO -->
<article class="conteudo">

    <!-- ENVOLVE FORMAÇÕES -->   
    <div class="env_experiencias">
        <h1>Editar Experiência Profissionais</h1>
        
        <?php 
            if(!empty($ex)):
                
                // MENSAGENS DE ERRO, ALERTA E SUCESSO
                   if(isset($_GET['op']) && !empty($_GET['op'])):
                       $op = $_GET['op'];

                       switch($op):
                           case 'um':
               ?>
                                  <p class="merro">Erro! Nenum campo pode ficar vazio!</p>
               <?php
                                 break;
                           case 'dois':
               ?>
                                   <p class="msucesso">A sua Experiência foi alterado com ucesso :)</p> 
               <?php                    
                               break;
                           case 'tres':
               ?> 
                                   <p class="merro">Surgiu um erro na hora de alterar sua formação, contate o lenilson_pires@ig.com.br!</p>
               <?php
                               break;
                           case 'quatro':
               ?> 
                                   <p class="merro">Surgiu um problema ao enviar a experiência para ser excluído, por favor catate o lenilson_pires@ig.com.br!</p>
               <?php
                               break;
                           case 'cinco':
               ?> 
                                   <p class="msucesso">Experiência excluida com sucesso!</p>
               <?php
                               break;
                            case 'seis':
               ?> 
                                   <p class="merro">Houve um erro ao tentar excluir a experiência, por favor contate o lenilson_pires@ig.com.br!</p>
               <?php
                               break;
                       endswitch;
                   endif;//FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO
            
                foreach($ex as $key):
        ?>
        
        <!-- FORMULÁRIO DE EDITAR FORMAÇÃO -->
        <form name="form_editar_experiencias_profissionais" class="form_editar_experiencias_profissionais" action="<?php echo URLPH.DS;?>Experiencia/EditarExperiencia" method="post"> 
            <label for="empresa" id="l_empresa">Escola ou Instuição
                <input type="text" name="empresa" id="empresa" placeholder="Empresa" title="Empresa" value="<?php echo utf8_encode($key['empresa']); ?>" required><br>
            </label> 
            <label for="dataini" id="l_dataini">Data Inicial
                <input type="text" name="dataini" id="dataini" title="Data Inicial" value="<?php echo $key['per_ini']; ?>" placeholder="Data Inicial(Ex: 02/2010)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
            </label>
            <label for="datafim" id="l_datafim">Data Final
                <input type="text" name="datafim" id="datafim" title="Data Final" value="<?php echo $key['per_fim']; ?>" placeholder="Data Final(Ex: 02/2012)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
            </label>
            <label for="funcao" id="l_funcao">Função 
            <input type="text" name="funcao" id="funcao" placeholder="Formação" value="<?php echo utf8_encode($key['funcao']); ?>" title="Responsável Geral" required><br>
            </label>
            <label for="descricao" id="l_descricao">Descrição da Função 
                <textarea name="descricao" id="descricao" placeholder="Descrição" title="Descição" required><?php echo utf8_encode($key['descricao']); ?></textarea><br>
            </label>
            <input type="hidden" name="idexp" value="<?php echo $key['id_exp']?>">
            <a href="<?php echo URLPH.DS.'Experiencia/ExcluirExperiencia&idexp='.$key['id_exp'];?>"><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>delete.png" title="Excluir Experiência"></a>
            <a href="<?php echo URLPH.DS;?>home/home" class="bt_voltar">Voltar</a>
            <input type="submit" value="Alterar">
            <hr class="hr_ed_formacao">
        </form> <!-- FIM FORMULÁRIO DE EDITAR FORMAÇÃO -->                
        
        <?php
                endforeach; 
            else:
        ?>
            <p class="vazio_experiencia">Você não tem nenhuma Experiência registrada :( <br> Não perca oportunidades, <a href="<?php echo URLPH.DS;?>Experiencia/Inserir"><span>CLIQUE AQUI</span></a> e registre um agora :)<p/>
        <?php
            endif;
        ?>
    </div><!-- FIM ENVOLVE FORMAÇÕES -->    

</article><!-- FIM CONTEÚDO -->

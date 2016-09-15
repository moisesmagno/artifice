<!-- CONTEÚDO -->
<article class="conteudo">

    <!-- ENVOLVE FORMAÇÕES -->   
    <div class="env_formacao">
        
        <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        <?php
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
                            <p class="msucesso">A sua formação foi alterado com ucesso :)</p> 
        <?php                    
                        break;
                    case 'tres':
        ?> 
                            <p class="merro">Surgiu um erro na hora de alterar sua formação, contate o lenilson_pires@ig.com.br!</p>
        <?php
                        break;
                    case 'cinco':
        ?> 
                            <p class="merro">Não foi possível excluir a formação, por favor contate o lenilson_pires@ig.com.br!</p>
        <?php
                        break;
                    case 'seis':
        ?> 
                            <p class="merro">Houve um erro ao enviar dados da formação, por favor contate o lenilson_pires@ig.com.br!</p>
        <?php
                        break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO --> 
        
        <h1>Editar Formação Profissionais</h1>
        
        <?php 
            if(!empty($formacao)):
        ?>
            <!-- FORMULÁRIO DE EDITAR FORMAÇÃO -->
            <form name="form_edita_formacao_profissionais" class="form_edita_formacao_profissionais" action="<?php echo URLPH.DS;?>Formacao/EditarFormacao" method="post"> 
                <label for="escola" id="l_escola">Escola ou Instuição
                    <input type="text" name="escola" id="escola" placeholder="Escola ou Instituição" title="Escola ou Instituição" value="<?php echo utf8_encode($formacao['instituto']);?>" required><br>
                </label> 
                <label for="dataini" id="l_dataini">Data Inicial
                    <input type="text" name="dataini" id="dataini" title="Data Inicial" value="<?php echo $formacao['periodo_inicial'];?>" placeholder="Data Inicial(Ex: 02/2010)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
                </label>
                <label for="datafim" id="l_datafim">Data Final
                    <input type="text" name="datafim" id="datafim" title="Data Final" value="<?php echo $formacao['periodo_final'];?>" placeholder="Data Final(Ex: 02/2012)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
                </label>
                <label for="formacao" id="l_formacao">Formação
                <input type="text" name="formacao" id="formacao" placeholder="Formação" value="<?php echo utf8_encode($formacao['formacao']);?>" title="Formação" required><br>
                </label>
                <label for="descricao" id="l_descricao">Descrição do curso
                    <textarea name="descricao" id="descricao" placeholder="Descrição" title="Descição" required><?php echo utf8_encode($formacao['descricao']);?></textarea><br>
                </label>
                <input type="hidden" name="form_id" value="<?php echo $formacao['form_id'];?>">
                <a href="<?php echo URLPH.DS.'Formacao/ExcluirFormacao&idf='.$formacao['form_id'];?>"><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>delete.png" title="Excluir Formação"></a>
                <a href="<?php echo URLPH.DS;?>home/home" class="bt_voltar">Voltar</a>
                <input type="submit" value="Alterar">
            </form> <!-- FIM FORMULÁRIO DE EDITAR FORMAÇÃO -->                
        <?php
            else:
        ?>        
            <p class="vazio_formacao">Você não tem nenhuma Formação registrada :( <br> Não perca oportunidades, <a href="<?php echo URLPH.DS;?>Formacao/Inserir"><span>CLIQUE AQUI</span></a> e registre um agora :)<p/>
        <?php         
            endif;
        ?>    
        
    </div><!-- FIM ENVOLVE FORMAÇÕES -->    

</article><!-- FIM CONTEÚDO -->

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
                           <p class="merro">Erro! Todos os campos devem ser preenchidos corretamente!</p>
        <?php
                          break;
                    case 'tres':
        ?> 
                            <p class="merro">Surgiu um erro na hora de registra sua formação, contate o lenilson_pires@ig.com.br!</p>
        <?php
                        break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->    
        
        
        
        <h1>Inserir Formação Profissionais</h1>
        
        <?php 
            if(empty($formacao)):
        ?>
                <!-- FORMULÁRIO DE INSERIR FORMAÇÃO -->   
        <form name="form_formacao_profissionais" class="form_formacao_profissionais" action="<?php echo URLPH.DS;?>Formacao/NovaFormacao" method="post"> 
            <label for="escola" id="l_escola">Escola ou Instuição <span>*</span>
                <input type="text" name="escola" id="escola" placeholder="Escola ou Instituição" title="Escola ou Instituição" required><br>
            </label> 
            <label for="dataini" id="l_dataini">Data Inicial <span>*</span>
                <input type="text" name="dataini" id="dataini" title="Data Inicial" placeholder="Data Inicial(Ex: 02/2010)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required >
            </label>
            <label for="datafim" id="l_datafim">Data Final <span>*</span>
                <input type="text" name="datafim" id="datafim" title="Data Final" placeholder="Data Final(Ex: 02/2012)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
            </label>
            <label for="formacao" id="l_formacao">Formação <span>*</span>
            <input type="text" name="formacao" id="formacao" placeholder="Formação" title="Formação" required><br>
            </label>
            <label for="descricao" id="l_descricao">Descrição do curso <span>*</span>
                <textarea name="descricao" id="descricao" placeholder="Descrição" title="Descição" required></textarea><br>
            </label>
            <input type="reset" value="Cancelar">
            <input type="submit" value="Cadastrar">
        </form><!-- FIM FORMULÁRIO DE INSERIR FORMAÇÃO -->
        <?php
            else:
        ?>   
            <p class="formacao_inserido">Sua Formação já está registrada :) <br> Porém se você quer edita-la ou excluí-la, <a href="<?php echo URLPH.DS;?>Formacao/Editar"><span>CLIQUE AQUI.</span></a><p/>
        <?php        
            endif;
        ?>
    </div><!-- FIM ENVOLVE FORMAÇÕES -->     

</article><!-- FIM CONTEÚDO -->




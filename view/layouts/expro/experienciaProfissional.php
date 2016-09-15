<!-- CONTEÚDO -->
<article class="conteudo">

    <!-- ENVOLVE FORMAÇÕES --> 
    <div class="env_experiencias">
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
                    case 'dois':
        ?> 
                           <p class="msucesso">Sua Experiência foi registrada com sucesso :)</p>
        <?php
                        break;
                    case 'tres':
        ?>
                           <p class="merro">Surgiu um erro na hora de registra sua Experiência, contate o lenilson_pires@ig.com.br!</p>
        <?php
                          break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->  
        
        <h1>Inserir Experiência Profissionais</h1>

        <!-- FORMULÁRIO DE INSERIR FORMAÇÃO -->   
        <form name="form_experiencias_profissionais" class="form_experiencias_profissionais" action="<?php echo URLPH.DS;?>Experiencia/NovaExperiencia" method="post"> 
            <label for="empresa" id="l_empresa">Empresa <span>*</span>
                <input type="text" name="empresa" id="empresa" placeholder="Nome da Empresa" title="Nome da Empresa" required><br>
            </label> 
            <label for="dataini" id="l_dataini">Data Inicial <span>*</span>
                <input type="text" name="dataini" id="dataini" title="Data Inicial" placeholder="Data Inicial(Ex: 02/2010)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
            </label>
            <label for="datafim" id="l_datafim">Data Final <span>*</span>
                <input type="text" name="datafim" id="datafim" title="Data Final" placeholder="Data Final(Ex: 02/2012)" maxlength="7" onkeydown="Mascara(this,Data);" onkeypress="Mascara(this,Data);" onkeyup="Mascara(this,Data);" required>
            </label>
            <label for="funcao" id="l_funcao">Função <span>*</span>
            <input type="text" name="funcao" id="funcao" placeholder="Função" title="Função" required><br>
            </label>
            <label for="descricao" id="l_descricao">Descrição da Função <span>*</span>
                <textarea name="descricao" id="descricao" placeholder="Descrição" title="Descição" required></textarea><br>
            </label>
            <input type="reset" value="Cancelar">
            <input type="submit" value="Cadastrar">
        </form><!-- FIM FORMULÁRIO DE INSERIR FORMAÇÃO -->       
    </div><!-- FIM ENVOLVE FORMAÇÕES -->     

</article><!-- FIM CONTEÚDO -->

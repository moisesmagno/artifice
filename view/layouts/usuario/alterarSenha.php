<!-- CONTEÚDO -->
<article class="conteudo">

    <form name="form_alterarsenha" class="form_alterarsenha" action="<?php echo URLPH.DS;?>Usuario/AlterarSenhaUsu" method="post">
            <?php
                   // MENSAGENS DE ERRO, ALERTA E SUCESSO
                   if(isset($_GET['op']) && !empty($_GET['op'])):
                       $op = $_GET['op'];

                       switch($op):
                           case 'um':
               ?>
                                  <p class="merro">Preencha todos os campos corretamente!</p>
               <?php
                                 break;
                           case 'dois':
               ?>
                                   <p class="malerta">Você digitou errado a senha atual. Por favor verificar!</p> 
               <?php                    
                               break;
                           case 'tres':
               ?> 
                                   <p class="malerta">A senha nova e a senha de confirmção não são identicas. Por favor verificar!</p>
               <?php
                               break;
                           case 'quatro':
               ?> 
                                   <p class="merro">Surgiu um problema ao tentar alterar sua senha, por favor contate o lenilson_pires@ig.com.br!</p>
               <?php
                               break;
                           case 'cinco':
               ?> 
                                   <p class="msucesso">Senha alterado com sucesso!</p>
               <?php
                               break;
                            case 'seis':
               ?> 
                                   <p class="merro">Houve um erro ao tentar excluir a experiência, por favor contate o lenilson_pires@ig.com.br!</p>
               <?php
                               break;
                       endswitch;
                   endif;//FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO
               ?>
                                   
           <h1>Alterar Senha</h1>
           <input type="password" name="senha_atual" placeholder="Senha Atual" title="Senha Atual" required><br>
           <input type="password" name="nova_senha" placeholder="Nova Senha" title="Nova Senha" required><br>
           <input type="password" name="nova_senha_conf" placeholder="Confirmar Nova Senha" title="Confirmar Nova Senha" required><br>
           <input type="reset" value="Cancelar">
           <input type="submit" value="Alterar">
           
    </form>    

</article><!-- FIM CONTEÚDO -->





<!-- CONTEÚDO -->
<article class="conteudo">
    <figure class="logotipo_cadastro">
        <a href="<?php echo URLPH; ?>"><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>logo.png" width="300"></a>
    </figure>
    <p class="txt_bv_cadastro"><span>Olá!</span> Cadastre-se no Artifice e conquiste diversas oportunidades ao divulgar seus trabalhos,  
       pois acreditamos no seu potencial :) </p>
        
        <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        <?php
            if(isset($_GET['op']) && !empty($_GET['op'])):
                $op = $_GET['op'];
                
                switch($op):
                    case 'um':
        ?>
                           <p class="merro">Por favor, Preencher todos os campos!</p>
        <?php
                          break;
                    case 'dois':
        ?>
                            <p class="malerta">As senhas digitadas não são iguais, por favor verificar!</p> 
        <?php                    
                        break;
                    case 'tres':
        ?> 
                            <p class="malerta">O E-mail informado, já existe. Por favor escoha outro!</p>
        <?php
                        break;
                    case 'quatro':
        ?>
                            <p class="msucesso">Seu cadastro foi um sucesso, lhe enviamos um e-mail de confirmação :)</p>     
                            <p class="macesseagora"><a href="<?php echo URLPH;?>/login/login">CLIQUE AQUI!</a> e acesse agora mesmo :)</p>
        <?php                            
                        break;
                    case 'cinco':
       ?>
                        <p class="merro">Ocorreu um erro na hora do cadastro, por favor contate o lenilson_pires@ig.com.br</p>
       <?php
                        break;
                    case 'seis':
       ?>
                        <p class="msucesso">Parabens, seu cadastro foi um sucesso :)</p>     
                        <p class="macesseagora"><a href="<?php echo URLPH;?>/login/login">CLIQUE AQUI!</a> e acesse agora mesmo :)</p>
                        <p class="malerta">O E-mail de confirmação de cadastro não foi enviado por falta de internet, mais já pode acessar no sistema normalmente :)</p>
       <?php                 
                        break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
                
    <div class="env_form_cadastrousu">
        <h4> Cadastro de Usuário</h4>
        <form name="form_cadastro_usu" class="form_cadastro_usu" action="<?php echo URLPH.DS; ?>Cadastrar/FiltraDadosCadastrar" method="post" onsubmit="return valida()">  
            <input type="text" name="nome" placeholder="Nome Artista / Nome Companhia">
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="senha" placeholder="Digite uma Senha">
            <input type="password" name="senha_conf" placeholder="Confirme a Senha">
            <select name="tipo_perfil">
                <option value="1">Artista</option>
                <option value="2">Companhia</option>
                <option value="3" selected>Escolha o tipo de usuário</option>
            </select>    
            <input type="reset" value="Cancelar">
            <input type="submit" value="Cadastrar">
        </form>
    </div>    
</article><!-- FIM CONTEÚDO -->


<!-- CONTEÚDO -->
<article class="conteudo_login">
    <figure class="logotipo">
        <img src="<?php echo URLPH.VWPH.IMGPH.DS;?>logo.png">
    </figure>

    <script type="text/javascript">
     function valida(){
            d=document.form_login;

            if (d.email.value == ""){
            alert("Informe o seu E-mail!");
            d.email.focus();
            return false;
            }
            parte1 = d.email.value.indexOf("@");
            parte2 = d.email.value.indexOf(".");
            parte3 = d.email.value.length;
            if (!(parte1 >= 3 && parte2 >= 6 && parte3 >= 9)) {
                    alert("Insira um E-mail válido!");
                    d.email.focus();
                    return false;
            }

            if (d.senha.value == ''){
                    alert("Insira sua senha!");
                    d.senha.focus();
                    return false;
            } 

            return true;
        }
    </script>
    
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
                            <p class="malerta">Usuário inexistente ou Senha incorreta!</p>
        <?php
                        break;
                    case 'tres':
        ?>
                            <p class="merro">Por favor! Faça login antes de acessar qualquer página!</p>
        <?php                            
                        break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
    
    <form name="form_login" class="formulario_login" action="<?php echo URLPH.DS; ?>login/Autenticar" method="post" onsubmit="return valida()">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="senha" placeholder="Senha">
        <a href="<?php echo URLPH.DS;?>Cadastrar/NovoUsuario"><h1>Cadastre-se</h1></a>
        <input type="submit" value="Entrar">
    </form>
        
    <div class="recemail" >
        <p class="recuperar_conta">Se você desativou sua conta ou esqueceu sua senha <a href="#" id="re">CLIQUE AQUI </a> e não perca oportunidades de mostrar seus trabalhos e de conhecer novas pessoas.</p>    
    </div>
        <form class="for_recup_conta" id="m_e" class="for_recup_conta" action="<?php echo URLPH.DS;?>Login/RecuperaConta" method="post">
            <span> Informe seu Nome e o seu E-mail, caso ele esteja em nosso banco de dados, lhe enviaremos um E-mail, informando o seu login e uma nova senha de acesso :)</span>
            <input type="text" name="nome_rc" placeholder="Nome Completo / Nome Fantasia" required>
            <input type="email" name="email_rc" placeholder="E-mail" required>
            <input type="submit" value="Enviar">
            <a href="#" id="cc"><p class="pcancelar">Cancelar</p></a>
        </form>

        <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        <?php
            if(isset($_GET['op']) && !empty($_GET['op'])):
                $op = $_GET['op'];
                
                switch($op):
                    case 'quatro':
        ?>
                           <p class="msucesso">O processo foi um sucesso, enviamos no seu E-mail o seu login e uma senha temporária :)</p>
        <?php
                          break;
                    case 'cinco':
        ?> 
                            <p class="merro">Não foi possível enviar seu login e senha no seu E-mail, pois não há internet ou a mesma está oscilante!</p>
        <?php
                        break;
                    case 'seis':
        ?>
                            <p class="merro">Surgiu um erro na hora de reativar sua conta, contate o lenilson_pires@ig.com.br!</p>
        <?php                            
                        break;
                    case 'sete':
        ?>
                            <p class="merro">O E-mail informado não existe no nosso banco de dados e não tem nenhum usuário registrado com esse E-mail :(</p>
        <?php                            
                        break;
                endswitch;
            endif;
        ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
</article><!-- FIM CONTEÚDO -->

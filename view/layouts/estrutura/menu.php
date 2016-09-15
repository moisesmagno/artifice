<?php  
    $ss = new sessao(FALSE);
    $tipo_usu = ($ss->devSessao('tipo') == 1)? 'Artista' : 'Companhia';
    
    //Descobre o nome do usuário logado.
    $uc = new UsuarioController();
    $nome_usu = $uc->actionRecuperaNome($ss->devSessao('id'), $ss->devSessao('tipo'));   
    
    //instancia a classe ExperienciaController e seus métodos q serão usados abaixo.
    $ec = new ExperienciaController();
    
    //Recupera os dados do Perfil do usuário.
    if(!isset($_GET['usu']) && empty($_GET['usu']) && !isset($_GET['tp']) && empty($_GET['tp'])):
        $dadosusuario = $uc->actionDadosUsu($ss->devSessao('id'), $ss->devSessao('tipo'));
        
        //Recupera as pessoas que o usuário está seguindo.
        $sg = new SeguirController();
        $seguindo = $sg->actionPessoasSeguindo($ss->devSessao('id'));

        //Recupera as pessoas que estão seguindo o usuário.
        $me_seguindo = $sg->actionPessoasMeSeguindo($ss->devSessao('id'));

        //Se for artista chama a formação do usuário.
        if($ss->devSessao('tipo') == 1):
             $fc = new FormacaoController();
             $formacao = $fc->actionFormacao($ss->devSessao('id'));
        endif;
        
        //Recupera o portfolio do usuário.
        $pc = new PortfolioController();
        $portfolio = $pc->actionRecuperaPortfolio($ss->devSessao('id'));
        
        //Recupera as experiências profissionais do usuario.
        $ex = $ec->actionExperiencias($ss->devSessao('id'));
    else:
        $dadosusuario = $uc->actionDadosUsu($_GET['usu'], $_GET['tp']);
        
        //Recupera as pessoas que o usuário está seguindo.
        $sg = new SeguirController();
        $seguindo = $sg->actionPessoasSeguindo($_GET['usu']);

        //Recupera as pessoas que estão seguindo o usuário.
        $me_seguindo = $sg->actionPessoasMeSeguindo($_GET['usu']);

        //Se for artista chama a formação.
        if($_GET['tp'] == 1):
            $fc = new FormacaoController();
             $formacao = $fc->actionFormacao($_GET['usu']);
        endif;
        
        //Recupera o portfolio do usuário.
        $pc = new PortfolioController();
        $portfolio = $pc->actionRecuperaPortfolio($_GET['usu']);
        
        //Recupera as experiências profissionais do usuario.
        $ex = $ec->actionExperiencias($_GET['usu']);
    endif;
    
    
    
    
    //Recupera as pessoas que estão seguindo o usuário logado.
    
    //variável contendo a fraze etilizada. 
    $ni = '<span class="vazio">Não informado</span>';
?>
<!-- MENU -->
<nav class="menu">
    <a href="<?php echo URLPH.DS;?>home/home"><h3>Artifice</h3></a>
    <a href="<?php echo URLPH.DS.$tipo_usu.DS;?>Perfil"><span class="nome_usu"><?php echo ($ss->devSessao('tipo') == 1) ? utf8_encode($nome_usu['nome']) : utf8_encode($nome_usu['nome_fantasia']);?></span></a>

    <div class="menusesub">
        <div class="mprinc"><span id="m_nome">Pessoal</span></div>
            <?php if($ss->devSessao('tipo') == 1): ?>
                <a href="<?php echo URLPH.DS;?>Artista/InserirDadosPessoais"><div class="mprinc" id="ef"><span>Dados Pessoais</span></div></a>
            <?php else:?> 
                <a href="<?php echo URLPH.DS;?>Companhia/InserirDados"><div class="mprinc" id="ef"><span>Dados Pessoais</span></div></a>
            <?php endif;?>
            <a href="<?php echo URLPH.DS;?>Usuario/fotoperfil"><div class="mprinc" id="ef"><span>Foto Perfil</span></div></a>
            <a href="<?php echo URLPH.DS;?>Usuario/AlterarSenha"><div class="mprinc" id="ef"><span>Alterar Senha</span></div></a>
            <a href="<?php echo URLPH.DS;?>Usuario/DesativarConta"><div class="mprinc" id="ef"><span>Excluir Perfil</span></div></a>
            <a href="<?php echo URLPH.DS;?>Usuario/Sair"><div class="mprinc" id="ef"><span>Sair</span></div></a>
        </div>
    </div>
    
    <div class="menusesub">
        <div class="mprinc"><span id="m_nome">Editar</span></div>
        <?php if($ss->devSessao('tipo') == 1): ?>
            <a href="<?php echo URLPH.DS;?>Formacao/Editar"><div class="mprinc" id="ef"><span>Formação</span></div></a>
        <?php endif;?> 
        
        <a href="<?php echo URLPH.DS;?>Portfolio/Editar"><div class="mprinc" id="ef"><span>Portfolio</span></div></a>
        <a href="<?php echo URLPH.DS;?>Experiencia/Editar"><div class="mprinc" id="ef"><span>Experiências</span></div></a>
    </div>

    <div class="menusesub">
        <div class="mprinc"><span id="m_nome">Inserir</span></div>
        <?php if($ss->devSessao('tipo') == 1): ?>
            <a href="<?php echo URLPH.DS;?>Formacao/Inserir"><div class="mprinc" id="ef"><span>Formação</span></div></a>
        <?php endif;?>

        <a href="<?php echo URLPH.DS;?>Portfolio/Inserir"><div class="mprinc" id="ef"><span>Portfolio</span></div></a>
        <a href="<?php echo URLPH.DS;?>Experiencia/Inserir"><div class="mprinc" id="ef"><span>Experiências</span></div></a>
    </div>
    
</nav><!-- FIM MENU -->
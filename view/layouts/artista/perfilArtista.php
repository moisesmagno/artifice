<!-- CONTEÚDO -->
<article class="conteudo">

    <script type="text/javascript">    
        Shadowbox.init({
        handleOversize: "arrastar",
                    displayNav: true,
                    handleUnsupported: "remover",
                    autoplayMovies: false 

        });
    </script> 
    <!-- INFORMAÇÕES DO USUÁRIO -->
    <section class="foto_info_imp">
        <figure class="foto_perfil">
            <img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu'.DS.$dadosusuario['foto_perfil'];?>" width="200" alt="Foto de <?php echo utf8_encode($dadosusuario['nome']);?>">
        </figure>
        <div class="inf_imp_usu">
            <p><span>Nome: </span><?php echo utf8_encode($dadosusuario['nome']);?><br></p>
            <p><span>Nome artistico: </span><?php echo (!empty($dadosusuario['nome_artistico']))?utf8_encode($dadosusuario['nome_artistico']):$ni;?><br></p>
            <p><span>Categoria: </span><?php echo (!empty($dadosusuario['categoria']))?utf8_encode($dadosusuario['categoria']):$ni;?><br></p>
            <p><span>Data de Nacimento: </span><?php echo (!empty($dadosusuario['data_nasc']))? strftime("%d/%m/%Y", strtotime($dadosusuario['data_nasc'])) :$ni;?><br></p>
            <p><span>Idade: </span><?php echo (!empty($dadosusuario['data_nasc']))? date("Y") - substr($dadosusuario['data_nasc'], 0, -6).' Anos':$ni;?><br></p>
            <p><span>Localização: </span>
                <?php echo (!empty($dadosusuario['pais']))?utf8_encode($dadosusuario['pais']):$ni;?> - 
                <?php echo (!empty($dadosusuario['estado']))?utf8_encode($dadosusuario['estado']):$ni;?> - 
                <?php echo (!empty($dadosusuario['cidade']))?utf8_encode($dadosusuario['cidade']):$ni;?> 
            </p>
        </div>
        
        <?php 
            $sc = new SeguirController();
            if($ss->devSessao('id') <> $dadosusuario['id_usu']):
                if($sc->actionVerificaSeguindo($ss->devSessao('id'), $_GET['usu']) != TRUE):
       ?>
                    <a href="<?php echo URLPH.DS.'Seguir/Seguir&usu='.$dadosusuario['id_usu'].'&tp='.$dadosusuario['tipo'];?>" class="bt_seguir" style="display:block;">Seguir</a>    
        <?php
                else:
        ?>
                    <a href="<?php echo URLPH.DS.'Seguir/DeixarSeguir&usu='.$dadosusuario['id_usu'].'&tp='.$dadosusuario['tipo'];?>" class="bt_dxseguir" style="display:block;"> Deixar de Seguir</a>
        <?php    
                endif;
            endif;
        ?>
        <a href="#" id="rec_port" class="rec_port_oculto">Recolher Portfolio</a>
        <a href="#" id="exi_port" class="exi_portf">Exibir Portfolio</a>

    </section><!-- FIM INFORMAÇÕES DO USUÁRIO -->

    <!-- PORTFOLIO -->
    <section class="porfolio_oculto">
        <?php 
            //Recupera o portfolio completo do usuário.
            if(!empty($portfolio)):
                foreach($portfolio as $key):
        ?>        
                <div class="fotodesc">
                    <figure class="foto_port">
                        <a href="<?php echo URLPH.VWPH.IMGPH.DS.'portfolio'.DS.$key['foto'];?>"  rel="shadowbox[Mixed]" title="Eu1"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'portfolio'.DS.$key['foto'];?>" title="Foto do Portfolio"></a>
                    </figure>
                    <div class="env_tt_desc">
                        <span class="datahoraport"><?php echo $key['datahora'];?></span>
                        <h4><?php echo utf8_encode($key['titulo']);?></h4>
                        <p><?php echo utf8_encode($key['descricao']);?></p>
                    </div>
                 </div>   
         <?php
                endforeach;
            else:
                echo '<span class="sem_portfolio">Este usuário não possui um portfolio ainda :(</span>';
            endif;
        ?>
        
    </section><!-- PORTFOLIO -->    

    <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
            <?php
                if(isset($_GET['op']) && !empty($_GET['op'])):
                    $op = $_GET['op'];

                    switch($op):
                        case 'um':
            ?>
                               <p class="msucesso">Vocês está seguindo a <?php echo utf8_encode($dadosusuario['nome']);?> :)</p>
            <?php
                              break;
                        case 'dois':
            ?>
                               <p class="merro">Houve um erro na hora de seguir este(a) pessoa :( - conta-te lenilson_pires@ig.com.br!</p> 
            <?php                    
                            break;
                        case 'tres':
            ?>
                               <p class="msucesso">Você deixou de segui a <?php echo utf8_encode($dadosusuario['nome']);?> !</p> 
            <?php                    
                            break;
                        case 'quatro':
            ?>
                               <p class="merro">Houve um erro na hora de deixar de seguir este(a) pessoa :( - conta-te lenilson_pires@ig.com.br!</p> 
            <?php                    
                            break;
                    endswitch;
                endif;
            ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
    
    <!-- SEGUINDO -->
    <section class="seguindo">
        <h4>Seguindo</h4>
        <div class="foto_seguindo">
            <?php
                if(!empty($seguindo)):
                    foreach($seguindo as $key):
                        if($key['tipo'] == 1):    
            ?>
            <a href="<?php echo URLPH.DS.'Artista/Perfil&usu='.$key['usuid'].'&tp='.$key['tipo'];?>"><figure class="evl_foto_seg"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu/'.$key['foto'];?>" title="<?php echo utf8_encode($key['nome']);?>"></figure></a>
            <?php
                        else:
            ?>
            <a href="<?php echo URLPH.DS.'Companhia/Perfil&usu='.$key['usuid'].'&tp='.$key['tipo'];?>"><figure class="evl_foto_seg"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu/'.$key['foto'];?>" title="<?php echo utf8_encode($key['nome_fantasia']);?>"></figure></a>
            <?php    
                        endif;
                    endforeach;
                else: 
            ?>
                    <span class="vazio_seguidores">Não está seguindo ninguém ainda :(</span>
            <?php        
                endif;
            ?>
        </div>
    </section><!-- FIM SEGUINDO -->

    <!-- SEGUIDORES -->
    <section class="seguidores">
        <h4>Seguidores</h4>
        <div class="foto_seguidores">
            <?php
                if(!empty($me_seguindo)):
                    foreach($me_seguindo as $key):
                        if($key['tipo'] == 1):    
            ?>
            <a href="<?php echo URLPH.DS.'Artista/Perfil&usu='.$key['usuid'].'&tp='.$key['tipo'];?>"><figure class="evl_foto_seg"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu/'.$key['foto'];?>" title="<?php echo utf8_encode($key['nome']);?>"></figure></a>
            <?php
                        else:
            ?>
            <a href="<?php echo URLPH.DS.'Companhia/Perfil&usu='.$key['usuid'].'&tp='.$key['tipo'];?>"><figure class="evl_foto_seg"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu/'.$key['foto'];?>" title="<?php echo utf8_encode($key['nome_fantasia']);?>"></figure></a>
            <?php    
                        endif;
                    endforeach;
                else: 
            ?>
                    <span class="vazio_seguidores">Não está sendo seguindo por ninguém ainda :(</span>
            <?php        
                endif;
            ?>
        </div>
    </section><!--  FIM SEGUIDORES -->

    <!-- FORMAÇÃO -->
    <section class="formacao">
            <h4>Formação</h4>
            <p><span>Escola / Instituto: </span> <?php echo (!empty($formacao['instituto']))?utf8_encode($formacao['instituto']):$ni;?><br></p>
            <p><span>Perído de estudo: </span>
                <?php echo (!empty($formacao['periodo_inicial']))?utf8_encode($formacao['periodo_inicial']):$ni;?> à 
                <?php echo (!empty($formacao['periodo_final']))?utf8_encode($formacao['periodo_final']):$ni;?><br></p>
            <p><span>Formação: </span><?php echo (!empty($formacao['formacao']))?utf8_encode($formacao['formacao']):$ni;?><br></p>
            <p><span>Descrição do Curso: <br></span><?php echo (!empty($formacao['descricao']))?utf8_encode($formacao['descricao']):$ni;?><br></p>
    </section><!-- FIM FORMAÇÃO -->

    <!-- CONTATO -->
    <section class="contato">
        <h4>Contato</h4>
        <p><span>Bairro: </span><?php echo (!empty($dadosusuario['bairro']))?utf8_encode($dadosusuario['bairro']):$ni;?> - <span>CEP: </span><?php echo (!empty($dadosusuario['cep']))?utf8_encode($dadosusuario['cep']):$ni;?><br></p>
        <p><span>Endereço: </span><?php echo (!empty($dadosusuario['endereco']))?utf8_encode($dadosusuario['endereco']):$ni;?><br></p>
        <p><span>Nº: </span><?php echo (!empty($dadosusuario['numero']))?utf8_encode($dadosusuario['numero']):$ni;?> - <span>Complemento: </span><?php echo (!empty($dadosusuario['complemento']))?utf8_encode($dadosusuario['complemento']):$ni;?><br></p>
        <hr class="hrs">
        <p><span>Telefone: </span><?php echo (!empty($dadosusuario['telefone']))?utf8_encode($dadosusuario['telefone']):$ni;?> - <span>Celular: </span><?php echo (!empty($dadosusuario['celular']))?utf8_encode($dadosusuario['celular']):$ni;?><br></p>
        <p><span>E-mail: </span><?php echo (!empty($dadosusuario['email']))?utf8_encode($dadosusuario['email']):$ni;?> - <span>Site: </span><?php echo (!empty($dadosusuario['site']))?utf8_encode($dadosusuario['site']):$ni;?><br></p>
        <figure class="redes">
            <a href="<?php echo (!empty($dadosusuario['facebook']))?utf8_encode($dadosusuario['facebook']):'#';?>" <?php if(!empty($dadosusuario['facebook'])){echo 'target="_blank"';}?>><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>redes/face.jpg" alt="Foto do Facebook" title="<?php echo (!empty($dadosusuario['facebook']))? 'Facebook': 'Este Usuário não tem Facebook :('; ?>"></a>
            <a href="<?php echo (!empty($dadosusuario['google_plus']))?utf8_encode($dadosusuario['google_plus']):'#';?>" <?php if(!empty($dadosusuario['google_plus'])){echo 'target="_blank"';}?>><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>redes/google.jpg" alt="Foto do Google +" title="<?php echo (!empty($dadosusuario['google_plus']))? 'Google +': 'Este Usuário não tem Google + :('; ?>"></a>
            <a href="<?php echo (!empty($dadosusuario['twitter']))?utf8_encode($dadosusuario['twitter']):'#';?>" <?php if(!empty($dadosusuario['twitter'])){echo 'target="_blank"';}?>><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>redes/twitter.jpg" alt="Foto do Twitter" title="<?php echo (!empty($dadosusuario['linkedin']))? 'Twitter': 'Este Usuário não tem Twitter :('; ?>"></a>
            <a href="<?php echo (!empty($dadosusuario['linkedin']))?utf8_encode($dadosusuario['linkedin']):'#';?>" <?php if(!empty($dadosusuario['linkedin'])){echo 'target="_blank"';}?>><img src="<?php echo URLPH.VWPH.IMGPH.DS;?>redes/in.jpg" alt="Foto do Linkedin" title="<?php echo (!empty($dadosusuario['linkedin']))? 'Linkedin': 'Este Usuário não tem Linkedin :('; ?>"></a>
        </figure>
    </section><!-- FIM CONTATO -->

    <!-- EXPERIÊNCIAS -->
    <section class="experiencias">
        <h4>Experiências Profissionais</h4>
        <?php
            if(!empty($ex)):
                foreach($ex as $key):
        ?>
                    <div class="env_exp">
                        <p><span>Empresa: </span><?php echo utf8_encode($key['empresa']);?><br></p>
                        <p><span>Período: </span><?php echo $key['per_ini'];?> à <?php echo $key['per_fim'];?><br></p>
                        <p><span>Função: </span><?php echo utf8_encode($key['funcao']);?><br></p>
                        <p class="descricao"><span>Descrição da função: </span> <br><?php echo utf8_encode($key['descricao']);?></p>
                   </div>
        <?php
                endforeach;
                
            else:    
                echo '<span class="vazio_ex">Não informado ainda :(</span>';
            endif;
        ?>        
       
    </section><!-- FIM EXPERIÊNCIAS -->

    
<?php 
    if(isset($_GET['en']) && !empty($_GET['en'])):
        $ss = new sessao(FALSE);
        $dadosemail = array(
                'nome' => (isset($nome_usu['nome'])) ? $nome_usu['nome'] : '',
                'nome_fantasia' => (isset($nome_usu['nome_fantasia'])) ? $nome_usu['nome_fantasia'] : '', 
                'id' => $ss->devSessao('id'),
                'tiposeg' => $ss->devSessao('tipo'),
                'email' => $dadosusuario['email'],
                'tipoenv' => 3
                );

                $em = new Email();
                $em->eviarEmail($dadosemail);
    endif;
?>
    
</article><!-- FIM CONTEÚDO -->

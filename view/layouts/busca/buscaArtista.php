<!-- CONTEÚDO -->
<article class="conteudo">
    <section class="perfils_encontrados">
        <img src="<?php echo URLPH.VWPH.IMGPH.DS;?>artista.png" width="75">
        <h1>Resultado de Artistas</h1>
        
        <?PHP 
            if(isset($_POST) && !empty($_POST)):
                $bc = new BuscaController();
                $art = $bc->actionRetornaArtistas($_POST);
                if(!empty($art)):
                    foreach($art as $key):
        ?>
                <!-- PERFIL ENCONTRADO -->
                <div class="env_dados_encontrado">
                    <figure class="env_foto_busca">
                        <a href="<?php echo URLPH.DS;?>Artista/Perfil&usu=<?php echo $key['idusu'];?>&tp=<?php echo $key['tipo'];?>"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu'.DS.$key['foto'];?>" title="<?php echo utf8_encode($key['nome']);?>" alt="Foto de <?php echo utf8_encode($key['nome']);?>"></a>
                    </figure>
                    <h3><?php echo utf8_encode($key['nome']);?></h3>
                    <p><span>Categoria: </span><?php echo utf8_encode($key['categoria']);?></p>
                    <p><span>Data de Nascimento: </span><?php echo strftime("%d/%m/%Y", strtotime($key['datanasc']));?> - <span>Idade: </span><?php echo date("Y") - substr($key['datanasc'], 0, -6).' Anos';?></p>
                    <p><span>Localização: </span><?php echo utf8_encode($key['pais']);?> - <?php echo utf8_encode($key['estado']);?> - <?php echo utf8_encode($key['cidade']);?></p>
                    <form name="form_acessar_perfil" class="form_acessar_perfil" action="<?php echo URLPH.DS;?>Artista/Perfil&usu=<?php echo $key['idusu'];?>&tp=<?php echo $key['tipo'];?>" method="post">
                        <input type="submit" value="Ver Perfil">
                    </form>
                </div><!-- PERFIL ENCONTRADO -->
        <?php
                    endforeach;
               else:
                   echo '<span class="nao_foi_encontrado">Não foi encontrado nenhum artista <br> com as características especificadas. <br><br><a href="'.URLPH.DS.'home/home">Realizar outra busca</a></span>';
               endif;    
            else:
                echo '<span class="erro_busca">Surgiu um erro na hora da busca :( <br> por favor contate o lenilson_pires@ig.com.br!</span>';
            endif;    
        ?>
    </section>

</article><!-- FIM CONTEÚDO -->

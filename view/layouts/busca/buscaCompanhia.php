<!-- CONTEÚDO -->
<article class="conteudo">

    <!-- PERFILS ENCONTRADOS -->
    <section class="perfils_encontrados">
        <img src="<?php echo URLPH.VWPH.IMGPH.DS;?>companhia.png" width="65">
        <h1>Resultado de Companhias</h1>
        <?PHP 
            if(isset($_POST) && !empty($_POST)):
                $bc = new BuscaController();
                $companhia = $bc->actionRetornaCompanhias($_POST);
                if(!empty($companhia)):
                    foreach($companhia as $comp):
        ?>
                <!-- PERFIL ENCONTRADO -->
                <div class="env_dados_encontrado">
                    <figure class="env_foto_busca">
                        <a href="<?php echo URLPH.DS;?>Companhia/Perfil&usu=<?php echo $comp['idusu'];?>&tp=<?php echo $comp['tipo'];?>"><img src="<?php echo URLPH.VWPH.IMGPH.DS.'usu'.DS.$comp['foto'];?>" title="<?php echo utf8_encode($comp['nf']);?>" alt="Foto de <?php echo utf8_encode($comp['nf']);?>"></a>
                    </figure>
                    <h3><?php echo utf8_encode($comp['nf']);?></h3>
                    <p><span>Razão Social: </span><?php echo utf8_encode($comp['rs']);?></p>
                    <p><span>Localização: </span><?php echo utf8_encode($comp['pais']);?> - <?php echo utf8_encode($comp['estado']);?> - <?php echo utf8_encode($comp['cidade']);?></p>
                    <p><span>Site: </span><?php echo utf8_encode($comp['site']);?> - <span>Tel.:</span> <?php echo $comp['telefone'];?></p>
                    <form name="form_acessar_perfil" class="form_acessar_perfil" action="<?php echo URLPH.DS;?>Companhia/Perfil&usu=<?php echo $comp['idusu'];?>&tp=<?php echo $comp['tipo'];?>" method="post">
                        <input type="submit" value="Ver Perfil">
                    </form>
                </div><!-- PERFIL ENCONTRADO -->
        <?php
                    endforeach;
               else:
                   echo '<span class="nao_foi_encontrado">Não foi encontrado nenhuma companhia <br> com as características especificadas. <br><br><a href="'.URLPH.DS.'home/home">Realizar outra busca</a></span>';
               endif;    
            else:
                echo '<span class="erro_busca">Surgiu um erro na hora da busca :( <br> por favor contate o lenilson_pires@ig.com.br!</span>';
            endif;    
        ?>
    </section><!-- FIM PERFILS ENCONTRADOS -->

</article><!-- FIM CONTEÚDO -->


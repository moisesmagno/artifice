<!-- CONTEÚDO -->
<article class="conteudo">
    <!-- PROCURA ARTISTA -->
    <section class="procurarartista">
        <img src="<?php echo URLPH.VWPH.IMGPH.DS;?>artista.png" width="55">
        <h1>Artista</h1>
        <form name="form_proc_artista" class="form_proc_artista" action="<?php echo URLPH.DS?>Busca/Artistas" method="post">
            <label id="l_categoria_b">Categoria
                <select name="categoria" class="categoria">
                    <?php
                        $bc = new BuscaController();
                        $cat = $bc->actionCategorias();
                        foreach($cat as $key):
                    ?>
                    <option value="<?php echo $key['cat_id'];?>"><?php echo utf8_encode($key['cat_nome']);?></option>
                    <?php
                        endforeach;
                    ?>
                    <option selected value="0">Todos</option>
                </select>
            </label>
            <label id="l_idade_b"> Idade
                <select name="idade" class="idade">
                    <option selected value="0">Todos</option>
                    <?php 
                        for($i = 1; $i <= 100; $i++):
                    ?>
                    <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php
                        endfor;
                    ?>
                </select>
            </label>
            <label id="l_pais_b">Pais
                <select name="pais" class="pais" onchange="CarregaEstados(this.value)">
                    <?php
                        $pc = new PECController();
                        $pais = $pc->actionPaises();
                        foreach($pais as $p):
                    ?>
                    <option value="<?php echo $p['pais_id']?>"><?php echo utf8_encode($p['pais_nome'])?></option>
                    <?php 
                        endforeach;
                    ?>    
                    <option selected value="0">Todos</option>
                </select>
            </label>
            <label id="l_estado_b">Estado
                <div id="estadoAjax">
                    <select name="estado" class="estado">
                        <option selected value="0">Todos</option>
                    </select>
                </div>    
            </label>                    
            <label id="l_cidade_b">Cidade
                <div id="cidadeAjax">
                    <select name="cidade" class="cidade">
                        <option selected value="0">Todos</option>
                    </select>
                </div>  
            </label>

            <input type="submit" value="Buscar">
        </form>
    </section><!-- FIM PROCURA ARTISTA -->

    <!-- PROCURA COMPANHIA -->
    <section class="procuraracompanhia">
        <img src="<?php echo URLPH.VWPH.IMGPH.DS;?>companhia.png" width="50">
        <h1>Companhia</h1>
        <form name="form_proc_companhia" class="form_proc_companhia" action="<?php echo URLPH.DS?>Busca/Companhias" method="post">
            <label id="l_pais_b">Pais
                <select name="pais" class="pais" onchange="CarregaEstadosComp(this.value)">
                    <?php 
                        $pais = $pc->actionPaises();
                        foreach($pais as $p):
                    ?>
                    <option value="<?php echo $p['pais_id']?>"><?php echo utf8_encode($p['pais_nome'])?></option>
                    <?php 
                        endforeach;
                    ?>
                    <option selected value="0">Todos</option>
                </select>
            </label>
            <label id="l_estado_b">Estado
                <div id="estadoCompAjax">
                    <select name="estado" class="estado">
                        <option selected value="">Todos</option>
                    </select>
                </div>
            </label>                    
            <label id="l_cidade_b">Cidade
                <div id="cidadeCompAjax">
                    <select name="cidade" class="cidade">
                        <option selected value="">Todos</option>
                    </select>
                </div>    
            </label>

            <input type="submit" id="sub_comp" value="Buscar">
        </form>
    </section><!-- FIM PROCURA COMPANHIA -->

    <!-- AQUI FICA O RODAPE -->
</article><!-- FIM CONTEÚDO -->

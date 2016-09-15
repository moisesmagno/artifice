<!-- CONTEÚDO -->
<article class="conteudo">

    <div class="env_dados_pessoais">
        <!-- MENSAGENS DE ERRO, ALERTA E SUCESSO -->
            <?php
                if(isset($_GET['op']) && !empty($_GET['op'])):
                    $op = $_GET['op'];

                    switch($op):
                        case 'um':
            ?>
                               <p class="merro">Os campos com a marca (*) de cor vermelha, não podem ficar vazios, pois são obrigatórios! </p>
            <?php
                              break;
                        case 'dois':
            ?>
                                <p class="msucesso">Seus dados foram atualizado com sucesso :)</p> 
            <?php                    
                            break;
                        case 'tres':
            ?> 
                                <p class="merro">Surgiu um erro ao tentar atulizar seus dados, contate o lenilson_pires@ig.com.br</p>
            <?php
                            break;
                    endswitch;
                endif;
            ?><!-- FIM DAS MENSAGENS DE ERRO, ALERTA E SUCESSO -->
        <h1>Atualizar Dados Pessoais</h1>

        <form name='form_insere_dados_pessoais' class="form_insere_dados_pessoais" action="<?php echo URLPH.DS;?>Usuario/AtualizaDados" method="post">
            <label for="nome" id="l_nome">Nome <span>*</span>
                <input type="text" id="nome" name="nome" placeholder="Nome Completo" title="Nome" value="<?php echo (!empty($dadosusuario['nome']))?utf8_encode($dadosusuario['nome']):'';?>" required>
            </label>
            <label for="nome_artistico" id="l_nome_artistico">Nome Artístico <span>*</span> 
                <input type="text" id="nome_artistico" name="nome_artistico" placeholder="Nome Artístico" title="Nome Artístico" value="<?php echo (!empty($dadosusuario['nome_artistico']))?utf8_encode($dadosusuario['nome_artistico']):'';?>" required>
            </label>
            <label for="rg" id="l_rg">RG <span>*</span>
                <input type="text" id="rg" name="rg" placeholder="RG" title="RG" value="<?php echo (!empty($dadosusuario['rg']))?utf8_encode($dadosusuario['rg']):'';?>" required>
            </label>
            <label for="cpf" id="l_cpf">CPF <span>*</span>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" title="CPF" maxlength="14" onkeydown="Mascara(this,Cpf);" onkeypress="Mascara(this,Cpf);" onkeyup="Mascara(this,Cpf);" value="<?php echo (!empty($dadosusuario['cpf']))?utf8_encode($dadosusuario['cpf']):'';?>" required>
            </label>
            <label for="drt" id="l_drt">DRT <span>*</span>
                <input type="text" id="drt" name="drt" placeholder="DRT" title="DRT" value="<?php echo (!empty($dadosusuario['drt']))?utf8_encode($dadosusuario['drt']):'';?>" required>
            </label>
            <label for="categoria" id="l_categoria"> Categoria  <span>*</span>
                <select name="categoria" id="categoria" title="Categoria" required>
                    <option value=""></option>
                    <?php
                        $bc = new BuscaController();
                        $cat = $bc->actionCategorias();
                        foreach($cat as $key):
                    ?>
                        <option <?php echo ($key['cat_id'] == $dadosusuario['id_categoria']) ? 'selected' : ''; ?> value="<?php echo $key['cat_id'];?>"><?php echo utf8_encode($key['cat_nome']);?></option>
                    <?php endforeach;?>
                </select>
            </label>    
            <label for="datanasc" id="l_datanasc">Data de Nascimento <span>*</span>
                <input type="text" id="datanasc" name="datanasc" placeholder="Data de Nascimento" title="Data de Nascimento" maxlength="10" onkeydown="Mascara(this,Datanasc);" onkeypress="Mascara(this,Datanasc);" onkeyup="Mascara(this,Datanasc);" value="<?php echo (!empty($dadosusuario['data_nasc']))?strftime("%d/%m/%Y", strtotime($dadosusuario['data_nasc'])):'';?>" required>
            </label>
            <label for="pais" id="l_pais">Pais <span>*</span>
                <select name="pais" id="pais" title="Pais" onchange="CarregaEstadosD(this.value)" required>
                    <option value=""></option>
                    <?php 
                        $pc = new PECController(); //Instanciando um objeto da classe PECController.
                        $pais = $pc->actionPaises();
                        foreach($pais as $p):
                    ?>
                    <option <?php echo ($p['pais_id'] == $dadosusuario['pais_id']) ? 'selected' : ''; ?> value="<?php echo $p['pais_id']?>"><?php echo utf8_encode($p['pais_nome'])?></option>
                    <?php endforeach; ?> 
                </select>
            </label>
            <label for="estado" id="l_estado">Estado <span>*</span>
                <?php 
                    if(empty($dadosusuario['est_id'])):
                ?>
                        <div id="estadoAjaxD">
                            <select name="estado" id="estado" title="Estado" required>
                                <option></option>
                                <option>Ecolha um pais.</option>
                            </select>
                        </div>
                <?php
                    else:
                        $estado = $pc->actionTodosEstados();
                ?>
                        <div id="estadoAjaxD">
                            <select name="estado" id="estado" title="Estado" onchange="CarregaCidadesD(this.value)" required>
                                <option value=""></option>
                <?php
                                foreach($estado as $e): 
                ?>
                                <option <?php echo ($e['est_id'] == $dadosusuario['est_id']) ? 'selected' : '';?> value="<?php echo $e['est_id'];?>"><?php echo utf8_encode($e['est_nome']);?></option>          
                <?php
                                endforeach;
                ?>    
                            </select> 
                         </div>   
                <?php endif; ?>
            </label>
            <label for="cidade" id="l_cidade">Cidade <span>*</span>
                <?php 
                    if(empty($dadosusuario['cid_id'])):
                ?>
                        <div id="cidadeAjaxD">
                            <select name="cidade" id="cidade" title="Cidade" required>
                                <option></option>
                                <option>Ecolha um estado.</option>
                            </select>
                        </div>
                <?php
                    else:
                        $cidades = $pc->actionTodasCidasdes();
                ?>
                        <div id="cidadeAjaxD">
                            <select name="cidade" id="cidade" title="Cidade" required>
                                <option value=""></option>
                <?php
                                foreach($cidades as $c): 
                ?>
                                <option <?php echo ($c['cid_id'] == $dadosusuario['cid_id']) ? 'selected' : '';?> value="<?php echo $c['cid_id'];?>"><?php echo utf8_encode($c['cid_nome']);?></option>          
                <?php
                                endforeach;
                ?>    
                            </select> 
                         </div>   
                <?php endif; ?>
            </label>
            <label for="telefone" id="l_telefone">Telefone Fixo
                <input type="tel" id="telefone" name="telefone" placeholder="Telefone Fixo" maxlength="14" onkeydown="Mascara(this,Telefone);" onkeypress="Mascara(this,Telefone);" onkeyup="Mascara(this,Telefone);" value="<?php echo (!empty($dadosusuario['telefone']))?$dadosusuario['telefone']:'';?>">
            </label>
            <label for="celular" id="l_celular">Celular
                <input type="tel" id="celular" name="celular" placeholder="Celular" maxlength="15" onkeydown="Mascara(this,TelefoneCel);" onkeypress="Mascara(this,TelefoneCel);" onkeyup="Mascara(this,TelefoneCel);" value="<?php echo (!empty($dadosusuario['celular']))?$dadosusuario['celular']:'';?>">
            </label>
            <label for="site" id="l_site">Site
                <input type="text" id="site" name="site" placeholder="Site" value="<?php echo (!empty($dadosusuario['site']))?utf8_encode($dadosusuario['site']):'';?>">
            </label>
            <label for="bairro" id="l_bairro">Bairro
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo (!empty($dadosusuario['bairro']))?utf8_encode($dadosusuario['bairro']):'';?>">
            </label>
            <label for="endereco" id="l_endereco">Endereço
                <input type="text" id="endereco" name="endereco" placeholder="Endereço" value="<?php echo (!empty($dadosusuario['endereco']))?utf8_encode($dadosusuario['endereco']):'';?>">
            </label>
            <label for="numero" id="l_numero">Nº
                <input type="number" id="numero" name="numero" placeholder="Número" min=0 value="<?php echo (!empty($dadosusuario['numero']))?$dadosusuario['numero']:'';?>">
            </label>
            <label for="complemento" id="l_complemento">Complemento
                <input type="text" id="complemento" name="complemento" placeholder="Complemento" value="<?php echo (!empty($dadosusuario['complemento']))?utf8_encode($dadosusuario['complemento']):'';?>" >
            </label>
            <label for="cep" id="l_cep">CEP
                <input type="text" id="cep" name="cep" placeholder="CEP" maxlength="9" onkeydown="Mascara(this,Cep);" onkeypress="Mascara(this,Cep);" onkeyup="Mascara(this,Cep);" value="<?php echo (!empty($dadosusuario['cep']))?$dadosusuario['cep']:'';?>">
            </label>

            <label for="facebook" id="l_facebook">Facebook
                <input type="text" id="facebook" name="facebook" placeholder="Facebook" value="<?php echo (!empty($dadosusuario['facebook']))?utf8_encode($dadosusuario['facebook']):'';?>">
            </label>
            <label for="google" id="l_google">Google+
                <input type="text" id="google" name="googleplus" placeholder="Google+" value="<?php echo (!empty($dadosusuario['google_plus']))?utf8_encode($dadosusuario['google_plus']):'';?>">
            </label>
            <label for="twitter" id="l_twitter">Twitter
                <input type="text" id="twitter" name="twitter" placeholder="Twitter+" value="<?php echo (!empty($dadosusuario['twitter']))?utf8_encode($dadosusuario['twitter']):'';?>">
            </label>
            <label for="linkin" id="l_linkin">Linkin
                <input type="text" id="linkin" name="linkedin" placeholder="Linkedin" value="<?php echo (!empty($dadosusuario['linkedin']))?utf8_encode($dadosusuario['linkedin']):'';?>">
            </label>

            <input type="reset" value="Cancelar">
            <input type="submit" value="Cadastrar">
        </form>
    </div>                
</article><!-- FIM CONTEÚDO -->

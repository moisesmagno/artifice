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
        <h1>Inserir Dados Pessoais</h1>

        <form name='form_insere_dados_pessoais' class="form_insere_dados_pessoais" action='<?php echo URLPH.DS;?>Usuario/AtualizaDados' method='post'>
            <label for="nome_fantasia" id="l_nome">Nome Fantasia <span>*</span>
                <input type="text" id="nome_fantasia" name="nome_fantasia" placeholder="Nome Fantasia" title="Nome Fantasia" value="<?php echo (!empty($dadosusuario['nome_fantasia']))?utf8_encode($dadosusuario['nome_fantasia']):'';?>" required>
            </label>
            <label for="razao_social" id="l_razao_social">Razão Social <span>*</span>
                <input type="text" id="razao_social" name="razao_social" placeholder="Razão Social" title="Razão Social" value="<?php echo (!empty($dadosusuario['razao_social']))?utf8_encode($dadosusuario['razao_social']):'';?>" required>
            </label>
            <label for="ins_esta" id="l_ins_esta">Inscrição Estadual <span>*</span>
                <input type="text" id="ins_esta" name="ins_esta" placeholder="Inscrição Estadual" title="Inscrição Estadual" maxlength="15" onkeydown="Mascara(this,InscEst);" onkeypress="Mascara(this,InscEst);" onkeyup="Mascara(this,InscEst);" value="<?php echo (!empty($dadosusuario['insc_est']))? $dadosusuario['insc_est'] : '';?>" required>
            </label>
            <label for="cnpj" id="l_cnpj">CNPJ <span>*</span>
                <input type="text" id="cnpj" name="cnpj" placeholder="CNPJ" title="CNPJ" maxlength="18" onkeydown="Mascara(this,Cnpj);" onkeypress="Mascara(this,Cnpj);" onkeyup="Mascara(this,Cnpj);" value="<?php echo (!empty($dadosusuario['cnpj']))? $dadosusuario['cnpj'] : '';?>" required>
            </label>
            <label for="pais" id="l_pais_comp">Pais <span>*</span>
                <select name="pais" id="pais" title="Pais" onchange="CarregaEstadosD(this.value)" required>
                    <option value=""></option>
                    <?php 
                        $pc = new PECController(); //Instanciando um objeto da classe PECController.
                        $pais = $pc->actionPaises();
                        foreach($pais as $p):
                    ?>
                    <option <?php echo ($p['pais_id'] == $dadosusuario['pais_id']) ? 'selected' : ''; ?> value="<?php echo $p['pais_id']?>"><?php echo utf8_encode($p['pais_nome'])?></option>
                    <?php 
                        endforeach;
                    ?> 
                </select>
            </label>
            <label for="estado" id="l_estado_comp">Estado <span>*</span>
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
                        $pc = new PECController(); //Instanciando um objeto da classe PECController.
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
                <?php
                    endif;
                ?>
            </label>
            <label for="cidade" id="l_cidade_comp">Cidade <span>*</span>
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
                <?php
                    endif;
                ?>
            </label>
            <label for="telefone" id="l_telefone_comp">Telefone Fixo
                <input type="tel" id="telefone" name="telefone" placeholder="Telefone Fixo" maxlength="14" onkeydown="Mascara(this,Telefone);" onkeypress="Mascara(this,Telefone);" onkeyup="Mascara(this,Telefone);" value="<?php echo (!empty($dadosusuario['telefone']))? $dadosusuario['telefone'] : '';?>">
            </label>
            <label for="celular" id="l_celular_comp">Celular
                <input type="tel" id="celular" name="celular" placeholder="Celular" maxlength="15" onkeydown="Mascara(this,TelefoneCel);" onkeypress="Mascara(this,TelefoneCel);" onkeyup="Mascara(this,TelefoneCel);" value="<?php echo (!empty($dadosusuario['celular']))? $dadosusuario['celular'] : '';?>">
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
                <input type="number" id="numero" name="numero" placeholder="Número" min="0" value="<?php echo (!empty($dadosusuario['numero']))? $dadosusuario['numero']:'';?>">
            </label>
            <label for="complemento" id="l_complemento">Complemento
                <input type="text" id="complemento" name="complemento" placeholder="Complemento" value="<?php echo (!empty($dadosusuario['complemento']))?utf8_encode($dadosusuario['complemento']):'';?>">
            </label>
            <label for="cep" id="l_cep">CEP
                <input type="text" id="cep" name="cep" placeholder="CEP" maxlength="9" onkeydown="Mascara(this,Cep);" onkeypress="Mascara(this,Cep);" onkeyup="Mascara(this,Cep);" value="<?php echo (!empty($dadosusuario['cep']))? $dadosusuario['cep'] : '';?>">
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

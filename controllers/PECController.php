<?php
    class PECController{
        //Recupera todos os paises registrados.
        public function actionPaises(){
            $pd = new PECDAO();
            return $pd->devolvePaises();
        }
        
        //Recupera todos os estados registrados e que fazem parte do grupo onde se encontra o estado do usuario logado.
        public function actionTodosEstados(){
            $ss = new Sessao(FALSE);
            $um = new UsuarioModel();
            $um->setId($ss->devSessao('id'));
            
            $pd = new PECDAO();
            return $pd->devolveTodasEstados($um);
        }
        
        //Recupera todos as cidades registradas e que fazem parte do grupo onde se encontra a cidade do usuario logado.
        public function actionTodasCidasdes(){
            $ss = new Sessao(FALSE);
            $um = new UsuarioModel();
            $um->setId($ss->devSessao('id'));
            
            $pd = new PECDAO();
            return $pd->devolveTodassCidades($um);
        }
        
        //------------------------------------------------------------------------------------------------
        
        //Recupera os estados da busca feita pelo artista..
        public function actionEstados(){
            if(isset($_GET['idpais']) && !empty($_GET['idpais'])):
                $pm = new PECModel;
                $pm->setIdPais($_GET['idpais']);

                $pd = new PECDAO();
                $estados = $pd->devolveEstados($pm);
                
                echo '<select name="estado" class="estado" onchange="CarregaCidades(this.value)">';
                    foreach($estados as $key):
                        echo '<option value="'.$key['est_id'].'">'.utf8_encode($key['est_nome']).'</option>';
                    endforeach;  
                        echo '<option selected value="0">Todos</option>';
                echo '</select>';
            endif; 
        }
        
        //Recupera os estados da busca feita pela companhia.
        public function actionEstadosComp(){
            if(isset($_GET['idpais']) && !empty($_GET['idpais'])):
                $pm = new PECModel();
                $pm->setIdPais($_GET['idpais']);

                $pd = new PECDAO();
                $estados = $pd->devolveEstados($pm);
                
                echo '<select name="estado" class="estado" onchange="CarregaCidadesComp(this.value)">';
                    foreach($estados as $key):
                        echo '<option value="'.$key['est_id'].'">'.utf8_encode($key['est_nome']).'</option>';
                    endforeach;  
                        echo '<option selected value="0">Todos</option>';
                echo '</select>';
            endif; 
        }
        
//--------------------------------------------------------------------------------------------------------------------

        //Recupera os estados que serão registrado ou editados nos dados do artista ou companhia.
        public function actionEstadosD(){
            if(isset($_GET['idpais']) && !empty($_GET['idpais'])):
                $pm = new PECModel();
                $pm->setIdPais($_GET['idpais']);

                $pd = new PECDAO();
                $estados = $pd->devolveEstados($pm);
                
                echo '<select name="estado" id="estado" title="Estado" onchange="CarregaCidadesD(this.value)" required>';
                    foreach($estados as $key):
                        echo '<option value="'.$key['est_id'].'">'.utf8_encode($key['est_nome']).'</option>';
                    endforeach;  
                        echo '<option selected value="0"></option>';
                echo '</select>';
            endif; 
        }
        
        //Retorna as cidades.
        public function actionCidades(){
            if(isset($_GET['idestado']) && !empty($_GET['idestado'])):
                $pm = new PECModel();
                $pm->setIdEstado($_GET['idestado']);

                $pd = new PECDAO();
                $cidades = $pd->devolveCidades($pm);
                
                echo '<select name="cidade" class="cidade">';
                    echo '<option selected value="0">Todos</option>';
                    foreach($cidades as $key):
                        echo '<option value="'.$key['cid_id'].'">'.utf8_encode($key['cid_nome']).'</option>';
                    endforeach;  
                echo '</select>';
            endif; 
        }
        
        //Recupera as cidades que serão registrado ou editados nos dados do artista ou companhia.
        public function actionCidadesD(){
            if(isset($_GET['idestado']) && !empty($_GET['idestado'])):
                $pm = new PECModel();
                $pm->setIdEstado($_GET['idestado']);

                $pd = new PECDAO();
                $cidades = $pd->devolveCidades($pm);
                
                echo '<select name="cidade" id="cidade" title="Cidade" required>';
                    foreach($cidades as $key):
                        echo '<option value="'.$key['cid_id'].'">'.utf8_encode($key['cid_nome']).'</option>';
                    endforeach;  
                        echo '<option selected value="0"></option>';
                echo '</select>';
            endif; 
        }
    }
?>
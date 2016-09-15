<?php
    class SeguirController{
        
        //Envia o id do usuário para o SeguirDAO, assim recuperamos as Pessoas que o usuário está seguindo.
        public function actionPessoasSeguindo($id){
            
            $um = new UsuarioModel();
            $um->setId($id);
            
            $sd = new SeguirDAO();
            return $sd->recuperaPessoasSeguindo($um);//Enviando um objeto no parâmetro.
        }
        
        //Envia o id do usuário para o SeguirDAO, assim recuperamos as Pessoas que estão seguindo o usuário.
        
        public function actionPessoasMeSeguindo($id){
            
            $um = new UsuarioModel();
            $um->setId($id);
            
            $sd = new SeguirDAO();
            return $sd->recuperaPessoasMeSeguindo($um);//Enviando um objeto no parâmetro.
        }
        
        //Verifica se o usuário logado já está seguindo uma pessa em específico.
        public function actionVerificaSeguindo($id,$idseguindo){
            $sm = new SeguirModel();
            $sm->setId($id);
            $sm->setIdSeguir($idseguindo);
            
            $sd = new SeguirDAO();

            if($sd->verificaSeguindo($sm)):
                return TRUE;
            else:
                return FALSE;
            endif;
        }
        
        //Metodo que recebe o Id da pessoa que vai ser seguido.
        public function actionSeguir(){
            $me = new MetodosExtras();
            
            $ss = new Sessao();
            $sm = new SeguirModel();
            $sm->setId($ss->devSessao('id'));
            $sm->setIdSeguir($_GET['usu']);
               
            $sd = new SeguirDAO();
            if($sd->insereSeguir($sm)):
                if($_GET['tp'] == 1):
                    $me->redireciona('Artista/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=um&en=sim');
                else:
                    $me->redireciona('Companhia/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=um&en=sim');
                endif;
            else:
                if($_GET['tp'] == 1):
                    $me->redireciona('Artista/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=dois');
                else:
                    $me->redireciona('Companhia/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=dois');
                endif;
            endif;
        }
        
        //Metodo que recebe o Id da pessoa que vai deixar de seguir.
        public function actionDeixarSeguir(){
            $me = new MetodosExtras();
            
            $ss = new Sessao();
            $sm = new SeguirModel();
            $sm->setId($ss->devSessao('id'));
            $sm->setIdSeguir($_GET['usu']);
            
               
            $sd = new SeguirDAO();
            if($sd->dexarSeguir($sm) == 2):
                if($_GET['tp'] == 1):
                    $me->redireciona('Artista/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=tres');
                else:
                    $me->redireciona('Companhia/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=tres');
                endif;
            else:
                if($_GET['tp'] == 1):
                    $me->redireciona('Artista/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=quatro');
                else:
                    $me->redireciona('Companhia/Perfil&usu='.$_GET['usu'].'&tp='.$_GET['tp'].'&op=quatro');
                endif;
            endif;
        }
    }
?>


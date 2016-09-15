<?php
    class CompanhiaController{

        //CHAMA O PERFIL DA COMPANHIA.
        public function actionPerfil(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('perfilCompanhia');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
        //CHAMA A PÁGINA QUE INSERE OS DADOS PESSOAIS DA COMPANHIA.
        public function actionInserirDados(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('dadosCompanhia');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
    }
?>


<?php
    class HomeController{
        
//CHAMA A PÁGINA HOME E BUSCA.
        public function actionHome(){
            //Verifica se o usuário está logado. 
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('home');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
    }
?>


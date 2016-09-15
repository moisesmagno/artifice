<?php
    class ArtistaController{
        
        //CHAMA O PERFIL DO ARTÍSTA.
        public function actionPerfil(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('perfilArtista');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;    
        }
        
        //CHAMA A PÁGINA QUE INSERE OS DADOS PESSOAIS DO ARTÍSTA.
        public function actionInserirDadosPessoais(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('dadosPessoaisArtista');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;  
        }
   
    }
?>


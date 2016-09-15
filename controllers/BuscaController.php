<?php
    class BuscaController{
        
        //CHAMA A PÁGINA COM O RESULTADO DE BUSCA DOS ARTÍSTAS.
        public function actionArtistas(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('buscaArtista');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;     
        }
        
        //CHAMA A PÁGINA COM O RESULTADO DE BUSCA DAS COMPANHIAS.
        public function actionCompanhias(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):    
                $ly = new Layouts();
                $ly->montaView('buscaCompanhia');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif; 
        }
        
        //Recupera todas as categorias.
        public function actionCategorias(){
            $bd = new BuscarDAO();
            return $bd->devolveCategorias();
        }
        
        //Retorna todos os artistas que foram filtrados no busca, que fica no home.
        public function actionRetornaArtistas($post = array()){
            $bm = new BuscarModel();
            $bm->setCategoria($post['categoria']);
            $bm->setIdade($post['idade']);
            $bm->setPais($post['pais']);
            $bm->setEstado($post['estado']);
            $bm->setCidade($post['cidade']);
            
            $bd = new BuscarDAO();
            $dados = $bd->devolveArtistas($bm);
            return $dados;
        }
        
        //Retorna todas as companhias que foram filtrados no busca, que fica no home.
        public function actionRetornaCompanhias($post = array()){
            $bm = new BuscarModel();
            $bm->setPais($post['pais']);
            $bm->setEstado($post['estado']);
            $bm->setCidade($post['cidade']);
            
            $bd = new BuscarDAO();
            $dados = $bd->devolveCompanhias($bm);
            return $dados;
        }
    }
?>
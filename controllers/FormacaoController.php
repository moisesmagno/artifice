<?php
    class FormacaoController{
        
        //CHAMA A PÁGINA QUE INSERE DADOS DA FORMAÇÃO DO ARTÍSTA.
        public function actionInserir(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('formacao');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;    
        }
        
        //Insere uma nova formação.
        public function actionNovaFormacao(){
            $dados = array(
                'escola' => strip_tags(utf8_decode($_POST['escola'])),
                'dataini' => strip_tags($_POST['dataini']),
                'datafim' => strip_tags($_POST['datafim']),
                'formacao' => strip_tags(utf8_decode($_POST['formacao'])),
                'descricao' => strip_tags(utf8_decode($_POST['descricao']))
            );
            
            $me = new MetodosExtras();
            if($me->verificaCampos($dados)):
                //Instanciamos a classe sessão para pegar o id do usuário que está na sessão.
                $ss = new Sessao();
                
                $art = new ArtistaModel();
                $art->setId($ss->devSessao('id'));
                $art->setaFormacao($dados['escola'], $dados['dataini'], $dados['datafim'], $dados['formacao'], $dados['descricao']);

                $fd = new FormacaoDAO();
                if($fd->inserirFormacao($art)):
                    $me->redireciona('Formacao/Inserir');
                else:
                    $me->redireciona('Formacao/Inserir&op=tres');
                endif;
                
            else:
                $me->redireciona('Formacao/Inserir&op=um');
            endif;
        }
        
        //CHAMA A PÁGINA QUE EDITA DADOS DA FORMAÇÃO DO ARTÍSTA.
        public function actionEditar(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('editarFormacao');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;        
        }
        
        //EDITA A FORMAÇÃO DO USUÁRIO.
        public function actionEditarFormacao(){
            $dados = array(
                'id' => $_POST['form_id'], 
                'escola' => strip_tags(utf8_decode($_POST['escola'])),
                'dataini' => strip_tags($_POST['dataini']),
                'datafim' => strip_tags($_POST['datafim']),
                'formacao' => strip_tags(utf8_decode($_POST['formacao'])),
                'descricao' => strip_tags(utf8_decode($_POST['descricao']))
            );
            
            $me = new MetodosExtras();
            if($me->verificaCampos($dados)):
                $fm = new FormacaoModel();
                $fm->setIdForm($dados['id']);
                $fm->setEscola($dados['escola']);
                $fm->setDataIni($dados['dataini']);
                $fm->setDataFim($dados['datafim']);
                $fm->setFormacao($dados['formacao']);
                $fm->setDescricao($dados['descricao']);
                
                $fd = new FormacaoDAO();
                if($fd->editarFormacao($fm)):
                  $me->redireciona('Formacao/Editar&op=dois');
                else:
                  $me->redireciona('Formacao/Editar&op=tres');
                endif;
            else:
                $me->redireciona('Formacao/Editar&op=um');
            endif;
        }
        
        //Exclui a formção do usuário.
        public function actionExcluirFormacao(){
            
            $me = new MetodosExtras();
            
            if(isset($_GET['idf']) && !empty($_GET['idf'])):
                
                $fm = new FormacaoModel();
                $fm->setIdForm($_GET['idf']);
                
                $fd = new FormacaoDAO();
                if($fd->exluirFormacao($fm)):
                    $me->redireciona('Formacao/Editar');    
                else:
                    $me->redireciona('Formacao/Editar&op=cinco');    
                endif;
            else: 
            $me->redireciona('Formacao/Editar&op=seis');    
            endif;
        }
        
        //Chama o método recuperaFormacao() do FormacaoDAO apra recuperar a formação do usuário.
        public function actionFormacao($id){
            $um = new UsuarioModel();
            $um->setId($id);
            
            $fd = new FormacaoDAO();
            return $fd->recuperaFormacao($um);//Passando um objeto com parâmetro.
        }
    }
?>


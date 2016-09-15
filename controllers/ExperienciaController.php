<?php
    class ExperienciaController{
        
        //CHAMA A PAGINA QUE INSERIR AS EXPERIÊNCIAS PROFISSIONAIS DOS USUÁRIOS.
        public function actionInserir(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('experienciaProfissional');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
        //REGISTRA UMA NOVA EXPERIÊNCIA.
        public function actionNovaExperiencia(){
            $dados = array(
                'empresa' => strip_tags(utf8_decode($_POST['empresa'])),
                'dataini' => $_POST['dataini'],
                'datafim' => $_POST['datafim'],
                'funcao' => strip_tags(utf8_decode($_POST['funcao'])),
                'descricao' => strip_tags(utf8_decode($_POST['descricao']))
            );
            
            $me = new MetodosExtras();
            if($me->verificaCampos($dados)):
                $ss = new Sessao();//Instanciamos por causa que o id do usuário está na sessão.
                if($ss->devSessao('tipo') == 1):
                    $um = new ArtistaModel();
                    $um->setId($ss->devSessao('id'));
                    $um->setarExp($dados['empresa'], $dados['dataini'], $dados['datafim'], $dados['funcao'], $dados['descricao']);
                else:
                    $um = new CompanhiaModel;
                    $um->setId($ss->devSessao('id'));
                    $um->setarExp($dados['empresa'], $dados['dataini'], $dados['datafim'], $dados['funcao'], $dados['descricao']);
                endif;
                
                $ed = new ExperienciaDAO();
                if($ed->inserirExperiencia($um)):
                    $me->redireciona('Experiencia/Inserir&op=dois');
                else: 
                    $me->redireciona('Experiencia/Inserir&op=tres');
                endif;
            else:
                $me->redireciona('Experiencia/Inserir&op=um');
            endif;
        }
        
        //Chama o método recuperaExperiencias() do ExperienciaDAO e recupera as experiências pprofissionais do usuário.
        public function actionExperiencias($id){
            $um = new UsuarioModel();
            $um->setId($id);
            
            $ed = new ExperienciaDAO();
            return $ed->recuperaExperiencias($um);//Passando um objeto com parâmetro.
        } 
        
        //CHAMA A PAGINA QUE EDITA AS EXPERIÊNCIAS PROFISSIONAIS DOS USUÁRIOS.        
        public function actionEditar(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('editarExperienciaProfissional');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
        //Edita a experiência escolhida pelo usuário.
        public function actionEditarExperiencia(){
            $dados = array(
                'id' => $_POST['idexp'],
                'empresa' => strip_tags(utf8_decode($_POST['empresa'])),
                'dataini' => $_POST['dataini'],
                'datafim' => $_POST['datafim'],
                'funcao' => strip_tags(utf8_decode($_POST['funcao'])),
                'descricao' => strip_tags(utf8_decode($_POST['descricao']))
            );
            
            $me = new MetodosExtras();
            if($me->verificaCampos($dados)):
                $em = new ExperienciaModel();  
                $em->setIdExp($dados['id']);
                $em->setEmpresa($dados['empresa']);
                $em->setDataini($dados['dataini']);
                $em->setDatafim($dados['datafim']);
                $em->setFuncao($dados['funcao']);
                $em->setDescricao($dados['descricao']);
                
                $ed = new ExperienciaDAO();
                if($ed->editarExperiencia($em)):
                    $me->redireciona('Experiencia/Editar&op=dois');
                else: 
                    $me->redireciona('Experiencia/Editar&op=tres');
                endif;
            else:
                $me->redireciona('Experiencia/Editar&op=um');
            endif;
            
        }
        
        //Esclui uma experiência escolhido pelo usuário.
        public function actionExcluirExperiencia(){
            $me = new MetodosExtras();
            if(isset($_GET['idexp']) && !empty($_GET['idexp'])):
                $em = new ExperienciaModel();
                $em->setIdExp($_GET['idexp']);
                
                $ed = new ExperienciaDAO();
                if($ed->excluirExperiencia($em)):
                    $me->redireciona('Experiencia/Editar&op=cinco');
                else:    
                    $me->redireciona('Experiencia/Editar&op=seis');
                endif;
            else:
                $me->redireciona('Experiencia/Editar&op=quatro');
            endif;
        }
    }
?>
<?php
    class LoginController{
        
        //CHAMA A PÁGINA LOGIN.
        public function actionLogin(){
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $me = new MetodosExtras();
                $me->redireciona('home/home');
            else:
                $ly = new Layouts();    
                $ly->montaView('login');
            endif;
        }
        
        //VERIFICA SE O EMAIL E SENHA INSERIDOS EXISTEM NO BANCO.CASO EXISTAM, O SISTEMA PERMITE ACESSAR AO PERFIL, SENÃO NÃO.
        public function actionAutenticar(){
            
            $dados_obrigatorios = array(
                'email' => $_POST['email'],
                'senha' => $_POST['senha']
            );
            
            $me = new MetodosExtras();
            if($me->verificaCampos($dados_obrigatorios)):
                $uc = new UsuarioModel();
                $uc->setEmail($dados_obrigatorios['email']);
                $uc->setSenha($dados_obrigatorios['senha']);
                
                $ld = new LoginDAO();
                if($ld->vericarEmailSenha($uc)):
                    //Recupera alguns dados básicos do usuário e os coloca na sessão.
                    $uc = new UsuarioController();
                    $db = $uc->actionIDTipo($dados_obrigatorios);
                    
                    $ss = new Sessao();
                    $ss->criaSessao('id', $db['usu_id']);
                    $ss->criaSessao('tipo', $db['usu_tipo_usu']);
                    $ss->criaSessao('email', $dados_obrigatorios['email']);
                    $ss->criaSessao('senha', md5($dados_obrigatorios['senha']));
                    $ss->criaSessao('status', 'logado');
                    $me->redireciona('home/home');
                else: 
                    $me->redireciona('login/login&op=dois');
                endif;
            else: 
                $me->redireciona('login/login&op=um');    
            endif;
        }
        
        //Verifica se o E-mail do usuário que quer receber a conta existe no banco.
        public function actionRecuperaConta(){
            $me = new MetodosExtras();
            
            $um = new UsuarioModel();
            $um->setEmail($_POST['email_rc']);
           
            $cd = new CadastrarDao();
            if($cd->verificaEmail($um)):
                 $ld = new LoginDAO();
                 if($ld->AtivarUsu($um)):
                     $dadosemail = array(
                            'nome' => $_POST['nome_rc'],
                            'email' => $_POST['email_rc'],
                            'tipoenv' => 2);
                 
                     $em = new Email();
                     if($em->eviarEmail($dadosemail)):
                         $me->redireciona('login/login&op=quatro');
                     else:    
                         $me->redireciona('login/login&op=cinco');
                     endif;
                 else:
                     $me->redireciona('login/login&op=seis');
                 endif;
            else:
                $me->redireciona('login/login&op=sete');
            endif;
            
        }
        
    }

?>
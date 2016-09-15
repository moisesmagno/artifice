<?php
    class UsuarioController{
        
        //Recupera o IDe tipo do usuário.
        public function actionIDTipo($dados = array()){
           $um = new UsuarioModel();
           $um->setEmail($dados['email']);
           $um->setSenha($dados['senha']);
           
           $ud = new UsuarioDAO();
           $dr = $ud->recuperaIDTipo($um);//Passando um objeto com parâmetro.
           return $dr;
        }
        
        //Recupera o nome do usuário logado.
        public function actionRecuperaNome($id, $tipo){
            $um = new UsuarioModel();
            $um->setId($id);
            $um->setTipo($tipo);
            
            $ud = new UsuarioDAO();
            return $ud->recuperaNome($um); //Passando um objeto com parâmetro.
        }
        
        //Atualiza os dados basicos do usuário
        public function actionAtualizaDados(){
            $ss = new Sessao();
            if($ss->devSessao('tipo') == 1)://Se for artista.
                $obrigatorios = array('nome'=>strip_tags(utf8_decode($_POST['nome'])),'nome_artistico'=>strip_tags(utf8_decode($_POST['nome_artistico'])),
                                  'rg'=>strip_tags(utf8_decode($_POST['rg'])),'cpf'=>$_POST['cpf'],
                                  'drt'=>strip_tags(utf8_decode($_POST['drt'])),'categoria'=>$_POST['categoria'],
                                  'datanasc'=>substr($_POST['datanasc'], 6, 4).substr($_POST['datanasc'], 2, -4).substr($_POST['datanasc'], 0, -8),
                                  'pais'=>$_POST['pais'],'estado'=>$_POST['estado'], 'cidade'=>$_POST['cidade']);
            else:     
                //Se for Companhia
                $obrigatorios = array('nome_fantasia'=>strip_tags(utf8_decode($_POST['nome_fantasia'])),'razao_social'=>strip_tags(utf8_decode($_POST['razao_social'])),
                                  'ins_esta'=>$_POST['ins_esta'],'cnpj'=>$_POST['cnpj'],
                                  'pais'=>$_POST['pais'],'estado'=>$_POST['estado'], 'cidade'=>$_POST['cidade']);
            endif;    
            
            $me = new MetodosExtras();
            if($me->verificaCampos($obrigatorios)):
               $outros = array('telefone'=>$_POST['telefone'],'celular'=>$_POST['celular'],'site'=>strip_tags(utf8_decode($_POST['site'])),
                               'bairro'=>strip_tags(utf8_decode($_POST['bairro'])),'endereco'=>strip_tags(utf8_decode($_POST['endereco'])),
                               'numero'=>$_POST['numero'],'complemento'=>strip_tags(utf8_decode($_POST['complemento'])),'cep'=>$_POST['cep'],
                               'facebook'=>strip_tags(utf8_decode($_POST['facebook'])),'googleplus'=>strip_tags(utf8_decode($_POST['googleplus'])),
                               'twitter'=>strip_tags(utf8_decode($_POST['twitter'])),'linkedin'=>strip_tags(utf8_decode($_POST['linkedin'])));
               
               if($ss->devSessao('tipo') == 1)://Seta os Dados só do artista
                    $dusu = new ArtistaModel();
                    $dusu->setId($ss->devSessao('id'));
                    $dusu->setTipo($ss->devSessao('tipo'));
                    $dusu->setPais($obrigatorios['pais']);
                    $dusu->setEstado($obrigatorios['estado']);
                    $dusu->setCidade($obrigatorios['cidade']);
                    $dusu->setTelefone($outros['telefone']);
                    $dusu->setCelular($outros['celular']);
                    $dusu->setSite($outros['site']);
                    $dusu->setBairro($outros['bairro']);
                    $dusu->setEndereco($outros['endereco']);
                    $dusu->setNumero($outros['numero']);
                    $dusu->setComplemento($outros['complemento']);
                    $dusu->setCEP($outros['cep']);
                    $dusu->setFacebook($outros['facebook']);
                    $dusu->setGooglePlus($outros['googleplus']);
                    $dusu->setTwitter($outros['twitter']);
                    $dusu->setLinkedin($outros['linkedin']);
                    $dusu->setNome($obrigatorios['nome']);
                    $dusu->setNomeArtistico($obrigatorios['nome_artistico']);
                    $dusu->setRG($obrigatorios['rg']);
                    $dusu->setCPF($obrigatorios['cpf']);
                    $dusu->setDRT($obrigatorios['drt']);
                    $dusu->setCategoria($obrigatorios['categoria']);
                    $dusu->setDataNasc($obrigatorios['datanasc']);
               else:
                   //Seta os Dados só da companhia.
                    $dusu = new CompanhiaModel();
                    $dusu->setId($ss->devSessao('id'));
                    $dusu->setTipo($ss->devSessao('tipo'));
                    $dusu->setPais($obrigatorios['pais']);
                    $dusu->setEstado($obrigatorios['estado']);
                    $dusu->setCidade($obrigatorios['cidade']);
                    $dusu->setTelefone($outros['telefone']);
                    $dusu->setCelular($outros['celular']);
                    $dusu->setSite($outros['site']);
                    $dusu->setBairro($outros['bairro']);
                    $dusu->setEndereco($outros['endereco']);
                    $dusu->setNumero($outros['numero']);
                    $dusu->setComplemento($outros['complemento']);
                    $dusu->setCEP($outros['cep']);
                    $dusu->setFacebook($outros['facebook']);
                    $dusu->setGooglePlus($outros['googleplus']);
                    $dusu->setTwitter($outros['twitter']);
                    $dusu->setLinkedin($outros['linkedin']);
                    $dusu->setRazaoSocial($obrigatorios['nome_fantasia']);
                    $dusu->setNomeFantasia($obrigatorios['razao_social']);
                    $dusu->setInscEstadual($obrigatorios['ins_esta']);
                    $dusu->setCNPJ($obrigatorios['cnpj']);
               endif;
               
               $ud = new UsuarioDAO();
               if($ud->atualizarDados($dusu)):
                   if($ss->devSessao('tipo') == 1):
                       $me->redireciona('Artista/InserirDadosPessoais&op=dois');
                   else:
                       $me->redireciona('Companhia/InserirDados&op=dois');
                   endif;
               else:
                   if($ss->devSessao('tipo') == 1):
                       $me->redireciona('Artista/InserirDadosPessoais&op=tres');
                   else:
                       $me->redireciona('Companhia/InserirDados&op=tres');
                   endif;
               endif;
               
            else:
                if($ss->devSessao('tipo') == 1):
                    $me->redireciona('Artista/InserirDadosPessoais&op=um');
                else:
                    $me->redireciona('Companhia/InserirDados&op=um');
                endif;
            endif;
        }
        
        //Recupera os dados básicos do usuário.
        public function actionDadosUsu($id, $tipo){
            $um = new UsuarioModel();
            $um->setId($id);
            $um->setTipo($tipo);
                        
            $ud = new UsuarioDAO();
            return $ud->retornaDadosUsu($um); //Passando um objeto com parâmetro.
        }
        
        //CHAMA A PÁGINA QUE ALTERA A SENHA DO USUÁRIO.
        public function actionAlterarSenha(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('alterarSenha');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;    
        }
        
        //Método que realiza a alteração da senha do usário.
        public function actionAlterarSenhaUsu(){
            $dados = array(
                'senha_atual' => md5($_POST['senha_atual']),
                'nova_senha' => $_POST['nova_senha'],
                'nova_senha_conf' => $_POST['nova_senha_conf']
            );

            $ss = new Sessao();
            $me = new MetodosExtras();

            if($me->verificaCampos($dados)):
                if($dados['senha_atual'] == $ss->devSessao('senha')):
                    if($dados['nova_senha'] == $dados['nova_senha_conf']):
                        $um = new UsuarioModel();
                        $um->setId($ss->devSessao('id'));
                        $um->setSenha($dados['nova_senha']);
                        
                        $ud = new UsuarioDAO();
                        if($ud->alterarSenha($um))://Enviando um objeto pelo parâmetro.
                            $me->redireciona('Usuario/AlterarSenha&op=cinco');
                        else:
                            $me->redireciona('Usuario/AlterarSenha&op=quatro');
                        endif;
                    else:
                        $me->redireciona('Usuario/AlterarSenha&op=tres');
                    endif;    
                else:
                    $me->redireciona('Usuario/AlterarSenha&op=dois');
                endif;    
            else:
                $me->redireciona('Usuario/AlterarSenha&op=um');
            endif;
        }
        
        //CHAMA A PÁGINA DE CONFIRMAÇÃO DO ENCERRAMENTO DE CONTA.
        public function actionDesativarConta(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('desativaConta');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
        //Desativa a conta do usúario.
        public function actionDesativaConta(){
            $ss = new Sessao();
            $um = new UsuarioModel();
            $um->setId($ss->devSessao('id'));
            
            $me = new MetodosExtras();
            
            //Método que altera o status do usuário para zero.
            $ud = new UsuarioDAO();
            if($ud->desativaConta($um)):
                $ss->destroiTodasSessoes();
                $me->redireciona('login');
            else:
                $me->redireciona('Usuario/DesativarConta&op=um');
            endif;
        }
        
        //CHAMA A PÁGINA PARA A INSERÇÃO E EDIÇÃO DA FOTO DO PERFIL DO USUÁIO.
        public function actionFotoPerfil(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('fotoPerfil');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
        //Insere a foto do perfil do usuário.
        public function actionInserirFotoPerfil(){
            
            if(isset($_FILES) && !empty($_FILES)):
                
                $arquivo = array(
                    'nome' => $_FILES['arquivo']['name'],
                    'type' => $_FILES['arquivo']['type'],
                    'tmp_name' => $_FILES['arquivo']['tmp_name'],
                    'erro' => $_FILES['arquivo']['error'],
                    'tamanho_img' => $_FILES['arquivo']['size'],
                    'pasta' => 'view/img/usu');
                
                //Verifica o se o upload foi um sucesso ou se existem erros.
                $up = new Upload();        
                $reposta = $up->actionUpload($arquivo);
   
                    $me = new MetodosExtras();//Instanciando esta classe, para realizar os redirecionamento.
                    switch($reposta):
                        case 'um':
                            //Não foi Possivel fazer Upload da Imagem!
                            $me->redireciona('Usuario/fotoperfil&op=um');
                            break;
                        case 'dois':
                            //Informa que o a extesão da img do usúario não corresponde aos já estabelicidos.
                            $me->redireciona('Usuario/fotoperfil&op=dois');
                            break;
                        case 'tres':
                            //Informa que o arquivo ultrapasa o limite do tamanho especificado.
                            $me->redireciona('Usuario/fotoperfil&op=dois');
                            break;
                        case 'cinco':
                            //Houve um erro na execução do upload da imagem.
                            $me->redireciona('Usuario/fotoperfil&op=dois');
                            break;
                        default:
                                //Instancia a classe sessão para devolver o id do usário logado.
                                $ss = new Sessao();
                                $um = new UsuarioModel();
                                $um->setId($ss->devSessao('id'));
                                $um->setFotoPerf($reposta);
                                
                                //Inserção da foto do perfil no banco.
                                $ud = new UsuarioDAO();
                                if($ud->inserirFotoPerfil($um)):
                                    $me->redireciona('Usuario/fotoperfil&op=quatro');//Mostra que o upload foi realizado com sucesso.
                                endif;
                            break;
                    endswitch;
            else:
                $me = new MetodosExtras();
                $me->redireciona('Usuario/fotoperfil&op=seis');
            endif;
        }
        
        //Desloga o usuário e redireciona a págin de Login.
        public function actionSair(){
            $ss = new Sessao();
            $ss->destroiTodasSessoes();
        
            $me = new MetodosExtras();
            $me->redireciona('login');
        }
        
    }
?>
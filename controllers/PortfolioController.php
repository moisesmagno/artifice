<?php
    class PortfolioController{
        
        //CHAMA A PÁGINA QUE INSERI FOTOS E DESCRIÇÕES NO PORTFOLIO.
        public function actionInserir(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('inserirFotoPortfolio');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
                
        //CHAMA A PÁGINA QUE INSERI FOTOS E DESCRIÇÕES NO PORTFOLIO.
        public function actionEditar(){
            //Verifica se o usuário está logado.
            $ss = new Sessao();
            if($ss->getSessao('email') && $ss->getSessao('senha') && $ss->getSessao('status')):
                $ly = new Layouts();
                $ly->montaView('editarFotoPortfolio');
            else:
                $me = new MetodosExtras();
                $me->redireciona('login/login&op=tres');
            endif;
        }
        
        //Envia um objeto com o id do usuário para recuperar o portfolio completo do mesmo.
        public function actionRecuperaPortfolio($id){
            $um = new UsuarioModel();
            $um->setId($id);
            
            $pd = new PortfolioDAO();
            return $pd->retornaPortfolio($um);//Enviando um objeto no parâmentro.
        }
        
        //Upload da imagem e dados do portfolio do usuário.
        public function actionInserirFotoPortfolio(){
            
            if(isset($_FILES) && !empty($_FILES) && isset($_POST) && !empty($_POST)):
                
                $arquivo = array(
                    'nome' => $_FILES['arquivo']['name'],
                    'type' => $_FILES['arquivo']['type'],
                    'tmp_name' => $_FILES['arquivo']['tmp_name'],
                    'erro' => $_FILES['arquivo']['error'],
                    'tamanho_img' => $_FILES['arquivo']['size'],
                    'pasta' => 'view/img/portfolio'
                );
            
                $tt_desc = array(
                    'titulo' => strip_tags(utf8_decode($_POST['titulo'])),
                    'descricao' => strip_tags(utf8_decode($_POST['descricao']))
                );
                
                $me = new MetodosExtras();
                //Metodo que verifica se os campos obrigatórios estão preenchidos corretamente.
                if($me->verificaCampos($tt_desc)):
                    $uc = new Upload();
                    $reposta = $uc->actionUpload($arquivo);//Realiza upload da foto.
                
                    switch($reposta):
                        case 'um':
                            //Não foi Possivel fazer Upload da Imagem!
                            $me->redireciona('Portfolio/Inserir&op=um');
                            break;
                        case 'dois':
                            //Informa que o a extesão da img do usúario não corresponde aos já estabelicidos.
                            $me->redireciona('Portfolio/Inserir&op=dois');
                            break;
                        case 'tres':
                            //Informa que o arquivo ultrapasa o limite do tamanho especificado.
                            $me->redireciona('Portfolio/Inserir&op=tres');
                            break;
                        case 'cinco':
                            //Houve um erro na execução do upload da imagem.
                            $me->redireciona('Portfolio/Inserir&op=cinco');
                            break;
                        default:
                                //Instancia a classe sessão para devolver o id do usário logado.
                                $ss = new Sessao();
                                if($ss->devSessao('tipo') == 1):
                                    $pu = new ArtistaModel();
                                    $pu->setId($ss->devSessao('id'));
                                    $pu->setaPortfolio($tt_desc['titulo'], $tt_desc['descricao'], $reposta);
                                else:
                                    $pu = new CompanhiaModel();
                                    $pu->setId($ss->devSessao('id'));
                                    $pu->setaPortfolio($tt_desc['titulo'], $tt_desc['descricao'], $reposta);
                                endif;
                                 
                                //Inserção da foto do perfil no banco.
                                $pd = new PortfolioDAO();
                                if($pd->inserirFotoPortf($pu)):
                                    $me->redireciona('Portfolio/Inserir&op=quatro');//Mostra que o upload foi realizado com sucesso.
                                else:
                                    $me->redireciona('Portfolio/Inserir&op=oito');
                                endif;
                            break;
                    endswitch;
                    
                else: 
                    $me->redireciona('Portfolio/Inserir&op=seis');
                endif;
                
            else:
                $me = new MetodosExtras();
                $me->redireciona('Portfolio/Inserir&op=sete');
            endif;  
        }
        
        //Atera um Portfolio.
        public function actionEditaPortfolio(){
            $campos = array(
                'id' => $_POST['id'],
                'titulo' => strip_tags(utf8_decode($_POST['titulo'])),
                'descricao' => strip_tags(utf8_decode($_POST['descricao'])),
            );
            
            $me = new MetodosExtras();
            if($me->verificaCampos($campos)):
                $pm = new PortfolioModel();
                $pm->setIdPort($campos['id']);
                $pm->setTitulo($campos['titulo']);
                $pm->setDescricao($campos['descricao']);
                
                //Envia um objeto para o PortfolioDAO, assim realizará a atualização no banco.
                $pd = new PortfolioDAO();
                if($pd->editaPortfolio($pm)):
                    $me->redireciona('Portfolio/Editar&op=dois');
                else:
                    $me->redireciona('Portfolio/Editar&op=tres');
                endif;
            else:
                $me->redireciona('Portfolio/Editar&op=um');
            endif;
        }
        
        //Exccluir Portfolio.
        public function actionExcluirPortfolio(){
            $id = (isset($_GET['idport']) && !empty($_GET['idport']))?$_GET['idport']:'0';

            $me = new MetodosExtras();//Instancia esta classe para usar o método de redirecionamento.
            
            if($id != 0):
                $pm = new PortfolioModel();
                $pm->setIdPort($id);

                //Envia um objeto por parâmetro e assim excluiremos o portfolio.
                $pd = new PortfolioDAO();
                if($pd->excluirPortfolio($pm)):
                    $me->redireciona('Portfolio/Editar&op=quatro');
                else: 
                    $me->redireciona('Portfolio/Editar&op=cinco');
                endif;
            else:
                $me->redireciona('Portfolio/Editar&op=cinco');
            endif;
            
        }
    }
?>


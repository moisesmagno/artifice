<?php
class CadastrarController{
    //CHAMA A PÁGINA DE CADASTRO DE UM NOVO USUÁRIO.
    public function actionNovoUsuario(){
        $ly = new Layouts();
        $ly->montaView('cadastro');
    }
  
    //RECEBE E FILTRA DADOS DOS INPUTS DO FORMULÁRIO DE CADASTRAR.
    public function actionFiltraDadosCadastrar(){
        
        //IF QUE VERIFICA SE TODOS OS CAMPOS FORAM PREENCHIDOS.
        if(isset($_POST['nome']) && !empty($_POST['nome']) && 
                isset($_POST['email']) && !empty($_POST['email']) && 
                isset($_POST['senha']) && !empty($_POST['senha']) && 
                isset($_POST['senha_conf']) && !empty($_POST['senha_conf']) && 
                isset($_POST['tipo_perfil']) && is_numeric($_POST['tipo_perfil']) && $_POST['tipo_perfil'] < 3 && $_POST['tipo_perfil'] > 0): 
 
            if($_POST['senha'] == $_POST['senha_conf']):
                
                $dados = array(
                    'nome' => strip_tags(utf8_decode($_POST['nome'])),
                    'email' => strip_tags(utf8_decode($_POST['email'])),
                    'senha' => $_POST['senha'],
                    'tipo' => $_POST['tipo_perfil'] 
                );
                
                //VERIFICA SE O EMAIL JÁ EXISTE.
                $cd = new CadastrarDao();
                $um = new UsuarioModel();
                $um->setEmail($dados['email']);
                if($cd->verificaEmail($um)):
                    $me = new MetodosExtras();
                    $me->redireciona('Cadastrar/NovoUsuario&op=tres');
                else:
                    //Verifica se é artista ou companhia.
                    if($dados['tipo'] == 1):
                        $obj = new ArtistaModel();
                        $obj->setNome($dados['nome']);
                        $obj->setEmail($dados['email']);
                        $obj->setSenha($dados['senha']);
                        $obj->setTipo($dados['tipo']);
                    else:
                        $obj = new CompanhiaModel();
                        $obj->setNomeFantasia($dados['nome']);
                        $obj->setEmail($dados['email']);
                        $obj->setSenha($dados['senha']);
                        $obj->setTipo($dados['tipo']);
                    endif;
                    
                    //PASSAMOS O OBJETO $obj PARA O DAO RECUPERAR AS INFORMAÇÕES, VIA GET.
                    if($cd->cadastrarNovoUsuario($obj)):
                        $dadosemail = array(
                            'nome' => $dados['nome'],
                            'email' => $dados['email'],
                            'tipoenv' => 1
                            );
                        
                    //Envia o e-mail de Confirmação de Cadastro.
                        $ee = new Email();
                        if($ee->eviarEmail($dadosemail) == TRUE):
                            $me = new MetodosExtras();
                            $me->redireciona('Cadastrar/NovoUsuario&op=quatro');
                        else:
                            $me = new MetodosExtras();
                            $me->redireciona('Cadastrar/NovoUsuario&op=seis');                           
                        endif;
    
                    else:
                        $me = new MetodosExtras();
                        $me->redireciona('Cadastrar/NovoUsuario&op=cinco');
                    endif;
                endif;

            else:
                $me = new MetodosExtras();
                $me->redireciona('Cadastrar/NovoUsuario&op=dois');
            endif;
            
        else: 
            $me = new MetodosExtras();
            $me->redireciona('Cadastrar/NovoUsuario&op=um');
        endif;
    }
}
?>


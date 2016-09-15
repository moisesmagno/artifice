<?php
    class Layouts{
        
        //METODO QUE MONTA E ESTRUTURA AS VIEWS.
        public function montaView($view, $parametros = array()){
            if($view == 'login' && file_exists(BSPH.VWPH.LAYOUTSPH.LOGINPH.DS.$view.'.php')):
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'head.php';
                require BSPH.VWPH.LAYOUTSPH.LOGINPH.DS.$view.'.php';
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'rodape.php';
            elseif($view == 'cadastro' && file_exists(BSPH.VWPH.LAYOUTSPH.CADASTROPH.DS.$view.'.php')):
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'head.php';
                require BSPH.VWPH.LAYOUTSPH.CADASTROPH.DS.$view.'.php';  
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'rodape.php';
            elseif($view == 'recuperarConta' && file_exists(BSPH.VWPH.LAYOUTSPH.OUTROSPH.$view.'.php')):
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'head.php';
                require BSPH.VWPH.LAYOUTSPH.HOMEPH.DS.$view.'.php';    
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'rodape.php';
            else:
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'head.php';
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'menu.php';
                
                $pagina = $view;
                
                switch($pagina):
                    case 'home':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.HOMEPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.HOMEPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'buscaArtista':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.BUSCAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.BUSCAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'dadosPessoaisArtista':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'formacao':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'editarFormacao':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'perfilArtista':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.ARTISTAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'buscaCompanhia':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.BUSCAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.BUSCAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'dadosCompanhia':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.COMPANHIAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.COMPANHIAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'perfilCompanhia':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.COMPANHIAPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.COMPANHIAPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'alterarSenha':
                        (file_exists(BSPH.VWPH.LAYOUTSPH.USUSPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.USUSPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'desativaConta';
                        (file_exists(BSPH.VWPH.LAYOUTSPH.USUSPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.USUSPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'fotoPerfil';
                        (file_exists(BSPH.VWPH.LAYOUTSPH.USUSPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.USUSPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'experienciaProfissional';
                        (file_exists(BSPH.VWPH.LAYOUTSPH.EXPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.EXPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'editarExperienciaProfissional';
                        (file_exists(BSPH.VWPH.LAYOUTSPH.EXPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.EXPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'inserirFotoPortfolio';
                        (file_exists(BSPH.VWPH.LAYOUTSPH.PORTFOLIOPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.PORTFOLIOPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                    case 'editarFotoPortfolio';
                        (file_exists(BSPH.VWPH.LAYOUTSPH.PORTFOLIOPH.DS.$pagina.'.php')) ? require BSPH.VWPH.LAYOUTSPH.PORTFOLIOPH.DS.$pagina.'.php' : 'Falha ao chamar a página '.$pagina;
                        break;
                endswitch;
                
                require BSPH.VWPH.LAYOUTSPH.ESTRUTURAPH.DS.'rodape.php';                
            endif;
        }
    }
?>
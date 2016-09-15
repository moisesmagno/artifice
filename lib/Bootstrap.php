<?php 
    class Bootstrap{
        
        public function run(){
            //VERIFICAMOS SE A VARIÁVEL $URL FOI INICIALIZADA.
            if(!isset($_GET['url'])):
                 $lc = new LoginController();
                 $lc->actionLogin();
            else:
                $url = rtrim($_GET['url'],'/');
                $urlExplodida = explode('/', $url);
                $nomeClasseController = ucwords($urlExplodida[0]).'Controller';
                
                //VERIFICA A SE A CLASSE CONTROLLER EXISTE.
                if(class_exists($nomeClasseController)):
                    $controller = new $nomeClasseController();
                
                    //VERIFICA O SE HÁ UMA AÇÃO NA POSIÇÃO 1 DO $urlExplodida[1].
                    $nomeAction = (isset($urlExplodida[1])) ? 'action'.ucwords($urlExplodida[1]) : 'actionLogin';
                    
                    //VERIFICA SE $nomeAction existe dentro do $controller.
                    if(method_exists($controller, $nomeAction)):
                        $controller->$nomeAction(); //Executa a acão, que está dentro do controller.
                    else: 
                        //Caso não o $nomeAction não exista no $controller, é redirecionado ao login. 
                        $me = new MetodosExtras();
                        $me->redireciona('login');
                    endif;
                 else:
                    //SE O CONTROLLER DIGITA NO BROWSER NÃO EXISTA, ACHA A AÇÃO actionErro(), DA CLASSE CONTROLLER ErroController.
                    $controller = new ErroController();
                    $controller->actionErro();
                 
               endif;
           endif;
        }    
    }
?>



<?php
    
    //REQUISITANDO O ARQUIVO CONFIG.PHP, PARA FAZER USO DAS CONSTANTES.
    require dirname(dirname(__FILE__)).'/config/Config.php';
    
    //FUNÇÃO __AUTOLOAD();
    function __autoload($classe){
        try{
            $classe = str_replace('..','',$classe);
        
            if(file_exists(BSPH.CONTROLLERPH.DS.$classe.'.php')):
                require BSPH.CONTROLLERPH.DS.$classe.'.php';
            elseif(file_exists(BSPH.LIBPH.DS.$classe.'.php')):
                require BSPH.LIBPH.DS.$classe.'.php';
            elseif(file_exists(BSPH.MODELPH.DS.$classe.'.php')):
                require BSPH.MODELPH.DS.$classe.'.php';
            elseif(file_exists(BSPH.UTILPH.DS.$classe.'.php')):
                require BSPH.UTILPH.DS.$classe.'.php';
            endif;
        }catch(Exception $e){
            throw new Exception('As classes não estão sendo requeridas pela função __autoload(). Por favor contate o administrador', 0, $e);
        }
    }

?>



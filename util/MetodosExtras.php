<?php
    class MetodosExtras{
        
        //Adiciona o CSS dinamente. 
        public function addCSS($arquivo = NULL, $pastaExtra = NULL, $media = 'screen', $import = FALSE){
            if($arquivo != NULL):
                if($import == TRUE):
                    echo '<style type="text/css">@import url("'.URLPH.VWPH.CSSPH.DS.$arquivo.'.css");</style>'."\n";
                elseif($pastaExtra != NULL):
                    echo '<link rel="stylesheet" type="text/css" href="'.URLPH.VWPH.CSSPH.DS.$pastaExtra.DS.$arquivo.'.css" media="'.$media.'">'."\n";
                else:
                    echo '<link rel="stylesheet" type="text/css" href="'.URLPH.VWPH.CSSPH.DS.$arquivo.'.css" media="'.$media.'">'."\n";
                endif;
            endif;
        }
        
        //Adiciona o JS dinamicamente.
        public function addJS($arquivo = NULL, $pastaExtra = NULL, $remoto = FALSE){
            if($arquivo != NULL):
                if($remoto != FALSE):
                    echo '<script type="text/javascript" src="'.$arquivo.'"></script>'."\n";
                elseif($pastaExtra != NULL):
                    echo '<script type="text/javascript" src="'.URLPH.VWPH.DS.$pastaExtra.DS.$arquivo.'.js"></script>'."\n";
                else:
                    echo '<script type="text/javascript" src="'.URLPH.VWPH.JSPH.DS.$arquivo.'.js"></script>'."\n";
                endif;
             endif;
        }
        
        //Método que redireciona a página para outro lugar. 
        public function redireciona($url = ''){
             header('location: '.URLPH.DS.$url);
        }
        
        //Método que verifica se todos os campos obrigatórios de um formulário estão preenchidos.
        public function verificaCampos($dados = array()){
            foreach($dados as $key => $valor):
                if(!isset($valor) || empty($valor)):
                    return FALSE;
                    exit();
                endif;
            endforeach;

            return TRUE;
        }
    }
?>
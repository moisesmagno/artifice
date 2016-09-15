<?php
    class Upload{
        
        //Método que faz a inserção de fotos no sistema. 
        public function actionUpload($arquivo = array()){
            
            //Pasta onde o arquivo vai ser salvo.
            $_UP['pasta'] = $arquivo['pasta'];
            
            //Tamanho maximo permitido(em Byte).
            $_UP['tamanho'] = 1024 * 1024 * 15;
            
            //Array com as extensões permitias.
            $_UP['extensoes'] = array('jpg','jpeg','png','gif');
            
            //Remoneia o aquivo(Se TRUE, o aquivo sera salvo com um nome único)
            $_UP['renomeia'] = TRUE;
            
            if($arquivo['erro'] != 0):
                return 'um';
            endif;
            
            //Pega a extensão do arquivo.
            $nome_img_explodida = explode('.',$arquivo['nome']);
            $extensao = strtolower(end($nome_img_explodida));//Pega a extensão do arquivo.
            
            //Verifica se a extenção da imagem está dentro do array onde se encontra as extenções permitidas.
            if(!in_array($extensao, $_UP['extensoes'])):
                return 'dois';
            elseif($_UP['tamanho'] < $arquivo['tamanho_img']):
                return 'tres';
            else:
                //Verifica de deve trocar o nome do arquivo
                if($_UP['renomeia'] == TRUE):
                    //CrieI um nome com a extensão .extenção
                    $nome_final = time().'.'.end($nome_img_explodida);
                else:
                    //Matem o nome original do arquivo
                    $nome_final = $arquivo['nome'];
                endif;
                
            endif;
                        
            //Depois verifica se é possivel mover o arquivo para a pasta escolhida
            if(move_uploaded_file($arquivo['tmp_name'], $_UP['pasta'].DS.$nome_final)):
                return $nome_final;
            else:
                return 'cinco';
            endif;
        }
    }
?>

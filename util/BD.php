<?php
    class BD{
        private static $conn;
        
                
        public function __construct(){}
        
        public static function conn(){
            //Verificando se a variável $conn está nulo, se estiver, é adicionado a conexão nele.
            if(is_null(self::$conn)):
                self::$conn = new PDO('mysql:host='.BDHOST.';dbname='.BDNAME.';',''.BDUSU.'',''.BDPASS.'');
            endif;
            
            return self::$conn; //Retorna a variável já com a conexão.
        }

        //FECHA A CONEXÃO COM O BANCO.
        public static function fecharConcexao(){
            if(!is_null(self::$conn)):
                self::$conn = null;
            endif;
        }
    }
?>

<?php
    class BuscarModel extends UsuarioModel{
        private $categoria;
        private $idade;
        
        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }
        
        public function getCategoria(){
            return $this->categoria;
        }
        
        public function setIdade($idade){
            $this->idade = $idade;
        }
        
        public function getIdade(){
            return $this->idade;
        }
    }
?>

<?php
    class SeguirModel extends UsuarioModel{
        protected $idseguir;
        protected $idmeseguindo;
        
        public function setIdSeguir($seguir){
            $this->idseguir = $seguir;
        }
        
        public function getIdSeguir(){
            return $this->idseguir;
        }
        
        public function setIdMeSeguir($meseguindo){
            $this->idmeseguindo = $meseguindo;
        }
        
        public function getIdMeSeguir(){
            return $this->idmeseguindo;
        }
    }
?>
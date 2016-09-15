<?php
    class PECModel{
        private $idpais;
        private $idestado;
        private $idcidade;
        
        public function setIdPais($idpais){
            $this->idpais = $idpais;
        }
        
        public function getIdPais(){
            return $this->idpais;
        }
        
        public function setIdEstado($idestado){
            $this->idestado= $idestado;
        }
        
        public function getIdEstado(){
            return $this->idestado;
        }
        
        public function setIdCidade($idcidade){
            $this->idcidade = $idcidade;
        }
        
        public function getIdCidade(){
            return $this->idcidade;
        }        
    }
?>
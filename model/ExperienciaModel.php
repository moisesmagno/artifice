<?php
    class ExperienciaModel extends UsuarioModel{
        private $idexp;
        private $empresa;
        private $dataini;
        private $datafim;
        private $funcao;
        private $descricao;
        
        public function setIdExp($idexp){
            $this->idexp = $idexp;
        }
        
        public function getIdExp(){
            return $this->idexp;
        }
        
        public function setEmpresa($empresa){
            $this->empresa = $empresa;
        }
        
        public function getEmpresa(){
            return $this->empresa;
        }
        
        public function setDataini($dataini){
            $this->dataini = $dataini;
        }
        
        public function getDataini(){
            return $this->dataini;
        }
        
        public function setDatafim($datafim){
            $this->datafim = $datafim;
        }
        
        public function getDatafim(){
            return $this->datafim;
        }
        
        public function setFuncao($funcao){
            $this->funcao = $funcao;
        }
        
        public function getFuncao(){
            return $this->funcao;
        }
       
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        
        public function getDescricao(){
            return $this->descricao;
        }
    }
?>

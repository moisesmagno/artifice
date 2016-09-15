<?php
    class FormacaoModel{
        private $idform;
        private $escola;
        private $dataini;
        private $datafim;
        private $formacao;
        private $descricao;
        
        
        public function setIdForm($idform){
            $this->idform = $idform;
        }
        
        public function getIdForm(){
            return $this->idform;
        }
        
        public function setEscola($escola){
            $this->escola = $escola;
        }
        
        public function getEscola(){
            return $this->escola;
        }
        
        public function setDataIni($dataini){
            $this->dataini = $dataini;
        }
        
        public function getDataIni(){
            return $this->dataini;
        }
        
        public function setDataFim($datafim){
            $this->datafim = $datafim;
        }
        
        public function getDataFim(){
            return $this->datafim;
        }
        
        public function setFormacao($formacao){
            $this->formacao = $formacao;
        }
        
        public function getFormacao(){
            return $this->formacao;
        }
        
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        
        public function getDescricao(){
            return $this->descricao;
        }
    }
?>

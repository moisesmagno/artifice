<?php
    class PortfolioModel extends UsuarioModel{
        private $idpor;
        private $titulo;
        private $descricao;
        private $nome_arquivo;
        
        public function setIdPort($idport){
            $this->idport = $idport;
        }
        
        public function getIdPort(){
            return $this->idport;
        }
        
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }
        
        public function getTitulo(){
            return $this->titulo;
        }
        
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        
        public function getDescricao(){
            return $this->descricao;
        }
        
        public function setNomeArquivo($nome_arquivo){
            $this->nome_arquivo = $nome_arquivo;
        }
        
        public function getNomeArquivo(){
            return $this->nome_arquivo;
        }
    }
?>


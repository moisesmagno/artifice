<?php
    class ArtistaModel extends UsuarioModel{
        private $nome;
        private $nome_artistico;
        private $rg;
        private $cpf;
        private $drt;
        private $categoria;
        private $data_nascimento;
        private $formacao;
        private $experiencia;
        private $portfolio;
        
        public function setNome($nome){
            $this->nome = $nome;
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function setNomeArtistico($nome_artistico){
            $this->nome_artistico = $nome_artistico;
        }
        
        public function getNomeArtistico(){
            return $this->nome_artistico;
        }
        
        public function setRG($rg){
            $this->rg = $rg;
        }
        
        public function getRG(){
            return $this->rg;
        }
        
        public function setCPF($cpf){
            $this->cpf = $cpf;
        }
        
        public function getCPF(){
            return $this->cpf;
        }
        
        public function setDRT($drt){
            $this->drt = $drt;
        }
        
        public function getDRT(){
            return $this->drt;
        }
        
        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }
        
        public function getCategoria(){
            return $this->categoria;
        }
        
        public function setDataNasc($data_nascimento){
            $this->data_nascimento = $data_nascimento;
        }
        
        public function getDatNasc(){
            return $this->data_nascimento;
        }
        
        public function setExperiencia($experiencia){
            $this->experiencia = $experiencia;
        }
        
        public function getExperiencia(){
            return $this->experiencia;
        }
        
        public function setPortfolio($portfolio){
            $this->portfolio = $portfolio;
        }
        
        public function getPortfolio(){
            return $this->portfolio;
        }
        
        public function setFormacao($formacao){
            $this->formacao = $formacao;
        }
        
        public function getFormacao(){
            return $this->formacao;
        }
        
        public function setaFormacao($escola, $dataini, $datafim, $formacao, $descricao){
            $fm = new FormacaoModel();
            $fm->setEscola($escola);
            $fm->setDataIni($dataini);
            $fm->setDataFim($datafim);
            $fm->setFormacao($formacao);
            $fm->setDescricao($descricao);
            
            $this->setFormacao($fm);
        }
        
        public function setarExp($empresa, $dataini, $datafim, $funcao, $descricao){
            $exm = new ExperienciaModel();
            $exm->setEmpresa($empresa);
            $exm->setDataini($dataini);
            $exm->setDatafim($datafim);
            $exm->setFuncao($funcao);
            $exm->setDescricao($descricao);
            
            $this->setExperiencia($exm);
        }

        public function setaPortfolio($titulo, $descricao, $nome_arquivo){
            $pm = new PortfolioModel();
            $pm->setTitulo($titulo);
            $pm->setDescricao($descricao);
            $pm->setNomeArquivo($nome_arquivo);
            $this->setPortfolio($pm);
        }
    }
?>
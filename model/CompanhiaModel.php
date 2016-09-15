<?php
    class CompanhiaModel extends UsuarioModel{
        private $razao_social;
        private $nome_fantasia;
        private $cnpj;
        private $insc_estadual;
        private $experiencia;
        private $portfolio;
        
        public function setRazaoSocial($razao_social){
            $this->razao_social = $razao_social;
        }
        
        public function getRazaoSocial(){
            return $this->razao_social;
        }
        
        public function setNomeFantasia($nome_fantasia){
            $this->nome_fantasia = $nome_fantasia;
        }
        
        public function getNomeFantasia(){
            return $this->nome_fantasia;
        }
        
        public function setCNPJ($cnpj){
            $this->cnpj = $cnpj;
        }
        
        public function getCNPJ(){
            return $this->cnpj;
        }
        
        public function setInscEstadual($insc_estadual){
            $this->insc_estadual = $insc_estadual;
        }
        
        public function getInscEstadual(){
            return $this->insc_estadual;
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
        
        public function setarExp($empresa, $dataini, $datafim, $funcao, $descricao){
            $exm = new ExperienciaModel();
            $exm->setEmpresa($empresa);
            $exm->setDataini($dataini);
            $exm->setDatafim($datafim);
            $exm->setFuncao($funcao);
            $exm->setDescricao($descricao);
            
            $this->setExperiencia($exm);//Adicionando um objeto da classe Experiência ao atributo Expereiencia.
        }
        
        public function setaPortfolio($titulo, $descricao, $nome_arquivo){
            $pm = new PortfolioModel();
            $pm->setTitulo($titulo);
            $pm->setDescricao($descricao);
            $pm->setNomeArquivo($nome_arquivo);
            
            $this->setPortfolio($pm);//Adicionando um objeto da classe Portfolio ao atributo portfolio.
        }
           
    }
?>
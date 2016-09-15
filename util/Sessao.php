<?php
    class Sessao{
        
        public function __construct($iniciar = TRUE){
            if($iniciar == TRUE):
                $this->iniciasSessao();//Chama o método que inicía a sessão.
            endif;
        }
        
        //inicia a sessão.
        public function iniciasSessao(){
            session_start();
        }
        
        //CRIA UMA SESSÃO NOVA.
        public function criaSessao($nome, $conteudo){
            $_SESSION['S_'.$nome] = $conteudo;
        }
        
        //EXCLUI UMA SESESÃO.
        public function excluiSessao($nome){
            unset($_SESSION['S_'.$nome]);
        }
        
        //CONSULTA SE UMA SESSÃO EXISTE.
        public function getSessao($nome){
            return isset($_SESSION['S_'.$nome])? TRUE : FALSE;
        }
        
        //RETORNA UMA DETERMINADA SESSÃO.
        public function devSessao($nome){
            return ($this->getSessao($nome)) ? $_SESSION['S_'.$nome] : 'Sessão não existente.';
        }
        
        //EXCLUI TODAS AS SESSÕES.
        public function destroiTodasSessoes($inicia = FALSE){
            session_unset();
            session_destroy();
            
            if($inicia == TRUE):
                $this->iniciaSessao();
            endif;
        }
        
        //SESSÕES NECESSÁRIAS E OBRIGATÓRIAS PARA ACESSAR O SISTEMA.
        public function sessoesNecessarias(){
            return ($this->getSessao('email') && $this->getSessao('senha') && $this->getSessao('status'))? TRUE : FALSE;
        }
    }
?>

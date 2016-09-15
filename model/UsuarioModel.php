<?php
    class UsuarioModel{
        protected $id;
        protected $fotoperf;
        protected $email;
        protected $senha;
        protected $telefone;
        protected $celular;
        protected $site;
        protected $tipo;
        protected $pais;//
        protected $estado;
        protected $cidade;
        protected $bairro;
        protected $endereco;
        protected $numero;
        protected $complemento;
        protected $cep;
        protected $facebook;
        protected $googleplus;
        protected $twitter;
        protected $linkedin;
        
       
        //GET E SET DE CADA ATRIBUTO.
        public function setId($id){
            $this->id = $id;
        }
        
        public function getId(){
            return $this->id;
        }
        
        public function setFotoPerf($fotoperf){
            $this->fotoperf = $fotoperf;
        }
        
        public function getFotoPerf(){
            return $this->fotoperf;
        }
        
        public function setEmail($email){
            $this->email = $email;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function setSenha($senha){
            $this->senha = $senha;
        }
        
        public function getSenha(){
            return $this->senha;
        }
        
        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }
        
        public function getTelefone(){
            return $this->telefone;
        }
        
        public function setCelular($celular){
            $this->celular = $celular;
        }
        
        public function getCelular(){
            return $this->celular;
        }
        
        public function setSite($site){
            $this->site = $site;
        }
        
        public function getSite(){
            return $this->site;
        }
        
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        
        public function getTipo(){
            return $this->tipo;
        }
        
        public function setPais($pais){
            $this->pais = $pais;
        }
        
        public function getPais(){
            return $this->pais;
        }
        
        public function setEstado($estado){
            $this->estado = $estado;
        }
        
        public function getEstado(){
            return $this->estado;
        }
        
        public function setCidade($cidade){
            $this->cidade = $cidade;
        }
        
        public function getCidade(){
            return $this->cidade;
        }
        
        public function setBairro($bairro){
            $this->bairro = $bairro;
        }
        
        public function getBairro(){
            return $this->bairro;
        }
        
        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }
        
        public function getEndereco(){
            return $this->endereco;
        }
        
        public function setNumero($numero){
            $this->numero = $numero;
        }
        
        public function getNumero(){
            return $this->numero;
        }
        
        public function setComplemento($complemento){
            $this->complemento = $complemento;
        }
        
        public function getComplemento(){
            return $this->complemento;
        }
        
        public function setCEP($cep){
            $this->cep = $cep;
        }
        
        public function getCEP(){
            return $this->cep;
        }
        
        public function setFacebook($facebook){
            $this->facebook = $facebook;
        }
        
        public function getFacebook(){
            return $this->facebook;
        }
        
        public function setGooglePlus($googleplus){
            $this->googleplus = $googleplus;
        }
        
        public function getGooglePlus(){
            return $this->googleplus;
        }
        
        public function setTwitter($twitter){
            $this->twitter = $twitter;
        }
        
        public function getTwitter(){
            return $this->twitter;
        }
        
        public function setLinkedin($linkedin){
            $this->linkedin = $linkedin;
        }
        
        public function getLinkedin(){
            return $this->linkedin;
        }
        
    }
?>

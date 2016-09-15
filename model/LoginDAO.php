<?php
    class LoginDAO{
        
        //Verifica o se o E-mail e senha existe. 
        public function vericarEmailSenha($uc){
            
            $sql = 'SELECT usu_email, usu_senha FROM tb_usuario WHERE usu_email = :email AND usu_senha = :senha AND usu_status = :status';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':email', $uc->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':senha', md5($uc->getSenha()), PDO::PARAM_STR);
            $stmt->bindValue(':status', 1, PDO::PARAM_INT);
            $stmt->execute();
            
            return ($stmt->rowCount() >= 1) ? TRUE : FALSE;
        }
        
        //Ativa o usario.
        public function AtivarUsu($obj){
           
            $sql = 'UPDATE tb_usuario SET usu_senha = :senha, usu_status = :status WHERE usu_email = :email';
            $senhacriptografada = md5('123456');
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindParam(':senha', $senhacriptografada, PDO::PARAM_STR);
            $stmt->bindValue(':status', 1, PDO::PARAM_INT);
            $stmt->bindValue(':email', $obj->getEmail(), PDO::PARAM_INT);
            $stmt->execute();
            
            return ($stmt->execute()) ? TRUE : FALSE; 
        }              
        
    }
?>
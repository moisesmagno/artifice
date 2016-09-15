<?php
    class CadastrarDao{
        
        //VERIFICA UM DETERMINADO O E-MAIL EXISTE NO BANCO.
        public function verificaEmail($obj){                        
            $sql = 'SELECT usu_email FROM tb_usuario WHERE usu_email = :email';//QUERY QUE BUSCA EMAIL.
            
            $stmt = BD::conn()->prepare($sql); //PREPARA O $SQL.
            $stmt->bindValue(':email', $obj->getEmail(), PDO::PARAM_STR); //Envia o atributo via parâmentro.
            $stmt->execute();
            
            return ($stmt->rowCount() >= 1)? TRUE : FALSE; //Verifica se a consulta devolveu alguma linhas. 
            
        }
        
        //INSERE O NOVO USUÁRIO NO BANCO DE DADOS(tb_usuario, tb_artista ou tb_companhia).
        public function cadastrarNovoUsuario($obj){
            //POPULA A TABELA tb_usuario.
            try {
                $senhacriptografada = md5($obj->getSenha());//Criptografando a senha.
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO
                        tb_usuario(usu_foto, usu_email, usu_senha, usu_datacad, usu_horacad, usu_tipo_usu, usu_status) 
                        VALUES (:foto, :email, :senha, :data, :hora, :tipo, :status)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':foto', 'avatar.jpg', PDO::PARAM_STR);
                $stmt->bindValue(':email', $obj->getEmail(), PDO::PARAM_STR);
                $stmt->bindParam(':senha', $senhacriptografada, PDO::PARAM_STR);
                $stmt->bindValue(':data',date("Y/m/d"),PDO::PARAM_STR);
                $stmt->bindValue(':hora',date("h:i:s"),PDO::PARAM_STR);
                $stmt->bindValue(':tipo', $obj->getTipo(), PDO::PARAM_INT);
                $stmt->bindValue(':status', 1, PDO::PARAM_INT);
                BD::conn()->commit();
                $stmt->execute();
               $id_usu = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
            } catch (Exception $ex) {
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
            
            if($obj->getTipo() == 1)://Verifica se o usuário é artista ou companhia.
                //POPULA A TABELA tb_artista.
                try {
                    BD::conn()->beginTransaction();
                    $sql = 'INSERT INTO tb_artista(art_usuid, art_nome) VALUES (:usuid, :nome)';
                    $stmt = BD::conn()->prepare($sql);
                    $stmt->bindParam(':usuid', $id_usu, PDO::PARAM_INT);
                    $stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
                    BD::conn()->commit();
                    $stmt->execute();
                    $id_reg = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
                } catch (Exception $ex) {
                    BD::conn()->rollback();
                    print "Erro!: ".$e->getMessage()."<br>";
                }
            else: 
                //POPULA A TABELA tb_companhia.
                try {
                    BD::conn()->beginTransaction();
                    $sql = 'INSERT INTO tb_companhia(comp_usuid, comp_nome_fantasia) VALUES (:usuid, :nome)';
                    $stmt = BD::conn()->prepare($sql);
                    $stmt->bindParam(':usuid', $id_usu, PDO::PARAM_INT);
                    $stmt->bindValue(':nome', $obj->getNomeFantasia(), PDO::PARAM_STR);
                    BD::conn()->commit();
                    $stmt->execute();
                    $id_reg = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
                } catch (Exception $ex) {
                    BD::conn()->rollback();
                    print "Erro!: ".$e->getMessage()."<br>";
                } 
            endif;
            
            //POPULA A TABELA tb_localizacao com o Id do usuário.
            try {
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_localizacao(loc_usuid) VALUES (:idusu)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindParam(':idusu', $id_usu, PDO::PARAM_INT);
                BD::conn()->commit();
                $stmt->execute();
                $id_loc = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
            } catch (Exception $ex) {
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
            
            //POPULA A TABELA tb_midias_sociais com o Id do usuário.
            try {
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_midias_sociais(ms_usuid) VALUES (:idusu)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindParam(':idusu', $id_usu, PDO::PARAM_INT);
                BD::conn()->commit();
                $stmt->execute();
                $id_ms = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
            } catch (Exception $ex) {
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
           
            return (!empty($id_usu) && !empty($id_reg) && !empty($id_loc) && !empty($id_ms)) ? TRUE : FALSE;
        }
   }//fecha a classe.

?>


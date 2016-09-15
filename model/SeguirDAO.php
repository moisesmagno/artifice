<?php
    class SeguirDAO{
        
        //Recupera as informações das pessoas e companhias que o usuário está seguindo.
        public function recuperaPessoasSeguindo($obj){
            $sql = 'SELECT 
                        usu_id AS usuid,
                        usu_foto AS foto,
                        usu_tipo_usu AS tipo,
                        art_nome AS nome,
                        comp_nome_fantasia as nome_fantasia
                            FROM tb_usuario
                                    LEFT JOIN tb_artista ON art_usuid = usu_id
                                    LEFT JOIN tb_companhia ON comp_usuid = usu_id
                                        WHERE usu_id IN (SELECT 
                                                            seg_usuid_seguindo
                                                                FROM tb_usuario 
                                                                        INNER JOIN tb_seguindo ON seg_usuid = usu_id
                                                                                WHERE seg_usuid = :id)';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //Recupera as informações das pessoas e companhias que estão seguindo o usuário.
        public function recuperaPessoasMeSeguindo($obj){
            $sql = 'SELECT 
                        usu_id AS usuid,
                        usu_foto AS foto,
                        usu_tipo_usu AS tipo,
                        art_nome AS nome,
                        comp_nome_fantasia as nome_fantasia
                            FROM tb_usuario
                                    LEFT JOIN tb_artista ON art_usuid = usu_id
                                    LEFT JOIN tb_companhia ON comp_usuid = usu_id
                                        WHERE usu_id IN (SELECT 
                                                            meseg_usuid_meseguindo
                                                                FROM tb_usuario 
                                                                        INNER JOIN tb_me_seguindo ON meseg_usuid = usu_id
                                                                                WHERE meseg_usuid = :id)';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //Verifica no banco se o usuário logado já está seguindo uma pessa em específico.
        public function verificaSeguindo($obj){
            
            $sql = 'SELECT seg_usuid, seg_usuid_seguindo FROM tb_usuario
			  INNER JOIN tb_seguindo ON seg_usuid = usu_id
			  WHERE seg_usuid = :usuid ANd seg_usuid_seguindo = :idseguindo';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':usuid', $obj->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':idseguindo', $obj->getIdSeguir(), PDO::PARAM_INT);
            $stmt->execute();
            
            return ($stmt->rowCount() >= 1) ? TRUE : FALSE;
        }
        
        //Insere o id da usuairo logado o id do usuário que está seguindo.
        public function insereSeguir($obj){
            try{
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_seguindo(seg_usuid, seg_usuid_seguindo) VALUES(:idusu, :idususeguindo)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':idususeguindo', $obj->getIdSeguir(), PDO::PARAM_INT);
                BD::conn()->commit();
                $stmt->execute();
                $id_tb_seguindo = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
            } catch(Exception $e){
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
            
            try{
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_me_seguindo(meseg_usuid, meseg_usuid_meseguindo) VALUES(:idusu, :idusumeseguindo)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':idusu', $obj->getIdSeguir(), PDO::PARAM_INT);
                $stmt->bindValue(':idusumeseguindo', $obj->getId(), PDO::PARAM_INT);
                BD::conn()->commit();
                $stmt->execute();
                $id_tb_me_segindo = BD::conn()->lastInsertId();//PEGA O ID DO ÚLTIMO REGISTRO NO BANCO.
            } catch(Exception $e){
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
            
            return (!empty($id_tb_seguindo) && !empty($id_tb_me_segindo)) ? TRUE : FALSE;
        }
        
        //Deixa de seguir.
        public function dexarSeguir($obj){
            $sql = 'DELETE FROM tb_seguindo WHERE seg_usuid = :idusu AND seg_usuid_seguindo = :idususeguindo';
             $stmt = BD::conn()->prepare($sql);
             $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
             $stmt->bindValue(':idususeguindo', $obj->getIdSeguir(), PDO::PARAM_INT);
             $stmt->execute();
            
            $seg = ($stmt->execute()) ? 1 : 0;
            
            $sql = 'DELETE FROM tb_me_seguindo WHERE meseg_usuid = :idusu AND meseg_usuid_meseguindo = :idusumeseguindo';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':idusu', $obj->getIdSeguir(), PDO::PARAM_INT);
            $stmt->bindValue(':idusumeseguindo', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            
            $meseg = ($stmt->execute()) ? 1 : 0;
            
            $total = $seg + $meseg;
            
            return $total;
        }
    }
?>
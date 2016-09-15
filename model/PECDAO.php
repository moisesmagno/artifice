<?php
    class PECDAO{
        //Método que devolve todos os paises.
        public function devolvePaises(){
            $sql = 'SELECT * FROM tb_pais';
            $stmt = BD::conn()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //Método que devolve todos os estados.
        public function devolveTodasEstados($obj){
            $sql = 'SELECT * FROM tb_estado 
                    WHERE est_paisid = (SELECT loc_paisid
                                            FROM tb_usuario
                                                INNER JOIN tb_localizacao ON loc_usuid = usu_id
                                                  WHERE usu_id = :idusu)';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':idusu', $obj->getId(),PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //Método que devolve todas as cidades.
        public function devolveTodassCidades($obj){
            $sql = 'SELECT * FROM tb_cidade
                    WHERE cid_estid = (SELECT loc_estid
                                            FROM tb_usuario
                                                INNER JOIN tb_localizacao ON loc_usuid = usu_id
                                                  WHERE usu_id = :idusu)';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':idusu', $obj->getId(),PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
                
        //Método que devolve todos os estados com o ID do Pais.
        public function devolveEstados($obj){
            $sql = 'SELECT * FROM tb_estado WHERE est_paisid = :idpais';
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':idpais', $obj->getIdPais(),PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        //Método qu retorna todas as cidades com o ID do Estado.
        public function devolveCidades($obj){
            $sql = 'SELECT * FROM tb_cidade WHERE cid_estid= :idestado';
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':idestado', $obj->getIdEstado(), PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
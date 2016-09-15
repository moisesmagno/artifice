<?php
    class PortfolioDAO{
        
        //Retorna o portfolio completo do usuário.
        public function retornaPortfolio($obj){
            $sql = 'SELECT 
                        port_id AS id,
                        port_foto AS foto,
                        port_titulo AS titulo,
                        port_descricao AS descricao,
                        DATE_FORMAT(port_datahora, \'%d/%c/%Y %H:%i:%s\') as datahora
                                FROM tb_usuario 
                                        INNER JOIN tb_portfolio ON port_usuid = usu_id
                                                WHERE usu_id = :id
                                                ORDER BY port_datahora DESC';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
       //Atualiza o portfolio escolhido.
        public function editaPortfolio($obj){
            
            $sql = 'UPDATE tb_portfolio SET port_titulo = :titulo, port_descricao = :descricao WHERE port_id = :id';
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getIdPort(), PDO::PARAM_INT);
            $stmt->bindValue(':titulo', $obj->getTitulo(), PDO::PARAM_STR);
            $stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
            $stmt->execute();
            
            return ($stmt->execute()) ? TRUE : FALSE;
        }
        
        //Excluir um portfolio escolhido.
        public function excluirPortfolio($obj){            
            
            $sql = 'DELETE FROM tb_portfolio WHERE port_id = :id';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getIdPort(), PDO::PARAM_INT);
            $stmt->execute();
            
            return ($stmt->execute()) ? TRUE : FALSE;
        }
        
        //Registra a foto, titulo e descrição do portfolio.
        public function inserirFotoPortf($obj){
            try{
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_portfolio(port_usuid, port_foto, port_titulo, port_descricao) VALUES(:id, :foto, :titulo, :descricao)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':foto', $obj->getPortfolio()->getNomeArquivo(), PDO::PARAM_STR);
                $stmt->bindValue(':titulo', $obj->getPortfolio()->getTitulo(), PDO::PARAM_STR);
                $stmt->bindValue(':descricao', $obj->getPortfolio()->getDescricao(), PDO::PARAM_STR);
                BD::conn()->commit();
                $stmt->execute();
                $idPor = BD::conn()->lastInsertId();
            }catch(Exception $e){
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
            
            return (!empty($idPor)) ? TRUE : FALSE;
        }
    }
?>

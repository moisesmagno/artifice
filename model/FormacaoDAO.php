<?php
    class FormacaoDAO{
        
        public function recuperaFormacao($obj){
            $sql = 'SELECT 
                        for_id as form_id,
                        for_instituto as instituto,
                        for_formacao as formacao,
                        for_periodo_inicial as periodo_inicial,
                        for_periodo_final as periodo_final,
                        for_descricao as descricao
                        FROM tb_formacao
                             WHERE for_usuid = :id';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        //Inserindo uma nova Formação.
        public function inserirFormacao($obj){
                
            try{
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_formacao(for_usuid, for_instituto, for_formacao, for_periodo_inicial, for_periodo_final, for_descricao)
                        VALUES(:id, :instituto, :formacao, :dataini, :datafim, :descricao)';

                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':instituto', $obj->getFormacao()->getEscola(), PDO::PARAM_STR);
                $stmt->bindValue(':formacao', $obj->getFormacao()->getFormacao(), PDO::PARAM_STR);
                $stmt->bindValue(':dataini', $obj->getFormacao()->getDataIni(), PDO::PARAM_STR);
                $stmt->bindValue(':datafim', $obj->getFormacao()->getDataFim(), PDO::PARAM_STR);
                $stmt->bindValue(':descricao', $obj->getFormacao()->getDescricao(), PDO::PARAM_STR);
                BD::conn()->commit();
                $stmt->execute();
                $ultId = BD::conn()->lastInsertId();
            }catch(Exception $e){
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
            
            return (!empty($ultId)) ? TRUE : FALSE;
        }
        
        //Alterar a formaçao do usuário.
        public function editarFormacao($obj){
            $sql = 'UPDATE tb_formacao 
                    SET for_instituto = :instituto, for_formacao = :formacao, for_periodo_inicial = :dataini, for_periodo_final = :datafim, for_descricao = :descricao
                    WHERE for_id = :id';
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getIdForm(), PDO::PARAM_INT);
            $stmt->bindValue(':instituto', $obj->getEscola(), PDO::PARAM_STR);
            $stmt->bindValue(':formacao', $obj->getFormacao(), PDO::PARAM_STR);
            $stmt->bindValue(':dataini', $obj->getDataIni(), PDO::PARAM_STR);
            $stmt->bindValue(':datafim', $obj->getDataFim(), PDO::PARAM_STR);
            $stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
            $stmt->execute();
            
            return ($stmt->execute()) ? TRUE : FALSE;
        }
        
        //Excluir a formação do usuário.
        public function exluirFormacao($obj){
            $sql = 'DELETE FROM tb_formacao WHERE for_id = :id';
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getIdForm(),PDO::PARAM_INT);
            $stmt->execute();
            
            return ($stmt->execute()) ? TRUE : FALSE;
        }
    }
?>

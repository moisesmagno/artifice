<?php
    class ExperienciaDAO{
        //Recupera as Experiências profissionais do usuário.
         public function recuperaExperiencias($obj){
             $sql = 'SELECT 
                        exp_id as id_exp,
                        exp_empresa as empresa,
                        exp_funcao as funcao,
                        exp_periodo_inicial as per_ini,
                        exp_periodo_final as per_fim,
                        exp_descricao as descricao
                        FROM tb_usuario INNER JOIN tb_experiencia ON exp_usuid = usu_id WHERE usu_id = :id';
             $stmt = BD::conn()->prepare($sql);
             $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
             $stmt->execute();
             return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         
         //Registra uma nova experiência.
         public function inserirExperiencia($obj){
             try{
                BD::conn()->beginTransaction();
                $sql = 'INSERT INTO tb_experiencia(exp_usuid, exp_empresa, exp_funcao, exp_periodo_inicial, exp_periodo_final, exp_descricao)
                        VALUES(:idusu, :empresa, :funcao, :dataini, :datafim, :descricao)';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
                $stmt->bindValue(':empresa', $obj->getExperiencia()->getEmpresa(), PDO::PARAM_STR);
                $stmt->bindValue(':funcao', $obj->getExperiencia()->getFuncao(), PDO::PARAM_STR);
                $stmt->bindValue(':dataini', $obj->getExperiencia()->getDataini(), PDO::PARAM_STR);
                $stmt->bindValue(':datafim', $obj->getExperiencia()->getDatafim(), PDO::PARAM_STR);
                $stmt->bindValue(':descricao', $obj->getExperiencia()->getDescricao(), PDO::PARAM_STR);
                BD::conn()->commit();
                $stmt->execute();
                $idexp = BD::conn()->lastInsertId();;
            } catch(Exception $e){
                BD::conn()->rollback();
                print "Erro!: ".$e->getMessage()."<br>";
            }
             
            return (!empty($idexp)) ? TRUE : FALSE;
         }
         
         //Edita a experiência escolhida pelo usuário.
         public function editarExperiencia($obj){
             $sql = 'UPDATE tb_experiencia
                      SET exp_empresa = :empresa, exp_funcao = :funcao, exp_periodo_inicial = :dataini, exp_periodo_final = :datafim, exp_descricao = :descricao WHERE exp_id = :id';
             $stmt = BD::conn()->prepare($sql);
             $stmt->bindValue(':id', $obj->getIdExp(), PDO::PARAM_INT);
             $stmt->bindValue(':empresa', $obj->getEmpresa(), PDO::PARAM_STR);
             $stmt->bindValue(':funcao', $obj->getFuncao(), PDO::PARAM_STR);
             $stmt->bindValue(':dataini', $obj->getDataini(), PDO::PARAM_STR);
             $stmt->bindValue(':datafim', $obj->getDatafim(), PDO::PARAM_STR);
             $stmt->bindValue(':descricao', $obj->getDescricao(), PDO::PARAM_STR);
             $stmt->execute();
             
             return ($stmt->execute())? TRUE : FALSE;
         }
         
         //Exclui uma experiência escolhida pelo usuário.
         public function excluirExperiencia($obj){
             $sql = 'DELETE FROM tb_experiencia WHERE exp_id = :id';
             $stmt = BD::conn()->prepare($sql);
             $stmt->bindValue(':id', $obj->getIdExp(),PDO::PARAM_INT);
             $stmt->execute();
             
             return ($stmt->execute()) ? TRUE : FALSE;
         }
    }
?>

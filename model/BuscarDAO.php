<?php
    class BuscarDAO{
        //Retorna todas as categorias.
        public function devolveCategorias(){
            $sql = 'SELECT * FROM tb_categoria';
            $stmt = BD::conn()->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 
        
        public function devolveArtistas($obj){
                 $sql = 'CALL SP_BUSCA_ARTISTA_COMPLEXO(:categoria, :idade, :pais, :estado, :cidade)';
                 $stmt = BD::conn()->prepare($sql);
                 $stmt->bindValue(':categoria', $obj->getCategoria(), PDO::PARAM_INT);
                 $stmt->bindValue(':idade', $obj->getIdade(), PDO::PARAM_INT);
                 $stmt->bindValue(':pais', $obj->getPais(), PDO::PARAM_INT);
                 $stmt->bindValue(':estado', $obj->getEstado(), PDO::PARAM_INT);
                 $stmt->bindValue(':cidade', $obj->getCidade(), PDO::PARAM_INT);
                 $stmt->execute();
                 
                 return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function devolveCompanhias($obj){
                 $sql = 'CALL SP_BUSCA_COMPANHIAS_COMPLEXO(:pais, :estado, :cidade)';
                 $stmt = BD::conn()->prepare($sql);
                 $stmt->bindValue(':pais', $obj->getPais(), PDO::PARAM_INT);
                 $stmt->bindValue(':estado', $obj->getEstado(), PDO::PARAM_INT);
                 $stmt->bindValue(':cidade', $obj->getCidade(), PDO::PARAM_INT);
                 $stmt->execute();
                 
                 return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
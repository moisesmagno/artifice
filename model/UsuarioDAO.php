<?php
    class UsuarioDAO{
        
        //Método que devolve algumas informaçãoes básicas do usuário logado.
        public function recuperaIDTipo($um){
            $sql = 'SELECT usu_id, usu_tipo_usu FROM tb_usuario WHERE usu_email = :email AND usu_senha = :senha AND usu_status = :status';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue('email', $um->getEmail() ,PDO::PARAM_STR);
            $stmt->bindValue('senha', md5($um->getSenha()),PDO::PARAM_STR);
            $stmt->bindValue('status', 1,PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }
        
        //Retorna o nome do usuário logado.
        public function recuperaNome($obj){
            if($obj->getTipo() == 1):
                $sql = 'SELECT art_nome as nome FROM tb_usuario INNER JOIN tb_artista ON art_usuid = usu_id WHERE usu_id = :id';
            else:    
                $sql = 'SELECT comp_nome_fantasia as nome_fantasia FROM tb_usuario INNER JOIN tb_companhia ON comp_usuid = usu_id WHERE usu_id = :id';
            endif;
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        //Atualizar dados do usuário logado.
        public function atualizarDados($obj){
            if($obj->getTipo() == 1):
                //Atualizando a tabela tb_artista.
                $sql = 'UPDATE tb_artista SET art_nome = :nome, art_nome_artistico = :nome_artistico, 
                                              art_rg = :rg, art_cpf = :cpf, art_drt = :drt, art_catid = :categoria, 
                                              art_datanasc = :datanasc WHERE art_usuid = :idusu';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':nome', $obj->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(':nome_artistico', $obj->getNomeArtistico(), PDO::PARAM_STR);
                $stmt->bindValue(':rg', $obj->getRG(), PDO::PARAM_STR);
                $stmt->bindValue(':cpf', $obj->getCPF(), PDO::PARAM_STR);
                $stmt->bindValue(':drt', $obj->getDRT(), PDO::PARAM_STR);
                $stmt->bindValue(':categoria', $obj->getCategoria(), PDO::PARAM_INT);
                $stmt->bindValue(':datanasc', $obj->getDatNasc(), PDO::PARAM_STR);
                $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
                $stmt->execute();
                $cdusu = ($stmt->execute()) ? 1 : 0;
            else:    
                //Atualizando a tabela tb_companhia.
                $sql = 'UPDATE tb_companhia SET comp_razao_social = :rs, comp_nome_fantasia = :nf, comp_cnpj = :cnpj,
                                                comp_insc_estadual = :iest WHERE comp_usuid = :idusu';
                $stmt = BD::conn()->prepare($sql);
                $stmt->bindValue(':rs', $obj->getRazaoSocial(), PDO::PARAM_STR);
                $stmt->bindValue(':nf', $obj->getNomeFantasia(), PDO::PARAM_STR);
                $stmt->bindValue(':cnpj', $obj->getCNPJ(), PDO::PARAM_STR);
                $stmt->bindValue(':iest', $obj->getInscEstadual(), PDO::PARAM_STR);
                $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
                $stmt->execute();
                $cdusu = ($stmt->execute()) ? 1 : 0;
            endif;
            
            //Atualizando a tabela tb_usuario.
            $sql = 'UPDATE tb_usuario SET usu_telefone = :tel, usu_celular = :cel, usu_site = :site  WHERE usu_id = :idusu';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':tel', $obj->getTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(':cel', $obj->getCelular(), PDO::PARAM_STR);
            $stmt->bindValue(':site', $obj->getSite(), PDO::PARAM_STR);
            $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $cusu = ($stmt->execute()) ? 1 : 0;
            
            //Atualizando a tabela tb_localizacao.
            $sql = 'UPDATE tb_localizacao SET loc_paisid = :pais, loc_estid = :estado, loc_cidid = :cidade, 
                                                 loc_bairro = :bairro, loc_endereco = :endereco, loc_numero = :numero,
                                                 loc_complemento = :complemento, loc_cep = :cep WHERE loc_usuid = :idusu'; 
            $stmt = BD::conn()->prepare($sql);  
            $stmt->bindValue(':pais', $obj->getPais(), PDO::PARAM_INT);
            $stmt->bindValue(':estado', $obj->getEstado(), PDO::PARAM_INT);
            $stmt->bindValue(':cidade', $obj->getCidade(), PDO::PARAM_INT);
            $stmt->bindValue(':bairro', $obj->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(':endereco', $obj->getEndereco(), PDO::PARAM_STR);
            $stmt->bindValue(':numero', $obj->getNumero(), PDO::PARAM_INT);
            $stmt->bindValue(':complemento', $obj->getComplemento(), PDO::PARAM_STR);
            $stmt->bindValue(':cep', $obj->getCEP(), PDO::PARAM_STR);
            $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $cloc = ($stmt->execute()) ? 1 : 0;

            //Atualizando a tabela tb_midias_sociais.
            $sql = 'UPDATE tb_midias_sociais SET ms_facebook = :face, ms_googleplus = :gg, ms_twitter = :tw, ms_linkedin = :in 
                    WHERE ms_usuid = :idusu';
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':face', $obj->getFacebook(), PDO::PARAM_STR);
            $stmt->bindValue(':gg', $obj->getGooglePlus(), PDO::PARAM_STR);
            $stmt->bindValue(':tw', $obj->getTwitter(), PDO::PARAM_STR);
            $stmt->bindValue(':in', $obj->getLinkedin(), PDO::PARAM_STR);
            $stmt->bindValue(':idusu', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();
            $cms = ($stmt->execute()) ? 1 : 0;

            $soma = $cdusu + $cusu + $cloc + $cms;
            return ($soma == 4) ? TRUE: FALSE;
        }
        
        //Recupera os dados básicos do artista.
        public function retornaDadosUsu($obj){
            
            if($obj->getTipo() == 1):
                //Select que recupera dados do artista.
                $sql = 'SELECT 
                            art_nome AS nome, 
                            art_nome_artistico AS nome_artistico, 
                            art_rg as rg,
                            art_cpf as cpf,
                            art_drt as drt,
                            art_datanasc AS data_nasc,
                            cat_id AS id_categoria,
                            cat_nome AS categoria,
                            pais_id,
                            pais_nome AS pais,
                            est_id,
                            est_nome AS estado, 
                            cid_id,
                            cid_nome AS cidade,
                            loc_bairro AS bairro, 
                            loc_cep AS cep, 
                            loc_endereco AS endereco, 
                            loc_numero AS numero, 
                            loc_complemento AS complemento, 
                            usu_id AS id_usu,
                            usu_tipo_usu AS tipo,
                            usu_foto AS foto_perfil,
                            usu_telefone AS telefone, 
                            usu_celular AS celular,
                            usu_email AS email, 
                            usu_site AS site, 
                            ms_facebook AS facebook, 
                            ms_googleplus AS google_plus,
                            ms_twitter AS twitter, 
                            ms_linkedin AS linkedin 
                            FROM tb_usuario
				LEFT JOIN tb_artista ON art_usuid = usu_id
                                LEFT JOIN tb_categoria ON cat_id = art_catid
				LEFT JOIN tb_midias_sociais ON ms_usuid = usu_id
				LEFT JOIN tb_localizacao ON loc_usuid = usu_id
				LEFT JOIN tb_pais ON pais_id = loc_paisid
				LEFT JOIN tb_estado ON est_id = loc_estid
				LEFT JOIN tb_cidade ON cid_id = loc_cidid
				WHERE usu_id = :usu_id AND usu_status = :status';
            else:
                //Select que recupera dados da companhia.
                $sql = 'SELECT 
                            comp_nome_fantasia AS nome_fantasia, 
                            comp_razao_social AS razao_social, 
                            comp_cnpj AS cnpj, 
                            comp_insc_estadual AS insc_est,
                            pais_id,
                            pais_nome AS pais, 
                            est_id,
                            est_nome AS estado, 
                            cid_id,
                            cid_nome AS cidade,
                            loc_bairro AS bairro, 
                            loc_cep AS cep, 
                            loc_endereco AS endereco, 
                            loc_numero AS numero,
                            loc_complemento AS complemento,
                            usu_id AS id_usu,
                            usu_tipo_usu AS tipo,
                            usu_foto AS foto_perfil,
                            usu_telefone AS telefone, 
                            usu_celular AS celular, 
                            usu_email AS email,
                            usu_site AS site, 
                            ms_facebook AS facebook, 
                            ms_googleplus AS google_plus, 
                            ms_twitter AS twitter,
                            ms_linkedin AS linkedin
                            FROM tb_usuario
				LEFT JOIN tb_companhia ON comp_usuid = usu_id
				LEFT JOIN tb_midias_sociais ON ms_usuid = usu_id
				LEFT JOIN tb_localizacao ON loc_usuid = usu_id
				LEFT JOIN tb_pais ON pais_id = loc_paisid
				LEFT JOIN tb_estado ON est_id = loc_estid
				LEFT JOIN tb_cidade ON cid_id = loc_cidid
				WHERE usu_id = :usu_id AND usu_status = :status';
            endif;
            
            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':usu_id', $obj->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':status', 1, PDO::PARAM_INT);
            $stmt->execute();
            
            return ($stmt->rowCount() >= 1) ? $stmt->fetch(PDO::FETCH_ASSOC) : 'Vazio :(';
         }
         
         //Registra a foto do perfil no banco de dados.
         public function inserirFotoPerfil($obj){
            //Atualiza a tabela tb_usuario.
            $sql = 'UPDATE tb_usuario SET usu_foto = :foto WHERE usu_id = :id';

            $stmt = BD::conn()->prepare($sql);
            $stmt->bindValue(':foto', $obj->getFotoPerf(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
            $stmt->execute();

            return ($stmt->execute() == TRUE) ? TRUE: FALSE;
         }
         
         
         //Método que altera o status do usuário para zero.
         public function desativaConta($obj){
             $sql = 'UPDATE tb_usuario SET usu_status = :status WHERE usu_id = :id';
             $stmt = BD::conn()->prepare($sql);
             $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
             $stmt->bindValue(':status', 0, PDO::PARAM_INT);
             $stmt->execute();
             
             return ($stmt->execute()) ? TRUE : FALSE;
         }
         
         //Alterar a senha do usuário.
         public function alterarSenha($obj){
             $sql = 'UPDATE tb_usuario SET usu_senha = :senha WHERE usu_id = :id';
             $stmt = BD::conn()->prepare($sql);
             $stmt->bindValue(':id', $obj->getId(), PDO::PARAM_INT);
             $stmt->bindValue(':senha', md5($obj->getSenha()), PDO::PARAM_STR);
             $stmt->execute();
             
             return ($stmt->execute()) ? TRUE : FALSE; 
         }
    }
?>
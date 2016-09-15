<?php
    class Email{
        
        //MÉTODO QUE ENVIA O E-MAIL DE CONFIRMAÇÃO DE CADASTRO.
        public function eviarEmail($dadosenvio = array()){
    
            require BSPH.LIBPH.DS.'phpmailer/class.phpmailer.php';

            /*
            Aqui criamos uma nova instância da classe como $mail.
            Todas as características, funções e métodos da classe
            poderão ser acessados através da variável (objeto) $mail.
            */
            $mail = new PHPMailer(); //

            // Define o método de envio
            $mail->Mailer     = "smtp";

            // Define que a mensagem poderá ter formatação HTML
            $mail->IsHTML(true); //

            // Define que a codificação do conteúdo da mensagem será utf-8
            $mail->CharSet    = "utf-8";

            // Define que os emails enviadas utilizarão SMTP Seguro tls
            $mail->SMTPSecure = "ssl";//"tls";

            // Define que o Host que enviará a mensagem é o Gmail
            $mail->Host       = "smtp.gmail.com";

            //Define a porta utilizada pelo Gmail para o envio autenticado
            $mail->Port       = "465";                  

            // Deine que a mensagem utiliza método de envio autenticado
            $mail->SMTPAuth   = "true";

            // Define o usuário do gmail autenticado responsável pelo envio
            $mail->Username   = "artifice.portal@gmail.com";

            // Define a senha deste usuário citado acima
            $mail->Password   = "artifice123";

            // Defina o email e o nome que aparecerá como remetente no cabeçalho
            $mail->From       = "artifice.portal@gmail.com";
            $mail->FromName   = "Artifice";

            // Define o destinatário que receberá a mensagem
            $mail->AddAddress($dadosenvio['email']);

            /*
            Define o email que receberá resposta desta
            mensagem, quando o destinatário responder
            */
            $mail->AddReplyTo("artifice.portal@gmail.com", $mail->FromName);

            // 1 = Confirmação de cadastro.
            // 2 = Recuperação de conta ou senha.
            // 3(outro) = Mensagem de que alguém está me seguindo.        
            if($dadosenvio['tipoenv'] == 1):
                // Assunto da mensagem
                $mail->Subject    = "Confirmação de Cadastro";
                $mensagem = 'Olá <strong>'.utf8_encode($dadosenvio['nome']).'</strong>, Informamos que seu cadastro foi realizado com sucesso, agora não perca tempo :)  <br><strong><a href="'.URLPH.'">Clique aqui </a></strong> e monte o seu perfil e assim divulgue os seus trabalhos e encontre novas oportunidades.';
            elseif($dadosenvio['tipoenv'] == 2):
                // Assunto da mensagem
                $mail->Subject    = "Recuperação de Conta.";
                $mensagem = '<strong>'.$dadosenvio['nome']. '</strong>, Seu login e sua senha temporária de acesso é:<br>
                        <strong>E-mail:</strong> '.utf8_encode($dadosenvio['email']).'<br>
                        <strong>Senha:</strong> 123456 <br>
                        Após acessar sua conta sugerimos que altere sua senha para sua maior segurança, obrigado.';
            else:
                if($dadosenvio['tiposeg'] == 1):
                    // Assunto da mensagem
                    $mail->Subject    = "Tem alguem te seguindo.";
                    $mensagem = 'Olá :) <br> Sabia que <strong>'.utf8_encode($dadosenvio['nome']). '</strong> está te seguindo? quer visualizar o perfil dele(a)? <a href="'.URLPH.'/Artista/Perfil&usu='.$dadosenvio['id'].'&tp='.$dadosenvio['tiposeg'].'"><strong>CLIQUE AQUI</strong></a> e saiba tudo sobre ele(a).';
                else:
                    // Assunto da mensagem
                    $mail->Subject    = "Tem alguem te seguindo.";
                    $mensagem = 'Olá :) <br> Sabia que <strong>'.utf8_encode($dadosenvio['nome_fantasia']). '</strong> está te seguindo? quer visualizar o perfil dele(a)? <a href="'.URLPH.'/Companhia/Perfil&usu='.$dadosenvio['id'].'&tp='.$dadosenvio['tiposeg'].'"><strong>CLIQUE AQUI</strong></a> e saiba tudo sobre ele(a).';
                endif;
            endif;

            // Estrutura HTML da mensagem
            $msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
            $msg .= "<html>";
            $msg .= "<head></head>";
            $msg .= "<body style=\"background-color:#fff;\" >";
            $msg .= "<strong>Artifice Informa:</strong><br /><br />";
            $msg .= $mensagem;
            $msg .= "</body>";
            $msg .= "</html>";

            // Toda a estrutura HTML e corpo da mensagem
            $mail->Body       = $msg;

            // Controle de erro ou sucesso no envio
            if (!$mail->Send()):

                return FALSE;
                //echo "Erro de envio: " . $mail->ErrorInfo;
            else:
                return TRUE;    
                //echo "Mensagem enviada com sucesso!";
            endif;    
        }//Fim do método eviarEmail();  
    }
?>
               
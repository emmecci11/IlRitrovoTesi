<?php
namespace Utility;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use View\VEmail;

/**
 * Utility UEmail class
 * Class that contain all the configurations needed to send email 
 */
class UEmail {

    public static function sendConfirmation(string $to, array $data, ?int $idTable): bool {
        $mail = new PHPMailer(true);
        $view=new VEmail();
        try {
            //SMPT configurations. SMPT server NEEDED in local, different from other cases, like (ex)Altervista
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  //Google' SMPT
            $mail->SMTPAuth   = true;
            $mail->Username   = 'marcociprianituna2000@gmail.com';  //Configuration by config.php
            $mail->Password   = 'agpejyafvqqqphda';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            //Sender and Recipient
            $mail->setFrom('marcociprianituna2000@gmail.com', 'Il Ritrovo');
            $mail->addAddress($to);
            //Email's content (TPL will be loaded as it body)
            if ($idTable !== null) {
                $mail->Subject = 'Your Table Reservation Has Been Confirmed - Il Ritrovo';
                $bodyHtml=$view->showTablesEmail($data);
                $mail->Body=$bodyHtml;
                $mail->AltBody = strip_tags($bodyHtml);
            } else {
                $mail->Subject = 'Your Room Reservation has been Confirmed - Il Ritrovo';
                $bodyHtml=$view->showRoomsEmail($data);
                $mail->Body=$bodyHtml;
                $mail->AltBody = strip_tags($bodyHtml);
            }
            //Send the email
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Errore invio email: {$mail->ErrorInfo}");
            return false;
        }
    }
}
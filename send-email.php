<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHemailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Set up SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = '0770949757.h@gmail.com'; // Your email address
        $mail->Password = 'mozw dpxp hfxl kxvf '; // Use an app password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set the sender and recipient
        $mail->setFrom($_POST['email'], $_POST['firstname'] . ' ' . $_POST['lastname']);
        $mail->addAddress('amirarozale@gmail.com');

        // Attach file
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Demande de presence aux conference:';
        $mail->Body    = "Nom : " . $_POST['firstname'] . "\n" .
                         "Prénom : " . $_POST['lastname'] . "\n" .
                         "Université : " . $_POST['university'] . "\n" .
                         "Pays : " . $_POST['country'] . "\n" .
                         "Téléphone : " . $_POST['phone'] . "\n" .
                         "Email : " . $_POST['email'];

        // Send the email
        $mail->send();
        echo 'Email envoyé avec succès.';
                // Redirection vers la page principale
        header("Location: contact.html");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
    }
}
?>

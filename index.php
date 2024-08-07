<?php

    session_start();

    if(isset($_POST['submit'])){

        extract($_POST);

        if(isset($username) && $username != "" && 
            isset($email) && $email != "" && 
            isset($phone) && $phone != "" &&
            isset($message) && $message != ""){

            $to = "topogo.toure09@gmail.com";
            $subject = "vous avez réçu un message de ". $email;

            $message = "
                <p>vous avez réçu un message de <strong>".$email."</strong> </p>
                <p><strong>Nom :</strong> ".$username." </p>
                <p><strong>Téléphone :</strong> ".$phone." </p>
                <p><strong>Message :</strong> ".$message." </p>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <'.$email.'>' . "\r\n";
            // $headers .= 'Cc: myboss@example.com' . "\r\n";

            $send = mail($to,$subject,$message,$headers);

            if($send){
                $_SESSION['succes_message'] = "message envoyé";
            }else{
                $info = "message non envoyé";
            }

        }else{
            $info = "veuillez remplir tout les champs svp !";
            $color = "red";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



    <?php
    
        if(isset($info)){
            ?>
 
                <div class="msg" style="color: <?= $color ?>">
                    <?= $info ?>
                </div>

    <?php } ?>

    <!-- message de succès -->
    <?php
    
        if(isset($_SESSION['succes_message'])){
            ?>
 
                <div class="msg" style="color: green">
                    <?= $_SESSION['succes_message'] ?>
                </div>

    <?php } ?>

    <form action="" method="POST">
        <span>nom d'utilisateur</span>
        <input type="text" name="username">
        <span>email</span>
        <input type="email" name="email">
        <span>numéro de téléphone</span>
        <input type="number" name="phone">
        <span>messages</span>
        <textarea name="message" id=""></textarea>
        <button type="submit" name="submit">envoyer</button>
    </form>
    
</body>
</html>
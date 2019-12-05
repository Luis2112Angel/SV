<?php 

    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /SV/inicio.html');
      }

    require 'php-login/database.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT email,password FROM users WHERE email = :email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'],$results['password'])){
            header ("Location: inicio.html");
        } else {
            $message = "No existe el usuario";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="php-login/css/styles.css">
    </head>
    
    <body>

        <img src="portada.jpg" align=left height=730> 
        <br><br><br><br><br><br>
        <h1>METROPOLITANO</h1>
        <br>

        
        
        <?php if(!empty($message)):?>
            <p><?= $message ?></p>
        <?php endif; ?>     
    
        <form action="index.php" method="post">
            <input type="text" name="email" placeholder="Ingrese su email">
            <input type="password" name="password" placeholder="Ingrese su contraseña">
            <input type="submit" value="Ingresar">
    </body>
</html>
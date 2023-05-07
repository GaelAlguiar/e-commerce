<?php

include 'componentes/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id ='';
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass =  $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn -> prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user -> execute([$email, $pass]);

    $row = $select_user -> fetch(PDO::FETCH_ASSOC);

    if($select_user -> rowCount() > 0){
        $_SESSION['user_id'] = $row['id'];
        $message[] = 'Inicio de sesion exitosa!';
        header('location:home.php');

    }else{
        $message[] = 'Email o Contraseña incorrecta';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

<?php 
include 'componentes/user_header.php'; 
?>

<section class="form-container">

    <form action="" method="POST">
        <h3>Inicia Sesión!</h3>
        <input type="email" required maxlength="50" name="email" placeholder="Ingresa tu correo electronico" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="password" required maxlength="20" name="pass" placeholder="Ingresa tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="submit" value="Inicia Sesión" class="btn-green" name="submit">

        <p>¿No tienes una cuenta?</p>

        <a href="user_register.php" class="btn">Regístrate!</a>

    </form>

</section>








<?php include 'componentes/footer.php'?>


<script src="js/script.js"></script>

</body>

</html>
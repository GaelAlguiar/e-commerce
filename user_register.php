<?php

include 'componentes/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id ='';
}

if(isset($_POST['submit'])){

    $name =  $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass =  $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass =  $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_user = $conn -> prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user -> execute([$email]);

    $row = $select_user -> fetch(PDO::FETCH_ASSOC);

    if($select_user -> rowCount() > 0){

        $message[] = 'Ya existe este usuario!';

    }else{

        if($pass != $cpass){
            $message[] = 'Las contraseñas no coinciden';
        }else{
            $insert_user = $conn -> prepare("INSERT INTO `users` (name, email, password) VALUES (?,?,?); ");
            $insert_user -> execute([$name, $email, $cpass]);
            $message[] = 'Registro exitoso, porfavor Inicia Sesión!';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

<?php 
include 'componentes/user_header.php'; 
?>


<section class="form-container">

    <form action="" method="POST">
        <h3>Registrar usuario</h3>

        <input type="text" required maxlength="20" name="name" placeholder="Ingresa tu nombre" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="email" required maxlength="50" name="email" placeholder="Ingresa tu correo electronico" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="password" required maxlength="20" name="pass" placeholder="Ingresa tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="password" required maxlength="50" name="cpass" placeholder="Confirma tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="submit" value="Registrar" class="btn-green" name="submit">

        <p>¿Ya tienes una cuenta?</p>

        <a href="user_login.php" class="btn">Inicia Sesión!</a>

    </form>

</section>








<?php include 'componentes/footer.php'?>


<script src="js/script.js"></script>

</body>

</html>
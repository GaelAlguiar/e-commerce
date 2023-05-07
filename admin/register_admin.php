<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $select_admin = $conn -> prepare("SELECT * FROM `admins` WHERE name = ?");
    $select_admin -> execute([$name]);
    
if($select_admin -> rowCount()> 0){

   $message[] = 'Este usuario ya existe!';

}else{
    if($pass != $cpass){
        $message[] = 'Las contraseñas no coinciden';
    }else{
        $insert_admin = $conn -> prepare("INSERT INTO `admins` (name, password) VALUES(?,?)");
        $insert_admin -> execute([$name, $cpass]);
        $message[] = 'Administrador Registrado Exitosamente!';
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
    <title>Registrar</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php
    include '../componentes/admin_header.php';
    ?>

    <!---------Admin Registro------------>

    <section class="form-container">

    <form action="" method="POST" >
        <h3>Registro Nuevo</h3>
    
        <input type="text" name= "name" maxlength="20" required placeholder="Ingresa tu nombre" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
 
        <input type="password" name= "pass" maxlength="20" required placeholder="Ingresa tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="password" name= "cpass" maxlength="20" required placeholder="Confirma tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="submit" value="Registrar" name="submit"  class="btn">
        
    </form>

</section>



    

    <script src="../js/admin_script.js"></script>

</body>

</html>
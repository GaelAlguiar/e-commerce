<?php

include 'componentes/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id ='';
    header('location:home.php');
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile -> execute([$name, $email, $user_id]);

    $empty_pass = '';
    $prev_pass = $_POST['prev_pass'];
    $old_pass = $_POST['old_pass'];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if ($old_pass == $empty_pass) {
        $message[] = 'Porfavor ingresa tu contraseña anterior!';
    } elseif ($old_pass != $prev_pass) {
        $message[] = 'La contraseña anterior no coincide!';
    } elseif ($new_pass != $cpass) {
        $message[] = 'La confirmación no coincide!';
    } else {
        if ($new_pass != $empty_pass) {
            $update_user_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_user_pass->execute([$cpass, $user_id]);
            $message[] = 'Cambio de contraseña exitoso!';
        } else {
            $message[] = 'Porfavor Ingrese una nueva contraseña!';
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
    <title>Actualizar Usario</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

<?php 
include 'componentes/user_header.php'; 
?>



<section class="form-container">

    <form action="" method="POST">
        <h3>Actualizar usuario</h3>

        <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">

        <input type="text" required maxlength="20" name="name" placeholder="Ingresa tu nombre" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name']?>">

        <input type="email" required maxlength="50" name="email" placeholder="Ingresa tu correo electronico" class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['email']?>">

        <input type="password" maxlength="20" name="old_pass" placeholder="Ingresa tu contraseña anterior" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="password" maxlength="50" name="new_pass" placeholder="Ingresa tu nueva contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="password" maxlength="50" name="cpass" placeholder="Confirma tu nueva contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

        <input type="submit" value="Actualizar" class="btn-green" name="submit">

    </form>

</section>









<?php include 'componentes/footer.php'?>


<script src="js/script.js"></script>

</body>

</html>
<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
    $update_profile_name->execute([$name, $admin_id]);

    $empty_pass = '';
    $prev_pass = $_POST['prev_pass'];
    $old_pass = $_POST['old_pass'];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = $_POST['confirm_pass'];
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if ($old_pass == $empty_pass) {
        $message[] = 'Porfavor ingresa tu contraseña anterior!';
    } elseif ($old_pass != $prev_pass) {
        $message[] = 'La contraseña anterior no coincide!';
    } elseif ($new_pass != $confirm_pass) {
        $message[] = 'La confirmación no coincide!';
    } else {
        if ($new_pass != $empty_pass) {
            $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
            $update_admin_pass->execute([$confirm_pass, $admin_id]);
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
    <title>Actualizar Perfil</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php
    include '../componentes/admin_header.php';
    ?>

    <!--------Admin Perfil------------>
    <section class="form-container">

        <form action="" method="post">
            <h3>Actualizar Perfil</h3>

            <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">

            <input type="text" name="name"  required placeholder="Ingresa tu usuario" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="password" name="old_pass" placeholder="Ingresa tu contraseña anterior" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="password" name="new_pass" placeholder="Ingresa tu nueva contraseña" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="password" name="confirm_pass" placeholder="Confirma tu nueva contraseña" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="submit" value="Actualizar" class="btn" name="submit">

        </form>
    </form>

    </section>


    <script src="../js/admin_script.js"></script>

</body>

</html>
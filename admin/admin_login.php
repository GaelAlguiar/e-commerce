<?php

include '../componentes/connect.php';

session_start();

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
    $select_admin->execute([$name, $pass]);

    if ($select_admin->rowCount() > 0) {

        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        $message[] = 'Ingreso Exitoso!';
        header('location:dashboard.php');
    } else {
        $message[] = 'Usuario o Contraseña incorrecta';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
        }
    }

    ?>

    <section class="form-container-1">

        <form action="" method="POST">
            <h3>Iniciar Sesión</h3>
            <p>Nombre = <span>admin</span> & Contraseña = <span>111</span></p>

            <input type="text" name="name" maxlength="20" required placeholder="Ingresa tu nombre" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="password" name="pass" maxlength="20" required placeholder="Ingresa tu contraseña" class="box" oninput="this.value = this.value.replace(/\s/g, '')">

            <input type="submit" value="Iniciar" name="submit" class="btn">

        </form>

    </section>


</body>

</html>
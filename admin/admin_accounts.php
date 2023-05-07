<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_admin = $conn -> prepare("DELETE FROM `admins` WHERE id= ? ");
    $delete_admin -> execute([$delete_id]);
    header('location:admin_accounts.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuentas Administradoras</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>


    <?php
    include '../componentes/admin_header.php';
    ?>

    <!----------Cuentas Administradoras------------>

    <section class="accounts">
        <h1 class="heading">Cuentas Administradoras</h1>

        <div class="box-container">

        <div class="box">
            <p>Registrar Nuevo Administrador</p>
            <a href="register_admin.php" class="option-btn">Registrar</a>
        </div>

            <?php
            $select_account = $conn->prepare('SELECT * FROM `admins`');
            $select_account->execute();

            if ($select_account->rowCount() > 0) {
                while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
            ?>

                    <div class="box">
                        <p>Id: <span><?= $fetch_accounts['id'] ?></span></p>
                        <p>Usuario: <span><?= $fetch_accounts['name'] ?></span></p>

                        <div class="flex-btn">
                            <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Desea Eliminar esta cuenta?')">Eliminar</a>

                            <?php
                                if($fetch_accounts['id'] == $admin_id){
                                    echo ' <a href="update_profile.php" class="btn-green">Actualizar</a>';
                                }
                            ?>
                             
                        </div>
                    </div>

            <?php
                }
            } else {
                echo '<p class="empty">No hay cuentas disponibles</p>';
            }
            ?>

        </div>
    </section>


    <script src="../js/admin_script.js"></script>

</body>

</html>
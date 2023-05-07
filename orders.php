<?php

include 'componentes/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
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


    <section class="orders">

        <h1 class="heading">Tus pedidos</h1>

        <div class="box-container">

            <?php
            if ($user_id == '') {
                echo '<p class="empty">Iniciar sesión primero</p>';
            } else {
                $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
                $select_orders->execute([$user_id]);
                if ($select_orders->rowCount() > 0) {
                    while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>
                        <div class="box">
                            <p>Pedido el : <span><?= $fetch_orders['placed_on']; ?></span></p>
                            <p>Nombre : <span><?= $fetch_orders['name']; ?></span></p>
                            <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                            <p>Numero : <span><?= $fetch_orders['number']; ?></span></p>
                            <p>Lugar : <span><?= $fetch_orders['address']; ?></span></p>
                            <p>Metodo de pago : <span><?= $fetch_orders['method']; ?></span></p>
                            <p>Pedido : <span><?= $fetch_orders['total_products']; ?></span></p>
                            <p>Precio total : <span>$<?= $fetch_orders['total_price']; ?></span></p>
                            <p>Estatus del pedido : <span style="color:<?php if ($fetch_orders['payment_status'] == 'Pendiente') {
                                                                        echo 'red';
                                                                    } else {
                                                                        echo 'green';
                                                                    }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
                        </div>
            <?php
                    }
                } else {
                    echo '<p class="empty">Aun no hay ordenes pedidas!</p>';
                }
            }
            ?>

        </div>

    </section>





    <?php include 'componentes/footer.php' ?>


    <script src="js/script.js"></script>

</body>

</html>
<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $update_status = $conn -> prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_status -> execute([$payment_status, $order_id]);

    $message[] = 'Estatus del pago Actualizado!';
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_order = $conn -> prepare("DELETE FROM `orders` WHERE id= ? ");
    $delete_order -> execute([$delete_id]);
    header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenes Pedidas</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php
    include '../componentes/admin_header.php';
    ?>

    <!----------Pedidos Ordenados------------>

    <section class="placed-orders">

        <h1 class="heading">Pedidos Ordenados</h1>

        <div class="box-container">

            <?php

            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->rowCount() > 0) {

                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {

            ?>

            <div class="box">
                <p>Nombre de usuario: <span><?= $fetch_orders['id'];?></span></p>
                <p>Fecha del pedido: <span><?= $fetch_orders['placed_on'];?></span></p>
                <p>Nombre: <span><?= $fetch_orders['name'];?></span></p>
                <p>Email: <span><?= $fetch_orders['email'];?></span></p>
                <p>Número: <span><?= $fetch_orders['number'];?></span></p>
                <p>Dirección: <span><?= $fetch_orders['address'];?></span></p>
                <p>Productos: <span><?= $fetch_orders['total_products'];?></span></p>
                <p>Total: <span>$<?= $fetch_orders['total_price'];?></span></p>
                <p>Método de pago: <span><?= $fetch_orders['method'];?></span></p>

                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?= $fetch_orders['id'];?>">

                    <select name="payment_status" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['payment_status'];?></option>
                        <option value="Pendiente">Pago Pendiente</option>
                        <option value="Completado">Pago Realizado</option>
                    </select>

                    <div class="flex-btn">
                        <input type="submit" value="Actualizar" class="btn-green" name="update_payment">
                        <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Desea Eliminar este pedido?')">Eliminar</a>
                    </div>
                </form>
            </div>

            <?php
                }
            } else {
                echo  '<p class="empty">Aún no hay ordenes</p>';
            }
            ?>

        </div>


    </section>


    <script src="../js/admin_script.js"></script>

</body>

</html>
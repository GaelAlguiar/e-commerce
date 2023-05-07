<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregados</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php
    include '../componentes/admin_header.php';
    ?>

    <section class="show-products">

        <h1 class="heading">Productos Añadidos</h1>

        <div class="box-container">

            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
                while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <img src="../img_descargadas/<?= $fetch_products['image_01']; ?>" alt="">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="price">$<span><?= $fetch_products['price']; ?></span></div>
                        <div class="details"><span><?= $fetch_products['details']; ?></span></div>
                        <div class="flex-btn">
                            <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Actualizar</a>
                            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Desea Eliminar este producto?')">Eliminar</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Aún no hay productos agregados!</p>';
            }
            ?>

        </div>

    </section>


    <script src="../js/admin_script.js"></script>

</body>

</html>
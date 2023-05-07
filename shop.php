<?php

include 'componentes/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'componentes/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

    <?php
    include 'componentes/user_header.php';
    ?>

    <section class="products">

        <h1 class="heading">Productos Disponibles!</h1>

        <div class="box-container">

            <?php

            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();

            if ($select_products->rowCount() > 0) {
                while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {

            ?>

                    <form action="" method="POST" class="box">

                        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">

                        <button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
                        <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                        <img src="img_descargadas/<?= $fetch_product['image_01']; ?>" class="image" alt="">
                        <div class="name"><?= $fetch_product['name']; ?></div>
                        <div class="flex">
                            <div class="price">$<span><?= $fetch_product['price']; ?></span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.lenght == 2) return false;" id="">
                        </div>

                        <input type="submit" value="Añadir al carrito" name="add_to_cart" class="btn">
                    </form>

            <?php
                }
            } else {
                echo '<p class="empty">No se encontraron productos!</p>';
            }
            ?>

        </div>

    </section>





    <?php include 'componentes/footer.php' ?>


    <script src="js/script.js"></script>

</body>

</html>
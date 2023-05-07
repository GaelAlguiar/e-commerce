<?php

include 'componentes/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:user_login.php');
}

include 'componentes/wishlist_cart.php';

if (isset($_POST['delete'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $delete_wishlist_item = $conn->prepare('DELETE FROM `wishlist` WHERE id = ?');
    $delete_wishlist_item->execute([$wishlist_id]);
}

if (isset($_GET['delete_all'])) {
    $delete_wishlist_item = $conn->prepare('DELETE FROM `wishlist` WHERE id = ?');
    $delete_wishlist_item->execute([$user_id]);
    header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Deseos</title>

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

            $dinero_total = 0;
            $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $select_wishlist->execute([$user_id]);

            if ($select_wishlist->rowCount() > 0) {
                while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
                    $dinero_total += $fetch_wishlist['price'];
            ?>

                    <form action="" method="POST" class="box">

                        <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                        <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">

                        <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                        <img src="img_descargadas/<?= $fetch_wishlist['image']; ?>" class="image" alt="">
                        <div class="name"><?= $fetch_wishlist['name']; ?></div>

                        <div class="flex">
                            <div class="price">$<span><?= $fetch_wishlist['price']; ?></span></div>
                            <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.lenght == 2) return false;" id="">
                        </div>

                        <input type="submit" value="Añadir al carrito" name="add_to_cart" class="btn">
                        <input type="submit" value="Eliminar producto" onclick="return confirm('Desea borrar este producto de la lista de deseos?');" class="delete-btn" name="delete">
                    </form>

            <?php
                }
            } else {
                echo '<p class="empty">Tu lista esta vacia!</p>';
            }
            ?>

        </div>

        <div class="wishlist-total">
            <p>Total : <span>$<?= $dinero_total; ?></span></p>
            <a href="shop.php" class="btn-green">Continuar comprando</a>
            <a href="wishlist.php?delete_all" class="delete-btn <?= ($dinero_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('Desea eliminar todo?');">Eliminar todo</a>
        </div>

    </section>










    <?php include 'componentes/footer.php' ?>


    <script src="js/script.js"></script>

</body>

</html>
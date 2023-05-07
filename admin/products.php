<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_POST['add_product'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_01_size = $_FILES['image_01']['size'];
    $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
    $image_01_folder = '../img_descargadas/' . $image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_02_size = $_FILES['image_02']['size'];
    $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
    $image_02_folder = '../img_descargadas/' . $image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_03_size = $_FILES['image_01']['size'];
    $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
    $image_03_folder = '../img_descargadas/' . $image_03;

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'El nombre de producto ya existe';
    } else {

        if ($image_01_size > 200000 or $image_02_size > 2000000 or $image_03_size > 2000000) {
            $message[] = 'Error, la imagen es demasiado grande';
        } else {

            move_uploaded_file($image_01_tmp_name, $image_01_folder);
            move_uploaded_file($image_02_tmp_name, $image_02_folder);
            move_uploaded_file($image_03_tmp_name, $image_03_folder);

            $insert_product = $conn->prepare("INSERT INTO `products` (name, details, price, image_01, image_02, image_03) VALUES (?,?,?,?,?,?)");
            $insert_product->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

            $message[] = 'Producto añadido exitosamente!';
        }
    }
}

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare('SELECT * FROM `products` WHERE id = ?');
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../img_descargadas/' .    $fetch_delete_image['image_01']);
    unlink('../img_descargadas/' .    $fetch_delete_image['image_02']);
    unlink('../img_descargadas/' .    $fetch_delete_image['image_03']);

    $delete_product = $conn->prepare('DELETE FROM `products` WHERE id = ?');
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);

    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);

    header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php
    include '../componentes/admin_header.php';
    ?>


    <!---------------Añadir Productos--------------------->

    <section class="add-products">

        <h1 class="heading">Añadir Productos</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputBox">
                    <span>Nombre del Producto</span>
                    <input type="text" class="box" required maxlength="100" placeholder="Ingrese el nombre del producto" name="name">
                </div>
                <div class="inputBox">
                    <span>Precio del Producto</span>
                    <input type="number" min="0" class="box" required max="9999999" placeholder="Ingrese el precio del producto" onkeypress="if(this.value.length == 10) return false;" name="price">
                </div>
                <div class="inputBox">
                    <span>Imagen 01</span>
                    <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Imagen 02</span>
                    <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Imagen 03</span>
                    <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
                </div>
                <div class="inputBox">
                    <span>Detalles del producto</span>
                    <textarea name="details" placeholder="Ingrese los detalles del producto" class="box" required maxlength="500" cols="30" rows="10"></textarea>
                </div>
            </div>

            <input type="submit" value="Añadir Producto" class="btn" name="add_product">
        </form>

        <!-------------Ir a Productos Añadidos------------------->

        <section class="show-products1">
            <div class="box-container1">
                <div class="box1">
                    <a href="update_lobby.php" class="btn-green">Ver Productos Añadidos</a>
                </div>
            </div>
        </section>
    </section>



    <script src="../js/admin_script.js"></script>
</body>

</html>
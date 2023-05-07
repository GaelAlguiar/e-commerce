<?php

include '../componentes/connect.php';
session_start();

$admin_id =   $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
};

if (isset($_POST['update'])) {

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ? WHERE id = ?");
    $update_product->execute([$name, $price, $details, $pid]);

    $message[] = 'Producto Actualizado Exitosamente!';

    $old_image_01 = $_POST['old_image_01'];
    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../img_descargadas/' . $image_01;

    if (!empty($image_01)) {
        if ($image_size_01 > 2000000) {
            $message[] = 'La imagen es muy grande!';
        } else {
            $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
            $update_image_01->execute([$image_01, $pid]);
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            unlink('../img_descargadas/' . $old_image_01);
        }
    }

    $old_image_02 = $_POST['old_image_02'];
    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../img_descargadas/' . $image_02;

    if (!empty($image_02)) {
        if ($image_size_02 > 2000000) {
            $message[] = 'La imagen es muy grande!';
        } else {
            $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
            $update_image_02->execute([$image_02, $pid]);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            unlink('../img_descargadas/' . $old_image_02);
        }
    }

    $old_image_03 = $_POST['old_image_03'];
    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../img_descargadas/' . $image_03;

    if (!empty($image_03)) {
        if ($image_size_03 > 2000000) {
            $$message[] = 'La imagen es muy grande!';
        } else {
            $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
            $update_image_03->execute([$image_03, $pid]);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            unlink('../img_descargadas/' . $old_image_03);
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
    <title>Actualizar productos</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_estilo.css">


</head>

<body>

    <?php include '../componentes/admin_header.php'; ?>

    <section class="update-product">

        <h1 class="heading">Actualizar Producto</h1>

        <?php

        $update_id = $_GET['update'];
        $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $show_products->execute([$update_id]);

        if ($show_products->rowCount() > 0) {
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {

        ?>
                <form action="" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
                    <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
                    <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">

                    <div class="image-container">
                        <div class="main-image">
                            <img src="../img_descargadas/<?= $fetch_products['image_01']; ?>" alt="">
                        </div>
                        <div class="sub-image">
                            <img src="../img_descargadas/<?= $fetch_products['image_01']; ?>" alt="">
                            <img src="../img_descargadas/<?= $fetch_products['image_02']; ?>" alt="">
                            <img src="../img_descargadas/<?= $fetch_products['image_03']; ?>" alt="">
                        </div>
                    </div>

                    <span>Actualizar Nombre</span>
                    <input type="text" class="box" required maxlength="100" placeholder="Ingrese el nombre del producto" name="name" value="<?= $fetch_products['name']; ?>">

                    <span>Actualizar Precio</span>
                    <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="Ingrese el precio del product" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">

                    <span>Actualizar Detalles</span>
                    <textarea name="details" placeholder="Ingrese los detalles del producto" class="box" required maxlength="500" cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>

                    <span>Actualizar Imagen 01</span>
                    <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">

                    <span>Actualizar Imagen 02</span>
                    <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">

                    <span>Actualizar Imagen 03</span>
                    <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">

                    <div class="flex-btn">
                        <input type="submit" value="Actualizar" class="btn-green" name="update">
                        <a href="products.php" class="delete-btn">Descartar</a>
                    </div>
                </form>

        <?php
            }
        } else {
            echo '<p class="empty">no product found!</p>';
        }
        ?>

    </section>

    <script src="../js/admin_script.js"></script>

</body>
</html>
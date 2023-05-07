<?php

include 'componentes/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:home.php');
}

if (isset($_POST['order'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {

        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);

        $message[] = 'Pedido pedido exitosamente!';
    } else {
        $message[] = 'Tu carrito esta vacio';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

    <?php
    include 'componentes/user_header.php';
    ?>

    <section class="checkout-orders">

        <form action="" method="POST">

            <h1 class="heading">Tus pedidos</h3>

                <div class="display-orders">

                    <?php

                    $dinero_total = 0;
                    $cart_items[] = '';
                    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);

                    if ($select_cart->rowCount() > 0) {
                        while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {

                            $cart_items[] =  $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                            $total_products = implode($cart_items);
                            $dinero_total += ($fetch_cart['price'] * $fetch_cart['quantity']);

                    ?>

                            <p> <?= $fetch_cart['name']; ?> <span>(<?= '$' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>

                    <?php
                        }
                    } else {
                        echo '<p class="empty">Tu carrito esta vacio!</p>';
                    }
                    ?>

                    <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                    <input type="hidden" name="total_price" value="<?= $dinero_total; ?>" value="">
                    <div class="grand-total">Total : <span>$<?= $dinero_total; ?></span></div>

                </div>

                <h3>Realiza tu pedido</h3>

                <div class="flex">
                    <div class="inputBox">
                        <span>Nombre :</span>
                        <input type="text" name="name" placeholder="Ingresa tu nombre" class="box" maxlength="20" required>
                    </div>
                    <div class="inputBox">
                        <span>Numero :</span>
                        <input type="number" name="number" placeholder="Ingresa tu numero" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="Ingresa tu email" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Metodo de pago :</span>
                        <select name="method" class="box" required>
                            <option value="Efectivo">Pagar al entregar</option>
                            <option value="Tarjeta de credito">Tarjeta de credito</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Paypal">Paypal</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Numero de la direccion :</span>
                        <input type="text" name="flat" placeholder="Ingresa el numero" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Nombre de la calle :</span>
                        <input type="text" name="street" placeholder="Nombre de la calle" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Cuidad :</span>
                        <input type="text" name="city" placeholder="Ingresa tu cuidad" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Estado :</span>
                        <input type="text" name="state" placeholder="Ingresa tu estado" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Pais :</span>
                        <input type="text" name="country" placeholder="Ingresa tu pais" class="box" maxlength="50" required>
                    </div>
                    <div class="inputBox">
                        <span>Codigo postal :</span>
                        <input type="number" min="0" name="pin_code" placeholder="Ingresa tu correo postal" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
                    </div>
                </div>

                <input type="submit" name="order" class="btn <?= ($dinero_total > 1) ? '' : 'disabled'; ?>" value="Ordenar">

        </form>

    </section>


    <?php include 'componentes/footer.php' ?>


    <script src="js/script.js"></script>

</body>

</html>
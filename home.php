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
    <title>Inicio</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

    <?php
    include 'componentes/user_header.php';
    ?>


    <div class="home-bg">

        <section class="home">

            <div class="swiper home-slider">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="imagenes/iphone1.png" alt="">
                        </div>
                        <div class="content">
                            <span>Hasta 40% de descuento</span>
                            <h3>Lo último en celulares</h3>
                            <a href="shop.php" class="btn">Compra ahora</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="imagenes/watch.png" alt="">
                        </div>
                        <div class="content">
                            <span>Hasta 40% de descuento</span>
                            <h3>Lo último en relojes</h3>
                            <a href="shop.php" class="btn">Compra ahora</a>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <div class="image">
                            <img src="imagenes/audifonos.png" alt="">
                        </div>
                        <div class="content">
                            <span>Hasta 40% de descuento</span>
                            <h3>Lo último en audifonos</h3>
                            <a href="shop.php" class="btn">Compra ahora</a>
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </section>

    </div>



    <section class="home-category">

        <h1 class="heading">Categorias</h1>

        <div class="swiper category-slider">

            <div class="swiper-wrapper">

                <a href="category.php?category=laptop" class="swiper-slide slide">
                    <img src="imagenes/icon-1.png" alt="">
                    <h3>Laptop</h3>
                </a>

                <a href="category.php?category=tv" class="swiper-slide slide">
                    <img src="imagenes/icon-2.png" alt="">
                    <h3>Tv</h3>
                </a>

                <a href="category.php?category=camara" class="swiper-slide slide">
                    <img src="imagenes/icon-3.png" alt="">
                    <h3>Camara</h3>
                </a>

                <a href="category.php?category=mouse" class="swiper-slide slide">
                    <img src="imagenes/icon-4.png" alt="">
                    <h3>Mouse</h3>
                </a>

                <a href="category.php?category=fridge" class="swiper-slide slide">
                    <img src="imagenes/icon-5.png" alt="">
                    <h3>Refrigerador</h3>
                </a>

                <a href="category.php?category=washing" class="swiper-slide slide">
                    <img src="imagenes/icon-6.png" alt="">
                    <h3>Lavador</h3>
                </a>

                <a href="category.php?category=smartphone" class="swiper-slide slide">
                    <img src="imagenes/icon-7.png" alt="">
                    <h3>Celular</h3>
                </a>

                <a href="category.php?category=watch" class="swiper-slide slide">
                    <img src="imagenes/icon-8.png" alt="">
                    <h3>Reloj</h3>
                </a>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>


    <section class="home-products">

        <h1 class="heading">Lo ultimo en productos!</h1>

        <div class="swiper products-slider">

            <div class="swiper-wrapper">

                <?php
                $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
                $select_products->execute();

                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {

                ?>

                        <form action="" method="POST" class="slide swiper-slide">

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
                    echo '<p class="empty">Aun no hay productos!</p>';
                }
                ?>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>









    <?php include 'componentes/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            spaceBetween: 100,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
        });


        var swiper = new Swiper(".category-slider", {
            loop: true,
            spaceBetween: 20,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                },
                650: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            },
        });


        var swiper = new Swiper(".products-slider", {
            loop: true,
            spaceBetween: 20,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>


</body>

</html>
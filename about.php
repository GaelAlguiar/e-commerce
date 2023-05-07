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
    <title>Sobre Nosotros</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>

    <?php
    include 'componentes/user_header.php';
    ?>

    <section class="about">

        <div class="row">

            <div class="image">

                <img src="imagenes/about-img.svg" alt="">

            </div>

            <div class="content">
                <h3>Por qué escogernos?</h3>
                <p>Te ofrecemos productos exclusivos, diseños únicos para que puedas sorprender a tus clientes, Stock inmediato, no tenemos demoras de producción, hacemos envíos a todo el país, ofrecemos diferentes descuentos de acuerdo a los montos de compra, puedes usar nuestras fotos de Instagram para comercializar los productos en tu emprendimiento digital. Atención y venta personalizada </p>

                <p>Conocimiento de producto: En nuestra web puedes encontrar mucha información: descripción de los productos, usos, materiales, etc. Es importante poder asesorar a nuestros clientes sobre los productos que ofrecemos en nuestra tienda. Conocer y saber más de los productos hacen que obtengamos una mejor conversión de venta y relación con nuestro cliente!. </p>
                <a href="contact.php" class="btn">contactanos</a>
            </div>

        </div>

    </section>



    <section class="reviews">

        <h1 class="heading">opiniones de usuarios</h1>

        <div class="swiper reviews-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="imagenes/imagen1.svg" alt="">
                    <p>Siempre me ha encantado Whoppie. es realmente el mejor lugar para comprar. la gente es genial, y la tienda en sí suele estar bien cuidada y limpia.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Emma Taylor</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="imagenes/imagen2.svg" alt="">
                    <p>Las personas son muy útiles, están muy bien capacitadas y eso se nota. Si tuviera que elegir entre alguna de las tiendas departamentales, se lo recomiendo a todos ustedes también.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>David Brown</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="imagenes/imagen3.svg" alt="">
                    <p>Ustedes siempre tienen lo que necesito y los cajeros siempre son muy amables. Esta noche, mi cajera no saludó ni sonrió, y vi su teléfono junto a la caja registradora.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Jake Williams</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="imagenes/imagen4.svg" alt="">
                    <p>Wow. Increíble compañía increíble. Saben cómo hacer las cosas cuando se trata de comercio en línea. Tan impresionada por el conocimiento y la sinceridad hacia los clientes.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Olivia Robinson</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="imagenes/imagen5.svg" alt="">
                    <p>Comerciantes experto excelente, amigable y bien informado y servicios rápidos, convenientes y asequibles. Te lo recomiendo mucho ya que tienen un excelente variedad de productos.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h3>Emily Thompson</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="imagenes/imagen6.svg" alt="">
                    <p>Esta es una tienda de comestibles increíble! No puedo creer el tamaño. Siempre he tenido excelentes productos y servicios, con una gran calidad y variedad en su sitio web y tiendas.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Jack Walker</h3>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>







    <?php include 'componentes/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

    <script>
        var swiper = new Swiper(".reviews-slider", {
            loop: true,
            spaceBetween: 20,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
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
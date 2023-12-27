<?PHP
require_once "functions/autoload.php";
$marcas = (new Marcas())->catalogo_completo();
$colores = (new Colores())->catalogo_completo();


$secciones_validas = [
    "home" => [
        "titulo" => "Bienvenidos", "restringido" => FALSE
    ],
    "envios" => [
        "titulo" => "Políticas de envío", "restringido" => FALSE
    ],
    "quienes_somos" => [
        "titulo" => "¿Quienes Somos?", "restringido" => FALSE
    ],
    "guitarras" => [
        "titulo" => "Nuestro catálogo", "restringido" => FALSE
    ],
    "catalogo_completo" => [
        "titulo" => "Todo Nuestro Catálogo de Guitarras", "restringido" => FALSE
    ],
    "producto" => [
        "titulo" => "Detalle de Producto", "restringido" => FALSE
    ],
    "catalogo_favoritos" => [
        "titulo" => "catalogo de Guitarras favoritas", "restringido" => FALSE
    ],
    "carrito" => [
        "titulo" => "Carrito de Compras", "restringido" => FALSE
    ],
    "login" => [
        "titulo" => "Inicio de Sesión", "restringido" => FALSE
    ],
    "panel_usuario" => [
        "titulo" => "Panel de Usuario", "restringido" => TRUE
    ],
    "finalizar_pago" => [
        "titulo" => "Finalizar Pago", "restringido" => TRUE
    ]

];

$seccion = isset($_GET['sec']) ? $_GET['sec'] : 'home';

if (!array_key_exists($seccion, $secciones_validas)) {
    $vista = "404";
    $titulo = "404: Página no encontrada";
} else {
    $vista = $seccion;

    if ($secciones_validas[$seccion]['restringido']) {
        (new Autenticacion())->verify(FALSE);
    }

    $titulo = $secciones_validas[$seccion]['titulo'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Guitarras - <?= $seccion ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <script src="https://kit.fontawesome.com/9efbb80e14.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header  ">
        <div class="header__contenedor">
            <div class="header__barra p-3 barraFondo">
                <a href="index.php?sec=home">
                    <img class="header__logo" src="img/logo2.svg" alt="imagen logo">
                </a>
                <nav class="navegacion navbar-expand-lg navbar ">
                    <div class="container-fluid">
                        <button class="navbar-toggler bg-warning p-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon bg-warning"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav ms-auto ">
                                <li class="nav-item ">
                                    <a class="text-light nav-link sombras active <?= $userData ? "d-none" : "" ?> " href="index.php?sec=home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-light nav-link sombras active <?= $userData ? "d-none" : "" ?> " href="index.php?sec=quienes_somos">Nosotros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-light nav-link sombras active<?= $userData ? "d-none" : "" ?> " href="index.php?sec=catalogo_completo">Catálogo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-light nav-link sombras active <?= $userData ? "d-none" : "" ?> " href="admin">Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-light nav-link sombras active <?= $userData ? "d-none" : "" ?> " href="index.php?sec=carrito">Carrito</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-light nav-link sombras active <?= $userData ? "d-none" : "" ?> " href="index.php?sec=panel_usuario">Panel</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div><!--.header-barra-->
            <div class="modelo">
                <h1 class="modelo__nombre">Tienda Online de Instrumentos Musicales</h1>
            </div>
        </div>
        <img class="header__guitarra imgSombra" src="img/header_guitarra.png" alt="imagen header guitarra">
    </header>

    <!--Sección Filtros -->
    <div class="container-fluid bg-dark">
        <div class="container">
            <div class="">
                <nav class="navegacion navbar-expand-lg navbar ">
                    <div class="container-fluid">
                        <h2>Filtrar por: </h2>
                        <!-- <ul class="navbar-nav ms-auto header__barra"> -->
                        <form class="navbar-nav ms-auto header__barra barraFondo2" action="index.php">
                            <input type="hidden" name="sec" value="guitarras">
                            <label for="marca">Marca</label>
                            <select class="comboModelos bg-dark" name="marca" id="marca">
                                <option value="" selected>Seleccione</option>
                                <?PHP
                                foreach ($marcas as $m) { ?>
                                    <option value="<?= $m->getId() ?>"><?= $m->getMarca() ?></option>;
                                <?PHP } ?>
                            </select>
                            <label for="color">Color</label>
                            <select class="comboModelos bg-dark" name="color" id="color">
                                <option value="" selected>Seleccione</option>
                                <?PHP
                                foreach ($colores as $c) { ?>
                                    <option value="<?= $c->getId() ?>"><?= $c->getColor() ?></option>;
                                <?PHP } ?>
                            </select>
                            <label for="minimo">Precio Min</label>
                            <select class="comboModelos bg-dark" name="minimo" id="minimo">
                                <option value="">Seleccione</option>
                                <option value="20000">$ 20,000</option>
                                <option value="30000">$ 30,000</option>
                                <option value="40000">$ 40,000</option>
                                <option value="50000">$ 50,000</option>
                                <option value="60000">$ 60,000</option>
                                <option value="70000">$ 70,000</option>
                                <option value="80000">$ 80,000</option>
                                <option value="90000">$ 90,000</option>
                                <option value="100000">$ 100,000</option>
                                <option value="110000">$ 110,000</option>
                                <option value="120000">$ 120,000</option>
                                <option value="130000">$ 130,000</option>
                            </select>
                            <label for="maximo">Precio Max</label>
                            <select class="comboModelos bg-dark" name="maximo" id="maximo">
                                <option value="">Seleccione</option>
                                <option value="20000">$ 20,000</option>
                                <option value="30000">$ 30,000</option>
                                <option value="40000">$ 40,000</option>
                                <option value="50000">$ 50,000</option>
                                <option value="60000">$ 60,000</option>
                                <option value="70000">$ 70,000</option>
                                <option value="80000">$ 80,000</option>
                                <option value="90000">$ 90,000</option>
                                <option value="100000">$ 100,000</option>
                                <option value="110000">$ 110,000</option>
                                <option value="120000">$ 120,000</option>
                                <option value="130000">$ 130,000</option>
                            </select>

                            <button class="btn comboModelosBtn" type="submit">Filtrar</button>
                        </form>
                        <!-- </ul> -->
                    </div>
                </nav>
            </div><!--.header-barra-->
        </div>
    </div>


    <main class="productos productos__contenedor">

        <?PHP

        require_once "views/$vista.php";

        ?>


    </main>

    <?php
    require_once 'includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>
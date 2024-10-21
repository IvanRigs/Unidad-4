<?php
include './app/detalles.php';

$productController = new detalles();
$productResponse = $productController->getProductDetails();
$productData = $productResponse['data']; // Acceder directamente a los datos del producto
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($productData['name']); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid">
    <div class="row">

    <?php 
        require './sidebar.html';
    ?>

    <div class="col p-0 m-0">
        <?php 
            require './navbar.html';
        ?>

        <main class="container-fluid pb-3 overflow-auto">
            <div class="card">
                <h5 class="card-header"><?php echo htmlspecialchars($productData['name']); ?></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="carouselExampleCaptions" class="carousel slide w-100">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="<?php echo $productData['cover']; ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($productData['name']);?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h5 class="card-title"><?php echo htmlspecialchars($productData['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($productData['description']); ?></p>
                            <p class="card-text"><strong>Precio:</strong> <?php echo htmlspecialchars($productData['presentations'][0]['price'][0]['amount']); ?></p>
                            <a href="#" class="btn btn-primary">Comprar ahora</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de pedidos -->
            <div class="card mt-3">
                <h5 class="card-header">Historial de pedidos</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

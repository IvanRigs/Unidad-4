<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid d-flex flex-row p-0">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark w-25">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                    Home
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                    Orders
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                    Products
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                    Customers
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>

    <div class="flex-grow-1">
        <header class="py-3 mb-4 border-bottom shadow">
            <div class="container-fluid align-items-center d-flex">
                <div class="flex-shrink-1">
                    <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none">
                        <i class="bi bi-bootstrap fs-2 text-dark"></i>
                    </a>
                </div>
                <div class="flex-grow-1 d-flex align-items-center">
                    <nav class="navbar navbar-expand-lg w-100">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Riskleis</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Link</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <form class="d-flex mb-0" role="search">
                                    <input class="form-control me-2 mb-0" type="search" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        </div>
                    </nav>
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main class="container-fluid pb-3 overflow-auto">
            <div class="row">
                <?php
                    include './app/ProductController.php';
                    $productController = new ProductController();
                    $products = $productController->getProducts();

                    if (!empty($products) && isset($products['data'])) {
                        foreach ($products['data'] as $product) {
                            echo '<div class="col-md-4">';
                            echo '    <div class="card mb-4 shadow-sm">';
                            echo '        <img src="' . htmlspecialchars($product['cover']) . '" class="card-img-top" alt="' . htmlspecialchars($product['name']) . '">';
                            echo '        <div class="card-body">';
                            echo '            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>';
                            echo '            <p class="card-text">' . htmlspecialchars($product['description']) . '</p>';
                            echo '            <a href="detalleProducto.php?slug=' . urlencode($product['slug']) . '" class="btn btn-primary">Ver más</a>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-md-12">';
                        echo '<div class="alert alert-warning" role="alert">No products available.</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

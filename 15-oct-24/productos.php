<?php 	
	session_start();

	if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=null) {
		
		

		
	}else{

		header('Location: login.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Home
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
  </head>
</head>
<body>
 	
	<div class=""> 
	 	
	 	<div class="container-fluid">
	 		<div class="row">
	 			<div class="col-2 p-0 m-0 d-none d-md-block">
	 				<div class="d-flex flex-column min-vh-100 flex-shrink-0 p-3 text-white bg-dark" style="">
					    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
					      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
					      <span class="fs-4">Sidebar</span>
					    </a>
					    <hr>
					    <ul class="nav nav-pills  flex-column mb-auto">
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
	 			</div>
	 			<div class="col p-0 m-0">
	 				<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dar" data-bs-theme="dark">
					  <div class="container">
					    <a class="navbar-brand" href="#">Navbar</a>
					    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					      <span class="navbar-toggler-icon"></span>
					    </button>


					    <div class="collapse navbar-collapse" id="navbarNav">
					      <ul class="navbar-nav">
					        <li class="nav-item">
					          <a class="nav-link active" aria-current="page" href="#">Home</a>
					        </li>
					        <li class="nav-item">
					          <a class="nav-link" href="#">Features</a>
					        </li>
					        <li class="nav-item">
					          <a class="nav-link" href="#">Pricing</a>
					        </li>
					        <li class="nav-item">
					          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
					        </li>
					      </ul>
					    </div>

					    <form class="d-flex" role="search">
					      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					      <button class="btn btn-outline-success" type="submit">Search</button>
					    </form>

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
					</nav>


					<div id="main">
						
						<div class="container p-3"> 

							<h3>
								Productos
							</h3>

							<div class="row"> 

                                <?php 
                                
                                    include './app/ProductController.php';
                                    $productController = new ProductController();
                                    $products = $productController->getProducts();

                                    if(!empty($products) && isset($products['data'])) {
                                        foreach($products['data'] as $product) {
                                            echo '<div class="col-lg-4 mb-4">';
                                            echo '    <div class="card">';
                                            echo '        <img src="' . htmlspecialchars($product['cover']) . '" alt="" class="card-img-top">';
                                            echo '        <div class="card-body">';
                                            echo '            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>';
                                            echo '            <p class="card-text">' . htmlspecialchars($product['description']) . '</p>';
                                            echo '            <a href="detalleProducto.php?slug=' . urlencode($product['slug']) . '" class="btn btn-primary">Read More</a>';
                                            echo '        </div>';
                                            echo '    </div>';
                                            echo '</div>';
                                        }
                                    }

                                ?>

							</div>

						</div>

					</div>

	 			</div>
	 		</div>
	 	</div>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
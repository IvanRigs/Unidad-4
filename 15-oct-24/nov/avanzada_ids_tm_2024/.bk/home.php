<?php 	
	include_once "app/ProductController.php";
	include_once "app/BrandController.php";

	$productController = new ProducController();
	$brandController = new BrandController();


	if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=null) {
		

		$products = $productController->get();
		$brands = $brandController->get();


	}else{

		header('Location: index.php');
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

						<div class="container ">
						  <nav aria-label="breadcrumb">
						    <ol class="breadcrumb p-3 bg-body-tertiary rounded-3">
						      
						      <li class="breadcrumb-item active">
						      	<a href="#">
						      		Productos
						      	</a>
						      </li>
						       <li class="float-end ">
						       	
						       		<button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">
						       			Add producto
						       		</button>

						       </li>
						    </ol>
						  </nav>



						</div>
						
						<div class="container p-3"> 

							<!-- <h2>
								Lista de productso disponibles
							</h2> -->

							<div class="row"> 


								<?php if (isset($products) && count($products)): ?> 
								<?php foreach ($products as $product): ?>
								

								<div class="card m-1" style="width: 18rem;">
								  <img src="<?= $product->cover  ?>" class="card-img-top" alt="...">
								  <div class="card-body">
								    <h5 class="card-title">
								    	<?= $product->name  ?>
								    </h5>
								    <p class="card-text">
								    	
								    	<?= $product->description  ?>

								    </p>
								    <a href="details.php?slug=<?= $product->slug  ?>" class="btn btn-primary">
								    	Ver detalles
								    </a>

								    <button onclick='editar(this)' data-product='<?= json_encode($product)  ?>' data-bs-toggle="modal" data-bs-target="#updateModal" type="button" class="btn btn-warning">
								    	Editar
								    </button>

								     
								    <button onclick="eliminar(<?= $product->id ?>)" type="button" class="btn btn-danger m-2">
								    	Eliminar
								    </button>

								  </div>
								</div>


								<?php endforeach ?> 
								<?php endif ?> 
								 

							</div>

						</div>

					</div>

	 			</div>
	 		</div>
	 	</div>
		

			


	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">
	        	Añadir producto
	        </h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="app/ProductController.php">
			  
			  <div class="mb-3">
			    <label for="nombre" class="form-label">
			    	Nombre
			    </label>
			    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp" required> 
			  </div>
			  
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	Slug
			    </label>
			    <input type="text" class="form-control" id="slug" name="slug" required> 
			  </div>

			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	description
			    </label>
			    <input type="text" class="form-control" id="description" name="description" required> 
			  </div>

			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	features
			    </label>
			    <input type="text" class="form-control" id="features" name="features" required> 
			  </div> 

			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	Marca
			    </label>
			    
			    <select class="form-control">
			    	<?php if (isset($brands) && count($brands)): ?>
			    	<?php foreach ($brands as $brand): ?>
			    	<option value="<?= $brand->id ?>">
			    		<?= $brand->name ?>
			    	</option>
			    	<?php endforeach ?>
			    	<?php endif ?>
			    	
			    </select>

			  </div>
			  
			  <button type="submit" class="btn btn-primary">
			  	Crear producto
			  </button>

			  <input type="hidden" name="action" value="create_product">
			
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
	        	Cancelar
	        </button> 
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h1 class="modal-title fs-5" id="exampleModalLabel">
	        	Editar producto
	        </h1>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form method="POST" action="app/ProductController.php">
			  
			  <div class="mb-3">
			    <label for="nombre" class="form-label">
			    	Nombre
			    </label>
			    <input type="text" class="form-control" id="update_nombre" name="nombre" aria-describedby="emailHelp" required> 
			  </div>
			  
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	Slug
			    </label>
			    <input type="text" class="form-control" id="update_slug" name="slug" required> 
			  </div>

			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	description
			    </label>
			    <input type="text" class="form-control" id="update_description" name="description" required> 
			  </div>

			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	features
			    </label>
			    <input type="text" class="form-control" id="update_features" name="features" required> 
			  </div>
			  
			  <div class="mb-3">
			    <label for="slug" class="form-label">
			    	Marca
			    </label>
			    
			    <select class="form-control">
			    	<?php if (isset($brands) && count($brands)): ?>
			    	<?php foreach ($brands as $brand): ?>
			    	<option value="<?= $brand->id ?>">
			    		<?= $brand->name ?>
			    	</option>
			    	<?php endforeach ?>
			    	<?php endif ?>
			    	
			    </select>

			  </div>
			  
			  <button type="submit" class="btn btn-primary">
			  	Crear producto
			  </button>

			  <input type="hidden" name="action" value="update_product">
				
			  <input type="hidden" name="product_id" id="product_id">

			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
	        	Cancelar
	        </button> 
	      </div>
	    </div>
	  </div>
	</div>

	<form method="POST" id="remove_form" action="app/ProductController.php"> 

	  <input type="hidden" name="action" value="delete_product">
	  <input type="hidden" name="product_id" id="product_id_delete">

	</form>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript">
		
		function editar(boton)
		{

			let producto = JSON.parse(boton.dataset.product);

			console.log(producto.id)
			
			document.getElementById("update_nombre").value = producto.name
			document.getElementById("update_slug").value = producto.slug
			document.getElementById("update_description").value = producto.description
			document.getElementById("update_features").value = producto.features
			document.getElementById("product_id").value = producto.id
			


		}

		function eliminar(product_id)
		{
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this imaginary file!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    
			    swal("Poof! Your imaginary file has been deleted!", {
			      icon: "success",
			    });

			    document.getElementById("product_id_delete").value = product_id

			    document.getElementById('remove_form').submit();
			  
			  } else {
			    
			  }
			});
		}

	</script>
</body>
</html>
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
                <?php 
                        require './sidebar.html';
                ?>
	 			<div class="col p-0 m-0">
	 				
                    <?php 
                        require './navbar.html';
                    ?>

					<div id="main">
						
						<div class="container p-3"> 

                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <h3 class="mb-0">Productos</h3>
                                </div>
                                <div class="col text-end">
                                    <a onclick="openModalnewProduct()" class="btn btn-primary">Agregar producto</a>
                                </div>
                            </div>

							<div class="row mt-3"> 

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
                                            echo '            <a href="detalleProducto.php?slug=' . urlencode($product['slug']) . '" class="btn btn-primary">Ver mas</a>';
                                            echo '            <a onclick="openModalEditProduct()" class="btn">Editar</a>';
                                            echo '            <a href="detalleProducto.php?slug=' . urlencode($product['slug']) . '" class="btn text-danger">Eliminar</a>';
                                            echo '        </div>';
                                            echo '    </div>';
                                            echo '</div>';
                                        }
                                    }

                                ?>

                                <div class="modal fade" id="newProduct" tabindex="-1" aria-labelledby="ModalScrollableTitle" aria-hidden="true"  data-bs-backdrop="static" >
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                        
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="ModalScrollableTitle">Nuevo Producto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre">
                                                <!-- <div v-if="nameError" class="text-danger">Por favor, introduce un nombre válido.</div> -->

                                                <label class="form-label">Descripcion</label>
                                                <input type="text" class="form-control" placeholder="Descripcion">
                                                <!-- <div v-if="emailError" class="text-danger">Por favor, introduce un correo electrónico válido.</div>
                                                <div v-if="emailError2" class="text-danger">Correo electronico ya registrado.</div> -->

                                                <label class="form-label">Imagen</label>
                                                <input type="file" class="form-control" placeholder="Apodo">
                                                <!-- <div v-if="nicknameError" class="text-danger">Por favor, introduce un apodo válido.</div> -->

                                                <label class="form-label">Precio</label>
                                                <input type="text" class="form-control" placeholder="Precio">
                                                <!-- <div v-if="passwordError" class="text-danger">Por favor, introduce contrasenas iguales.</div>
                                                <div v-if="passwordError2" class="text-danger">Por favor, introduce una contrasena.</div> -->
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="ModalScrollableTitle" aria-hidden="true"  data-bs-backdrop="static" >
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                        
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="ModalScrollableTitle">Editar Producto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre">
                                                <!-- <div v-if="nameError" class="text-danger">Por favor, introduce un nombre válido.</div> -->

                                                <label class="form-label">Descripcion</label>
                                                <input type="text" class="form-control" placeholder="Descripcion">
                                                <!-- <div v-if="emailError" class="text-danger">Por favor, introduce un correo electrónico válido.</div>
                                                <div v-if="emailError2" class="text-danger">Correo electronico ya registrado.</div> -->

                                                <label class="form-label">Imagen</label>
                                                <input type="file" class="form-control" placeholder="Apodo">
                                                <!-- <div v-if="nicknameError" class="text-danger">Por favor, introduce un apodo válido.</div> -->

                                                <label class="form-label">Precio</label>
                                                <input type="text" class="form-control" placeholder="Precio">
                                                <!-- <div v-if="passwordError" class="text-danger">Por favor, introduce contrasenas iguales.</div>
                                                <div v-if="passwordError2" class="text-danger">Por favor, introduce una contrasena.</div> -->
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

							</div>

						</div>

					</div>

	 			</div>
	 		</div>
	 	</div>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
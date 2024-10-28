<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success_message']}</div>";
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error_message']}</div>";
    unset($_SESSION['error_message']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php require './sidebar.html'; ?>
            <div class="col p-0 m-0">
                <?php require './navbar.html'; ?>

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

                            if (!empty($products) && isset($products['data'])) {
                                foreach ($products['data'] as $product) {
                                    echo '<div class="col-lg-4 mb-4">';
                                    echo '    <div class="card">';
                                    echo '        <img src="' . htmlspecialchars($product['cover']) . '" alt="" class="card-img-top">';
                                    echo '        <div class="card-body">';
                                    echo '            <h5 class="card-title">' . htmlspecialchars($product['name']) . '</h5>';
                                    echo '            <p class="card-text">' . htmlspecialchars($product['description']) . '</p>';
                                    echo '            <p class="card-text">Marca: ' . htmlspecialchars($product['brand']['name']) . '</p>';
                                    echo '            <a href="detalleProducto.php?slug=' . urlencode($product['slug']) . '" class="btn btn-primary">Ver más</a>';
                                    echo '            <a onclick="openModaleditProduct(\'' . htmlspecialchars($product['slug']) . '\', \'' . htmlspecialchars($product['name']) . '\', \'' . htmlspecialchars($product['description']) . '\', \'' . htmlspecialchars($product['features']) . '\', \'' . htmlspecialchars($product['id']) . '\')" class="btn">Editar</a>';
                                    echo '            <a onclick="openModalDeleteProduct(\'' . htmlspecialchars($product['slug']) . '\', \'' . htmlspecialchars($product['id']) . '\')" class="btn text-danger">Eliminar</a>';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '</div>';
                                }
                            }
                            ?>

                            <?php
                            $brands = $productController->getBrands();
                            ?>

                            <!-- Modal para nuevo producto -->
                            <div class="modal fade" id="newProduct" tabindex="-1" aria-labelledby="ModalScrollableTitle" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Nuevo Producto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="./app/ProductController.php" enctype="multipart/form-data">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre" name="name" required>
                                                <label class="form-label">Slug</label>
                                                <input type="text" class="form-control" placeholder="Slug" name="slug" required>
                                                <label class="form-label">Descripción</label>
                                                <textarea class="form-control" placeholder="Descripción" name="description" required></textarea>
                                                <label class="form-label">Características</label>
                                                <input type="text" class="form-control" placeholder="Características" name="features">
                                                <label class="form-label">Imagen</label>
                                                <input type="file" class="form-control" name="cover">
                                                <label class="form-label">Marca</label>
                                                <select class="form-control" name="brand_id" required>
                                                    <option value="">Seleccione una marca</option>
                                                    <?php
                                                    if (isset($brands['data'])) {
                                                        foreach ($brands['data'] as $brand) {
                                                            echo '<option value="' . htmlspecialchars($brand['id']) . '">' . htmlspecialchars($brand['name']) . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="action" value="add_product">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para editar producto -->
                            <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="ModalScrollableTitle" aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Editar Producto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="./app/ProductController.php" id="editForm" enctype="multipart/form-data">
                                                <input type="hidden" name="id" id="editProductId">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="name" required>
                                                <label class="form-label">Slug</label>
                                                <input type="text" class="form-control" name="slug" required>
                                                <label class="form-label">Descripción</label>
                                                <textarea class="form-control" name="description" required></textarea>
                                                <label class="form-label">Características</label>
                                                <input type="text" class="form-control" name="features">

                                                <label class="form-label">Marca</label>
                                                <select class="form-control" name="brand_id" id="editBrandId" required>
                                                    <option value="">Seleccione una marca</option>
                                                    <?php
                                                    if (isset($brands['data'])) {
                                                        foreach ($brands['data'] as $brand) {
                                                            echo '<option value="' . htmlspecialchars($brand['id']) . '">' . htmlspecialchars($brand['name']) . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <!-- <label class="form-label">Imagen</label>
                                                <input type="file" class="form-control" name="cover">  -->
                                                <input type="hidden" name="action" value="edit_product">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openModalnewProduct() {
            var modal = new bootstrap.Modal(document.getElementById('newProduct'));
            modal.show();
        }

        function openModaleditProduct(slug, name, description, features, id) {
            document.getElementById('editProductId').value = id;
            document.querySelector('#editForm [name="name"]').value = name;
            document.querySelector('#editForm [name="slug"]').value = slug;
            document.querySelector('#editForm [name="description"]').value = description;
            document.querySelector('#editForm [name="features"]').value = features;

            var modal = new bootstrap.Modal(document.getElementById('editProduct'));
            modal.show();
        }

        function openModalDeleteProduct(slug, id) {
        swal({
            title: "Estas seguro?",
            text: "Deseas eliminar el producto?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = './app/ProductController.php';

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'id';
                input.value = id;
                form.appendChild(input);

                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'delete_product';
                form.appendChild(actionInput);

                document.body.appendChild(form);
                form.submit();
            } else {
                swal("No se ha eliminado.");
            }
        });
    }
    </script>
</body>
</html>

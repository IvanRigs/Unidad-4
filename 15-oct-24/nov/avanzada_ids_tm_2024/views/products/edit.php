<?php 
include_once "../../app/ProductController.php";
include_once "../../app/config.php";
$productController = new ProductController();
$products = $productController->getProducts();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include "../layouts/head.php"; ?>
  <style>
      .product-card {
         height: 500px;
      }
      .product-card .card-img-top {
         height: 500px; 
         overflow: hidden; 
      }
      .product-card img {
         width: 100%; 
         height: auto; 
      }
   </style>
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  
  <?php include "../layouts/sidebar.php"; ?>
  <?php include "../layouts/nav.php"; ?>

  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                <li class="breadcrumb-item" aria-current="page">Productos</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Productos</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-sm-12">
          <div class="ecom-wrapper">
            <div class="ecom-content">
              <div class="row">
                <?php foreach ($products as $product): 
                  $imageUrl = !empty($product->cover) ? $product->cover : '../assets/images/default-product.png';
                  $price = isset($product->presentations[0]->price[0]->amount) && $product->presentations[0]->price[0]->is_current_price
                           ? $product->presentations[0]->price[0]->amount
                           : '0.00';
                ?>
                  <div class="col-sm-6 col-xl-4">
                    <div class="card product-card">
                      <div class="card-img-top">
                        <img src="<?= $imageUrl ?>" alt="<?= $product->name ?>" class="img-prod img-fluid" />
                      </div>
                      <div class="card-body">
                        <p class="prod-content mb-0 text-muted"><?= $product->name ?></p>
                        <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                          <h4 class="mb-0 text-truncate">
                            <b>$<?= number_format($price, 2) ?></b>
                          </h4>
                        </div>
                        <div class="d-flex">
                          <div class="flex-grow-1 ms-3">
                            <div class="d-grid">
                              <button class="btn btn-link-secondary btn-prod-card" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setProductToEdit(<?= htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') ?>)">
                                Editar
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php include "../layouts/footer.php"; ?>
  <?php include "../layouts/scripts.php"; ?>

  <!-- Modal de Edición de Producto -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" action="../../app/ProductController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update_product">
            <input type="hidden" name="product_id" id="edit_product_id">

            <div class="mb-3">
              <label for="edit_name" class="form-label">Product Name</label>
              <input type="text" class="form-control" name="name" id="edit_name" required>
            </div>

            <div class="mb-3">
              <label for="edit_slug" class="form-label">Slug</label>
              <input type="text" class="form-control" name="slug" id="edit_slug" required>
            </div>

            <div class="mb-3">
              <label for="edit_description" class="form-label">Descripcion</label>
              <textarea class="form-control" name="description" id="edit_description" required></textarea>
            </div>

            <div class="mb-3">
              <label for="edit_features" class="form-label">Features</label>
              <textarea class="form-control" name="features" id="edit_features" required></textarea>
            </div>

            <div class="mb-3">
              <label for="edit_cover" class="form-label">Imagen</label>
              <input type="file" class="form-control" name="cover" id="edit_cover">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
  function setProductToEdit(product) {
    document.getElementById('edit_product_id').value = product.id;
    document.getElementById('edit_name').value = product.name;
    document.getElementById('edit_slug').value = product.slug;
    document.getElementById('edit_description').value = product.description;
    document.getElementById('edit_features').value = product.features;

    // Limpia el campo de imagen para evitar confusión
    document.getElementById('edit_cover').value = "";
  }
</script>
</body>
</html>

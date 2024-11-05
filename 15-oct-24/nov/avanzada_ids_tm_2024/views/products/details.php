<?php 
include_once "../../app/ProductController.php";
include_once "../../app/config.php";
$slug = $_GET['slug'] ?? null;

if ($slug) {
    $productController = new ProductController();
    $product = $productController->getBySlug($slug);

    if (!$product) {
        echo "No se encontro producto.";
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <?php include "../layouts/head.php"; ?>
</head>
<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <?php include "../layouts/sidebar.php"; ?>
  <?php include "../layouts/nav.php"; ?>

  <div class="pc-container">
    <div class="pc-content">
      <div class="page-header">
        <h2 class="mb-0">Detalles del Producto</h2>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="sticky-md-top product-sticky">
            <div id="carouselExampleCaptions" class="carousel slide ecomm-prod-slider" data-bs-ride="carousel">
              <div class="carousel-inner bg-light rounded position-relative">
                <div class="carousel-item active">
                  <img src="<?= $product->cover ?>" class="d-block w-100" alt="<?= $product->name ?>" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <h5 class="my-3"><?= $product->name ?></h5>
          <div class="star f-18 mb-3">
            <i class="fas fa-star text-warning"></i>
            <?= isset($product->rating) ? $product->rating : 'N/A' ?> <small class="text-muted">/ 5</small>
          </div>
          <p><strong>Precio:</strong> $<?= number_format($product->presentations[0]->price[0]->amount, 2) ?></p>
          <h5 class="mt-4 mb-sm-3 mb-2 f-w-500">Descripción</h5>
          <p><?= $product->description ?></p>
          <h5 class="mt-4 mb-sm-3 mb-2 f-w-500">Características</h5>
          <p><?= $product->features ?></p>

          <div class="row">
            <div class="col-6">
              <div class="d-grid">
                <button type="button" class="btn btn-primary">Comprar Ahora</button>
              </div>
            </div>
            <div class="col-6">
              <div class="d-grid">
                <button type="button" class="btn btn-outline-secondary">Agregar al carrito</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include "../layouts/footer.php"; ?>
  <?php include "../layouts/scripts.php"; ?>
</body>
</html>

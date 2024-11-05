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
                        <a href="details.php?slug=<?= $product->slug ?>">
                          <img src="<?= $imageUrl ?>" alt="<?= $product->name ?>" class="img-prod img-fluid" />
                        </a>
                        <div class="card-body position-absolute end-0 top-0">
                          <div class="form-check prod-likes">
                            <input type="checkbox" class="form-check-input" />
                            <i data-feather="heart" class="prod-likes-icon"></i>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <a href="details.php?slug=<?= $product->slug ?>">
                          <p class="prod-content mb-0 text-muted"><?= $product->name ?></p>
                        </a>
                        <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                          <h4 class="mb-0 text-truncate">
                            <b>$<?= number_format($price, 2) ?></b>
                          </h4>
                          <div class="d-inline-flex align-items-center">
                            <i class="ph-duotone ph-star text-warning me-1"></i>
                            <?= isset($product->rating) ? $product->rating : 'N/A' ?> <small class="text-muted">/ 5</small>
                          </div>
                        </div>
                        <div class="d-flex">
                          <div class="flex-shrink-0">
                            <a href="details.php?slug=<?= $product->slug ?>" class="avtar avtar-s btn-link-secondary btn-prod-card">
                              <i class="ph-duotone ph-eye f-18"></i>
                            </a>
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <div class="d-grid">
                              <button class="btn btn-link-secondary btn-prod-card">Agregar al carrito</button>
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

  <script>
    var tc = document.querySelectorAll('.scroll-block');
    for (var t = 0; t < tc.length; t++) {
      new SimpleBar(tc[t]);
    }
  </script>

  <?php include "../layouts/modals.php"; ?>
</body>
</html>

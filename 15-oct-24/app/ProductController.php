<?php
session_start();

class ProductController {
    public function getProducts() {
        $curl = curl_init();
        $token = $_SESSION['user_token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function addProduct($productData) {
        $curl = curl_init();
        $token = $_SESSION['user_token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($productData),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}

// Manejo de la acción de agregar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
    $productData = [
        'name' => $_POST['name'],
        'slug' => $_POST['slug'],
        'description' => $_POST['description'],
        'features' => $_POST['features']
    ];

    $productController = new ProductController();
    $response = $productController->addProduct($productData);

    if ($response) {
        $_SESSION['success_message'] = 'Producto agregado exitosamente.';
    } else {
        $_SESSION['error_message'] = 'Error al agregar el producto.';
    }

    header('Location: ../productos.php'); 
    exit;
}
?>

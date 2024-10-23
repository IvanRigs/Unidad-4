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
        return $this->makeApiRequest('POST', $productData);
    }

    public function editProduct($productData) {
        return $this->makeApiRequest('PUT', $productData);
    }

    private function makeApiRequest($method, $data) {
        $curl = curl_init();
        $token = $_SESSION['user_token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function deleteProduct($productId) {
        $curl = curl_init();
        $token = $_SESSION['user_token'];
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $productId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    
}

// Manejo de la acción de agregar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $productData = [
        'name' => $_POST['name'],
        'slug' => $_POST['slug'],
        'description' => $_POST['description'],
        'features' => $_POST['features']
    ];

    $productController = new ProductController();

    if ($_POST['action'] === 'add_product') {
        $response = $productController->addProduct($productData);
    } elseif ($_POST['action'] === 'edit_product') {
        $productData['id'] = $_POST['id'];
        $response = $productController->editProduct($productData);
    } elseif ($_POST['action'] === 'delete_product') {
        $productId = $_POST['id'];
        $response = $productController->deleteProduct($productId);
    }    

    header('Location: ../home.php'); 
    exit;
}
?>

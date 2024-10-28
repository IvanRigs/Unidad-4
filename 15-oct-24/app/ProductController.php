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
        unset($productData['cover']); 
        return $this->makeApiRequest('PUT', $productData);
    }
    

    private function makeApiRequest($method, $data) {
        $curl = curl_init();
        $token = $_SESSION['user_token'];
        
        $headers = [
            'Authorization: Bearer ' . $token
        ];
        
        if (isset($data['cover']) && is_array($data['cover'])) {
            $filePath = $data['cover']['tmp_name'];
            $fileName = $data['cover']['name'];
            $data['cover'] = new CURLFile($filePath, mime_content_type($filePath), $fileName);
            $headers[] = 'Content-Type: multipart/form-data';
        } else {
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $data = http_build_query($data);
        }
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_CUSTOMREQUEST => $method,
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
        'features' => $_POST['features'],
        'cover' => $_FILES['cover'], 
    ];

    $productController = new ProductController();

    if ($_POST['action'] === 'add_product') {
        $productData['cover'] = $_FILES['cover']; // Solo en agregar
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


<?php
session_start();

class detalles {
    // Función para obtener detalles del producto
    function getProductDetails($slug) {
        $token = $_SESSION['user_token'];
        $apiUrl = 'https://crud.jonathansoto.mx/api/products/slug/' . $slug;
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
    
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
    
        if ($error) {
            return ['error' => 'Curl error: ' . $error];
        }
    
        return json_decode($response, true);
    }
}
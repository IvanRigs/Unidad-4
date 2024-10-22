
<?php
session_start();

class detalles {
    // Función para obtener detalles del producto
    function getProductDetails() {
        $apiUrl = 'https://crud.jonathansoto.mx/api/products/slug/' . $_GET['slug'];
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 657|aMkXO4b8SEOJsSnQK6p84KfkvmbEckT3fyjKzovr'
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
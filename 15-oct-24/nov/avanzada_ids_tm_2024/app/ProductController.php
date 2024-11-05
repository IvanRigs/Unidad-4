<?php 
include_once 'config.php';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['action'])) {
    switch($_POST['action']){
        case 'create_product':
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $features = $_POST['features'];
            $brand_id = $_POST['brand_id'];
            $category = $_POST['category'];
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $price = $_POST['price'];
            $original_price = $_POST['original_price'];
            $stock = $_POST['stock'];
            $sku = $_POST['sku'];
            if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
                $cover = $_FILES['cover'];
            } else {
                echo "Error: La imagen no se subió correctamente.";
                exit;
            }
            $productController = new ProductController();
            $productController->create($name, $slug, $description, $features, $cover, $brand_id, [$category], $tags, $price, $original_price, $stock, $sku);
        break;

        case 'delete_product':
            $productId = $_POST['product_id'];
            $productController = new ProductController();
            $productController->delete($productId);
            break;

        case 'update_product':
            $productId = $_POST['product_id'];
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $features = $_POST['features'];
            $cover = isset($_FILES['cover']) && $_FILES['cover']['error'] === 0 ? $_FILES['cover'] : null;
                
            $productController = new ProductController();
            $productController->update($productId, $name, $slug, $description, $features, $cover);
            break;
    }
}

class ProductController
{

    public function getProducts() {
        $curl = curl_init();
        $token = $_SESSION['user_token'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

		if (isset($response->data) && count($response->data)) {
			
			return $response->data;
		}

		return array();
    }

	public function create($name, $slug, $description, $features, $cover, $brand_id, $categories, $tags, $price, $original_price, $stock, $sku)
    {
        $curl = curl_init();
        $coverFile = curl_file_create($cover['tmp_name'], $cover['type'], $cover['name']);

        $categoriesFormatted = [];
        foreach ($categories as $index => $category) {
            $categoriesFormatted["categories[$index]"] = $category;
        }

        $tagsFormatted = [];
        foreach ($tags as $index => $tag) {
            $tagsFormatted["tags[$index]"] = $tag;
        }

        $postData = array_merge(
            [
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
                'cover' => $coverFile,
                'brand_id' => $brand_id,
                'price' => $price,
                'original_price' => $original_price,
                'stock' => $stock,
                'sku' => $sku
            ],
            $categoriesFormatted,
            $tagsFormatted
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_token']
            ),
        ));

        $response = curl_exec($curl);
        if ($response === false) {
            $errorMsg = 'cURL Error: ' . curl_error($curl);
            curl_close($curl);
            header('Location: ' . BASE_PATH . 'views/products/index.php?status=error&msg=' . urlencode($errorMsg));
            exit;
        }

        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code == 4) {
            header('Location: ' . BASE_PATH . 'productos');
        } else {
            $errorMsg = $response->message ?? 'Error desconocido';
            header('Location: ' . BASE_PATH . 'views/products/index.php?status=error&msg=' . urlencode($errorMsg));
        }
    }

    public function getBySlug($slug)
	{ 
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['user_token']
        ),
		));

		$response = curl_exec($curl); 
		curl_close($curl);
		$response = json_decode($response);

		if (isset($response->data) && !is_null($response->data)) {
			
			return $response->data;
		}

		return null;

	}

    public function getCategories() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/categories',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_token']
            ),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data->data ?? [];
    }

    public function getBrands() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_token']
            ),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data->data ?? [];
    }

    public function getTags() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['user_token']
            ),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $data->data ?? [];
    }

	public function update($product_id, $name, $slug, $description, $features, $cover = null)
    {
        $curl = curl_init();
        $url = 'https://crud.jonathansoto.mx/api/products';

        if ($cover && is_uploaded_file($cover['tmp_name'])) {
            $postData = [
                'id' => $product_id,
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
                'cover' => new CURLFile($cover['tmp_name'], $cover['type'], $cover['name']),
            ];
            $headers = [
                'Authorization: Bearer ' . $_SESSION['user_token'],
                'Content-Type: multipart/form-data',
            ];
        } else {
            $postData = http_build_query([
                'id' => $product_id,
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'features' => $features,
            ]);
            $headers = [
                'Authorization: Bearer ' . $_SESSION['user_token'],
                'Content-Type: application/x-www-form-urlencoded',
            ];
        }
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        $curlInfo = curl_getinfo($curl);
        $httpCode = $curlInfo['http_code'];

        if ($response === false || $httpCode !== 200) {
            curl_close($curl);

            echo "<pre>Debug Info:\n";
            echo "URL: " . $curlInfo['url'] . "\n";
            echo "HTTP Code: " . $httpCode . "\n";
            echo "Request Headers: " . print_r($headers, true) . "\n";
            echo "Request Body: " . print_r($postData, true) . "\n";
            echo "Response: " . $response . "\n";
            echo "</pre>";
            exit;
        }

        curl_close($curl);
        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] == 4) {
            header('Location: ' . BASE_PATH . 'productos');
        } else {
            $errorMsg = isset($responseData['message']) ? $responseData['message'] : 'Error en la API';
            header('Location: ' . BASE_PATH . '/views/products/index.php?status=error&msg=' . urlencode($errorMsg));
        }
    }



	public function delete($product_id)
	{
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'.$product_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['user_token'],
        ),
        )); 

        $response = curl_exec($curl); 
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code == 2) {
            header('Location: ' . BASE_PATH . 'productos');
        } else {
            $errorMsg = $response->message ?? 'Error';
            header('Location: ' . BASE_PATH . 'views/products/index.php?status=error&msg=' . urlencode($errorMsg));
        }
    }

}

?>
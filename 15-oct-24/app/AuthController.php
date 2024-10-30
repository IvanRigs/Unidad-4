<?php
session_start();

// if (isset($_POST))


if (isset($_SESSION['user_id'])) {
    header("Location: ../home");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'access') {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    
    if (AuthController::validateInputs($email, $password)) {
        $authController = new AuthController();
        $authController->login($email, $password);
    } else {
        $_SESSION['login_error'] = "Email o contraseña no válidos. Inténtalo de nuevo.";
        header("Location: ../login.php");
        exit();
    }
}

class AuthController
{
    // Método para iniciar sesión
    public function login($email, $password) {
        $curl = curl_init();
        $response = $this->sendCurlRequest($email, $password);
        
        if ($response === false) {
            $_SESSION['login_error'] = "Error en la conexión: " . curl_error($curl);
            header("Location: ../login.php");
            exit();
        }

        $responseData = json_decode($response, true);

        // Si el código de respuesta es 2, es un inicio de sesión exitoso
        if (isset($responseData['code']) && $responseData['code'] == 2) {
            $this->setUserSession($responseData['data']);
            header("Location: ../home");
            exit();
        } else {
            $this->handleLoginError();
        }
    }

    // Método para configurar y enviar la solicitud cURL
    private function sendCurlRequest($email, $password) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(['email' => $email, 'password' => $password]),
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }

    // Método para establecer las variables de sesión del usuario
    private function setUserSession($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['name'];
        $_SESSION['user_token'] = $userData['token'];
        $_SESSION['user_data'] = $userData;

        echo '<pre>';
        print_r($_SESSION);
        echo '</pre>';
    }

    // Método para manejar errores de inicio de sesión
    private function handleLoginError() {
        $_SESSION['login_error'] = "Credenciales incorrectas. Inténtalo de nuevo.";
        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_data']);
        header("Location: ../login");
        exit();
    }

    // Método para validar los inputs del usuario
    public static function validateInputs($email, $password) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6;
    }

}

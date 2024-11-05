<?php 
// Configuración e inicialización de sesión
include_once "app/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_PATH . "productos");
    exit();
}

// Generar token de seguridad si no existe
if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
}

// Lógica de autenticación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar token CSRF
    if ($_POST['global_token'] !== $_SESSION['global_token']) {
        $_SESSION['login_error'] = "Token de seguridad inválido.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    
    include_once "app/AuthController.php";
    
    // Obtener y sanitizar entradas
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    
    // Validar entradas
    if (AuthController::validateInputs($email, $password)) {
        $authController = new AuthController();
        $authController->login($email, $password);
    } else {
        $_SESSION['login_error'] = "Email o contraseña no válidos. Inténtalo de nuevo.";
        header("Location: " . $_SERVER['PHP_SELF']);
exit();
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <title>Login | Light Able Admin & Dashboard Template</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective." />
    <meta name="author" content="phoenixcoded" />
    <link rel="icon" href="<?= BASE_PATH ?>assets/images/favicon.svg" type="image/x-icon" />

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/phosphor/duotone/style.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/tabler-icons.min.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/feather.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/material.css" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/css/style-preset.css" />
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Main -->
    <div class="auth-main v2">
        <div class="bg-overlay bg-dark"></div>
        <div class="auth-wrapper">
            <div class="auth-sidecontent">
                <div class="auth-sidefooter">
                    <hr class="mb-3 mt-4" />
                    <div class="row">
                        <div class="col my-1">
                            <p class="m-0">Hecho por ♥ Ivan Rios</p>
                        </div>
                        <div class="col-auto my-1">
                            <ul class="list-inline footer-link mb-0">
                                <li class="list-inline-item"><a href="../index.html">Home</a></li>
                                <li class="list-inline-item"><a href="https://pcoded.gitbook.io/light-able/" target="_blank">Documentation</a></li>
                                <li class="list-inline-item"><a href="https://phoenixcoded.support-hub.io/" target="_blank">Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- autenticación -->
            <div class="auth-form">
                <div class="card my-5 mx-3">
                    <div class="card-body">
                        <h4 class="f-w-500 mb-1">Login with your email</h4>
                        <p class="mb-3">Don't have an Account? <a href="register-v2.html" class="link-primary ms-1">Create Account</a></p>
                        
                        <form method="POST" action="index.php">
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" required />
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="Password" required />
                            </div>
                            
                            <!-- Campo oculto y global_token -->
                            <input type="hidden" name="action" value="access" />
                            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>" />

                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked />
                                    <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                                </div>
                                <a href="forgot-password-v2.html">
                                    <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
                                </a>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>

                        <div class="saprator my-3">
                            <span>Or continue with</span>
                        </div>
                        
                        <div class="text-center">
                            <ul class="list-inline mx-auto mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/" class="avtar avtar-s rounded-circle bg-facebook" target="_blank">
                                        <i class="fab fa-facebook-f text-white"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/" class="avtar avtar-s rounded-circle bg-twitter" target="_blank">
                                        <i class="fab fa-twitter text-white"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://myaccount.google.com/" class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                                        <i class="fab fa-google text-white"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASE_PATH ?>assets/js/plugins/popper.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/simplebar.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/fonts/custom-font.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/pcoded.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/feather.min.js"></script>

    <script>
        layout_change('light');
        layout_sidebar_change('light');
        change_box_container('false');
        layout_caption_change('true');
        layout_rtl_change('false');
        preset_change('preset-1');
    </script>
</body>
</html>
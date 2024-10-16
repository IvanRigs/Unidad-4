<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login con Less</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="https://images.pexels.com/photos/2506993/pexels-photo-2506993.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="img-fluid" alt="...">
                </div>

                <form  method="POST" action="./app/AuthController.php" class="col-md-6">
                    <input type="hidden" name="action" value="access">
                    <div class="text-center mb-3">
                        <img src="https://content.wepik.com/statics/68342939/preview-page0.jpg" class="rounded float-start w-25" alt="...">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email" required name="email" aria-label="Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" required name="password" id="password" aria-label="Password" placeholder="contraseña">
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
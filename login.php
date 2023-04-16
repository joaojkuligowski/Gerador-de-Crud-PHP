<?php 
include_once 'vendor/autoload.php';

use App\Auth;

$alert = '';
$class = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (Auth::login($username, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $alert = 'Usuário ou senha inválidos';
        $class = 'alert-danger';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ECG - Login</title>
    <link rel="stylesheet" href="assets/css/styles.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

  <body>
  <?php if (isset($alert)) : ?>
            <div class="<?php echo $class;?>" role="alert"><?php echo $alert;?></div>
        <?php endif; ?>
    <div class="vh-100 d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="card bg-white">
              <div class="card-body p-5">
                <form class="mb-3 mt-md-4" method="POST" id="login">
                  <h2 class="fw-bold mb-2 text-uppercase ">ECG Veículos</h2>
                  <div class="mb-3">
                    <label for="email" class="form-label ">Usuário</label>
                    <input type="input" class="form-control" name="username" placeholder="demo">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label ">Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="demo">
                  </div>
                  <div class="d-grid">
                    <button type="submit" id="enviar" class="btn btn-primary btn-lg">Entrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="loader">
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
        </div>

    <script>
        $(".loader").hide();
        $(document).ready(function(){
            $("#enviar").click(function(){
                $.ajax({
                    url: "login.php",
                    type: "POST",
                    data: {username: $("#username").val(), password: $("#password").val()},
                    beforeSend: function() {
                        $(".loader").show();
                    },
                });
            });
        });
    </script>

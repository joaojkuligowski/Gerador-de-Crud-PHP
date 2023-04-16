<!DOCTYPE html>
<html lang="en">
<head>
    <title>ECG</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/styles.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-1 mt-lg-1" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#"><img src="https://ecgsistemas.com/ecg_site/assets/img/img_logo_ecg_sistemas.png" alt="logo" width="150"></a>
            <ul class="navbar-nav me-auto mt-2 mt-lg-1">
                <?php echo $menu_item; ?>
            </ul>
            <a href="index.php" id="logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
        </div>
    </div>
    </nav>
    <div class="container-fluid">

        <div class="loader">
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
        </div>

    <script>
        $(".loader").hide();
        $(document).ready(function(){
            $("#logout").click(function(){
                $.ajax({
                    url: "index.php",
                    type: "POST",
                    data: {destroyed: true},
                    beforeSend: function() {
                        $(".loader").show();
                    },
                });
            });
        });
    </script>
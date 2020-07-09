<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>GuacaTSC</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 

  <link href="assets/app.css" rel="stylesheet" id="app-css">


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Datos del usuario</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">Estos son sus datos de registro:</h1>
      </div>
    </div>
  </div>



 <div class="container">
  <div class="row">

      <div class="col-md-6 mb-4">
      
          <div class="list-group-flush">

              <div class="list-group-item">
                <p ><i class="fa fa-cube fa-2x mr-4 mr-4  green white-text rounded" aria-hidden="true"></i><?php echo ($_SESSION['fullName']); ?></p>
              </div>
              <div class="list-group-item">
                <p ><i class="fa fa-user fa-2x mr-4 white-text rounded blue" aria-hidden="true"></i><?php echo ($_SESSION['name']); ?></p>
              </div>
              <div class="list-group-item">
                <p > <i class="fa fa-envelope-open fa-2x mr-4 mr-4  white-text rounded red" aria-hidden="true"></i><?php echo ($_SESSION['mail']); ?></p>
              </div>
              <div class="list-group-item">
                <p ><i class="fa fa-id-card fa-2x mr-4 mr-4  purple white-text rounded" aria-hidden="true"></i><?php echo ($_SESSION['tipo']); ?></p>
              </div>


            </div>
      
      </div>
  </div>


  <div class="row">
        <form action="register.php" class="form-inline" method="post">     
              <div class="form-check mb-2 mr-sm-2">
                  <input id="agree" name="agree" class="form-check-input" type="checkbox" id="inlineFormCheck">
                  <label  class="form-check-label " for="inlineFormCheck" >
                    Juro por Snoopy que no usaré la cuenta creada para hacer cosas malignas
                  </label>
                </div>

                <button id="enviar" type="submit"  disabled class="btn btn-primary mb-2">Siguiente</button>          
        </form>
  </div>

</div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/js/jquery.min.js"></script>
  <script src="vendor/js/bootstrap.min.js"></script>

  <script>
          $(function() {
              $('#agree').click(function() {
                  if ($(this).is(':checked')) {
                      $('#enviar').removeAttr('disabled');
                  } else {
                      $('#enviar').attr('disabled', 'disabled');
                  }
              });
          });
  </script>



</body>

</html>

<!DOCTYPE html>
<html>
	<link href="vendor/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="assets/app.css" rel="stylesheet" id="app-css">
	<script src="vendor/js/bootstrap.min.js"></script>
	<script src="vendor/js/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<head>
  		<title>login window</title>
	</head>

	<body>

			<?php
				if ($_GET["error"] == 1) {
					echo '
						<div class="alert alert-danger" role="alert">
  							Imposible conectar con el LDAP..
						</div>
						';

				}
				if ($_GET["error"] == 2 or $_GET["error"] == 3 ) {

					echo '
						<div class="alert alert-danger" role="alert">
  							Usuario y/o contraseña no válida.
						</div>
						';
				}


			?>

			<div class="container login-container">
			            <div class="row">                
			                <div class="col-md-6 login-form-2">
			                    <div class="login-logo">
			                        <img src="img/logo_white.png" alt=""/>
			                    </div>
			                    <h3>Bienvenido</h3>
			                    	<form action="authentication.php" method="post">
					                        <div class="form-group">
					                            <input name="username" type="text" class="form-control" placeholder="Usuario *" value="" />
					                        </div>
					                        <div class="form-group">
					                            <input  name="password"  type="password" class="form-control" placeholder="Contraseña *" value="" />
					                        </div>
					                        <div class="form-group">
					                            <input type="submit" class="btnSubmit" value="entrar" />
					                        </div>                       
					                </form>
			                </div>
			            </div>
			</div>
	</body>
</html>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css">
	<script src="main.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="js/bootstrap.min.js">
<link rel="stylesheet" href="css/login1.css">
</head>
<body>
	<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-12 col-sm-6 col-md-3">
			
					<form class="form-container" name="form1" method="post" action="check_login.php">
							<h4 class="text-center font-weight-bold">e-Doc System</h4>
							<div class="form-group">								
								<input type="text" class="form-control" id="txtUsername" aria-describedby="txtUsername" name="txtUsername" placeholder="Username">
							</div>
							<div class="form-group">								
								<input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Password">
							</div>
							
							<button type="submit" class="btn btn-primary btn-block">Login</button>
					</form>
			</section>
		</section>
	</section>
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>

</body>
</html>	
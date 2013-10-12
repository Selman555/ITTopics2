<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
                <link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" type="text/css" media="screen"/>
		<title>Login</title>
	</head>
	<body>
		<div id="headerStripe" style="background-color: #151C8A; color: #151C8A;">.</div>
		<?php include 'templates/header.php'; ?>

		<div id="content">
		<form method="post" action="<?php echo base_url('user/passwordRecovery'); ?>" id="login" autocomplete="on" >
          	<div id="inputsAndTekst">
            	<h1>Password recovery</h1>
                <p>U vindt uw nieuwe paswoord terug in uw mailbox </p>
                </div>
                </form>	
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>

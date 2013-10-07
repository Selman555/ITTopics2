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
		  <form id="login">
                        <h1>Log in</h1>
                        <fieldset id="inputs">
                            <input id="username" type="text" placeholder="Username" class="tekstfield" autofocus required>
                            <input id="password" type="password" placeholder="Password" class="tekstfield" required>
                        </fieldset>
                            <input type="submit" id="submit" value="Log in">
                       
                    </form>	
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
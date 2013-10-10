<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
                <link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" />
		<title>Login</title>
	</head>
	<body>
		<div id="headerStripe" style="background-color: #151C8A; color: #151C8A;">.</div>
		<?php include 'templates/header.php'; ?>

		<div id="content">
		  <form method="post" action="<?php echo base_url('user/index'); ?>" id="login" >
                     
                        <h1>Log in</h1>
                            <p>Geef hier uw gebruikersnaam en paswoord in </p>
                            <input id="username" type="text" placeholder="Gebruikersnaam" class="tekstfield" >
                            <input id="password" type="password" placeholder="Paswoord" class="tekstfield" >
                        
                          <input type="submit" id="SubmitButton" class="submit" value="Log in">
                         
                      
                    </form>	
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
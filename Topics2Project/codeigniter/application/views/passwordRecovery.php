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
		  <form method="post" action="<?php echo base_url(); ?>index.php/VerifyLogin" id="login" >
                      <fieldset id="geheel">
                      <fieldset id="inputsAndTekst">
                        <h1>Password recovery</h1>
                            <p>Geef email adres en gebruikersnaam in </p>
                            <input id="usernameP" type="text" placeholder="username" class="tekstfield" autofocus required>
                            <input id="email" type="password" placeholder="E-mail adres" class="tekstfield" required>
                        </fieldset>
                      <fieldset id="btn">
                          <input type="submit" id="SubmitButton" class="submit" value="Krijg uw paswoord">
                        
                      </fieldset>
                      </fieldset>
                    </form>	
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>

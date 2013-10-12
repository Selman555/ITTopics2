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
		  <form method="post" action="<?php echo base_url('user/index'); ?>" id="login" autocomplete="on" >
          	<div id="inputsAndTekst">
            	<h1>Log in</h1>
                <p>Geef hier uw gebruikersnaam en paswoord in </p>
                <input name="username" type="text" placeholder="Gebruikersnaam" class="tekstfield" required="required" >
                <input name="password" type="password" placeholder="Paswoord" class="tekstfield" required="required">
                <div id="error"><?php echo $validate; ?>
                <?php echo $passwordError; ?></div>
                 
            </div>
            <div id="btn">
            	<input type="submit" id="SubmitButton" class="submit" value="Log in">
           
            <?php if($var!='dontAdd'){?>
               
                <input type="submit" id="PasswordButton" class="submit" value="Passwoord vergeten?">
                </form>
            	
            <?php } ?>
            </div>
          </form>	
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
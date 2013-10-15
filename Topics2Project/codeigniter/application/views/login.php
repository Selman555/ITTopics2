<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
                <link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" />
		<title>Login</title>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>

		<div id="content">
		<form method="post" action="<?php echo base_url('user/loginUser'); ?>" id="login" autocomplete="on" >
          	<div id="inputsAndTekst">
            	<h1>Log in</h1>
            	<?php if (!$this->session->userdata('logged_in')) {?>
                <p>Geef hier uw gebruikersnaam en paswoord in </p>
                <input name="username" type="text" placeholder="Gebruikersnaam" class="tekstfield" required="required" >
                <input type="submit" id="SubmitButton" class="submit" value="Log in">
                <input name="password" type="password" placeholder="Paswoord" class="tekstfield" required="required">
                <button 
                <?php echo $this->session->flashdata("errors"); ?>
                <?php } else { ?>
                U bent reeds aangemeld<br />
                U kan zich <a href="<?php echo base_url('user/logout'); ?>">hier afmelden</a>
                <?php }?>
            </div>
        </form>
        </div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
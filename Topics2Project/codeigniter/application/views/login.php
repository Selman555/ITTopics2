<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
                <link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" />
		<title>Login</title>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>

		<section>
		<form method="post" action="<?php echo base_url('user/loginUser'); ?>" id="login" autocomplete="on" >
          	<div id="inputsAndTekst">
            	<h1>Log in</h1>
            	<?php if (!$this->session->userdata('logged_in')) {?>
                <p>Geef hier uw gebruikersnaam en paswoord in </p>
                <input name="username" type="text" placeholder="Gebruikersnaam" class="tekstfield" required >
                <input type="submit" id="SubmitButton" class="submit" value="Aanmelden">
                <input name="password" type="password" placeholder="Paswoord" class="tekstfield" required >
                <p>Bent u uw paswoord vergeten?<input type="submit" formaction="<?php echo base_url('user/password_recovery');?>" class="submit" value="Paswoord ophalen" /></p>
                <div id="error"> <?php echo $this->session->flashdata("errors"); ?></div>
                <?php } else { ?>
                U bent reeds aangemeld<br />
                U kan zich <a href="<?php echo base_url('user/logout'); ?>">hier afmelden</a>
                <?php }?>
            </div>
        </form>
        </section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
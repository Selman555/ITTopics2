<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" />
		<title>Paswoord instellen</title>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>

		<section>
		<form method="post" action="<?php echo base_url('user/loginUser'); ?>" id="Reset" autocomplete="on" >
          	<div id="inputsAndTekst">
            	<h1>Paswoord opnieuw instellen</h1>
            	<?php if (!$this->session->userdata('logged_in')) {?>
                <p><?php echo $this->lang->line('paswoordGebruikerTitel');?>
                <input name="username" type="text" placeholder=<?php echo $this->lang->line('loginGebruiker');?> class="tekstfield" required >
                <input name="password" type="password" placeholder=<?php echo $this->lang->line('loginPassword');?> class="tekstfield" required ><br />
                <input type="submit" id="SubmitButton" class="submit" value=<?php echo $this->lang->line('paswoordbtnReset');?>>
                </p>
                <?php echo $this->lang->line('loginPasswordTitel');?><br />
                <div class="button">
                <input type="submit" formaction="<?php echo base_url('user/password_recovery');?>" class="submit" value=<?php echo $this->lang->line('LoginbtnPasswoord');?> />
                </div>
                <div id="error"> <?php echo $this->session->flashdata("errors"); ?></div>
                <?php } else { ?>
                <?php echo $this->lang->line('loginMeldingIngelogd');?><br />
                <?php echo $this->lang->line('loginMeldingNietIngelogd');?> <a href="<?php echo base_url('user/logout'); ?>"><?php echo $this->lang->line('loginMeldingNietIngelogd2');?></a>
                <?php }?>
            </div>
        </form>
        </section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>

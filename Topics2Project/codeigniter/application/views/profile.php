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
            	<h1><?php echo $this->lang->line('profileTitle');?></h1>
            	<?php if (!$this->session->userdata('logged_in')) {?>
            	<table>
					<caption><?php echo $this->lang->line('email');?></caption>
					<tbody>
						<tr>
					    	<th>e-mail</th>
					        <td colspan="2"><?php echo $this->session->userdata('email');?></td>
					    </tr>
					    <tr>
					      	<th><?php echo $this->lang->line('reset');?></th>
					      	<td><input name="email" type="email" placeholder="e-mail" class="tekstfield" required >
                			<td><input name="emailconfirm" type="email" placeholder=<?php echo $this->lang->line('loginPassword');?> class="tekstfield" required >
					    </tr>
				    </tbody>
				</table>
            	<p>
                <p><?php echo $this->lang->line('loginGebruikerTitel');?>
                <input name="username" type="text" placeholder=<?php echo $this->lang->line('loginGebruiker');?> class="tekstfield" required >
                <input name="password" type="password" placeholder=<?php echo $this->lang->line('loginPassword');?> class="tekstfield" required ><br />
                <input type="submit" id="SubmitButton" class="submit" value=<?php echo $this->lang->line('LoginbtnAanmelden');?>>
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

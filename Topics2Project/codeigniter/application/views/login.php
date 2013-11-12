<!DOCTYPE html>
<html lang="nl-be">
<head>
	<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" />
	<title>Login</title>
</head>
<body>
		<?php include 'templates/header.php'; ?>

		<section>
		<form method="post" action="<?php echo base_url('user/loginUser'); ?>"
			id="login" autocomplete="on">
			<div id="inputsAndTekst">
				<h1>Login</h1>
                        <?php echo $this->lang->line('loginGebruikerTitel');?><br />
				<table>
					<tr>
						<td>
							<label> <?php echo $this->lang->line('loginGebruiker');?> </label>
						</td>
						<td>
							<input name="username" type="text" placeholder="<?php echo $this->lang->line('loginGebruiker');?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label> <?php echo $this->lang->line('loginPassword');?> </label>
						</td>
						<td>
							<input name="password" type="password" placeholder="<?php echo $this->lang->line('loginPassword');?>" />
						</td>
					</tr>
				</table>
				<p><?php print_r($error);?> </p>
				<input type="submit" id="SubmitButton" class="submit"
					value=<?php echo $this->lang->line('LoginbtnAanmelden');?> /> <br />
				<button type="submit"
					formaction="<?php echo base_url('user/Password_recovery');?>"
					class="submit"><?php echo $this->lang->line('LoginbtnPasswoord');?></button>
			</div>
		</form>
	</section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>


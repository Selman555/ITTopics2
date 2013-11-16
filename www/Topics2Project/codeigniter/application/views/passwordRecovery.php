<!DOCTYPE html>
<html lang="nl-be">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
<link rel="stylesheet"
	href="<?php echo base_url('styles/login.css'); ?>" />
<title>Paswoord instellen</title>
</head>
<body>
		<?php include 'templates/header.php'; ?>
		<?php
		if (! isset ( $_SERVER ['HTTPS'] ) || $_SERVER ['HTTPS'] == "") {
			// $redirect = "https://".'localhost:4430'.$_SERVER['REQUEST_URI'];
			// header("Location: $redirect");
		}
		?>

		<section>
		<form method="post"
			action="<?php echo base_url('user/setPassword'); ?>" id="Reset"
			autocomplete="on">
			<div id="inputsAndTekst">
				<h1>Paswoord recovery</h1>
				<table>
					<tr>
						<td><label> <?php echo $this->lang->line('loginGebruiker');?> </label></td>
						<td><input name="username" type="text" placeholder=<?php echo $this->lang->line('loginGebruiker');?> class="tekstfield" required /></td>
					</tr>
					<tr>
						<td><label><?php echo $this->lang->line('loginEmail');?></label></td>
						<td><input name="email" type="text" placeholder="<?php echo $this->lang->line('loginEmail');?>" class="tekstfield" required /></td>
					</tr>
				</table>
				<p><?php print_r($error);?></p>
				<input type="submit" id="SubmitButton" class="submit" value="Submit" />
			</div>
		</form>
	</section>

		<?php include 'templates/footer.php'; ?>
               
	</body>
</html>
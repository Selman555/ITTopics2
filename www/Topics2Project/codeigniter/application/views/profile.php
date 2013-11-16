<!DOCTYPE html>
<html lang="nl-be">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('styles/profile.css'); ?>" />
		<title>Profile</title>
		<script type='text/javascript'>
		//  [Faisal]
		function checkPassword(input) {
			if (input.value != document.getElementById('newpass').value) {
				input.setCustomValidity('Passwords do not match.');
			} else {
			// input is valid -- reset the error message
				input.setCustomValidity('');
			}
		}
		function checkEmail(input) {
			if (input.value != document.getElementById('email').value) {
				input.setCustomValidity('E-mails do not match.');
			} else {
				input.setCustomValidity('');
			}
		}
		</script>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>
		<?php
		if (! isset ( $_SERVER ['HTTPS'] ) || $_SERVER ['HTTPS'] == "") {
			 $redirect = "https://".'localhost'.$_SERVER['REQUEST_URI'];
			 header("Location: $redirect");
		}
		?>

		<section id="profilepage" style="padding: 0 2%">
            	<h1><?php echo $this->lang->line('profileTitle');?></h1>
            	<?php if ($this->session->userdata('logged_in')) {?>
            	<form id="submitnewemail" action="changeEmail" method="post">
	            	<table>
						<caption><?php echo $this->lang->line('email');?></caption>
						<tbody>
							<tr>
						    	<th>E-mail</th>
						        <td colspan="3"><?php echo $email; ?></td>
						    </tr>
						    <tr>
						      	<th><?php echo $this->lang->line('reset');?></th>
						      	<td><input name="email" type="email" placeholder="<?php echo $this->lang->line('mailNew');?>" class="tekstfield"
						      		id="email" required ></td>
	                			<td><input name="emailconfirm" type="email" placeholder="<?php echo $this->lang->line('mailConfirm');?>" class="tekstfield"
	                				id="emailconfirm" required oninput="checkEmail(this)" ></td>
	                			<td><input type="submit" value="<?php echo $this->lang->line('paswoordbtnReset');?>" id="resetemail" /></td>
						    </tr>
						    <?php if (isset($errorsMail)) {?>
						    <tr id="error"><td colspan="4" style="text-align: right;"><?php echo $errorsMail; ?></td></tr>
						    <?php } 
						    	  if (isset($doneMail)) {?>
						    <tr><td colspan="4" style="text-align: right;"><?php echo $doneMail; ?></td></tr>
						    <?php } ?>
					    </tbody>
					</table>
				</form>
                <form id="submitnewpassword" action="changePassword" method="post" >
	            	<table style="width: 100%">
						<caption><?php echo $this->lang->line('passwordresettitle');?></caption>
						<tbody>
						    <tr>
						      	<th><?php echo $this->lang->line('reset');?></th>
						      	<td><input id="newpass" name="newpass" type="password" placeholder="<?php echo $this->lang->line('passwordNew');?>" class="tekstfield" required >
	                			<td><input id="confirmpass" name="confirmpass" type="password" placeholder="<?php echo $this->lang->line('passwordConfirm');?>" class="tekstfield"
	                			required oninput="checkPassword(this)" >
						    </tr>
						    <tr>
						    	<th><?php echo $this->lang->line('passwordOld');?></th>
						    	<td><input id="oldpass" name="oldpass" type="password" placeholder="<?php echo $this->lang->line('loginPassword');?>" class="tekstfield" required >
	                			<td><input type="submit" value="<?php echo $this->lang->line('paswoordbtnReset');?>" id="resetpass" /></td>
						    </tr>
						    <?php if (isset($errorsPass)) {?>
						    <tr id="error"><td colspan="3" style="text-align: right;"><?php echo $errorsPass; ?></td></tr>
						    <?php }
						    	  if (isset($donePass)) {?>
						    <tr><td colspan="4" style="text-align: right;"><?php echo $donePass; ?></td></tr>
						    <?php } ?>
					    </tbody>
					</table>
				</form>
                <?php } else { ?>
                <?php echo $this->lang->line('loginMeldingIngelogd');?><br />
                <?php echo $this->lang->line('loginMeldingNietIngelogd');?> <a href="<?php echo base_url('user/logout'); ?>"><?php echo $this->lang->line('loginMeldingNietIngelogd2');?></a>
                <?php }?>
        </section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
<!-- Uitgebreide bronvermeldingen:
[Faisal]: HTML5 validation and field comparison - URL: http://stackoverflow.com/questions/13865146/html5-validation-and-field-comparison
-->

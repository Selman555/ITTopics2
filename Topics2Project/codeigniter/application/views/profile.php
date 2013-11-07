<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('styles/login.css'); ?>" />
		<title>Profile</title>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>

		<section id="profilepage" style="padding: 0 2%">
            	<h1><?php echo $this->lang->line('profileTitle');?></h1>
            	<?php if ($this->session->userdata('logged_in')) {?>
            	<form id="submitnewemail" action="changeEmail" method="post">
	            	<table>
						<caption><?php echo $this->lang->line('email');?></caption>
						<tbody>
							<tr>
						    	<th>E-mail</th>
						        <td colspan="3"><?php echo $this->session->userdata('email');?></td>
						    </tr>
						    <tr>
						      	<th><?php echo $this->lang->line('reset');?></th>
						      	<td><input id="email" name="email" type="email" placeholder="<?php echo $this->lang->line('new');?>" class="tekstfield" required ></td>
	                			<td><input id="emailconfirm" name="emailconfirm" type="email" placeholder="<?php echo $this->lang->line('confirm');?>" class="tekstfield" required ></td>
	                			<td><input type="submit" value="<?php echo $this->lang->line('paswoordbtnReset');?>" id="resetemail" /></td>
						    </tr>
					    </tbody>
					</table>
				</form>
                <div id="error"> <?php echo $this->session->flashdata("errors"); ?></div>
                <form id="submitnewpassword" action="changePassword" method="post" >
	            	<table style="width: 100%">
						<caption><?php echo $this->lang->line('passwordresettitle');?></caption>
						<tbody>
						    <tr>
						      	<th><?php echo $this->lang->line('reset');?></th>
						      	<td><input id="newpass" name="newpass" type="password" placeholder="<?php echo $this->lang->line('new');?>" class="tekstfield" required >
	                			<td><input id="confirmpass" name="confirmpass" type="password" placeholder="<?php echo $this->lang->line('confirm');?>" class="tekstfield" required >
						    </tr>
						    <tr>
						    	<th><?php echo $this->lang->line('passwordOld');?></th>
						    	<td><input id="oldpass" name="oldpass" type="password" placeholder="<?php echo $this->lang->line('loginPassword');?>" class="tekstfield" required >
	                			<td><input type="submit" value="<?php echo $this->lang->line('paswoordbtnReset');?>" id="resetpass" /></td>
						    </tr>
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

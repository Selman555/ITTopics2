<!DOCTYPE html>
<html lang="nl-be">
	<head>
        <?php $user_language=$this->session->userdata('language');
        $this->lang->load('home_form_'.$user_language,$user_language);?>
		
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" media="screen"/>
		<title><?php echo $this->lang->line('prive');?></title>
		<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropins.js" id="dropboxjs"
		data-app-key="clmhchmnj71v0t0"></script>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>
		<?php
		if (! isset ( $_SERVER ['HTTPS'] ) || $_SERVER ['HTTPS'] == "") {
			 $redirect = "https://".'localhost'.$_SERVER['REQUEST_URI'];
			 header("Location: $redirect");
		}
		?>
                
			<section>
				<h1><?php echo $this->lang->line('prive');?></h1>
				<?php if ($this->session->userdata('logged_in')) {?>
				<article>
					<p><?php echo $this->lang->line('priveBestandBericht');?></p>
					<input type="dropbox-chooser" name="selected-file" style="visibility: hidden;"/>
				</article>
				<?php } else { ?>
                <?php echo $this->lang->line('loginMeldingIngelogd');?><br />
                <?php echo $this->lang->line('loginMeldingNietIngelogd');?> <a href="<?php echo base_url('user/logout'); ?>"><?php echo $this->lang->line('loginMeldingNietIngelogd2');?></a>
                <?php }?>
			</section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>

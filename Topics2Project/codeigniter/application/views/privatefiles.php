<!DOCTYPE html />
<html lang="nl-be">
	<head>
                <?php $user_language=$this->session->userdata('language');
                $this->lang->load('home_form_'.$user_language,$user_language);?>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" media="screen"/>
		<title><?php echo $this->lang->line('prive');?></title>
		<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropins.js" id="dropboxjs"
		data-app-key="clmhchmnj71v0t0"></script>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>
                
		<div id="content">
			<section>
				<header><h1><?php echo $this->lang->line('prive');?></h1></header>
				<article>
					<p><?php echo $this->lang->line('priveBestandBericht');?></p>
					<input type="dropbox-chooser" name="selected-file" style="visibility: hidden;"/>
				</article>
			</section>
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>

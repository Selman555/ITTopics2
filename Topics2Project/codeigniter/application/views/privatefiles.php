<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" media="screen"/>
		<title>Priv� bestanden</title>
		<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropins.js" id="dropboxjs"
		data-app-key="clmhchmnj71v0t0"></script>
	</head>
	<body>
		<?php include 'templates/header_online.php'; ?>
		<?php include 'templates/status.php'; ?>
                
		<div id="content">
			<section>
				<header><h1>Priv� bestanden</h1></header>
				<article>
					<p>Hier kan u al onze bestanden zoals verslagen, mock-ups, enz.</p>
					<input type="dropbox-chooser" name="selected-file" style="visibility: hidden;"/>
				</article>
			</section>
		</div>

		<?php include 'templates/footer_online.php'; ?>
	</body>
</html>

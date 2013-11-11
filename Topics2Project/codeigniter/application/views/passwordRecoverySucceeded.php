<!DOCTYPE html>
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('styles/passwordRecovery.css'); ?>" />
		<title>Paswoord instellen</title>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>
		<?php 
			if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
			//	$redirect = "https://".'localhost:4430'.$_SERVER['REQUEST_URI'];
			//	header("Location: $redirect");
			}
		?>

		<section>
                     <h1>Paswoord recovery</h1>
                     <br/>
                     &nbsp;&nbsp;Uw paswoord werd naar u doorgestuurd.<br/>
                     &nbsp;&nbsp;Gelieven uw email te checken.<br/><br/>
		
                </section>

		<?php include 'templates/footer.php'; ?>
               
	</body>
</html>
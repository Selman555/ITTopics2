<!DOCTYPE html>
<html lang="nl-be">
	<head>
		<meta charset="UTF-8">
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
                    <form method="post" action="<?php echo base_url('user/setPassword'); ?>" id="Reset" autocomplete="on" >
                        <div id="inputsAndTekst">
                        <h1>Paswoord recovery</h1>
                         <table> 
                             <tr>
                                <label> <?php echo $this->lang->line('loginGebruiker');?> </label>&nbsp;&nbsp;&nbsp;
                                <input name="username" type="text" placeholder=<?php echo $this->lang->line('loginGebruiker');?> class="tekstfield" required="true"  >
                             </tr>
                             <tr>                        
                                <label>Email &nbsp;&nbsp;    </label>
                                <input name="email" type="text" placeholder="Email" class="tekstfield" required="true"  ><br /><br/>
                            </tr>
                        </table>
                        <p><?php print_r($error);?></p>
                        <input type="submit" id="SubmitButton" class="submit" value="Submit"/>
                        </div>
                    </form>
                </section>

		<?php include 'templates/footer.php'; ?>
               
	</body>
</html>

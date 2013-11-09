<!DOCTYPE html>
<html lang="nl-be">
	<head>
             <?php $user_language=$this->session->userdata('language');
             $this->lang->load('home_form_'.$user_language,$user_language);
             $logged = false;
             if ($this->session->userdata('logged_in')) {
             	$logged = true;
             }?>
             <link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
             <title>Hoofdpagina</title>
        </head>
	
        <body>
            <?php include('templates/header.php'); ?>

            <section>
                
                <h1><?php echo $this->lang->line('aboutHoofdTitel');?></h1>
				<article>
					<?php if ($logged) { ?>
					<form action="<?php echo base_url('start/cmsAboutOpdrachtgever');?>" method="post">
						<textarea rows="20" cols="150" id="aboutpagina" name="aboutpagina"><?php echo str_replace("__NewLine__", "\r\n", $text);?></textarea><br />
						<input type="submit" id="submit" value="OK" /><div id="error"> <?php echo $this->session->flashdata("errors"); ?></div>
					</form>
					<?php } else {?>
	            	<p><?php echo str_replace("__NewLine__", "\r\n" ,$text);?></p>
	            	<?php } ?>
            	</article>    
            </section>

            <?php include('templates/footer.php'); ?>
       </body>
</html>
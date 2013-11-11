<!DOCTYPE HTML>
<html lang="NL-be">
	<head>
        <?php $user_language=$this->session->userdata('language');
        $this->lang->load('home_form_'.$user_language,$user_language);
        ?>
		
	<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo base_url('styles/contact.css'); ?>" type="text/css" media="screen"/>
	<title>Contact</title>
		
	</head>
	<body onkeydown="onkeydown(this)">
		<?php include('templates/header.php'); ?>
           <section>
                
                <h1><?php echo $this->lang->line('ContactTitel');?></h1>
               
                <article>
                    <?php echo $this->lang->line('ContactMessage');?><br/>
                    <?php echo $this->lang->line('ContactMessage2');?>
                </article>
                
           </section>
		
		<?php include('templates/footer.php'); ?>
	</body>
</html>
<!DOCTYPE HTML>
<html lang="NL-be">
	<head>
        <?php $user_language=$this->session->userdata('language');
        $this->lang->load('home_form_'.$user_language,$user_language);
        ?>
		
	<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
        <link rel="stylesheet" href="<?php echo base_url('styles/contact.css'); ?>" type="text/css" media="screen"/>
	<title>Hoofdpagina</title>
		
	</head>
	<body onkeydown="onkeydown(this)">
		<?php include('templates/header.php'); ?>
           <section>
                
                <h1>Contacteer ons</h1>
               
                <article>
                    <form method="post" action="<?php echo base_url('user/ContactUs'); ?>">

                        <label>Name</label>
                        <input name="name" placeholder="Type Here">
            
                        <label>Email</label>
                        <input name="email" type="email" placeholder="Type Here">
            
                        <label>Message</label>
                        <textarea name="message" placeholder="Type Here"></textarea>
            
                        <input id="submit" name="submit" type="submit" value="Submit">
        
                    </form>
                </article>
                <article>
                    
                </article>
           </section>
		
		<?php include('templates/footer.php'); ?>
	</body>
</html>
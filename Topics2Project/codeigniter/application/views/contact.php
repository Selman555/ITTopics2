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
                    <form method="post" action="<?php echo base_url('user/ContactUs'); ?>">

                        <label><?php echo $this->lang->line('ContactName');?></label>
                        <input name="name" placeholder="Type Here">
            
                        <label><?php echo $this->lang->line('ContactEmail');?></label>
                        <input name="email" type="email" placeholder="Type Here">
            
                        <label><?php echo $this->lang->line('ContactMessage');?></label>
                        <textarea name="message" placeholder="Type Here"></textarea><br/>
                        <p><?php print_r($error);?></p>
                       
                        
                              <?php 
                                $this->load->helper('recaptchalib');
                                 $publickey = "6LeWDeoSAAAAABra6x4Byum5xTJnlNlqEZkgS6eo";
                                 echo recaptcha_get_html($publickey);
                             
                              ?>
                        
                        
                        <input id="submit" name="submit" type="submit" value="Submit">
        
                    </form>
                </article>
                
           </section>
		
		<?php include('templates/footer.php'); ?>
	</body>
</html>
<footer>
     <?php $user_language=$this->session->userdata('language');
      $this->lang->load('home_form_'.$user_language,$user_language);?>

	<section>
     <article>
       <ul>
         <li> | <a href="index">Home</a></li>
         <li> | <a href="http://www.ford.be/" target="_blank">Ford</a></li>
         <li> | <a href="#">About</a></li>
         <li> | <a href="#">Voorstelling</a></li>
         <li> | <a href="https://github.com/Selman555/ITTopics2/blob/master/Topics2Project/www/index.html" target="_blank">
           GitHub
         </a></li>
         <li> | <a href="<?php echo base_url('start/leden'); ?>">Leden</a></li>
         <li><a href="#">Verslagen</a> | </li>
         <li><a href="<?php echo base_url('start/todo'); ?>">To Do's</a></li>
         <?php if ($this->session->userdata('logged_in')) {?>
         <li> | <a href="<?php echo base_url('user/profile'); ?>">Profile</a></li>
         <li id="status">U bent aangemeld als: <?php echo $this->session->userdata('username');?></li>
         <?php }?>
         <li style="margin-left: 2%;"> | <a href="<?php echo base_url('user/language/nederlands');?>">Nederlands</a></li>
         <li> | <a href="<?php echo base_url('user/language/english');?>">English</a></li>
       </ul>
     </article>
    </section>
    
    <section>
        <a href="<?php echo base_url('start/index'); ?>"><img src="<?php echo base_url('img/Ford_Logo.jpg'); ?>" alt="logo" /></a>
    </section>
	
</footer>
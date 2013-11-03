<footer>
     <?php $user_language=$this->session->userdata('language');
      $this->lang->load('home_form_'.$user_language,$user_language);?>

	<section>
     <article>
       <ul>
         <li><a href="index">Home</a> | </li>
         <li><a href="http://www.ford.be/" target="_blank">Ford</a> | </li>
         <li><a href="<?php echo base_url('start/about'); ?>">About</a> | </li>
         <li><a href="#">Voorstelling</a> | </li>
         <li><a href="https://github.com/Selman555/ITTopics2/blob/master/Topics2Project/www/index.html" target="_blank">
           GitHub
         </a> | </li>
         <li><a href="<?php echo base_url('start/leden'); ?>">Leden | </a></li>
         <li><a href="#">Verslagen</a> | </li>
         <li><a href="<?php echo base_url('start/todo'); ?>">To Do's</a></li>
         <?php if ($this->session->userdata('logged_in')) {?>
         <li id="status">U bent aangemeld als: <?php echo $this->session->userdata('username');?></li>
         <?php }?>
       </ul>
       
     </article>
    </section>
   
   <form method="post" action="<?php echo base_url('user/language'); ?>" >
    	<select name="language">
        	<?php if($user_language === 'nederlands') { ?>
           	<option value="nederlands">Nederlands</option>
            <option value="english">English</option>
            <?php } else { ?>
            <option value="english">English</option>
            <option value="nederlands">Nederlands</option>
            <?php } ?>
        </select>
        <input type="submit" id="LanguageButton" value="ok">
    </form>
   
    <section>
        <a href="<?php echo base_url('start/index'); ?>"><img src="<?php echo base_url('img/Ford logo.jpg'); ?>" alt="logo" height="5%" /></a>
    </section>
	
</footer>
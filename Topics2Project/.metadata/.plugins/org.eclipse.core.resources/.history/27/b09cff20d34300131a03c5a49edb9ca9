<footer>
     <?php $user_language=$this->session->userdata('language');
      $this->lang->load('home_form_'.$user_language,$user_language);?>
    
    <section>
        Dit is een footer die gemaakt is om tekst als test te tonen. Copyricht PiXel Apps & Co.
    </section>
   
    <section>
        <a href="<?php echo base_url('start/index'); ?>"><img src="<?php echo base_url('img/Ford logo.jpg'); ?>" alt="logo" height="5%" /></a>
    </section>
    <section>
        <?php if ($this->session->userdata('logged_in')) {?>
	<li id="status">U bent aangemeld als: <?php echo $this->session->userdata('username');?></li>
	<?php }?>
    </section>
	
</footer>
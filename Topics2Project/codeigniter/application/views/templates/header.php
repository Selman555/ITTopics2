<header>
    <?php $user_language=$this->session->userdata('language');
    $this->lang->load('home_form_'.$user_language,$user_language);?>
	
	<nav>
	    <a href="<?php echo base_url(); ?>" ><?php echo $this->lang->line('home');?></a>               	    
        <a href="<?php echo base_url('start/about'); ?>" ><?php echo $this->lang->line('about');?></a> 
        <a href="<?php echo base_url('start/contact'); ?>">Contact</a>
        <a href="<?php echo base_url('start/leden'); ?>"><?php echo $this->lang->line('leden');?></a>
    	<?php if ($this->session->userdata('logged_in')) {?>
        <a href="<?php echo base_url('user/prive'); ?>" ><?php echo $this->lang->line('prive');?></a>
        <a href="<?php echo base_url('user/logout');?>"  ><?php echo $this->lang->line('logout');?></a>
        <?php } else {?>
        <a href="<?php echo base_url('user/login'); ?>" ><?php echo $this->lang->line('login');?></a>
        <?php }?>
	</nav>
	<a href="<?php echo base_url('start/index'); ?>"><img src="<?php echo base_url('img/Ford_Logo.jpg'); ?>" alt="logo" /></a>
</header>
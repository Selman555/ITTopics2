<header>
	<a href="index"><img src="<?php echo base_url('img/logo.png'); ?>" alt="logo" height="90%" /></a>

	<section>
		<p id="inlog"><a href="<?php echo base_url('user/login_ingelogd'); ?>">Inloggen</a></p>
		<nav>
			<a href="index">Home</a> / 
			<a href="#">About</a> / 
			<?php if ($this->session->userdata('logged_in')) {?>
            <a href="<?php echo base_url('user/logout'); ?>">Log Out </a> / 
            <a href="<?php echo base_url('user/prive'); ?>">Privé bestanden</a>
            <?php } else {?>
            <a href="<?php echo base_url('user/login_ingelogd'); ?>">Inloggen</a>
            <?php }?>
            
		</nav>
	</section>
</header>
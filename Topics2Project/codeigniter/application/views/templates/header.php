<header>
	<a href="<?php echo base_url('start/index'); ?>"><img src="<?php echo base_url('img/logo.png'); ?>" alt="logo" height="90%" /></a>

	<section>
		<nav>
			<a href="index">Home</a> / 
			<a href="#">About</a> / 
			<?php if ($this->session->userdata('logged_in')) {?>
            <a href="<?php echo base_url('user/prive'); ?>">Priv� bestanden</a> / 
            <a href="<?php echo base_url('user/logout'); ?>">Afmelden</a>
            <?php } else {?>
            <a href="<?php echo base_url('user/login'); ?>">Aanmelden</a>
            <?php }?>
		</nav>
	</section>
</header>
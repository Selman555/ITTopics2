<footer>
	<section>
		<article>
			<ul>
				<li><a href="index">Home | </a></li>
				<li><a href="http://www.ford.be/" target="_blank">Ford | </a></li>
				<li><a href="#">About | </a></li>
				<li><a href="#">Voorstelling | </a></li>
				<li><a href="https://github.com/Selman555/ITTopics2/blob/master/Topics2Project/www/index.html" target="_blank">
					GitHub | 
				</a></li>
				<li><a href="<?php echo base_url('start/leden'); ?>">Leden | </a></li>
				<li><a href="#">Verslagen | </a></li>
				<li><a href="<?php echo base_url('start/todo'); ?>">To Do's</a></li>
				<?php if ($this->session->userdata('logged_in')) {?>
				<li id="status">U bent aangemeld als: <?php echo $this->session->userdata('username');?></li>
				<?php }?>
			</ul>
			
		</article>
	</section>
	
</footer>
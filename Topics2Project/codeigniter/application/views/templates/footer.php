<footer>
     <?php $user_language=$this->session->userdata('language');
      $this->lang->load('home_form_'.$user_language,$user_language);?>
	<section>
		<article>
			<ul>
				<li><a href="index"><?php echo $this->lang->line('home');?></a> |</li>
				<li><a href="http://www.ford.be/" target="_blank">Ford</a> |</li>
				<li><a href="#"><?php echo $this->lang->line('about');?></a> |</li>
				<li><a href="#"><?php echo $this->lang->line('voorstelling');?></a> |</li>
				<li><a href="https://github.com/Selman555/ITTopics2/blob/master/Topics2Project/www/index.html" target="_blank">
					GitHub
				</a> |</li>
				<li><a href="<?php echo base_url('start/leden'); ?>"><?php echo $this->lang->line('leden');?>|</a></li>
				<li><a href="#"><?php echo $this->lang->line('verslagen');?></a> |</li>
				<li><a href="<?php echo base_url('start/todo'); ?>"><?php echo $this->lang->line('to do');?></a></li>
				<?php if ($this->session->userdata('logged_in')) {?>
				<li id="status">U bent aangemeld als: <?php echo $this->session->userdata('username');?></li>
				<?php }?>
			</ul>
		</article>
	</section>
	
</footer>
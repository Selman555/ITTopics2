<header>
        <?php $user_language=$this->session->userdata('language');
         $this->lang->load('home_form_'.$user_language,$user_language);?>
	<a href="<?php echo base_url('start/index'); ?>"><img src="<?php echo base_url('img/logo.png'); ?>" alt="logo" height="90%" /></a>
	<section>
		<nav>
		    <a href="index" ><?php echo $this->lang->line('home');?></a> / 
               	    <a href="#" ><?php echo $this->lang->line('about');?></a> / 
                    <?php if ($this->session->userdata('logged_in')) {?>
                    <a href="<?php echo base_url('user/prive'); ?>" ><?php echo $this->lang->line('prive');?></a> / 
                    <a href="<?php echo base_url('user/logout');?>"  ><?php echo $this->lang->line('logout');?></a>
                    <?php } else {?>
                    <a href="<?php echo base_url('user/login'); ?>" ><?php echo $this->lang->line('login');?></a>
                    <?php }?>
		</nav>
                <form method="post" action="<?php echo base_url('user/language'); ?>"   >
                    <select name="language">
                         <?php if($user_language==='nederlands'){?>
                         <option value="nederlands">Nederlands</option>
                         <option value="english">English</option>
                         <?php }else{ ?>
                         <option value="english">English</option>
                         <option value="nederlands">Nederlands</option>
                        <?php  }?>
                        <input type="submit" id="LanguageButton" value="ok">
                     </select>
            </form>
	</section>
</header>
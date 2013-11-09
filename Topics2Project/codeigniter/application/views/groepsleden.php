<!DOCTYPE html>
<html lang="nl-be">
	<head>
        <?php $user_language=$this->session->userdata('language');
        $this->lang->load('home_form_'.$user_language,$user_language);?>
		
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" 
			type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?php echo base_url('styles/other/jquery.bxslider.css'); ?>" /> <!-- [BxSlider] -->
		
		<title><?php echo $this->lang->line('titelLeden');?></title>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="<?php echo base_url('scripts/jquery/jquery.bxslider.min.js'); ?>"></script>
		<script>
			$(document).ready(function(){
			  $('.bxslider').bxSlider();
			});
		</script>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>

		<section id="content">
			<ul class="bxslider">
			  <li>
			  	<section>
					<h1>Steven Verheyen</h1>
					<article>
						<img src="<?php echo base_url('img/Steven.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2><?php echo $this->lang->line('functie');?></h2>
						<?php echo $this->lang->line('functieBericht');?>
					</article>
					<article>
						<h2><?php echo $this->lang->line('specialiteit');?></h2>
						<ul>
							<li><?php echo $this->lang->line('specialiteitBericht');?></li>
						</ul>
					</article>
					<article>
						<h2><?php echo $this->lang->line('hobbie');?></h2>
						<?php echo $this->lang->line('hobbieBericht');?>
					</article>
				</section>
			  </li>
			  <li>
			  	<section>
					<h1>Anke Appeltans</h1>
					<article>
						<img src="<?php echo base_url('img/Anke.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2><?php echo $this->lang->line('functie');?></h2>
						<?php echo $this->lang->line('functieBericht');?>
					</article>
					<article>
						<h2><?php echo $this->lang->line('specialiteit');?></h2>
						<ul>
							<li><?php echo $this->lang->line('specialiteitBericht');?></li>
						</ul>
					</article>
					<article>
						<h2><?php echo $this->lang->line('hobbie');?></h2>
						Ik heb een aantal hobbies
                                                nl paardrijden, dwarsfluit spelen en lezen.
                                                Ook ben ik actief lid van de harmonie Sint Aloysius te Alken.
                                                
                                              
					</article>
				</section>
			  </li>
			  <li>
			  	<section>
					<h1>Glenn Thielman</h1>
					<article>
						<img src="<?php echo base_url('img/Steven.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2><?php echo $this->lang->line('functie');?></h2>
						<?php echo $this->lang->line('functieBericht');?>
					</article>
					<article>
						<h2><?php echo $this->lang->line('specialiteit');?></h2>
						<ul>
							<li><?php echo $this->lang->line('specialiteitBericht');?></li>
						</ul>
					</article>
					<article>
						<h2><?php echo $this->lang->line('hobbie');?></h2>
						<?php echo $this->lang->line('hobbieBericht');?>
					</article>
				</section>
			  </li>
			  <li>
			  	<section>
					<h1>Robbie Vercammen</h1>
					<article>
						<img src="<?php echo base_url('img/Robbie.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2><?php echo $this->lang->line('functie');?></h2>
						Mijn functies binnen dit project zijn momenteel nog onbepaald.<br />
						Bij deze zou ik willen voorstellen:<br />
						- CodeIgniter verantwoordelijke<br />
						- templates verantwoordelijk (bijna voltooid ;) )
					</article>
					<article>
						<h2><?php echo $this->lang->line('specialiteit');?></h2>
						<ul>
							<li>HTML5</li>
							<li>PHP</li>
							<li>CodeIgniter</li>
							<li>CSS3</li>
						</ul>
					</article>
					<article>
						<h2><?php echo $this->lang->line('hobbie');?></h2>
						<p>In mijn vrije tijd houd ik me het liefst bezig met dingen die mij interesseren.
						   Over de grote lijnen is dit programmeren, maar zeker ook dingen die meer als 'leuk' aanvaard worden zoals
						   gamen en fitnissen. Maar programmeren is mijn drijfveer waarna ik altijd teruggrijp, vooral als ik me verveel
						   of als ik onder grote druk sta vanwegen een deadline.</p>
						<p>Wat wonderbaarlijk is voor een IT'er is dat ik een zeer druk sociaal leven heb. Elk vrij weekend staan er wel
						   enkele items op de agende waarmee ik mijn tijd aan leuke dingen kan spenderen. Samen met mijn vriendengroep gaan
						   we regelmatig karten, darten, naar de cinema, feesten en nog veel meer.</p>
					</article>
				</section>
			  </li>
			</ul>
		</section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
<!-- [BxSlider] = Bedrijf: BxSlider - Auteur: Steven Wanderski - Website: http://www.bxslider.com/ -->
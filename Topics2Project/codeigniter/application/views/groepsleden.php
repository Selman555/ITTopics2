<!DOCTYPE html />
<html lang="nl-be">
	<head>
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" 
			type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?php echo base_url('styles/other/jquery.bxslider.css'); ?>" />
		
		<title>PixelApps - Groepsleden</title>
		
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

		<div id="content">
			<header><h1>Biografie Groepsleden</h1></header>
			<ul class="bxslider">
			  <li>
			  	<section>
					<header><h1>Steven Verheyen</h1></header>
					<article>
						<img src="<?php echo base_url('img/Steven.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2>Functies</h2>
						Functie hier
					</article>
					<article>
						<h2>Gerelateerde Specialiteiten</h2>
						<ul>
							<li>Specialiteiten hier</li>
						</ul>
					</article>
					<article>
						<h2>Hobbies</h2>
						hobbies hier
					</article>
				</section>
			  </li>
			  <li>
			  	<section>
					<header><h1>Anke Appeltans</h1></header>
					<article>
						<img src="<?php echo base_url('img/Anke.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2>Functies</h2>
						Functie hier
					</article>
					<article>
						<h2>Gerelateerde Specialiteiten</h2>
						<ul>
							<li>Specialiteiten hier</li>
						</ul>
					</article>
					<article>
						<h2>Hobbies</h2>
						hobbies hier
					</article>
				</section>
			  </li>
			  <li>
			  	<section>
					<header><h1>Glenn Thielman</h1></header>
					<article>
						<img src="<?php echo base_url('img/Glenn.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2>Functies</h2>
						Functies hier
					</article>
					<article>
						<h2>Gerelateerde Specialiteiten</h2>
						<ul>
							<li>Specialiteiten hier</li>
						</ul>
					</article>
					<article>
						<h2>Hobbies</h2>
						hobbies hier
					</article>
				</section>
			  </li>
			  <li>
			  	<section>
					<header><h1>Robbie Vercammen</h1></header>
					<article>
						<img src="<?php echo base_url('img/Robbie.png');?>" alt="Steven's foto" />
					</article>
					<article>
						<h2>Functies</h2>
						Mijn functies binnen dit project zijn momenteel nog onbepaald.<br />
						Bij deze zou ik willen voorstellen:<br />
						- CodeIgniter verantwoordelijke<br />
						- templates verantwoordelijk (bijna voltooid ;) )
					</article>
					<article>
						<h2>Gerelateerde Specialiteiten</h2>
						<ul>
							<li>HTML5</li>
							<li>PHP</li>
							<li>CodeIgniter</li>
							<li>CSS3</li>
						</ul>
					</article>
					<article>
						<h2>Hobbies</h2>
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
		</div>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
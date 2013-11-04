<!DOCTYPE html />
<html lang="nl-be">
	<head>
             <?php $user_language=$this->session->userdata('language');
             $this->lang->load('home_form_'.$user_language,$user_language);
             $logged = false;
             if ($this->session->userdata('logged_in')) {
             	$logged = true;
             }?>
             <link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
             <title>Hoofdpagina</title>
        </head>
	
        <body>
            <?php include('templates/header.php'); ?>

            <section>
                
                <h1><?php echo $this->lang->line('aboutHoofdTitel');?></h1>
		
				<?php if ($logged) { ?>
				<form action="<?php echo base_url('start/cmsAboutOpdrachtgever');?>" method="post">
					<textarea rows="20" cols="150" id="aboutpagina" name="aboutpagina"><?php echo str_replace("__NewLine__", "\r\n", $text);?></textarea><br />
					<input type="submit" id="submit" value="OK" /><div id="error"> <?php echo $this->session->flashdata("errors"); ?></div>
				</form>
				<?php } else {?>
            	<p><?php echo str_replace("__NewLine__", "\r\n" ,$text);?></p>
            	<?php } ?>
                <!-- <h1>Over opdrachtgever</h1>
				<article>
                    <p>Onze opdracht werd gegeven door Lommel Proving Grounds. <br/>
                    	Dit bedrijf is gelegend in het bosrijke Lommel.</br><br/>
                       	Bij Lommel Proving Grounds worden allerlei autos getest op verschillende punten.</br>
                       	Enkele voorbeelden van controlepunten:</br>
                       	<ul>
	                       	<li>Duurzaamheid</li>
	                       	<li>Corrosie</li>
	                       	<li>Prestatie</li>
	                       	<li>Remfunctionaliteit</li>
	                       	<li>...</li>
						</ul>
                       	Voor deze testen uitvoerbaar zijn, moeten er een groot aantal testchauffeurs aanwezig.</br>
                       	Deze testchauffeurs krijgen allemaal elke dag een heleboel documenten mee.</br>
                       	Daarom kwam Lommel Proving Grounds naar ons met de vraag of we een applicatie konden schrijven 
                       	die het hun mensen wat gemakkelijker kon maken</br>
                       	met betrekking tot het vele papierwerk.</br>
                    </p>
				</article>
                <article> 
                    <h1>Waarom dit project</h1>
                    <p>Onze groep heeft deze opdracht gekozen omdat:
                    <ul>
                      	<li>Het ons een interessant project leek, met veel mogelijkheid tot zelfontplooing</li>
                      	<li>Tevens vormt het voor ons ook een uitdaging om zulk een groot project in goede banen te leiden.</li>
                    </ul>
                    </p>
                </article>
                
                <h1>Opdrachtomschrijving</h1>
                <article>
                    <p>Het doel van dit project is het maken van een applicatie die de volgend dingen aanbiedt:
                    <ul>
                        <li>Een digitale versie van alle taken en aandachtspunten voor de chauffeur.</li>
                        <li>Voice to tekst, zodat de chauffeur tijdens het rijden opmerkingen kan inspreken.</li>
                        <li>Bijhouden van waarschuwingen en problemen voor de volgende gebruiker.</li>
                        <li>De bestuurder zou via wifi-connectie gegevens moeten kunnen doorsturen naar de server</li>
                        <li>Als er geen wifi is dan moeten de gegevens via usb of bleutooth kunnen worden doorgegeven</li>
                    </ul></p>
                </article> -->
                
            </section>

            <?php include('templates/footer.php'); ?>
       </body>
</html>
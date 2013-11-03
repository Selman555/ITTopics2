<!DOCTYPE html />
<html lang="nl-be">
	<head>
             <?php $user_language=$this->session->userdata('language');
             $this->lang->load('home_form_'.$user_language,$user_language);?>
             <link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
             <title>Hoofdpagina</title>
        </head>
	
        <body>
            <?php include('templates/header.php'); ?>

            <section>
                
                <h1>Een korte samenvatting van ons ICT Project</h1>
		
                <h1>Voorstelling Opdrachtgever</h1>
		<article>
                    <p>Onze opdracht werd gegeven door Lommel Proving Grounds. <br/>
                       Dit bedrijf is gelegend in het bosrijke Lommel.</br><br/>
                       Bij Lommel Proving Grounds worden alle ford auto's getest op verschillende punten.</br>
                       Zoals bevoorbeeld op:</br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Duurzaamheid</br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Corrosie</br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prestatie</br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remfunctionaliteit</br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...</br>
                       Voor deze tests uit te voeren zijn er een groot aantal testchauffeurs aanwezig.</br>
                       Deze testchauffeurs krijgen allemaal elke dag een heleboel documenten mee.</br>
                       Daarom kwam Lommel Proving Grounds naar ons met de vraag of we geen applicatie konden schrijven 
                       die het hun mensen wat gemakkelijker kon maken</br>
                       met betrekking tot het vele papierwerk.</br>
                       
                    </p>
		</article>
                <article> 
                    <h1>Waarom we deze opdracht gekozen hebben</h1>
                    <p>Onze groep heeft deze opdracht gekozen omdat:</br>
                      &nbsp;&nbsp;&nbsp;&nbsp; Het ons een interessant project leek, met veel mogelijkheid tot zelfontplooing</br>
                      &nbsp;&nbsp;&nbsp;&nbsp; Tevens vormt het voor ons ook een uitdaging om z'on groot project ingoede banen te leiden.</br>
                     
                    </p>
                </article>
                
                <h1>Korte omschrijving van onze opdracht</h1>
                <article>
                    <p>
                        Het doel van dit project is het maken van een applicatie die de volgend dingen aanbiedt:<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;1)&nbsp;Een digitale versie van alle taken en aandachtspunten voor de chauffeur.</br>
                        &nbsp;&nbsp;&nbsp;&nbsp;2)&nbsp;Voice to tekst, zodat de chauffeur tijdens het rijden opmerkingen kan inspreken.</br>
                        &nbsp;&nbsp;&nbsp;&nbsp;3)&nbsp;Bijhouden van waarschuwingen en problemen voor de volgende gebruiker.</br>
                        &nbsp;&nbsp;&nbsp;&nbsp;4)&nbsp;De bestuurder zou via wifi-connectie gegevens moeten kunnen doorsturen naar de server</br>
                        &nbsp;&nbsp;&nbsp;&nbsp;5)&nbsp;Als er geen wifi is dan moeten de gegevens via usb of bleutooth kunnen worden doorgegeven
                    
                    
                    </p>
                    
                </article>
                
            </section>

            <?php include('templates/footer.php'); ?>
       </body>
</html>
<!DOCTYPE html>
<html lang="nl-be">
	<head>
        <?php $user_language=$this->session->userdata('language');
        $this->lang->load('home_form_'.$user_language,$user_language);?>
		
		<meta charset="UTF-8">
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" media="screen"/>
		<title><?php echo $this->lang->line('prive');?></title>
		<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropins.js" id="dropboxjs"
		data-app-key="clmhchmnj71v0t0"></script>
	</head>
	<body>
		<?php include 'templates/header.php'; ?>
		<?php 
			if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
			//	$redirect = "https://".'localhost:4430'.$_SERVER['REQUEST_URI'];
			//	header("Location: $redirect");
			}
		?>
                
			<section>
				<h1><?php echo $this->lang->line('prive');?></h1>
				<article>
					<p><?php echo $this->lang->line('priveBestandBericht');?></p>
					<input type="dropbox-chooser" name="selected-file" style="visibility: hidden;"/>
				</article>
				
				<h1>Behaalde Punten</h1>
				<article>
		            <table style="width: 90%; text-align: left; margin:auto; padding:1%;">
		                <tr>
		                    <th>Naam</th>
		                    <th>Omschrijving</th>
		                    <th>Behaald</th>
		                    <th>Maximum</th>
		                </tr>
		                
		                <?php foreach($tasks as $row) {?>
		                    <tr>
		                        <td><?php echo $row['naam']; ?></td>
		                        <td><?php echo $row['omschrijving']; ?></td>
		                        <td><?php echo $row['puntbehaald']; ?></td>
		                        <td><?php echo $row['puntmogelijk']; ?></td>
		                    </tr>
		                <?php } ?>
		            </table>
		        </article>
			</section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>

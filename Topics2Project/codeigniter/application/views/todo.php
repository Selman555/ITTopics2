<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>To Do's</title>
		<link rel="stylesheet" href="<?php echo base_url('styles/todo.css'); ?>" 
			type="text/css" media="screen"/>
	</head>
	<body>
		<div id="btnChangeState">
			<input type="button" value="Wijzig status" onclick="changeState()" />
			<input type="button" value="Wijziging klaar" onclick="changeStateReady()" />
		</div>

		<h1>To Do</h1>
		<div id="box1" ondrop="drop(event)" ondragover="allowDrop(event)">
			<article id="taak1" draggable="false" ondragstart="drag(event)">
				<h2>Taak 1 - Naam (AON)</h2>
				<section>Omschrijving opdracht</section>
				<section>~Door: [Naam]</section>
			</article>			
		</div>

		<h1>In Behandeling</h1>
		<div id="box2" ondrop="drop(event)" ondragover="allowDrop(event)">
			<article id="taak2" draggable="false" ondragstart="drag(event)">
				<h2>Taak 2 - Naam (SNB)</h2>
				<section>Omschrijving opdracht</section>
				<section>~Door: [Naam]</section>
			</article>
		</div>

		<h1>Nazicht Nodig</h1>
		<div id="box3" ondrop="drop(event)" ondragover="allowDrop(event)">
			<article id="taak3" draggable="false" ondragstart="drag(event)">
				<h2>Taak 3 - Naam (SNB)</h2>
				<section>Omschrijving opdracht</section>
				<section>~Door: [Naam]</section>
			</article>
		</div>

		<h1>In Nazicht</h1>
		<div id="box4" ondrop="drop(event)" ondragover="allowDrop(event)">
			<article id="taak4" draggable="false" ondragstart="drag(event)">
				<h2>Taak 4 - Naam (AON)</h2>
				<section>Omschrijving opdracht</section>
				<section>~Door: [Naam]</section>
			</article>
		</div>

		<h1>Klaar!</h1>
		<div id="box5" ondrop="drop(event)" ondragover="allowDrop(event)">
			<article id="taak5" draggable="false" ondragstart="drag(event)">
				<h2>Taak 5 - Naam (AON)</h2>
				<section>Omschrijving opdracht</section>
				<section>~Door: [Naam]</section>
			</article>
		</div>

		<form method="POST" action="#">
			<h1>Voeg opdracht toe</h1>
			<table>
				<tbody>
					<tr>
						<td>Taaknaam:</td>
						<td><input type="text" placeholder="Bijv. GUI Win8" name="naam" /></td>
					</tr>
					<tr>
						<td>Omschrijving:</td>
						<td><input type="text" placeholder="Bijv. GUI verspringt bij rotatie scherm" name="omschrijving" /></td>
					</tr>
					<tr>
						<td>Prioriteit:</td>
						<td>
							<select name="prioriteit">
								<option name="1">Zeer Hoog</option>
								<option name="2">Hoog</option>
								<option name="3">Matig</option>
								<option name="4">Laag</option>
								<option name="5">Zeer Laag</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Aanmaken" onclick="nogNietKlaar()" /></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
	<script type="text/javascript" src="<?php echo base_url('scripts/todo.js') ?>"></script>
</html>
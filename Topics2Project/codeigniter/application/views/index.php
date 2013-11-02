<!DOCTYPE html />
<html lang="nl-be">
	<head>
             <?php $user_language=$this->session->userdata('language');
             $this->lang->load('home_form_'.$user_language,$user_language);?>
            
		<link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" 
			type="text/css" media="screen"/>
		<title>Hoofdpagina</title>
		<script type="text/javascript">
			var keysPressed = new Array();
			var keysToPress = new Array(38, 38, 40, 40, 37, 39, 37, 39, 65, 66);
			
			onkeydown = function (e) {
				if (keysToPress[keysPressed.length] == e.keyCode)
				{
					keysPressed[keysPressed.length] = e.keyCode;
				} else {
					keysPressed = new Array();
				}
				if (keysPressed.length == keysToPress.length)
				{
					var same = true;
					for (var counter = 0; counter < keysToPress.length; counter++)
					{
						if (keysPressed[counter] != keysToPress[counter])
						{
							same = false;
						}
					}
					if (same == true) {
						window.location.href = '<?php echo base_url('start/todo');?>';
					} else {
						keysPressed = new Array();
					}
				}
			};
		</script>
	</head>
	<body onkeydown="onkeydown(this)">
		<?php include 'templates/header.php'; ?>

		<section>
                       <h1>PIXEL APPS</h1>
		
			<h1><?php echo $this->lang->line('algemeen');?></h1>
			<article>
                            <p><?php echo $this->lang->line('inl');?> </p>
			</article>
			
		</section>

		<?php include 'templates/footer.php'; ?>
	</body>
</html>
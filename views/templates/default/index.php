<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $site_title?> - <?php echo $site_name?></title>
	<?php echo $head?>
	<?php echo $css?>
	<?php echo $js?>
</head>

<body>

	<section id="header">

		<div class="container">
	
			<div class="page-header">
		
				<h1><?php echo $site_name?></h1>
	
			</div>	
	
		</div>
	
	</section>


	<section id="main">

		<div class="container">
		
			<div class="main">
				<?php echo $messages?>
				<?php echo $content?>
			</div>
			
		</div>

	</section>


	<section id="footer">

		<div class="container">
		
			<p><br />Page rendered in {elapsed_time} seconds</p>
	
		</div>
		
	</section>

</body>
</html>
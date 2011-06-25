<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $site_title?> - <?php echo $site_name?></title>
	<?php echo head?>
	<?php echo css?>
	<?php echo js?>
</head>

<body>

	<div class="wrap">

		<div class="header">
			<h1><?php echo $site_name?></h1>
			
		</div>
	
		
		<div class="main">
			<?php echo messages?>
			<?php echo content?>
		</div>
		
	
		<div class="footer">
		
			<p><br />Page rendered in {elapsed_time} seconds</p>
	
		</div>
		
	</div>

</body>
</html>
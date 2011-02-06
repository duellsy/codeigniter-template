<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$site_title?> - <?=$site_name?></title>
	<?=$head?>
	<?=$css?>
	<?=$js?>
</head>

<body>

	<div class="wrap">

		<div class="header">
			<h1><?=$site_name?></h1>
			
		</div>
	
		
		<div class="main">
			<?=$messages?>
			<?=$content?>
		</div>
		
	
		<div class="footer">
		
			<p><br />Page rendered in {elapsed_time} seconds</p>
	
		</div>
		
	</div>

</body>
</html>
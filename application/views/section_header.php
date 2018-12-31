<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>
		<?php 
			if(isset($subtitle)){
				echo ucwords(strtolower($subtitle)).' ';
			}else{
				echo '';
			} 
			if(isset($title)){
				echo ' | '.$title;
			}else{
				echo ' | '.'Untitled';
			}
		?>
	</title>
	<?php if(isset($redir) AND $redir != null): ?>
		<script>
		setTimeout(function () {    
			window.location.href = <?php echo "'".base_url()."upload/'"; ?>; 
		},30000);
		</script>
	<?php endif; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.4.2/js/all.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.4.2/js/v4-shims.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">	
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> 	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
	
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/main.js"></script>	
</head>
<body>
<div class="container-fluid" id="wrap">
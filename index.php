<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Exercise - Withe Lion</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><h1>Simple contact form</h1></li>
			</ul>
		</nav>
	</header>
	<section>
		<div class="contact_form">
		<?php
			$msg=0;
			$display=1;
			if(isset($_GET['msg'])){
				if($_GET['msg']==1){
					//message of thanks
					$msg='Thanks, a email is sent to you';
					//the form will not display
					echo "<div class='flash-success'>$msg</div>";
					$display=0;
				}elseif($_GET['msg']==2){
					$msg='An error occurred, please try again';
					echo "<div class='flash-fail'>$msg</div>";
				}

			}
			if($display){
		?>
			<form action="submit.php" enctype="multipart/form-data" autocomplete="on" method="post">
				<ul>
					<li>
						<label>First name:</label>
						<input type="text" name="fname" required='required'>
					</li>
					<li>
						<label>Last name:</label>
						<input type="text" name="lname" required='required'>
					</li>
					<li>	
						<label>E-mail:</label>
						<input type="email" name="email" required='required'>
					</li>
					<li>	
						<label>Resume</label>
						<input type="file" name="file" id="file" required='required'>
					</li>
					<li>	
						<input type="submit">
					</li>
				</ul>
			</form>
			<?php } ?>
		</div>		
	</section>
	<footer>
		<p>Carlos A. Lizaola</p>
	</footer>
</body>
</html>
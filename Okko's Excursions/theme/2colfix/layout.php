<?
#
# $data structure:
# - sections
# - pages
# - sitename
# - heading
# - permalink
# - floatimage
# - contents
# - copyright
#
#print_r($data);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title><?php echo $data['title'] ?></title> 
	<BASE href="http://www.golfhockey.fi/Okko's Excursions/"/>
	<link rel="stylesheet" type="text/css" media="all" href="./theme/2colfix/stylesheet1.css"/>
	<link rel="stylesheet" type="text/css" media="print" href="/theme/2colfix/print.css"/>
</head>
<body>
	<div id="container">

		<div id="header" >
			<a href=""><img src="./theme/2colfix/okko_header.png"/></a>
		</div>
		
		<div id="contents">

				<?php if( $data['floatimage'] ): ?>
					<div class="imagefloat">
					<img src="<?php echo $data['floatimage']['url'];?>" alt="<?php echo $data['floatimage']['alt'];?>" width="<?php echo $data['floatimage']['width'];?>" height="<?php echo $data['floatimage']['height'];?>" border="0">
					<?php if( $data['floatimage']['title'] ): ?>
						<br/><?php echo $data['floatimage']['title'];?>
					<?php endif; ?>
					</div>
				<?php endif; ?>
				<h2><?php echo  $data['heading'] ?></h2>
				<?php echo  $data['contents']; ?>

				<div class="reservation">
					<p>RESERVATION</p>
					<p>Email to <a href="mailto:info@golfhockey.fi">info@golfhockey.fi</a></p>
					<p>or call from mobile phone 09-4547117 or 040-5897517</p>
					<p>or call from your hotel phone 4547117 or 040-5897517</p>
					<p>Be ready to answer following questions:</p>
					<p>Where, when, how many persons? What is your name, hotel and room number?</p>
				</div>
		</div>
		
		
		<div id="footer">
			<?php echo $data['footer']?>
		</div>

	</div>

	<!-- Google analytics script should stay right before </body> tag. -->
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	var pageTracker = _gat._getTracker("UA-4583751-2");
	pageTracker._initData();
	pageTracker._trackPageview();
	</script>
	<!-- Google analytics script should stay right before </body> tag. -->

</body>
</html>


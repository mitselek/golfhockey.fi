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
	<BASE href="http://www.golfhockey.fi/"/>
	<link rel="stylesheet" href="/theme/2colfix/stylesheet1.css" media="screen"/>
	<style type="text/css" media="screen">@import url("/theme/2colfix/stylesheet2.css");</style>
	<link rel="stylesheet" href="/theme/2colfix/print.css" media="print"/>
    <link rel="stylesheet" type="text/css" media="all" href="/theme/2colfix/tree/tree.css" />
    <script type="text/javascript" src="/theme/2colfix/tree/tree.js"></script>
    <meta name="google-site-verification" content="MzGv_q-aKBzGkChbv4NHTrdNtfLgY5DL8zDpp_IbfSc" />
</head>
<body>
	<div id="container">

		<?php if( $data['sitename'] ): ?>
			<div id="header">
				<!--a href="Okko's Excursions"><img src="http://www.golfhockey.fi/images/okko_minibanner.png" border="0" style="float:left; display:block;" height="45" width="360" alt="OKKO's Excursions"/></a-->
				<h1>
					<?php echo $data['sitename']?>
				</h1>
			</div>
		<?php endif; ?>
		<div id="mainnav">
			<ul>
			<?php foreach( $data['sections'] as $section ): ?>
				<li<?php echo($data['section']['url'] == $section['url']) ? ' class="selected"' : ''; ?>><a href="/<?php echo $section['url']?>/"><?php echo $section['name']?></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
		
		
		<?php if(count($data['pages']) > 0): ?>
		<div id="treemenu">
			<ul>
			<?php #print_r($data['pages']);?>
			<?php foreach( $data['pages'] as $pagename => $page ): ?>
				<?php unset($nodeclass_a); ?>
				<?php if(isset($page['pages'])): ?>
					<?php $nodeclass_a[] = 'container'; ?>
				<?php endif; ?>
				<?php if(count($page['pages']) == 0): ?>
					<?php $nodeclass_a[] = 'empty'; ?>
				<?php endif; ?>
				<?php if(count($page['pages']) > 0): ?>
				<li class="<?php echo implode(' ', $nodeclass_a)?>">
					<p><a href="<?php echo 
						$page['link']
						? $page['link']
						: ('/'.$data['section']['url'].'/'.$pagename.'/' )
						;
									 ?>">
					<?php echo $pagename;?>
					</a></p>
					<ul <?php echo ($data['path'][1] == $pagename ? '' : 'class="hidden '.$data['path'][1] .'.'. $pagename.'"'); ?>>
					<?php foreach( $page['pages'] as $pagename2 => $page2 ): ?>
						<li><p filemtime="<?php echo(filemtime( './pages/' . $data['section']['url'] . '/'. $pagename . '/' . $pagename2 . '.html' )
						                             . ' - '
															  . date("F d Y H:i:s.", 1241100000));?>"
						<?php if ( filemtime( './pages/' . $data['section']['url'] . '/'. $pagename . '/' . $pagename2 . '.html' ) > 1241100000 ): ?>
							class="refreshed"
						<?php endif; ?>
						><a href="/<?php echo $data['section']['url']?>/<?php echo $pagename?>/<?php echo $pagename2?>"><?php echo $pagename2?></a></p></li>
					<?php endforeach; ?>
					</ul>
				</li>
				<?php elseif(isset($page['link'])): ?>
					<li class="<?php echo implode(' ', $nodeclass_a)?>">
					<p><a target="_blank" href="<?php echo $page['link']?>">
					-&gt; <?php echo $pagename;?>
					</a></p></li>
				<?php elseif(!isset($page['pages'])): ?>
					<li><p><a href="/<?php echo $data['section']['url']?>/<?php echo strip_tags($pagename)?>/"><?php echo $pagename?></a></p></li>
				<?php endif; ?>
			<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>


		<div id="contents"<?php echo (count($data['pages']) == 0) ? ' style="margin-right:10px;"' : '';?>>
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
		</div>
		
		
		<?php if( $data['footer'] ): ?>
		<div id="footer">
			<?php echo $data['footer'];?>
		</div>
		<?php endif; ?>
	</div>

	<!-- BEGIN Snoobi v1.4 -->
	<script type="text/javascript" src="http://eu1.snoobi.com/snoop.php?tili=golfhockey_fi"></script>
	<!-- END Snoobi v1.4 -->

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


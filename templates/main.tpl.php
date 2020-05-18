<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<title>Countries</title>
        <link rel="stylesheet" type="text/css" href="scripts/datetimepicker/jquery.datetimepicker.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="style/main.css" media="screen" />
        <script type="text/javascript" src="scripts/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="scripts/datetimepicker/jquery.datetimepicker.full.min.js"></script>
        <script type="text/javascript" src="scripts/main.js"></script>
	</head>
	<body>
		<div id="body">
			<div id="header">
				<h3 id="slogan"><a href="index.php">Countries data</a></h3>
			</div>
			<div id="content">
				<div id="topMenu">
					<ul class="float-left">
						<li><a href="index.php?module=country&action=list" title="Šalys"<?php if($module == 'country') { echo 'class="active"'; } ?>>Countries</a></li>
						</ul>
				</div>
				<div id="contentMain">
					<?php
						if(file_exists($actionFile)) {
							include $actionFile;
						}
					?>
					<div class="float-clear"></div>
				</div>
			</div>
			<div id="footer">

			</div>
		</div>
	</body>
</html>
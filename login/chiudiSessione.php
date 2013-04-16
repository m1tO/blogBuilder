<html>
	<head>
    	<title>LogOut</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <?php
        	/* Connessione al Server */
            include ("../config.php");
		?>
	</head>
    <body>
    	<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
		</div>
    	<?php
        session_start();
        session_regenerate_id(TRUE);

        session_destroy();
        ?>
        <meta http-equiv="refresh" content="1; url=../index.php">
	</body>
</html>

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
                     <a href="#"><img src="../<?php print($logoSito);?>" alt="logo" title="0x00" /></a>
                </div>
			</div>
            <div id="main">
				<div id="content">
                <h2>Vieni a trovarci!</h2>
                </div>
		</div>
    	<?php
        session_start();
        session_regenerate_id(TRUE);

        session_destroy();
        ?>
        <meta http-equiv="refresh" content="2; url=../index.php">
	</body>
</html>

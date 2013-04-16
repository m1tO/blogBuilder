<html>
	<head>
    	<title>Installazione Guidata</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro" />
		<meta name="generator" content="" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
				<div id="main">
					<div id="content">
                    	<h2>Pulsante non ancora funzionante</h2>
						<?php
	                        //Assegnazione variabili
							$dir="installation";
							function rmdirr($dir) 
							{
								if($objs = @glob($dir."/*"))
								{
									foreach($objs as $obj) 
									{
	 									@is_dir($obj)? rmdirr($obj) : @unlink($obj);
	  								}
 								}
								@rmdir($dir);
							}		

						?>
						<meta http-equiv="refresh" content="2; url=../index.php">
					</div>
                    <div id="clearer">&nbsp;
            		</div>
		        </div>
				<div id="footer">
        		&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
	</body>
</html>

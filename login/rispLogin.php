<?php
	session_start();
	session_regenerate_id(TRUE);
?>
<html>
	<head>
    		<title>Login</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Lo Porto Giovanni & Emmanuele Catanzaro" />
		<meta name="generator" content="" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<?php 
			//Includo file di configurazione
			include ("../config.php");
			//Includo file query
			require("../query.php");
		?>
	</head>
	<body>
		<?php
			$username=$_POST["username"];
			$passwd=$_POST["passwd"];
			$passwd= md5(md5($passwd));

			$flag=0; //Variabile di controllo
			while($rigaUtenti)
			{
				//Controllo esistenza utente
				if($username==$rigaUtenti['username'] && $passwd==$rigaUtenti['passwd'])
				{
					$flag=1;
				}
				$rigaUtenti=mysql_fetch_array($resultUtenti);
			}
		?>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="../index.php"><img src="../<?php print($logoSito);?>" alt="logo"/></a>
                </div>
			</div>
            <div id="main">
				<div id="content">
					<?php         
		               if($flag==1)
                        {
                                $_SESSION['username'] = $username;
								print('<h2>Login effettuato</h2> <meta http-equiv="refresh" content="2; url=../index.php">');	
                        }
                        else
                        {
                                print('<h2>Login non effettuato</h2> <meta http-equiv="refresh" content="2; url=../index.php">');
                        }			
    		 		?>   	 	
				</div>
				<div id="clearer">&nbsp;
            	</div>
		        <div id="footer">
       				<br><br>&copy; 2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
		</div>
	</body>
</html>		

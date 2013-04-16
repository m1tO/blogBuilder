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
			include ("../config.php");
		?>
	</head>
	<body>
		<?php
			$username=$_POST["username"];
			$passwd=$_POST["passwd"];
			$passwd= md5(md5($passwd));

			//Estrapolazione utenti DB
			$query="SELECT username,passwd FROM utenti";
			$result= mysql_query($query,$myconn) or die("Errore query");
			$riga=mysql_fetch_array($result);
			
			$flag=0; //Variabile di controllo
			while($riga)
			{
				//Controllo esistenza utente
				if($username==$riga['username'] && $passwd==$riga['passwd'])
				{
					$flag=1;
				}
				$riga=mysql_fetch_array($result);
			}
		?>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
            <div id="main">
				<div id="content">
					<?php         
		               if($flag==1)
                        {
                                $_SESSION['username'] = $username;
								print('Login effettuato <meta http-equiv="refresh" content="2; url=../index.php" </div>');	
                        }
                        else
                        {
                                print('Login non effettuato <meta http-equiv="refresh" content="2; url=../index.php"</div>');
                        }			
    		 		?>   	 	
				</div>
				<div id="clearer">&nbsp;
            	</div>
		        <div id="footer">
       				<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
		</div>
	</body>
</html>		

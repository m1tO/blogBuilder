<html>
	<head>
    	<title>mithole | home</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro" />
		<meta name="generator" content="" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
        <?php include("config.php"); ?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
				<div id="main">
					<?php
						$query="SELECT nome, percorso FROM menu";
						$result=mysql_query($query,$myconn) or die ("Errore query");
						$riga=mysql_fetch_array($result);
					?>                 
					<div id="menu">
						<div class="nav">
							<ul>
								<?php
									while($riga)
									{
										print('<li><a href="'.$riga['percorso'].'">'.$riga['nome'].'</a></li>');
										$riga=mysql_fetch_array($result);
									}
								?>
							</ul>
						</div>
					</div>
	        		<br>
					<div id="contentRight"><h2>Login</h2>
						<form action="login/rispLogin.php" method="post">
							<table align="left">
								<tr><td>Username</td></tr>
								<tr><td><input type="text" name="username" value=""></td></tr>
								<tr><td>Password</td></tr>
								<tr><td><input type="password" name="passwd" value=""></td></tr>
								<tr><td><input type="submit" name="login" value="Login"></td></tr>
								<tr><td><a href="login/registrazione.php" rel="register" class="linkform">Registrati</a></td></tr>
							</table>
						</form>
					</div>
					<?php 
						$query1="SELECT titolo, testo, DATE_FORMAT(dataPub, '%d') AS giorno, DATE_FORMAT(dataPub, '%m') AS mese FROM post";
						$result1=mysql_query($query1,$myconn) or die ("Errore query 1");
						$riga1=mysql_fetch_array($result1);
						
						while($riga1) 
						{
							$m=(int) $riga1['mese'];
							print('<div id="content"><div class="blog"><h2>'.$mese[$m].'</h2><h3>'.$riga1['giorno'].'</h3></div><h2>'.$riga1['titolo'].'</h2>'.$riga1['testo'].'</div>');
							$riga1=mysql_fetch_array($result1);
						}
					?>
					<div id="clearer">&nbsp;
            		</div>
		        </div>
				<div id="footer">
        		&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
	</body>
</html>

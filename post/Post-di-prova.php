						
<?php
	//Per quanto riguarda l'utilizzo del materiale presente in questo sito, declino ogni responsabilità da qualunque eventuale danno dovuto all'uso di esso.
	session_start();
	session_regenerate_id(TRUE);
?>

<html>
	<head>
    	<title>Blog</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro & Lo Porto Giovanni" />
		<meta name="generator" content="" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
        <?php include("../config.php"); ?>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="#"><img src="../img/logo.png" alt="logo" title="0x00" /></a>
                </div>
			</div>
				<div id="main">
					<?php
						//Estrapolazione menu
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
				<?php 
				//Controllo sessione
				if(!isset($_SESSION['username']))
				{ ?>
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
				<?php } 
				else
				{ ?>  
					<div id="contentRight">
						<?php
							//Estrapolazione e controllo ruolo utente
							$user=$_SESSION['username'];
							$query2="SELECT ruoli.id FROM ruoli, ruolixutenti, utenti WHERE (ruoli.id=ruolixutenti.idRuoli) && (ruolixutenti.idUtenti=utenti.id)  && (utenti.username='$user')";
							$result2=mysql_query($query2,$myconn) or die ("Errore query 2");
							$riga2=mysql_fetch_array($result2);
							
					   		
							if($riga2['id']==2)
							{ 
								print('lettore');
							}
							elseif($riga2['id']==3)
							{
								print('<a href="newPost.php">Inserisci nuovo Post</a>');
							}
							elseif($riga2['id']==4)
							{
								print('amministratore');
							}
						?> 
				 		<br><br>
                        <input type="button" onClick="window.location='login/chiudiSessione.php'" value="Logout">
					</div>
				<?php }
						//stampa post ?>
						<div id="content"><div class="blog"><h2>Apr</h2><h3>16</h3></div><h2>Post di prova</h2>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</div>
					

					<div id="clearer">&nbsp;
            		</div>
		        	<div id="footer">
       					<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
					</div>
              </div>
		</div>
	</body>
</html>


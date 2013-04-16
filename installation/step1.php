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
                    	<?php
	                        //Assegnazione variabili
							$nomeSito=$_POST['nomeSito'];
							$indirizzoDB=$_POST['indirizzoDB'];
							$nomeDB=$_POST['nomeDB'];
							$userDB=$_POST['userDB'];
							$passwdDB=$_POST['passwdDB'];
							$portaDB=$_POST['portaDB'];
							
							$mese="$"."mese";
							$myconn="$"."myconn";
							$query="$"."query";
							$result="$"."result";
							$riga="$"."riga";
							$query1="$"."query1";
							$result1="$"."result1";
							$riga1="$"."riga1";
							$m="$"."m";
							
							//Creazione DataBase
							$conn=mysql_connect("$indirizzoDB","$userDB","$passwdDB","$portaDB") or die("Errore Connessione");
							$sql="CREATE DATABASE $nomeDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci";
							$sql1 = @mysql_query($sql) or die ('Errore creazione DataBase');
							
							//Selezione DataBase
							mysql_select_db("$nomeDB", $conn) or die ("Errore Selezione");
							
							//Creazione Tabelle
							$menu="CREATE TABLE menu (id INT(11) PRIMARY KEY AUTO_INCREMENT, nome VARCHAR(50), percorso VARCHAR(250) );";
							$menu1=@mysql_query($menu) or die ('Errore creazione Tabella Menu');
							$menu2="INSERT INTO menu (nome, percorso) VALUES ('Home','index.php'); ";
							$menu3=@mysql_query($menu2) or die ('Errore inserimento Tabella Menu');
							
							$post="CREATE TABLE post (id INT(11) PRIMARY KEY AUTO_INCREMENT, titolo VARCHAR(50), testo TEXT, dataPub TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, idUtenti INT(11) );";
							$post1 = @mysql_query($post) or die ('Errore creazione Tabella Post');
							$post2="INSERT INTO post (titolo, testo, idUtenti) VALUES ('Post di prova','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', 1); ";
							$post3=@mysql_query($post2) or die ('Errore inserimento Tabella Post');
							
							$ruoli="CREATE TABLE ruoli (id INT(11) PRIMARY KEY AUTO_INCREMENT, nome VARCHAR(50) );";
							$ruoli1 = @mysql_query($ruoli) or die ('Errore creazione Tabella Ruoli');
							$ruoli2="INSERT INTO ruoli ( id, nome ) VALUES (1,'other'),(2,'lettore'),(3,'scrittore'),(4,'amministratore');";
							$ruoli3=@mysql_query($ruoli2) or die ('Errore inserimento Tabella Ruoli');
							
							$ruolixutenti="CREATE TABLE ruolixutenti (id INT(11) PRIMARY KEY AUTO_INCREMENT, idUtenti INT(11), idRuoli INT(11) );";
							$ruolixutenti1 = @mysql_query($ruolixutenti) or die ('Errore creazione Tabella Ruoli per utenti');
							
							$utenti="CREATE TABLE utenti (id INT(11) PRIMARY KEY AUTO_INCREMENT, username VARCHAR(50), passwd VARCHAR(50) );";
							$utenti1 = @mysql_query($utenti) or die ('Errore creazione Tabella Utenti');
							$utenti2="INSERT INTO utenti (username, passwd ) VALUES ('demo', 'demo');";
							$utenti3=@mysql_query($utenti2) or die ('Errore inserimento Tabella Utenti');
							
							//Creazione file config.php
							$file = "../config.php"; //percoso + nome pagina
							$codice = "<?php
/* Connessione al Server */
$myconn=mysql_connect(\"{$indirizzoDB}\",\"{$userDB}\",\"{$passwdDB}\",\"$portaDB\") or die(\"Errore Connessione\");

/* Selezione Database */
mysql_select_db(\"{$nomeDB}\", $myconn) or die (\"Errore Selezione\");

/*Array Mesi*/
{$mese}[01]='Gen';
{$mese}[02]='Feb';
{$mese}[03]='Mar';
{$mese}[04]='Apr';
{$mese}[05]='Mag';
{$mese}[06]='Giu';
{$mese}[07]='Lug';
{$mese}[08]='Ago';
{$mese}[09]='Set';
{$mese}[10]='Ott';
{$mese}[11]='Nov';
{$mese}[12]='Dic';
?>
							";
							//Creazione, scrittura e permessi file
	                    	$fo = fopen($file, "w");
						    fwrite($fo, $codice);
    						fclose($fo);
							chmod("$file",0755);
						
							//Creazione file index.php
							$file1 = "../index.php"; //percoso + nome pagina
							$codice1 = "<html>
	<head>
    	<title>{$nomeSito}</title>
		<meta content=\"text/html; charset=UTF-8\" http-equiv=\"content-type\" />
		<meta name=\"author\" content=\"Emmanuele Catanzaro\" />
		<meta name=\"generator\" content=\"\" />
		<link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
        <?php include(\"config.php\"); ?>
	</head>
	<body>
		<div id=\"container\">
			<div id=\"header\">
				<div class=\"logo\">
                     <a href=\"#\"><img src=\"img/logo.png\" alt=\"logo\" title=\"0x00\" /></a>
                </div>
			</div>
				<div id=\"main\">
					<?php
						$query=\"SELECT nome, percorso FROM menu\";
						$result=mysql_query($query,$myconn) or die (\"Errore query\");
						$riga=mysql_fetch_array($result);
					?>                 
					<div id=\"menu\">
						<div class=\"nav\">
							<ul>
								<?php
									while($riga)
									{
										print('<li><a href=\"'.{$riga}['percorso'].'\">'.{$riga}['nome'].'</a></li>');
										$riga=mysql_fetch_array($result);
									}
								?>
							</ul>
						</div>
					</div>
	        		<br>
					<div id=\"contentRight\"><h2>Login</h2>
						<form action=\"login/rispLogin.php\" method=\"post\">
							<table align=\"left\">
								<tr><td>Username</td></tr>
								<tr><td><input type=\"text\" name=\"username\" value=\"\"></td></tr>
								<tr><td>Password</td></tr>
								<tr><td><input type=\"password\" name=\"passwd\" value=\"\"></td></tr>
								<tr><td><input type=\"submit\" name=\"login\" value=\"Login\"></td></tr>
								<tr><td><a href=\"login/registrazione.php\" rel=\"register\" class=\"linkform\">Registrati</a></td></tr>
							</table>
						</form>
					</div>
					<?php 
						$query1=\"SELECT titolo, testo, DATE_FORMAT(dataPub, '%d') AS giorno, DATE_FORMAT(dataPub, '%m') AS mese FROM post\";
						$result1=mysql_query($query1,$myconn) or die (\"Errore query 1\");
						$riga1=mysql_fetch_array($result1);
						
						while($riga1) 
						{
							$m=(int) {$riga1}['mese'];
							print('<div id=\"content\"><div class=\"blog\"><h2>'.{$mese}[$m].'</h2><h3>'.{$riga1}['giorno'].'</h3></div><h2>'.{$riga1}['titolo'].'</h2>'.{$riga1}['testo'].'</div>');
							$riga1=mysql_fetch_array($result1);
						}
					?>
					<div id=\"clearer\">&nbsp;
            		</div>
		        </div>
				<div id=\"footer\">
        		&copy;2012- <?php error_reporting(0); echo date(\"Y\"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
	</body>
</html>

							";
							//Creazione, scrittura e permessi file
	                    	$fo1 = fopen($file1, "w");
						    fwrite($fo1, $codice1);
    						fclose($fo1);
							chmod("$file1",0755);
						
						?>
						<h2>Se non visuallizate alcun messaggio di errore, puoi procedere alla cancellazione della cartella <font color="#FF9900"><b>installation</b></font></h2>
                        <form action="step2.php" method="post">
                        	<input type="hidden" name="delete" value="delete">
                        	<input type="submit" name="cancella" value="Cancella cartella" onClick="return confirm('Conferma la tua scelta.')" />
                            <input type="button" onClick="window.location='../index.php'" value="Vai all'Home Page">
                        </form>
                        
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

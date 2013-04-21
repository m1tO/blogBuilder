<?php
	//Avvio sessione per il controllo login
	session_start();
	session_regenerate_id(TRUE);
	
	//Includo file di configurazione
	include("../../config.php");
	//Includo file query
	require("../../query.php");
?>
<html>
	<head>
    	<title><?php print($nomeSito);?></title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro & Lo Porto Giovanni" />
		<meta name="generator" content="" />
		<!--Collegamento al foglio di stile-->
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />
    </head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="../../index.php"><img src="../../<?php print($logoSito);?>" alt="logo" /></a>
                </div>
			</div>
            <div id="main">
            	<div id="content">
		        		<?php
						//Passaggio e codifica del titolo e del testo
						$titolo=$_POST['titolo'];
						$testo=$_POST['testo'];
						$titoloEscape=mysql_real_escape_string($titolo);
						$testoEscape=mysql_real_escape_string($testo);
						
						//Autore del post
						$idUtente=$rigaInfoUtente['id'];
						$cognome=$rigaInfoUtente['cognome'];
						$nome=$rigaInfoUtente['nome'];
						
						//Rimozione caratteri speciali per creazione percorso/file
						$cod = rand(1, 99);	//Numero casuale da inserire al nome del file
						$nomeFile=preg_replace("/[^a-zA-Z-0-9_-]/","", $titolo);	//Tutti i caratteri speciali verranno cancellati
						$file=$nomeFile."-".$cod.".php";	//Creazione del nome del file compreso di numero casuale ed estensione
						$percorso="post/".$file;	//Percorso di collegamento per il DB da dove andare a prendere il file

						//Inserimento nuovo post al momento della creazione
						$post1="INSERT INTO post (titolo, testo, percorso, idUtenti) VALUES('$titoloEscape', '$testoEscape','$percorso' ,'$idUtente')";
						$resultPost1 = mysql_query($post1, $myconn) or die("Errore inserimento post");
						
						//Query estrapolazione post dopo l'inserimento appena avvenuto
						$post="SELECT titolo, testo, DATE_FORMAT(dataPub, '%d') AS giorno, DATE_FORMAT(dataPub, '%m') AS mese FROM post WHERE (titolo='$titolo')";
						$resultPost=mysql_query($post, $myconn) or die("Errore query post appena inserito");
						$rigaPost=mysql_fetch_array($resultPost);
						
						//Passaggio dei campi mese e giorno in nuove variabili 
						$m=(int) $rigaPost['mese'];	//La variabile m rappresenta l'indice per la stampa del mese (Array dentro config.php)
						$mese1=$mese[$m];	//Il contenuto estratto dall'array viene copiato in una nuova variabile
						$giorno=$rigaPost['giorno'];	
						
						//Variabili che verranno utilizzate per la creazione dei file es. titoloPost.php
						$nomeSito="$"."nomeSito";
						$logoSito="$"."logoSito";
						$rigaMenu="$"."rigaMenu";
						$resultMenu="$"."resultMenu";
						$myconn="$"."myconn";
						$rigaInfoUtente="$"."rigaInfoUtente";
						$sessione="$"."_SESSION";
						$rigaRuolo="$"."rigaRuolo";
						


/*Contenuto file*/
$codice="<?php
	//Avvio sessione per il controllo login
	session_start();
	session_regenerate_id(TRUE);

	//Includo file di configurazione
	include(\"../config.php\");
	//Includo file query
	require(\"../query.php\");
?>
<html>
	<head>
    	<title><?php print($nomeSito);?></title>
		<meta content=\"text/html; charset=UTF-8\" http-equiv=\"content-type\" />
		<meta name=\"author\" content=\"Emmanuele Catanzaro & Lo Porto Giovanni\" />
		<meta name=\"generator\" content=\"\" />
		<!--Collegamento al foglio di stile-->
        <link href=\"../css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
    </head>
	<body>
		<div id=\"container\">
			<div id=\"header\">
				<div class=\"logo\">
					<!--Percorso logo per il blog-->	
					<a href=\"../index.php\"><img src=\"../<?php print($logoSito);?>\" alt=\"logo\"/></a>
                </div>
				<!--Funzione cerca -->
                <div class=\"functions\">
					<form action=\"../search.php\" id=\"cse-search-box\" method=\"get\">
						<div>
					    	<input type=\"hidden\" name=\"cx\" value=\"015840823095456170186:8mk2li9pevc\" />
						    <input type=\"hidden\" name=\"cof\" value=\"FORID:9\" />
						    <input type=\"hidden\" name=\"ie\" value=\"UTF-8\" />
						    <input type=\"text\" name=\"q\" size=\"20\" onFocus=\"if(this.value=='cerca...'){this.value=''};\" onBlur=\"if(this.value==''){this.value='cerca...'};\" value=\"cerca...\" />
				        </div>
					</form>
                </div>
			</div>
				<div id=\"main\">
					<div id=\"menu\">
						<div class=\"nav\">
							<ul>
								<?php
									//Stampa di tutte le voci presenti nella tabella menu
									while($rigaMenu)
									{
										print('<li><a href=\"../'.{$rigaMenu}['percorso'].'\">'.{$rigaMenu}['nome'].'</a></li>');
										$rigaMenu=mysql_fetch_array($resultMenu);
									}
								?>
							</ul>
						</div>
					</div>
	        		<br>
				<?php 
				//Controllo sessione
				if(!isset({$sessione}['username']))
				{ ?>
					 <div id=\"contentRight\">
	                     <div id=\"contentRight1\">
                         	<h2>Login</h2>
    	                 	<!--Form di login-->
							<form action=\"../login/rispLogin.php\" method=\"post\">
								<table align=\"left\">
									<tr><td>Username</td></tr>
									<tr><td><input type=\"text\" name=\"username\" value=\"\"></td></tr>
									<tr><td>Password</td></tr>
									<tr><td><input type=\"password\" name=\"passwd\" value=\"\"></td></tr>
                                    <tr><td></td></tr>
									<tr>
                                    	<td><input type=\"submit\" name=\"login\" value=\"Login\">
                                    	<input type=\"reset\" name=\"reset\" value=\"Reset\"></td>
									</tr>
                                    <tr><td></td></tr>
									<tr><td><a href=\"../login/registrazione.php\" rel=\"register\" class=\"linkform\">Registrati</a></td></tr>
								</table>
							</form>
						</div>
					</div>
				<?php } 
				else
				{ ?>  
                	<div id=\"contentRight\">
						<div id=\"contentRight1\">
							<?php
								print('<div class=\"avatar\"><img src=\"../'.{$rigaInfoUtente}['avatar'].'\"</img></div>');
								//Controllo ruolo utente
								if({$rigaRuolo}['id']==2)
								{ 
									//L'utente è un lettore
									print('Lettore');
								}
								elseif({$rigaRuolo}['id']==3)
								{
									//L'utente è uno scrittore
									print('<br><a href=\"../action/insert/newPost.php\">Inserisci nuovo Post</a>');
								}
								elseif({$rigaRuolo}['id']==4)
								{
									//L'utente è un'amministratore
									print('Amministratore');
								}
							?> 
				 			<br><br>
                        	<input type=\"button\" onClick=\"window.location='../login/closedSession.php'\" value=\"Logout\">
						</div>
						<div id=\"contentRight2\">
							Testo di prova
				 			<br><br>
						</div>
                    </div>
				<?php }	?>
               		
                    <!--Post generato automaticamente in fase di creazione-->
					<div id=\"content\"><div class=\"blog\"><h2>{$mese1}</h2><h3>{$giorno}</h3></div><div id=\"titolo\"><h2>{$titolo}</h2></div><div id=\"autore\"><i>Scritto da: {$cognome}&nbsp;{$nome}</i></div>{$testo}</div>
					
                    <!--<div id=\"clearer\">&nbsp;
            		</div>-->
		        	<div id=\"footer\">
       					<br><br>&copy;2012- <?php error_reporting(0); echo date(\"Y\"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
					</div>
              </div>
		</div>
	</body>
</html>
";						
/*Fine contenuto file*/
					//Script per apertura, scrittura e permessi di lettura file
					$fo=fopen("../../post/".$file,"w");	//Percorso di creazione file
					fwrite($fo,$codice);
					fclose($fo);
					chmod("../../post/".$file,0755);
					?>
                    <!--Messaggio da stampare un'avvolta creato il file-->
					<h2>Inserimento avvenuto con successo!</h2>
                    <?php 
						//Passaggio della variabile nascosta per non perdere la sessione
						$_SESSION['username']=$_POST['newUsername'];
					?>
                   <meta http-equiv="refresh" content="2; url=../../index.php">
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

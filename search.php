<?php
	//Avvio sessione per il controllo login
	session_start();
	session_regenerate_id(TRUE);

	//Includo file di configurazione
	include("config.php");
	//Includo file query
	require("query.php");
?>
<html>
	<head>
    	<title><?php print($nomeSito);?></title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro & Lo Porto Giovanni" />
		<meta name="generator" content="" />
		<!--Collegamento al foglio di stile-->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
					<!--Percorso logo per il blog-->	
					<a href="index.php"><img src="<?php print($logoSito);?>" alt="logo"/></a>
                </div>
				<!--Funzione cerca -->
                <div class="functions">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="cse-search-box" method="get">
						<div>
					    	<input type="hidden" name="cx" value="015840823095456170186:8mk2li9pevc" />
						    <input type="hidden" name="cof" value="FORID:9" />
						    <input type="hidden" name="ie" value="UTF-8" />
						    <input type="text" name="q" size="20" onFocus="if(this.value=='cerca...'){this.value=''};" onBlur="if(this.value==''){this.value='cerca...'};" value="cerca..." />
				        </div>
					</form>
                </div>
			</div>
				<div id="main">
					<div id="menu">
						<div class="nav">
							<ul>
								<?php
									//Stampa di tutte le voci presenti nella tabella menu
									while($rigaMenu)
									{
										print('<li><a href="'.$rigaMenu['percorso'].'">'.$rigaMenu['nome'].'</a></li>');
										$rigaMenu=mysql_fetch_array($resultMenu);
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
					 <div id="content"><h2>Funzione riservata ai soli utenti registrati</h2></div>
                     <meta http-equiv="refresh" content="2; url=index.php">
				<?php } 
				else
				{ 
                	//Controllo esistenza variabile di ricerca
					if(!isset($_GET['q']))
					{
						//La variabile di ricerca non esiste
					}
					else
					{
						$search=$_GET['q'];
						$searchEscp=mysql_real_escape_string($search);
						
						//Estrapolazione ricerca post
						$querySearch="SELECT COUNT(id) AS id, titolo, LEFT(testo, 250) AS testo, DATE_FORMAT(dataPub, '%d') AS giorno, DATE_FORMAT(dataPub, '%m') AS mese, percorso AS percorsoPost FROM post WHERE (titolo LIKE '%$searchEscp%') OR (testo LIKE '%$searchEscp%') GROUP BY dataPub DESC;";
						$resultSearch=mysql_query($querySearch,$myconn) or die ("Errore query Search");
						$rigaSearch=mysql_fetch_array($resultSearch);
					}
						//Controllo numero di post presenti nel DB
						if($rigaSearch['id']==0)
						{
							print('<div id="content"><h2>Nessun risultato trovato</h2></div>');
						}
						else
						{
						while($rigaSearch) 
							{
								//Converto variabile mese in intero per generare l'indice dell'array presente in config.php
								$m=(int) $rigaSearch['mese'];	
								//Stampa di tutti i post presenti nella tabella post
								print('<div id="content"><div class="blog"><h2>'.$mese[$m].'</h2><h3>'.$rigaSearch['giorno'].'</h3></div><div id=titolo><h2>'.$rigaSearch['titolo'].'</h2></div><div id="autore"><i>Scritto da: '.$rigaIdUtenti['cognome'].'&nbsp;'.$rigaIdUtenti['nome'].'</i></div>'.$rigaSearch['testo'].'<br><br><a href='.$rigaSearch['percorsoPost'].'>Continua a leggere</a></div>');
								$rigaSearch=mysql_fetch_array($resultSearch);
							}
						}
					}	
					?>
					<!--<div id="clearer">&nbsp;
            		</div>-->
		        	<div id="footer">
<<<<<<< HEAD
       					<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
=======
       					<br><br>&copy; 2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
>>>>>>> f76d70f560dd28b40d34238f6f8ba893a97414f5
					</div>
              </div>
		</div>
	</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> f76d70f560dd28b40d34238f6f8ba893a97414f5

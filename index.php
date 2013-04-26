<?php
	//Avvio sessione per il controllo login
	session_start();
	session_regenerate_id(TRUE);

	//Includo file di configurazione
	include("config.php");
	//Includo file query
	require("query.php");
	//Includo file impaginazione
	require("pagination.php");
?>
<html>
	<head>
    	<title><?php print($nomeSito);?></title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
		<meta name="author" content="Emmanuele Catanzaro & Lo Porto Giovanni" />
		<meta name="generator" content="" />
        <!--Script Social Network-->
        <script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="js/button.js"></script>
		<script type="text/javascript">stLight.options({publisher: "229e3611-b862-4f69-8667-ebfbc036cc8b", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        
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
					<form action="search.php" id="cse-search-box" method="get">
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
					 <div id="contentRight">
	                     <div id="contentRight1">
                         	<h2>Login</h2>
    	                 	<!--Form di login-->
							<form action="login/rispLogin.php" method="post">
								<table align="left">
									<tr><td>Username</td></tr>
									<tr><td><input type="text" name="username" value=""></td></tr>
									<tr><td>Password</td></tr>
									<tr><td><input type="password" name="passwd" value=""></td></tr>
                                    <tr><td></td></tr>
									<tr>
                                    	<td><input type="submit" name="login" value="Login">
                                    	<input type="reset" name="reset" value="Reset"></td>
									</tr>
                                    <tr><td></td></tr>
									<tr><td><a href="login/registrazione.php" rel="register" class="linkform">Registrati</a></td></tr>
								</table>
							</form>
						</div>
					</div>
				<?php } 
				else
				{ ?>  
                	<div id="contentRight">
						<div id="contentRight1">
							<h2>Profilo: <i><?php print($rigaInfoUtente['username']); ?></i></h2>
							<?php
								print('<div class="avatar"><img src="'.$rigaInfoUtente['avatar'].'"</img></div>');
								//Controllo ruolo utente
								if($rigaRuolo['id']==2)
								{ 
									//L'utente è un lettore
									print('Lettore');
								}
								elseif($rigaRuolo['id']==3)
								{
									//L'utente è uno scrittore
									print('<br><a href="action/insert/newPost.php">Inserisci nuovo Post</a>');
								}
								elseif($rigaRuolo['id']==4)
								{
									//L'utente è un'amministratore
									print('Amministratore');
								}
							?> 
				 			<br><br>
                        	<input type="button" onClick="window.location='login/closedSession.php'" value="Logout">
						</div>
						<div id="contentRight2">
                        	<div align="center">
                            	<h2>Social Network</h2>
                                <!--Pulsanti di condivisione-->
                                <span class='st_facebook_large' displayText='Facebook'></span>
                                <span class='st_twitter_large' displayText='Tweet'></span>
                                <span class='st_googleplus_large' displayText='Google +'></span>
                                <span class='st_linkedin_large' displayText='LinkedIn'></span>
				 			</div>
                            <br>
						</div>
                    </div>
				<?php }
						//Istanziamo la classe per l'impaginazione
						$p = new Paging;
						
						//Numero massimo di post per pagina
						$max = 20;
						
						//Identifichiamo la pagina da cui iniziare la numerazione
						$inizio = $p->paginaIniziale($max);
						
						//Troviamo il numero delle pagine che dovrà essere contato
						$count=$rigaNumPost['id'];
						$pagine = $p->contaPagine($count, $max);
						
						//Variabile di sessione da passare alla query i valori per la suddivisione dei post nelle pagine
						$_SESSION['per_page']=$inizio;
						$_SESSION['primo']=$max;
						
						//Controllo numero di post presenti nel DB
						if($rigaNumPost['id']==0)
						{
							print('<div id="content">Nessun post presente in DataBase</div>');
						}
						else
						{
							while($rigaPost) 
							{
								//Converto variabile mese in intero per generare l'indice dell'array presente in config.php
								$m=(int) $rigaPost['mese'];	
								//Stampa di tutti i post presenti nella tabella post
								print('<div id="content"><div class="blog"><h2>'.$mese[$m].'</h2><h3>'.$rigaPost['giorno'].'</h3></div><div id=titolo><h2>'.$rigaPost['titolo'].'</h2></div><div id="autore"><i>Scritto da: '.$rigaPost['cognome'].'&nbsp;'.$rigaPost['nome'].'</i></div>'.$rigaPost['testo'].'<br><br><a href='.$rigaPost['percorsoPost'].'>Continua a leggere</a></div>');
								$rigaPost=mysql_fetch_array($resultPost);
							}
						}
					?>
					<!--<div id="clearer">&nbsp;
            		</div>-->
		        	<div id="footer">
                    	<?php
							//Stampa numeri di pagine
							/*$lista = $p->listaPagine($_GET['p'], $pagine);
							echo $lista . "<br>";*/
							
							//Stampa Precedente/Successiva
							$navigatore = $p->precedenteSuccessiva($_GET['p'], $pagine);
							echo $navigatore;
						?>
       					<br><br>&copy;2012 - <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
					</div>
              </div>
		</div>
	</body>
</html>

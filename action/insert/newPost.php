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
		<meta name="author" content="Emmanuele Catanzaro" />
		<meta name="generator" content="" />
        <!--Collegamento al foglio di stile-->
		<link href="../../css/style.css" rel="stylesheet" type="text/css" />
        <!--Script editor di testo-->
        <script type="text/javascript" src="../../js/nicEdit.js"></script>
        <script type="text/javascript" src="../../js/buttonActivation.js"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		</script>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="logo">
                     <a href="../../index.php"><img src="../../<?php print($logoSito);?>" alt="logo"/></a>
                </div>
			</div>
            <div id="main">
            	<div id="menu">
					<div class="nav">
						<ul>
							<?php
								while($rigaMenu)
								{
									print('<li><a href="../../'.$rigaMenu['percorso'].'">'.$rigaMenu['nome'].'</a></li>');
									$rigaMenu=mysql_fetch_array($resultMenu);
								}
							?>
						</ul>
					</div>
				</div>
					<?php
                    if(!isset($_SESSION['username']))
					{ ?>
                    	<div id="content"><h2>Funzione riservata ai soli utenti registrati</h2></div>
                     	<meta http-equiv="refresh" content="3; url=../../index.php"> 
					 	<?php
					}
					else
					{ 
					?>
                    <div id="content">
                        <form name="selezione" action="rispNewPost.php" method="post">
                        <!--<select class="shelf_selection" name="selezione" onChange="this.form.submit();">-->
                            <table>
                                <tr>
                                    <td>Titolo</td>
                                    <td><input type="text" name="titolo" value="">
                                </tr>
                                <tr>
                                <td>Testo</td>
                                    <td><textarea name="testo" rows="15" cols="80" style="width: 100%" value=""></textarea></td>
                                    <br>
                                </tr>
                                <tr>
                                    <!--Variabile nascosta per non perdere la sessione-->
                                    <td><input type="hidden" name="newUsername" value="<?php print($_SESSION['username']); ?>"></td>
                                    <td><input type="submit" name="crea" value="Salva" onClick="return confirm('Conferma la tua scelta.')"  id="btn1" />
                                    <input type="reset" name="reset" value="Reset Campi" /></td>
                                </tr>
                            </table>
                            <!--Qui va la chiusura del form se dovessi cancellare la parte delle categorie -->
                            </div>
                            <!--Inizio parte nuova categorie-->
                            <div id="contentRight">
                                <div id="contentRight1">
                                    <h2>Categorie</h2>
                                    <div style="height: 240px; overflow:auto;">
										<?php
                                            //Stampa di tutte le categorie
                                            while ($rigaCategorie)
                                            {
                                                print($rigaCategorie['nome'].'<br>');
                                                $idCategoria=$rigaCategorie['id'];
                                                
                                                //Estrapolazione sottocategorie tramite la categoria
                                                $querySottocategorie="SELECT id, nome FROM sottocategorie WHERE (idCategoria='$idCategoria') ORDER BY nome";
                                                $resultSottocategorie=mysql_query($querySottocategorie,$myconn) or die ("Errore query Sottocategorie");
                                                $rigaSottocategorie=mysql_fetch_array($resultSottocategorie);
                                                
                                                //Stampa di tutte le sottocategorie
                                                while($rigaSottocategorie)
                                                {
                                                   //La selezione di ogni sottocategoria viene salvata su un'array e intercettata su un foreach su rispNewPost.php
                                                   print('&nbsp;&nbsp;&nbsp;<input type="checkbox" name="selezione[]" onClick="unlock(this, "btn1")" value="'.$rigaSottocategorie['id'].'">'.$rigaSottocategorie['nome'].'<br>');
                                                    
                                                    $rigaSottocategorie=mysql_fetch_array($resultSottocategorie);
                                                }
                                                
                                                $rigaCategorie=mysql_fetch_array($resultCategorie);
                                            }
											print('<script type="text/javascript">alert("Scrivi il tuo post, inserisci le immagini, ed effettua eventuali\nallineamenti solo dopo averlo completato!");</script>');
                                        ?>
									</div>
                                </div>
                            </div>
							<!--Fine parte nuova categorie-->
						</form>
                <?php } ?>
				<div id="clearer">&nbsp;
            	</div>
		        <div id="footer">
       				<br><br>&copy;2012 - <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
		</div>
	</body>
</html>		

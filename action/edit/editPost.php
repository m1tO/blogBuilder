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
						$idAutore=$_POST['idAutore'];	//Il primo Autore, creatore del post
						$idPost=$_POST['idPost'];
						$nomeFile=$_POST['nomeFile'];
						
						//Estrapolzaione post da modificare
						$queryEditPost="SELECT titolo, testo, idUtenti FROM post WHERE (id='$idPost')";
						$resultEditPost=mysql_query($queryEditPost,$myconn) or die ("Errore query Edit Post");
						$rigaEditPost=mysql_fetch_array($resultEditPost);
						
						$titolo=$rigaEditPost['titolo'];
						$testo=$rigaEditPost['testo'];
						
						//Controllo se l'utente loggato è l'autore del post
						if($rigaInfoUtente['id']==$rigaEditPost['idUtenti'])
						{ ?>
                            <div id="content">
                                <form action="rispEditPost.php" method="post">
                                    <table>
                                        <tr>
                                            <td>Titolo</td>
                                            <td><input type="text" name="titolo" value="<?php print($titolo);?>">
                                        </tr>
                                        <tr>
                                        <td>Testo</td>
                                            <td><textarea name="testo" rows="15" cols="80" style="width: 100%" value=""><?php print($testo);?></textarea></td>
                                            <br>
                                    </tr>
                                        <tr>
                                            <!--Variabili nascoste per non perdere la sessione, l'autore originale e il nome del file-->
                                            <td>
                                                <input type="hidden" name="newUsername" value="<?php print($_SESSION['username']); ?>">
                                                <input type="hidden" name="idPost" value="<?php print($idPost); ?>">
                                                <input type="hidden" name="idAutore" value="<?php print($idAutore); ?>">
                                                <input type="hidden" name="nomeFile" value="<?php print($nomeFile); ?>">
                                            </td>
                                            <td><input type="submit" name="crea" value="Salva" onClick="return confirm('Conferma la tua scelta.')" />
                                            <input type="reset" name="reset" value="Reset Campi" /></td>
                                        </tr>
                                    </table>
                                </div> 
                                <div id="contentRight">
                                    <div id="contentRight1">
                                        <h2>Categorie</h2>
                                        <div style="height: 240px; overflow:auto;">
                                            <?php
                                                //Estrapolazione categorie del post
                                                $queryCategoriaPost="SELECT DISTINCT categorie.id, categorie.nome FROM categorie, sottocategorie, sottocategoriepost WHERE (categorie.id=sottocategorie.idCategoria)&& (sottocategorie.id=sottocategoriepost.idSottocategoria) && (sottocategoriepost.idPost='$idPost') ORDER BY nome";
                                                $resultCategoriaPost=mysql_query($queryCategoriaPost,$myconn) or die ("Errore query Categorie Post");
                                                $rigaCategoriaPost=mysql_fetch_array($resultCategoriaPost);
                                                
                                                //Ciclo che stamperà tutte le sottocategorie del post in modo checked
                                                while($rigaCategoriaPost)
                                                {
                                                    print($rigaCategoriaPost['nome'].'<br>');
                                                    $idCategoria=$rigaCategoriaPost['id'];
                                                    
                                                    //Estrapolazione sottocategorie del post
                                                    $querySottocategoriaPost="SELECT sottocategorie.id, sottocategorie.nome FROM sottocategorie, sottocategoriepost WHERE (sottocategorie.idCategoria='$idCategoria') && (sottocategorie.id=sottocategoriepost.idSottocategoria) && (sottocategoriepost.idPost='$idPost') ORDER BY nome";
                                                    $resultSottocategoriaPost=mysql_query($querySottocategoriaPost,$myconn) or die ("Errore query Sottocategorie Post");
                                                    $rigaSottocategoriaPost=mysql_fetch_array($resultSottocategoriaPost);
                                                    
                                                    while($rigaSottocategoriaPost)
                                                    {
                                                        print('&nbsp;&nbsp;&nbsp;<input type="checkbox" name="selezione[]" onClick="unlock(this, "btn1")" value="'.$rigaSottocategoriaPost['id'].'" checked>'.$rigaSottocategoriaPost['nome'].'<br>');
                                                        $rigaSottocategoriaPost=mysql_fetch_array($resultSottocategoriaPost);
                                                    }
                                                    
                                                    $rigaCategoriaPost=mysql_fetch_array($resultCategoriaPost);
                                                }
                                                print("_________________<br>");
                                                
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
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
							<?php
							}
							else
							{ 
								?>
								<div id="content"><h2>Funzione riservata all'autore del post</h2></div>
		                     	<meta http-equiv="refresh" content="3; url=../../index.php"><?php
							}
						}?>
				<div id="clearer">&nbsp;
            	</div>
		        <div id="footer">
       				<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
				</div>
			</div>
		</div>
	</body>
</html>		

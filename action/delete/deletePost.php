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
                        //Assegnazione variabili
                        $idPost=$_POST['idPost'];
                        $idAutore=$_POST['idAutore'];
                        $nomeFile=$_POST['nomeFile'];
                        
                        //Percoso del file post da cancellare
						$dir='../../post/'.$nomeFile.'';
                        
                        //Estrapolzaione autore post
						$queryAutorePost="SELECT idUtenti FROM post WHERE (id='$idPost')";
						$resultAutorePost=mysql_query($queryAutorePost,$myconn) or die ("Errore query Autore Post");
						$rigaAutorePost=mysql_fetch_array($resultAutorePost);
						
						//Controllo se l'utente loggato è l'autore del post
                        if($rigaInfoUtente['id']==$rigaAutorePost['idUtenti'])
                        {
                        	//Cancellazione voce dal DB
							$queryDeletePost="DELETE FROM post WHERE (id='$idPost')";
							$resultDeletePost=mysql_query($queryDeletePost,$myconn) or die ("Errore query Delete Post");
							
							$queryDeleteSottPost="DELETE FROM sottocategoriepost WHERE (idPost='$idPost')";
							$resultDeleteSottPost=mysql_query($queryDeleteSottPost,$myconn) or die ("Errore query Delete Post");
							
							//Cancellazione file post
							unlink($dir);
							?>
                            <!--Messaggio da stampare un'avvolta eliminato il file-->
                            <h2>Eliminazione avvenuta con successo!</h2>
                            <meta http-equiv="refresh" content="3; url=../../index.php"><?php
						}
						else
						{
							?>
                            <!--Messaggio da stampare se non è stato possibile eliminare il file-->
                            <h2>Funzione riservata all'autore del post</h2>
		                    <meta http-equiv="refresh" content="3; url=../../index.php"><?php
						}
                    ?>
					</div>
					<!--<div id="clearer">&nbsp;
            		</div>-->
		        	<div id="footer">
       					<br><br>&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
					</div>
              </div>
		</div>
	</body>
</html>
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
							$nmSito="$"."nomeSito";
							$lgSito="$"."logoSito";
							
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
							$utenti2="INSERT INTO utenti (username, passwd ) VALUES ('demo', '6c5ac7b4d3bd3311f033f971196cfa75');";
							$utenti3=@mysql_query($utenti2) or die ('Errore inserimento Tabella Utenti');
							
							$categorie="CREATE TABLE categorie (id INT(11) PRIMARY KEY AUTO_INCREMENT, nome VARCHAR(50), descrizione VARCHAR(250) );";
							$categorie1 = @mysql_query($categorie) or die ('Errore creazione Tabella Categorie');
							
							$sottocategorie="CREATE TABLE sottocategorie (id INT(11) PRIMARY KEY AUTO_INCREMENT, nome VARCHAR(50), descrizione VARCHAR(250), idCategoria INT(11) );";
							$sottocategorie1 = @mysql_query($sottocategorie) or die ('Errore creazione Tabella Sottocategorie');
							
							$sottocategoriepost="CREATE TABLE sottocategoriepost (id INT(11) PRIMARY KEY AUTO_INCREMENT, idSottocategoria INT(11), idPost INT(11) );";
							$sottocategoriepost1 = @mysql_query($sottocategoriepost) or die ('Errore creazione Tabella Sottocategorie Post');
							
							//Caricamento logo
							$msg="";
							do {
								  if (is_uploaded_file($_FILES['image']['tmp_name'])) {
									/* Controllo che il file non superi i 18 KB
									if ($_FILES['image']['size'] > 18432) {
									  $msg = "<p>Il file non deve superare i 18 KB!!</p>";
									  break;
									}*/
									// Ottengo le informazioni sull'immagine
									list($width, $height, $type, $attr) = getimagesize($_FILES['image']['tmp_name']);
									/* Controllo che le dimensioni (in pixel) non superino 360x180
									if (($width >360) || ($height > 180)) {
									  $msg = "<p>Dimensioni non corrette!!</p>";
									  break;
									}*/
									// Controllo che il file sia in uno dei formati GIF, JPG o PNG
									if (($type!=1) && ($type!=2) && ($type!=3)) {
									  $msg = "<p>Formato non corretto!!</p>";
									  break;
									}
									// Verifico che sul sul server non esista già un file con lo stesso nome
									// In alternativa potrei dare io un nome che sia funzione della data e dell'ora
									if (file_exists('it-It/img/'.$_FILES['image']['name'])) {
									  $msg = "<p>Immagine già esistente sul server. Rinominarlo e riprovare.</p>";
									  break;
									}
									// Sposto il file nella cartella da me desiderata
									if (!move_uploaded_file($_FILES['image']['tmp_name'], 'it-It/img/'.$_FILES['image']['name'])) {
									  $msg = "<p>Errore nel caricamento dell'immagine!!</p>";
									  break;
									}
								  }
								} while (false);
								
								echo $msg;
							
								$percorsoLogo=$_FILES['image']['name'];
								
							//Creazione file config.php
							$file = "it-It/config.php"; //percoso + nome pagina
							$codice = "<?php
/* Connessione al Server */
$myconn=mysql_connect(\"{$indirizzoDB}\",\"{$userDB}\",\"{$passwdDB}\",\"$portaDB\") or die(\"Errore Connessione\");

/* Selezione Database */
mysql_select_db(\"{$nomeDB}\", $myconn) or die (\"Errore Selezione\");

/*Variabili comuni*/
{$nmSito}=\"{$nomeSito}\";
{$lgSito}=\"img/{$percorsoLogo}\";	//Dimensioni 360x140px

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
							
							//Funzione per copiare il contenuto in un'altra directory
							$source="it-It/";
							$destination="../Prova";
							function full_copy($source, $destination, $permissions = 0755)
							{
								// Check for symlinks
								if (is_link($source)) {
									return symlink(readlink($source), $destination);
								}
							
								// Simple copy for a file
								if (is_file($source)) {
									return copy($source, $destination);
								}
							
								// Make destination directory
								if (!is_dir($destination)) {
									mkdir($destination, $permissions);
								}
							
								// Loop through the folder
								$dir = dir($source);
								while (false !== $entry = $dir->read()) {
									// Skip pointers
									if ($entry == '.' || $entry == '..') {
										continue;
									}
							
									// Deep copy directories
									full_copy("$source/$entry", "$destination/$entry");
								}
							
								// Clean up
								$dir->close();
								return true;
							}
							
							full_copy($source, $destination);
						?>
						<h2>Se non visuallizate alcun messaggio di errore, puoi procedere alla cancellazione della cartella <font color="#FF9900"><b>installation</b></font></h2>
                        <form action="delete.php" method="post">
                        	<input type="hidden" name="delete" value="delete">
                        	<input type="submit" name="cancella" value="Cancella cartella" onClick="return confirm('Conferma la tua scelta.')" />
                            <input type="button" onClick="window.location='../index.php'" value="Vai all'Home Page">
                        </form>
                        
					</div>
                    <div id="clearer">&nbsp;
            		</div>
		       		 <div id="footer">
        				&copy;2012- <?php error_reporting(0); echo date("Y"); ?> - Lo Porto Giovanni &amp Emmanuele Catanzaro
					</div>
				</div>
          </div>
	</body>
</html>

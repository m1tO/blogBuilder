<?php
	//Includo file di configurazione
	include("config.php");
	
	//Estrapolazione menu
	$queryMenu="SELECT nome, percorso FROM menu";
	$resultMenu=mysql_query($queryMenu,$myconn) or die ("Errore query Menu");
	$rigaMenu=mysql_fetch_array($resultMenu);
	
	//Estrapolazione primi 20 post con limite dei primi 250 caratteri per post
	if(!isset($_SESSION['per_page']))
	{
		//La sessione non esiste
		$primo=0; 
		$per_page=20;	//Numero dei post da visualizzare
	}
	else
	{
		//Variabile di sessione per suddivisione post in pagine
		$primo=$_SESSION['per_page'];
		$per_page=$_SESSION['primo'];
	}
	$queryPost="SELECT post.id, utenti.nome, utenti.cognome, post.titolo, LEFT(post.testo, 250) AS testo, DATE_FORMAT(post.dataPub, '%d') AS giorno, DATE_FORMAT(post.dataPub, '%m') AS mese, post.percorso AS percorsoPost FROM post, utenti WHERE (utenti.id=post.idUtenti) GROUP BY post.dataPub DESC LIMIT $primo, $per_page";
	$resultPost=mysql_query($queryPost,$myconn) or die ("Errore query Post");
	$rigaPost=mysql_fetch_array($resultPost);
	
	//Estrapolazione numero di post
	$queryNumPost="SELECT COUNT(id) AS id FROM post";
	$resultNumPost=mysql_query($queryNumPost,$myconn) or die ("Errore query Num Post");
	$rigaNumPost=mysql_fetch_array($resultNumPost);
	
	//Estrapolazione categorie
	$queryCategorie="SELECT id, nome FROM categorie ORDER BY nome";
	$resultCategorie=mysql_query($queryCategorie,$myconn) or die ("Errore query Categorie");
	$rigaCategorie=mysql_fetch_array($resultCategorie);
	
	//Estrapolazione utenti
	$queryUtenti="SELECT username,passwd FROM utenti";
	$resultUtenti= mysql_query($queryUtenti,$myconn) or die("Errore query Utenti");
	$rigaUtenti=mysql_fetch_array($resultUtenti);
	
	//Controllo per eseguire query solo quando esiste una sessione User o meno
	if(!isset($_SESSION['username']))
	{
		//La sessione non esiste
	}
	else
	{
		//La sessione è stata creata
		
		//Estrapolazione ruolo utente
		$user=$_SESSION['username'];	//Variabile di sessione Utente
		$queryRuolo="SELECT ruoli.id, ruoli.nome FROM ruoli, utenti WHERE (ruoli.id=utenti.idRuolo)  && (utenti.username='$user')";
		$resultRuolo=mysql_query($queryRuolo,$myconn) or die ("Errore query Ruolo");
		$rigaRuolo=mysql_fetch_array($resultRuolo);
		
		//Estrapolazione dettagli utente se loggato
		$queryInfoUtente="SELECT id, nome, cognome, username, email, avatar FROM utenti WHERE (utenti.username='$user')";
		$resultInfoUtente=mysql_query($queryInfoUtente,$myconn) or die ("Errore query Dettagli Utente");
		$rigaInfoUtente=mysql_fetch_array($resultInfoUtente);
	}

?>
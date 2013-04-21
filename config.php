<?php
/* Connessione al Server */
$myconn=mysql_connect("localhost","root","Manu2199","3306") or die("Errore Connessione Server");

/* Selezione Database */
mysql_select_db("blog", $myconn) or die ("Errore Selezione DataBase");

/*Variabili comuni*/
$nomeSito="Blog";
$logoSito="img/logo.png";	//Dimensioni 360x140px

/*Array Mesi*/
$mese[01]='Gen';
$mese[02]='Feb';
$mese[03]='Mar';
$mese[04]="Apr";
$mese[05]='Mag';
$mese[06]='Giu';
$mese[07]='Lug';
$mese[08]='Ago';
$mese[09]='Set';
$mese[10]='Ott';
$mese[11]='Nov';
$mese[12]='Dic';
?>


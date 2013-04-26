//Script per validare i campi di un form
function validateForm()
{
	var x=document.forms["installazione"]["nomeSito"].value;
	if (x==null || x=="")
  	{
  		alert("Campo nome sito vuoto\nSite Name field empty");
  	return false;
  	}
	var x=document.forms["installazione"]["image"].value;
	if (x==null || x=="")
  	{
  		alert("Campo logo sito vuoto\nTrad. inglese");
  	return false;
  	}
	var x=document.forms["installazione"]["indirizzoDB"].value;
	if (x==null || x=="")
  	{
  		alert("Campo indirizzo DB vuoto\nTrad. inglese");
  	return false;
  	}
	var x=document.forms["installazione"]["nomeDB"].value;
	if (x==null || x=="")
  	{
  		alert("Campo nome DB vuoto\nTrad. inglese");
  	return false;
  	}
	var x=document.forms["installazione"]["userDB"].value;
	if (x==null || x=="")
  	{
  		alert("Campo user DB vuoto\nTrad. inglese");
  	return false;
  	}
	var x=document.forms["installazione"]["passwdDB"].value;
	if (x==null || x=="")
  	{
  		alert("Campo password DB vuoto\nTrad. inglese");
  	return false;
  	}
  
}
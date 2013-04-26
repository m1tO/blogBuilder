<!--Script attiva pulsanti dopo selezione checkbox-->
function unlock(el1, el2) 
{
	if(el1.checked) 
	{
		document.getElementById(el2).disabled = false;
	}
	else 
	{
		document.getElementById(el2).disabled = 'disabled';
	}
}


<!--Script per selezionare tutte le voci in un solo click-->
function SelezTT()
{
    var i = 0;
    var modulo = document.moduloReg.elements;
    for (i=0; i<modulo.length; i++)
    {
        if(modulo[i].type == "checkbox")
        {
            modulo[i].checked = !(modulo[i].checked);
        }
    }
}

function SpecialVermeldungen_Del(id)
{
	var params = new Object();
	params['id'] = id;
	if(confirm("Soll die Vermeldung wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=News_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					
					if(returns['id'])
					{
						document.getElementById('Vermeldung'+returns['id']).style.display = "none";
					}
				}
			}
		);
	}
}

function SpecialVermeldungen_Save()
{
	var params = new Object();
	params['name'] = document.getElementById('inname').value;;
	params['date'] = document.getElementById('indate').value;
	params['time'] = document.getElementById('intime').value;
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=News_save",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				if(returns['text']!="")
					alert(returns['text']);
				if(returns['ok']==1)
				{
					document.getElementById('Vermeldungsliste').innerHTML = returns['Vermeldungen'];
					document.getElementById('indate').value = "";
					document.getElementById('intime').value = "";
					document.getElementById('inname').value = "";
				}
			}
		}
	);
}

function SpecialVermeldungen_Clear()
{
	document.getElementById('indate').value = "";
	document.getElementById('intime').value = "";
	document.getElementById('inname').value = "";
}


function All_Del()
{
	var params = new Object();
	if(confirm("Sollen die Vermeldungen wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=All_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					var General = document.getElementById("Generalnews");
					General.tBodies[0].innerHTML = "";
					var News = document.getElementById("Terminvermeldungen");
					News.tBodies[0].innerHTML = "";
				}
			}
		);
	}
}


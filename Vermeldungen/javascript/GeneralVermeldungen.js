function GeneralVermeldungen_Del(id)
{
	var params = new Object();
	params['id'] = id;
	if(confirm("Soll die Vermeldung wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=GeneralNews_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					
					if(returns['id'])
					{
						document.getElementById('General'+returns['id']).style.display = "none";
					}
				}
			}
		);
	}
}

function GeneralVermeldungen_Save()
{
	var params = new Object();
	params['name'] = document.getElementById('ginname').value;;
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=GeneralNews_save",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				if(returns['text']!="")
					alert(returns['text']);
				if(returns['ok']==1)
				{
					document.getElementById('GeneralListe').innerHTML = returns['Vermeldungen'];
					GeneralVermeldungen_Clear();
				}
			}
		}
	);
}

function GeneralVermeldungen_Clear()
{
	document.getElementById('ginname').value = "";
}

function OutputSet(nid, oid, dbclass){
	var params = new Object();
	params['nid'] = nid;
	params['oid'] = oid;
	params['dbclass'] = dbclass;
	if(document.getElementById(dbclass+"Output"+nid+'_'+oid).checked == true)
		params['state'] = 1;
	else
		params['state'] = 0;
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=OutputSet",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				if(returns['text']!="")
					alert(returns['text']);
				if(returns['ok']==1)
				{
					//document.getElementById(dbclass+"Output"+nid+'_'+oid).checked == false
				}
			}
		}
	);
}

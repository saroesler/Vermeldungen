function Output_Del(id)
{
	var params = new Object();
	params['id'] = id;
	if(confirm("Soll die Ausgabe wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=Output_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					
					if(returns['id'])
					{
						document.getElementById('Output'+returns['id']).style.display = "none";
					}
				}
			}
		);
	}
}

function Output_Edit(id){
	document.getElementById('OutputInput'+id).style.display = "inline-block";
	document.getElementById('OutputText'+id).style.display = "none";
	document.getElementById('OutputPageFormatSelectorContainer'+id).style.display = "block";
	document.getElementById('OutputPageFormat'+id).style.display = "none";
	document.getElementById('OutputDateSideSelectorContainer'+id).style.display = "block";
	document.getElementById('OutputDateSide'+id).style.display = "none";
	document.getElementById('OutputEdit'+id).style.display = "none";
	document.getElementById('OutputEditExit'+id).style.display = "inline-block";
	document.getElementById('OutputEditSave'+id).style.display = "inline-block";
}

function Output_EditExit(id){
	document.getElementById('OutputInput'+id).style.display = "none";
	document.getElementById('OutputInput'+id).value = document.getElementById('OutputText'+id).innerHTML;
	document.getElementById('OutputText'+id).style.display = "inline-block";
	document.getElementById('OutputPageFormatSelectorContainer'+id).style.display = "none";
	document.getElementById('OutputPageFormatSelector'+id).value = document.getElementById('FormatValue'+id).value;
	document.getElementById('OutputPageFormat'+id).style.display = "inline-block";
	document.getElementById('OutputDateSideSelectorContainer'+id).style.display = "none";
	document.getElementById('OutputDateSideSelector'+id).value = document.getElementById('DateSideValue'+id).value;
	document.getElementById('OutputDateSide'+id).style.display = "inline-block";
	document.getElementById('OutputEdit'+id).style.display = "inline-block";
	document.getElementById('OutputEditExit'+id).style.display = "none";
	document.getElementById('OutputEditSave'+id).style.display = "none";
}

function Output_EditSave(id){
	var params = new Object();
	params['oid'] = id;
	params['name'] = document.getElementById('OutputInput'+id).value;
	
	var mySelect = document.getElementById("OutputPageFormatSelector"+id);
	var sid = mySelect.selectedIndex;
	params['format'] = mySelect.options[sid].value;
	
	var dateSideSelect = document.getElementById("OutputDateSideSelector"+id);
	var sid = dateSideSelect.selectedIndex;
	params['dateSide'] = dateSideSelect.options[sid].value;
	
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=Output_EditSave",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				if(returns['text']!="")
					alert(returns['text']);
				if(returns['ok']==1)
				{
					document.getElementById('OutputInput'+id).style.display = "none";
					document.getElementById('OutputInput'+id).value = returns['value'];
					document.getElementById('OutputText'+id).innerHTML = returns['value'];
					document.getElementById('OutputText'+id).style.display = "inline-block";
					document.getElementById('OutputPageFormatSelectorContainer'+id).style.display = "none";
					document.getElementById('OutputPageFormatSelector'+id).value = returns['format'];
					document.getElementById('FormatValue'+id).value = returns['format'];
					document.getElementById('OutputPageFormat'+id).innerHTML = returns['format'];
					document.getElementById('OutputPageFormat'+id).style.display = "inline-block";
					
					document.getElementById('OutputDateSideSelectorContainer'+id).style.display = "none";
					document.getElementById('OutputDateSideSelector'+id).value = returns['dateSide'];
					document.getElementById('DateSideValue'+id).value = returns['dateSide'];
					document.getElementById('OutputDateSide'+id).innerHTML = returns['dateSide'];
					document.getElementById('OutputDateSide'+id).style.display = "inline-block";
					
					document.getElementById('OutputEdit'+id).style.display = "inline-block";
					document.getElementById('OutputEditExit'+id).style.display = "none";
					document.getElementById('OutputEditSave'+id).style.display = "none";
				}
			}
		}
	);
}

function Output_Save()
{
	var params = new Object();
	params['name'] = document.getElementById('inname').value;
	
	var mySelect = document.getElementById("OutputPageFormatSelector");
	var sid = mySelect.selectedIndex;
	params['format'] = mySelect.options[sid].value;
	
	var dateSideSelect = document.getElementById("OutputDateSideSelector");
	var sid = dateSideSelect.selectedIndex;
	params['dateSide'] = dateSideSelect.options[sid].value;
	
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=Output_save",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				if(returns['text']!="")
					alert(returns['text']);
				if(returns['ok']==1)
				{
					document.getElementById('Outputlistcontainer').innerHTML = returns['Outputs'];
					Output_Clear();
				}
			}
		}
	);
}

function Output_Clear()
{
	document.getElementById('inname').value = "";
}

function All_Del()
{
	var params = new Object();
	if(confirm("Sollen die Ausgänge wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=OutputAll_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					var General = document.getElementById("Outputlist");
					General.tBodies[0].innerHTML = returns['Outputs'];
				}
			}
		);
	}
}

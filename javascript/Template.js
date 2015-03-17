function Template_Del(id)
{
	var params = new Object();
	params['id'] = id;
	if(confirm("Soll das Template wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=Template_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					
					if(returns['id'])
					{
						document.getElementById('Template'+returns['id']).style.display = "none";
					}
				}
			}
		);
	}
}

function All_Del()
{
	var params = new Object();
	if(confirm("Sollen die Templates wirklich gelöscht werden?"))
	{
		new Zikula.Ajax.Request(
			"ajax.php?module=Vermeldungen&func=TemplateAll_Del",
			{
				parameters: params,
				onComplete:	function (ajax) 
				{
					var returns = ajax.getData();
					var General = document.getElementById("Templatelist");
					General.tBodies[0].innerHTML = "";
				}
			}
		);
	}
}

function Template_load(id, nid){
	var params = new Object();
	params['id'] = id;
	params['nid'] = nid;
	
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=Template_load",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				
				if(returns['id'])
				{
					
					document.getElementById('attributeslist').innerHTML="";
					
					for(var i = 0; i < returns['fieldnum']; i ++){
						//create z-formrow
						var my_div = document.createElement('div');
						my_div.setAttribute("id", "attributediv"+i);
						my_div.setAttribute("class", "z-formrow");
						document.getElementById("attributeslist").appendChild(my_div);
	
						//create label
						var label = document.createElement('label');
						label.setAttribute("for", "attributediv"+i);
						label.setAttribute("id", "label"+i);
						document.getElementById("attributediv"+i).appendChild(label);
						document.getElementById("label"+i).innerHTML = returns['fieldname'+i]+":";
	
						//create input
						var feld = document.createElement('input');
						feld.setAttribute("type", "text");
						feld.setAttribute("name", "attribute"+i);
						feld.setAttribute("id", "attribute"+i);
						feld.setAttribute("value", returns['fieldvalue'+i]);
						feld.setAttribute("onChange", "getPreview()");
						document.getElementById("attributediv"+i).appendChild(feld);
	
						//create idfield
						var feld = document.createElement('input');
						feld.setAttribute("type", "hidden");
						feld.setAttribute("name", "attributeid"+i);
						feld.setAttribute("id", "attributeid"+i);
						feld.setAttribute("value", "0");
						document.getElementById("attributediv"+i).appendChild(feld);
						
						//create tfidfield
						var feld = document.createElement('input');
						feld.setAttribute("type", "hidden");
						feld.setAttribute("name", "attributetfid"+i);
						feld.setAttribute("id", "attributetfid"+i);
						feld.setAttribute("value", returns['fieldid'+i]);
						document.getElementById("attributediv"+i).appendChild(feld);
					}
					
					getPreview();
				}
			}
		}
	);
}

function getPreview(){
	var params = new Object();
	var params = new Object();
	params['tid'] = document.getElementById('tid').value;
	var i = 0;
	while(document.getElementById('attribute'+i) != null){
		params['attribute'+i] = document.getElementById('attribute'+i).value;
		params['attributetf'+i] = document.getElementById('attributetfid'+i).value;
		i ++;
	}
	params['attributenum'] = i;
	
	new Zikula.Ajax.Request(
		"ajax.php?module=Vermeldungen&func=Preview",
		{
			parameters: params,
			onComplete:	function (ajax) 
			{
				var returns = ajax.getData();
				document.getElementById("previewcontainer").innerHTML = returns['preview'];
			}
		}
	);
}

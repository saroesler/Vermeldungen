function New_Attribute(f)
{  
	//read number
	var attributes_num = parseInt(document.getElementById("attributes_num").value);
	attributes_num ++;
	
	//create z-formrow
	var my_div = document.createElement('div');
	my_div.setAttribute("id", "datediv"+attributes_num);
	my_div.setAttribute("class", "z-formrow");
	document.getElementById("fields").appendChild(my_div);
	
	//create label
	var label = document.createElement('label');
	label.setAttribute("for", "text");
	label.setAttribute("id", "label"+attributes_num);
	document.getElementById("datediv"+attributes_num).appendChild(label);
	document.getElementById("label"+attributes_num).innerHTML = "Attribut "+(attributes_num+1)+":";
	
	//create input
	var feld = document.createElement('input');
	feld.setAttribute("type", "text");
	feld.setAttribute("name", "attribute"+attributes_num);
	feld.setAttribute("id", "attribute"+attributes_num);
	feld.setAttribute("onChange", "New_Attribute(this.form)");
	document.getElementById("datediv"+attributes_num).appendChild(feld);
	
	//create idfield
	var feld = document.createElement('input');
	feld.setAttribute("type", "hidden");
	feld.setAttribute("name", "attributeid"+attributes_num);
	feld.setAttribute("id", "attributeid"+attributes_num);
	feld.setAttribute("value", "0");
	document.getElementById("datediv"+attributes_num).appendChild(feld);
	
	//set function to last input
	var last_id = attributes_num-1;
	var last_input = document.getElementById("attribute"+last_id);
	last_input.setAttribute("onChange", "");
	
	//save number
	document.getElementById("attributes_num").value = attributes_num;
}

function getPreview(){
	document.getElementById("previewcontainer").innerHTML = document.getElementById("value").value;
}

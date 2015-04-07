{pageaddvar name='stylesheet' value='modules/Vermeldungen/styles/style.css'}
{pageaddvar name="javascript" value="modules/Vermeldungen/javascript/Output.js"}

{include file='Admin/Header.tpl' __title='Output' icon='config'}

<div id="Outputlistcontainer">
	{$tabelle}
</div>

<table class="z-datatable">
	<thead>
		<tr>
			<th>{gt text='Name'}</th>
			<th>{gt text='Page Format'}</th>
			<th>{gt text='Date on side'}</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr> 
			<td><input type="text" name="inname" id="inname" maxlength="100" size="60"/></td>
			<td>{modapifunc modname='Vermeldungen' type='Admin' func='getPageFormatSelector' name=OutputPageFormatSelector"}</td>
			<td>{modapifunc modname='Vermeldungen' type='Admin' func='getDateSideSelector' name=OutputDateSideSelector"}</td>
			<td>
				<a onclick="Output_Save()" class="z-button">{img src='button_ok.png' modname='core' set='icons/extrasmall'}</a>
				<a onclick="Output_Clear()" class="z-button">{img src='button_cancel.png' modname='core' set='icons/extrasmall'}</a>
			</td>
		</tr>
	</tbody>
</table>
<a onclick="All_Del()" class="z-button">{gt text= "Delete all Outputs!"} {img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
{include file='Admin/Footer.tpl'}

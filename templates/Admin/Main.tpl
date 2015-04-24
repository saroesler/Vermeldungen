{pageaddvar name='javascript' value='jquery-ui'}
{pageaddvar name='stylesheet' value='javascript/jquery-ui/themes/base/jquery-ui.css'}
{pageaddvar name='javascript' value='javascript/jquery-plugins/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.js'}
{pageaddvar name='stylesheet' value='javascript/jquery-plugins/jQuery-Timepicker-Addon/jquery-ui-timepicker-addon.css'}

{pageaddvar name='stylesheet' value='modules/Vermeldungen/styles/style.css'}
{pageaddvar name="javascript" value="modules/Vermeldungen/javascript/GeneralVermeldungen.js"}
{pageaddvar name="javascript" value="modules/Vermeldungen/javascript/SpecialVermeldungen.js"}

{include file='Admin/Header.tpl' __title='Mainpage' icon='config'}

<style>
#normaltext .lumiculla_editor_bar{
	display:none;
}
#normaltext div{
	display:none;
}

/*td{
	text-align:center;
}*/
</style>
<form class="z-form" method="post" action="{modurl modname='Vermeldungen' type='admin' func='DataAdd'}">
	<div id="Vermeldungsliste">
		<table class="z-datatable" id="Terminvermeldungen">
			<thead>
				<tr>
					<th>{gt text='Date'}</th>
					<th>{gt text='Time'}</th>
					<th>{gt text='Text'}</th>
					<th></th>
					<th>{gt text='Standard'}</th>
					{foreach from=$outputs item='output'}
						<th>{$output->getName()}</th>
					{/foreach}
				</tr>
			</thead>
			<tbody>
				{foreach from=$datas item='data'}
					<tr id="Vermeldung{$data->getDid()}">
						<td>{$data->getDDateFormatted()}</td>
						<td>{$data->getDtimeFormatted()}</td>
						{if $data->getTid() == 0}
							<td>{$data->getDname()}</td>
						{else}
							<td>{modapifunc modname='Vermeldungen' type='Template' func='renderTemplate' nid=$data->getDid() dbtype='s'}</td>
						{/if}
						<td>
						<a href="{modurl modname=Vermeldungen type=admin func=dataEdit id=$data->getDid() class='special'}" class="z-button">{img src='xedit.png' modname='core' set='icons/extrasmall'}</a>
						<a onclick="SpecialVermeldungen_Del({$data->getDid()})" class="z-button">{img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
						</td>
						<td>
						{if $data->hasOutput(0) == 1}
							<input type="checkbox" id="specialOutput{$data->getDid()}_0" checked="checked" onchange="OutputSet({$data->getDid()}, 0, 'special')"/>
						{else}
							<input type="checkbox" id="specialOutput{$data->getDid()}_0" onchange="OutputSet({$data->getDid()}, 0, 'special')"/>
						{/if}
					</td>
					{foreach from=$outputs item='output'}
						<td>{if $data->hasOutput($output->getOid()) == 1}
							<input type="checkbox" id="specialOutput{$data->getDid()}_{$output->getOid()}" onchange="OutputSet({$data->getDid()}, {$output->getOid()}, 'special')" checked="checked"/>
						{else}
							<input type="checkbox" id="specialOutput{$data->getDid()}_{$output->getOid()}" onchange="OutputSet({$data->getDid()}, {$output->getOid()}, 'special')"/>
						{/if}
					</td>
					{/foreach}
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
		<table class="z-datatable">
			<thead>
				<tr>
					<th>{gt text='Date'}</th>
					<th>{gt text='Time'}</th>
					<th>{gt text='Text'}</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr> 
					<td><input type="text" name="indate" id="indate" maxlength="10" size="10"/></td>
					<script>
						jQuery(function() {
							jQuery( "#indate" ).datepicker();
							jQuery( "#indate" ).datepicker( "option", "dateFormat", "dd'.'mm'.'yy" );
						});
					</script>
					<td><input type="text" name="intime" id="intime" maxlength="5" size="5"/></td>
					<td id="normaltext"><textarea name="inname" id="inname" cols="60"></textarea></td>
					<td>
						<a onclick="SpecialVermeldungen_Save()" class="z-button">{img src='button_ok.png' modname='core' set='icons/extrasmall'}</a>
						<a onclick="SpecialVermeldungen_Clear()" class="z-button">{img src='button_cancel.png' modname='core' set='icons/extrasmall'}</a>
					</td>
				</tr>
			</tbody>
		</table>
	<input name="action" id="action" type="hidden" />
	<input name="id" id="id" type="hidden" />
	<a href="{modurl modname=Vermeldungen type=admin func=newNewsTemplate class='special'}" class="z-button">{gt text= "Create a news from a template"} {img src='edit_add.png' modname='core' set='icons/extrasmall'}</a>
</form>
<br/>
<h3>{gt text="General News"}</h3>
<form class="z-form" method="post" action="{modurl modname='Vermeldungen' type='admin' func='GeneralAdd'}">
	<div id="GeneralListe">
		<table class="z-datatable" id="Generalnews">
			<thead>
				<tr>
					<th>{gt text='Text'}</th>
					<th></th>
					<th>{gt text='Standard'}</th>
					{foreach from=$outputs item='output'}
						<th>{$output->getName()}</th>
					{/foreach}
				</tr>
			</thead>
			<tbody>
				{foreach from=$general item='gener'}
					<tr id="General{$gener->getGid()}">
						{if $gener->getTid() == 0}
							<td colspan="5">{$gener->getGname()|notifyfilters:'vermeldungen.filter_hooks.users_view'}</td>
						{else}
							<td colspan="5">{modapifunc modname='Vermeldungen' type='Template' func='renderTemplate' nid=$gener->getGid() dbtype='g'}</td>
						{/if}
						<td>
						<a href="{modurl modname=Vermeldungen type=admin func=GeneralEdit id=$gener->getGid() class='general'}" class="z-button">{img src='xedit.png' modname='core' set='icons/extrasmall'}</a>
						<a onclick="GeneralVermeldungen_Del({$gener->getGid()})" class="z-button" class="z-button">{img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
						</td>
						<td>
							{if $gener->hasOutput(0) == 1}
								<input type="checkbox" id="generalOutput{$gener->getGid()}_0" checked="checked" onchange="OutputSet({$gener->getGid()}, 0, 'general')"/>
							{else}
								<input type="checkbox" id="generalOutput{$gener->getGid()}_0" onchange="OutputSet({$gener->getGid()}, 0, 'general')"/>
							{/if}
						</td>
						{foreach from=$outputs item='output'}
							<td>{if $gener->hasOutput($output->getOid()) == 1}
								<input type="checkbox" id="generalOutput{$gener->getGid()}_{$output->getOid()}" onchange="OutputSet({$gener->getGid()}, {$output->getOid()}, 'general')" checked="checked"/>
							{else}
								<input type="checkbox" id="generalOutput{$gener->getGid()}_{$output->getOid()}" onchange="OutputSet({$gener->getGid()}, {$output->getOid()}, 'general')"/>
							{/if}
						</td>
						{/foreach}
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
		<table class="z-datatable">
			<colgroup>
				<col width="">
				<col width="120">
			</colgroup>
			<thead>
				<tr>
					<th>{gt text='Text'}</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr> 
					<td><textarea name="ginname" id="ginname" cols="60"></textarea></td>
					<td>
						<a onclick="GeneralVermeldungen_Save()" class="z-button">{img src='button_ok.png' modname='core' set='icons/extrasmall'}</a>
						<a onclick="GeneralVermeldungen_Clear()" class="z-button">{img src='button_cancel.png' modname='core' set='icons/extrasmall'}</a>
					</td>
				</tr>
			</tbody>
		</table>
	<input name="gaction" id="gaction" type="hidden" />
	<input name="gid" id="gid" type="hidden" />
</form>
<a href="{modurl modname=Vermeldungen type=admin func=newNewsTemplate class='general'}" class="z-button">{gt text= "Create a general news from a template"} {img src='edit_add.png' modname='core' set='icons/extrasmall'}</a>
<a onclick="All_Del()" class="z-button">{gt text= "Delete all News!"} {img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
{include file='Admin/Footer.tpl'}

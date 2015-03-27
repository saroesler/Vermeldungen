<table class="z-datatable" id="Outputlist">
	<thead>
		<tr>
			<th>{gt text='Id'}</th>
			<th>{gt text='Name'}</th>
			<th>{gt text='Page Format'}</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr id="Output0">
				<td>0</td>
				<td><a style="margin:0px" href="{modapifunc modname='Vermeldungen' type='user' func='view' id='0'}">{gt text = "Standard Output"}</a></td>
				<td>A4</td>
				<td></td>
			</tr>
		{foreach from=$outputs item='output'}
			<tr id="Output{$output->getOid()}">
				<td>{$output->getOid()}</td>
				<td >
					<a style="margin:0px" href="{modapifunc modname='Vermeldungen' type='user' func='view' oid=$output->getOid()}" id="OutputText{$output->getOid()}">{$output->getName()}</a>
					<input type="text" name="OutputInput" id="OutputInput{$output->getOid()}" maxlength="100" size="60" value="{$output->getName()}" style="display:none;"/>
				</td>
				<td >
					<a style="margin:0px" id="OutputPageFormat{$output->getOid()}">{$output->getPageFormat()}</a>
					<div id="OutputPageFormatSelectorContainer{$output->getOid()}" style="display:none;">
						<input type="hidden"id="FormatValue{$output->getOid()}" maxlength="100" size="60" value="{$output->getPageFormat()}"/>
						{assign var="oid" value=$output->getOid()}
						{modapifunc modname='Vermeldungen' type='Admin' func='getPageFormatSelector' name=OutputPageFormatSelector$oid selected=$output->getPageFormat() style="display:none;"}
					</div>
				</td>
				<td>
				<a onclick="Output_Edit({$output->getOid()})" class="z-button" id="OutputEdit{$output->getOid()}">{img src='xedit.png' modname='core' set='icons/extrasmall'}</a>
				<a onclick="Output_EditSave({$output->getOid()})" class="z-button" style="display:none;" id="OutputEditSave{$output->getOid()}">{img src='button_ok.png' modname='core' set='icons/extrasmall'}</a>
				<a onclick="Output_EditExit({$output->getOid()})" class="z-button" style="display:none;" id="OutputEditExit{$output->getOid()}">{img src='button_cancel.png' modname='core' set='icons/extrasmall'}</a>
				<a onclick="Output_Del({$output->getOid()})" class="z-button">{img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>

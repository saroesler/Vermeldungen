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

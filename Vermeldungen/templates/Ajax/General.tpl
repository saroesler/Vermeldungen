<table class="z-datatable"  id="Generalnews">
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

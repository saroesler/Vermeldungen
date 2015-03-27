{if $general}
	<table>
		{foreach from=$general item='genera'}
			<tr>
				<td colspan="5">{$genera->getGname()|notifyfilters:'vermeldungen.filter_hooks.users_view'}</td>
			</tr>
		{/foreach}
	</table>
{/if}

<style>
	td, th{
		vertical-align:top;
	}
	
	.Vermeldungen_Abstand{
		width:2px;
	}
	
	.lumiculaParser p, .lumiculaParser table{
		margin:0px;
	}
</style>

{pageaddvar name='stylesheet' value='modules/Vermeldungen/styles/style.css'}

{checkpermission component="Vermeldungen::" instance="::" level=ACCESS_ADMIN assign=admin}
	{if $admin}
		<a href="{modurl modname='Vermeldungen' type='admin' func='main'}" >{img src='configure.png' modname='core' set='icons/extrasmall'}{gt text='Admin page'}</a>
	{/if}

<h1>Vermeldungen</h1>
	<table cellspacing="10px">
	{assign var="last" value=0}
	{assign var="row" value=0}
	{assign var="date" value=0}
	{foreach from=$datas item='data'}
		{if (($dates.$date.row-1)==$row)}
				<tr style="height:15px;"><td colspan="5"></td></tr>
			{assign var="row" value=$row+1}
			<tr>
				<td rowspan={$dates.$date.rows} style="width:60px;">{$data->getDDateFormattedout()}</td>
			{assign var="date" value=$date+1}
		{else}
			<tr>
		{/if}
			<td class="Vermeldungen_Abstand"></td>
			<td style="text-align:right; width:60px;"><nobr>{$data->getDtimeFormatted()} Uhr</nobr></td>
			<td class="Vermeldungen_Abstand"></td>
			{if $data->getTid() == 0}
				<td>{$data->getDname()}</td>
			{else}
				<td>{modapifunc modname='Vermeldungen' type='Template' func='renderTemplate' nid=$data->getDid() dbtype='s'}</td>
			{/if}
			{assign var="last" value=$data->getDDateFormatted()}
		</tr>
		{assign var="row" value=$row+1}
	{/foreach}
	{foreach from=$general item='genera'}
		<tr style="height:15px;"><td colspan="5"></td></tr>
		<tr>
			{if $genera->getTid() == 0}
				<td colspan="5">{$genera->getGname()|notifyfilters:'vermeldungen.filter_hooks.users_view'}</td>
			{else}
				<td colspan="5">{modapifunc modname='Vermeldungen' type='Template' func='renderTemplate' nid=$genera->getGid() dbtype='g'}</td>
			{/if}
		</tr>
	{/foreach}
	</table>
	<br/>
	<br/>


<style>
	p, a, td, li, th {
		font-family: Arial,Helvetica,Geneva,Sans-serif;
		font-size: 14px;
		line-height: 1.5em;
	}
	td, th{
		vertical-align:top;
	}

	.Vermeldungen_Abstand{
		width:2px;
	}
</style>

{$heading}

<br/>
<br/>

<table cellspacing="5px">
	{assign var="last" value=0}
	{assign var="row" value=0}
	{assign var="date" value=0}
	{foreach from=$datas item='data'}
		{if (($dates.$date.row-1)==$row)}
				<tr style="height:15px;"><td colspan="5"></td></tr>
			{assign var="row" value=$row+1}
			<tr>
				<td rowspan="{$dates.$date.rows}" style="width:65px;"><nobr>{$data->getDDateFormattedout()}</nobr></td>
			{assign var="date" value=$date+1}
		{else}
			<tr>
		{/if}
			<td class="Vermeldungen_Abstand"></td>
			<td style="text-align:right; width:55px;"><nobr>{$data->getDtimeFormatted()} Uhr</nobr></td>
			<td class="Vermeldungen_Abstand"></td>
			<td style="width: 230px">{$data->getDname()}</td>
			{assign var="last" value=$data->getDDateFormatted()}
		</tr>
		{assign var="row" value=$row+1}
	{/foreach}
</table>

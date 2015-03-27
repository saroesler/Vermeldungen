<style>
	p, a, td, li, th {
		font-family: Arial,Helvetica,Geneva,Sans-serif;
		font-size: 30px;
		line-height: 1.5em;
	}
	td, th{
		vertical-align:top;
	}

	.Vermeldungen_Abstand{
		width:0.10cm;
	}
</style>

{$heading}

<br/>
<br/>
{if $datas}
<table cellspacing="5px">
	{assign var="row" value=0}
	{foreach from=$datas item='data'}
				<tr style="height:15px;"><td colspan="5"></td></tr>
			{assign var="row" value=$row+1}
			<tr>
				<td style="width: 8cm" align="justify" >{$data->getDname()}</td>
			<td class="Vermeldungen_Abstand"></td>
			<td rowspan="{$dates.$date.rows}" style="width:2.5cm;"><nobr>{$data->getDDateFormattedout()}</nobr></td>
			{*<td class="Vermeldungen_Abstand"></td>*}
			<td style="text-align:right; width:1.5cm;"><nobr>{$data->getDtimeFormatted()} Uhr</nobr></td>
		</tr>
		{assign var="row" value=$row+1}
	{/foreach}
</table>
{/if}

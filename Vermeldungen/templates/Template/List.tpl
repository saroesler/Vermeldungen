{include file='Admin/Header.tpl' __title='List Templates' icon='cubes'}

{pageaddvar name='stylesheet' value='modules/Vermeldungen/styles/style.css'}
{pageaddvar name="javascript" value="modules/Vermeldungen/javascript/Template.js"}

<div id="Templatelistcontainer">
	<table class="z-datatable" id="Templatelist">
		<thead>
			<tr>
				<th>{gt text='Name'}</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$templates item='template'}
				<tr id="Template{$template->getTid()}">
					<td>{$template->getName()}</td>
					<td>
					<a href="{modurl modname=Vermeldungen type=admin func=EditTemplate id=$template->getTid()}" class="z-button">{img src='xedit.png' modname='core' set='icons/extrasmall'}</a>
					<a onclick="Template_Del({$template->getTid()})" class="z-button">{img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
					</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
</div>
<a onclick="All_Del()" class="z-button">{gt text= "Delete all Templates!"}{img src='14_layer_deletelayer.png' modname='core' set='icons/extrasmall'}</a>
{include file='Admin/Footer.tpl'}

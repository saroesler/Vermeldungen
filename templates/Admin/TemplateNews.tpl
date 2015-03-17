{pageaddvar name="javascript" value="jquery-ui"}
{pageaddvar name="stylesheet" value="javascript/jquery-ui/themes/base/jquery-ui.css"}
{pageaddvar name="javascript" value="modules/Vermeldungen/javascript/Template.js"}

<script language="javaScript">
function id_datepicker(id)
{
	jQuery( "#"+id ).datepicker();
	jQuery( "#"+id ).datepicker( "option", "dateFormat", "dd.mm.yy");
	var value= document.getElementById('indate_org').value;
	jQuery( "#"+id ).datepicker('setDate', value);
}
jQuery(function() {
	id_datepicker("ddate");
});
</script>

{include file='Admin/Header.tpl' __title='Editor' icon='add'}
{form cssClass="z-form"}
    <fieldset>
        <legend>{gt text='Template News Editor'}</legend>
        {formvalidationsummary}
        <div class="z-formrow">
			{formlabel for='tid' __text='Template:'}
			{formdropdownlist id="tid" size="1" mandatory=true items=$forms selectedValue=$data->getTid() onchange="Template_load(document.getElementById('tid').value)"}
		</div>
		{if $class == 'special'}
			<div class="z-formrow">
				{formlabel for='ddate' __text='Date:'}
				{formtextinput id="ddate" maxLength=300 mandatory=true}
				{if $new == 0 }
					<input type="hidden" id="indate_org" value="{$data->getDDateFormatted()}"/>
				{else}
					<input type="hidden" id="indate_org" value=""/>
				{/if}
				<script type="text/javascript">
					jQuery(function() {
						jQuery( "#ddate" ).datepicker();
						jQuery( "#ddate" ).datepicker( "option", "dateFormat", "dd'.'mm'.'yy" );
					});
				</script>
			</div>
			<div class="z-formrow">
				{formlabel for='dtime' __text='Time:'}
				{if $new == 0 }
					{formtextinput id="dtime" maxLength=300 mandatory=true text=$data->getDTimeFormatted()}
				{else}
					{formtextinput id="dtime" maxLength=300 mandatory=true}
				{/if}
			
			</div>
		{/if}
	   <fieldset>
        <legend>{gt text='Attributes'}</legend>
        <div id="attributeslist">
        </div>
        </fieldset>
    </fieldset>
    
    <div class="z-formbuttons z-buttons">
	   {formbutton class="z-bt-ok" commandName="save" __text="Save"}
	   {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
   </div>
   <fieldset>
        <legend>{gt text='Preview'}</legend>
        <div id="previewcontainer">
        </div>
        </fieldset>
    </fieldset>
{/form}
<input type="hidden" id="nid" value="{$data->getId()}">

<script type="text/javascript">
	Template_load(document.getElementById('tid').value, document.getElementById('nid').value)
</script>
{include file='Admin/Footer.tpl'}

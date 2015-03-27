{pageaddvar name="javascript" value="jquery-ui"}
{pageaddvar name="stylesheet" value="javascript/jquery-ui/themes/base/jquery-ui.css"}
{pageaddvar name="javascript" value="modules/Miniplan/javascript/WorshipForm.js"}
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


<style>
#normaltext .lumiculla_editor_bar{
	display:none;
}
#normaltext div{
	display:none;
}
</style>

{include file='Admin/Header.tpl' __title='Editor' icon='xedit'}
{form cssClass="z-form"}
    <fieldset>
        <legend>{gt text='Church Editor'}</legend>
        {formvalidationsummary}
        <table class="z-datatable">
        	<thead>
        		<th>
        			<label for="ddate">{gt text='Date'}</label>
        		</th>
        		<th>
        			<label for="dtime">{gt text='Time'}</label>
        		</th>
        		<th>
        			<label for="ddata">{gt text='Text'}</label>
        		</th>
        	</thead>
        	<tbody>
        		<td>
        			<div class="z-formrow">
            			{formtextinput id="ddate" maxLength=300 mandatory=true text=$data->getDdateFormatted()}
						<input type="hidden" name="indate_org" id="indate_org" value="{$data->getDdateFormatted()}"/>
            			<script type="text/javascript">
						jQuery(function() {
							jQuery( "#ddate" ).datepicker();
							jQuery( "#ddate" ).datepicker( "option", "dateFormat", "dd'.'mm'.'yy" );
						});
						</script>
        			</div>
        		</td>
        		<td>
        			<div class="z-formrow">
            			{formtextinput id="dtime" maxLength=300 mandatory=true text=$data->getDtimeFormatted()}
        			</div>
        		</td>
        		<td>
        			<div class="z-formrow"  id="normaltext">
            			{formtextinput id="dname" maxLength=3000 mandatory=true rows=4 textMode='multiline' text=$data->getDname()}
        			</div>
        		</td>
        	</tbody>
        </table>
       
	   <div class="z-formbuttons z-buttons">
		   {formbutton class="z-bt-ok" commandName="save" __text="Save"}
		   {formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
	   </div>
    </fieldset>
{/form}

{include file='Admin/Footer.tpl'}

{include file='Admin/Header.tpl' __title='Template Editor' icon='cubes'}
<style>
.normaltext .lumiculla_editor_bar{
	display:none;
}
.normaltext div{
	display:none;
}
</style>
{pageaddvar name="javascript" value="modules/Vermeldungen/javascript/NewTemplate.js"}
{form cssClass="z-form"}
    <fieldset>
        <legend>{gt text='Template Editor'}</legend>
        {formvalidationsummary}
        <div class="z-formrow">
			{formlabel for='time' __text='Name:'}
			{formtextinput id="name" maxLength=300 mandatory=true text=$data->getName()}
		</div>
		<div class="z-informationmsg">
			<p>{gt text="You can insert your template via HTML. For Variables, you has to use &#123;YOUR VARIABLE&#125;. This Name you has to fill in the attribute list below."}</p>
		</div>
		<div class="z-formrow normaltext">
			{formlabel for='time' __text='Template:'}
			{formtextinput id="value" maxLength=300 mandatory=true lines=10 rows=10 textMode='multiline' text=$data->getValue() onChange="getPreview()"}
		</div>
		<fieldset>
			<legend>{gt text='Attributes'}</legend>
			<div id="fields">
				{assign var="attid" value=0}
				{foreach from=$fields item='field'}
			   		<div  class="z-formrow">
						<label for="text">{gt text='Attribute'} {$attid+1}:</label>
						<input type="text" name="attribute{$attid}" id="attribute{$attid}" value="{$field->getName()}"/>
						<input type="hidden" name="attributeid{$attid}" id="attributeid{$attid}" value="{$field->getTfid()}"/>
						{assign var="attid" value=$attid+1}
			   		</div>
			   	{/foreach}
			   	<div class="z-formrow">
					<label for="text">{gt text='Attribute'} {$attid+1}:</label>
					<input type="text" name="attribute{$attid}" id="attribute{$attid}"  onChange="New_Attribute(this.form)"/>
					<input type="hidden" name="attributeid{$attid}" id="attributeid{$attid}" value="0"/>
				</div>
			</div>
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
    <input type="hidden" id="attributes_num" name="attributes_num" value={$attid}>
    <script type="text/javascript">
    	getPreview();
    </script>
{/form}

{include file='Admin/Footer.tpl'}

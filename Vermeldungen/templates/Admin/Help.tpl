{modavailable modname="Help" assign="help_modul"}

{include file="Admin/Header.tpl" __title="Worships" icon="display"}

<h2>{gt text="Help"}</h2>

{if help_modul}
<script type="text/javascript">
<!--
window.location = "modules/Help/docs/pdf/Autoren_Gottesdienste.pdf"
//-->
</script>
{else}
<h3><u>{gt text="Add and manage a Church"}</u></h3>
<p><b>{gt text="It is necessary for the hole module to create a church."}</b></p>
<p>{gt text="You can manage the churches by clicking the \"church\" button in the headermenue of this module.You can see a list of all Churches there. There are shown the name, the adress and an internel ID. In the right there are buttons. With the rubbish you can delete Churches, with the green peg you can add a church and with the red cross you can delete the inputboxes befor adding."}</p>

<h3><u>{gt text="Add and manage a special worship"}</u></h3>
<p><b>{gt text="For a special worship is is nacessary to create a church and a special day."}</b></p>
<p>{gt text="You can manage the special worships by clicking the \"Special worships\" button in the headermenue of this module.You can see a list of all special days there. There are shown the title, the date and the internel ID of this Day. On the right there are buttons. With the rubbish you delete the day, with the right arrow you cahnge into the special worship area, to add and manage worships for this day. You see on the page a green peg, too. With this you can add a special day, with the red cross, you can delete the inputboxes befor adding.If you have create a special day, you can click on the right arrow button. You get the special worship page for this day. The day title is shown above the table. You see here again a list. This time with all special worships of this day. There is the rubbish again, to delete the worship. With the green arrow, you can add a worship after given a title and a time(format: \"hour:minuts\") and selecting a chuch in the list for this worship. With the red cross you can delete your input."}</p>

<h3><u>{gt text="Add and manage a daily worship"}</u></h3>
<p><b>{gt text="For a daily worship is is nacessary to create a church and a daily day."}</b></p>
<p>{gt text="You can manage the daily worships by clicking the \"Daily worships\" button in the headermenue of this module. You see there again a list. This time of all daily worships. There is the rubbish again, to delete the worship. With the green arrow, you can add a worship after given a title and a time(format: \"hour:minuts\") and selecting a chuch in the list for this worship and a day, when the worships happens. With the red cross you can delete your input."}</p>

<h3><u>{gt text="view"}</u></h3>
<p>{gt text="To view the worships you can use three different types on the main page. At first you can view all worships, the second type is to view only the specail worships and the third type is to view only the daily worships. You can use the URL of the viewsides to show the sides in public."}<p>
{/if}
{include file="Admin/Footer.tpl"} 

<?php
//---FUNCTION html_add_grp_form()--------------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: none
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_add_grp_form()
{
    GLOBAL $trunks, $l18n;
    $html = '<h3>&nbsp&nbsp&nbsp&nbsp '.
	    $l18n['egroups'].'</h3>'.
	    '<table style="padding : 1px 12px;" width="100%">'.
		'<tr>'.
		    '<td>'.
			'<font id="grp_title">'.
			    $l18n['gname'].' :'.
			'</font><br>'.
			'<input id="grp_name" type="text" size=40 '.
			'maxlength="40"><br><br>'.
		    '</td>'.
		'</tr>'.
		'<tr>'.
		    '<td>'.
			'<table width="100%" border=1 id="grptable">'.
			    '<tr>'.
				'<td id="n" align="center" width="20">'.
				    'n'.
				'</td>'.
				'<td>'.
				    'Name'.
				'</td>'.
				'<td>'.
				    'Phone #'.
				'</td>'.
				'<td>'.
				    'e-mail'.
				'</td>'.
			    '</tr>'.
			'</table>'.
		    '</td>'.
		'</tr>'.
		'<tr>'.
		    '<td>'.
		    '<form id="addnewgrp">'.
		    '<table align="right">'.
			'<tr>'.
			    '<td>'.
				'<font id="usr_title">'.
			        $l18n['uname'].' : '.
				'</font>'.
			    '</td>'.
			    '<td>'.
				'<input id="usr_name" '.
				'type="text" size="35" maxlength="20">'.
			    '</td>'.
			'</tr>'.
			'<tr>'.
			    '<td>'.
				$l18n['proto'].' : '.
			    '</td>'.
			    '<td>'.
				'<select id="proto">'.
				    '<option value="SIP">SIP</option>'.
				    '<option value="IAX2">IAX2</option>'.
				    '<option value="ZAP">ZAP</option>'.
				    '<option value="DAHDI">DAHDI</option>'.
				    '<option value="VPB">VPB</option>'.
				    '<option value="H323">H.323</option>'.
				    '<option value="SCCP">SCCP</option>'.
				'</select> '.
				' Trunk'.' : '.
				    $trunks.
			    '</td>'.
			'</tr>'.
			'<tr>'.
			    '<td>'.
				$l18n['phn'].
			    '</td>'.
			    '<td>'.
				'<input id="pn" type="text" size="35" maxlength="20">'.
			    '</td>'.
			'</tr>'.
			'<tr>'.
			    '<td>'.
				'e-mail'.
			    '</td>'.
			    '<td>'.
				'<input id="email" type="text" size="35" >'.
			    '</td>'.
			'</tr>'.
			'<tr>'.
			    '<td colspan="2" align="right">'.
				'<input type="button" id="addgrpuser" '.
				'value="'.$l18n['add'].'"'. 
				'onClick="addUserIntoGroup();">'.
				'&nbsp&nbsp&nbsp'.
				'<input type="button" id="save" '.
				'value="'.$l18n['save'].
				'" onClick="saveGroup();">'.
			    '</td>'.
			'</tr>'.
		    '</table>'.
		    '</form>'.
		    '</td>'.
		'</tr>'.
	    '</table>';
    
        
    return $html;
}
?>
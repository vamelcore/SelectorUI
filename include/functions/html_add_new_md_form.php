<?php
//---FUNCTION html_invite_users_form()-------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: none
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_add_new_md_form()
{
    GLOBAL $l18n;
	$groups = html_get_groups( 1 );
    
    $html = '<table>'.	
	'<tr>'.
	    '<td width=290>'.
		'<h3>&nbsp&nbsp&nbsp '.'Create new MD'.'</h3>'.
	    '</td>'.
	    '<td align="right" >'.
	    '</td>'.
	'</tr>'.
    '</table>'.
	'<input id="file_upload" type="file" name="file_upload">'.
		'<div id="upl_res"></div>'.
    '<table style="padding : 5px" width="485">'.
	'<tr>'.
	    '<td>'.
		'<table id="invusr" border=1 width="100%">'.
		    '<tr>'.
			'<td width=25 align="center">'.
			    '<b>'.'N'.'</b>'.
			'</td>'.
			'<td>'.
			    '<b>'.'Name'.'</b>'.
			'</td>'.
			'<td>'.
			    '<b>'.'Phone #'.'</b>'.
			'</td>'.
			'<td>'.
			    '<b>'.'e-mail'.'</b>'.
			'</td>'.
		    '</tr>'.
		'</table>'.
	    '</td>'.
	'</tr>'.
	'<tr>'.
	'</tr>'.
    '</table>'.
    '<table style="padding: 1px 10px;">'.
	'<tr>'.
	    '<td width=200 valign="top">'.
    '<select id="grp_select">'.
	$groups.
    '</select>'.
    '&nbsp&nbsp&nbsp'.
    '<input type="button" value="'.$l18n['add'].
	'" onClick="addUserInviteGroup();"><br>'.
	    '<font color="gray">'.
		'&nbsp&nbsp '.$l18n['addagf'].
	    '</font>'.
	    '</td>'.
	    '<td width=267 align="right">'.
		'<input id="invbtn" type="button" value="'.'Dial'.'" '.
		'disabled="disabled" onClick="massDial();">'.
	    '</td>'.
	'</tr>'.
    '</table>';
    return $html;
}
?>
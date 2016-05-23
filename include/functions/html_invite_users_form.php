<?php
//---FUNCTION html_invite_users_form()-------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: $con_num     - conference number
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_invite_users_form( $con_num )
{
    GLOBAL $l18n;
    $time = new Conference( $con_num );
    $start_date = date( 'G:i d/M', strtotime( $time->params['startTime'] ));
    $groups = html_get_groups( 1 );
    
    $html = '<table>'.	
	'<tr>'.
	    '<td width=290>'.
		'<h3>&nbsp&nbsp&nbsp '.$l18n['inviteinto'].' : &nbsp'.
		'<b style="color:gray;">"'.$con_num.'"</b></h3>'.
	    '</td>'.
	    '<td align="right" >'.
		'<img src="images/icons/calendar.png">&nbsp&nbsp '.
		$l18n['stime'].'&nbsp '.
		'<b>'.$start_date.'</b>'.
	    '</td>'.
	'</tr>'.
    '</table>'.
    '<table style="padding : 5px" width="485">'.
	'<tr>'.
	    '<td>'.
		'&nbsp&nbsp&nbsp'.
		'<img src="images/icons/phone.png">'.
		    '<input id="byphone" type="checkbox" checked="true">&nbsp -'.$l18n['byphone'].
		    '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.
		'<img src="images/icons/file_edit.png">'.
		    '<input id="byemail" type="checkbox">&nbsp -'.$l18n['byemail'].
	    '</td>'.
	'</tr>'.
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
    '<table>'.
	'<tr>'.
	    '<td width=200 valign="top">'.
    '&nbsp&nbsp&nbsp'.
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
		'<input id="invbtn" type="button" value="'.$l18n['invite'].'" '.
		'disabled="disabled" onClick="inviteGroup();">'.
		'&nbsp&nbsp '.
		'<input id="delta" type="text" size="2" '.
		'maxlength="2" align="center" value="3">'.
		'&nbsp '.$l18n['mbefore'].
		'<br>'.
		$l18n['or'].' <a id="inow" style="color: white;" href="#" '.
		'onClick="$(\'#startTime\').val(\''.date('U').'\');'.
			  '$(\'#delta\').val(\'0\');'.
			  'inviteGroup();">'.
		    $l18n['now'].
		'</a>'.
		'<input type="hidden" id="startTime" value="'.
		    $time->params['startTime'].'">'.
		'<input type="hidden" id="grp_n">'.
		'<input type="hidden" id="roomNo" '.
		'value="'.$con_num.'">'.
	    '</td>'.
	'</tr>'.
    '</table>';
    return $html;
}
?>

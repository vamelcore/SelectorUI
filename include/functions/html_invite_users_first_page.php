<?php
//---FUNCTION html_invite_users_form()-------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: $con_num     - conference number
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_invite_users_first_page( $con_num )
{
    GLOBAL $l18n;
    $time = new Conference( $con_num );
    $start_date = date( 'G:i d/M', strtotime( $time->params['startTime'] ));
    $groups = html_get_groups( 1 );
    
    $html = '<table>'.	
	'<tr>'.
	    '<td width=485>'.
		'<h3>&nbsp&nbsp&nbsp '."ПРИГЛАСИТЬ УЧАСТНИКОВ В СЕЛЕКТОР".' : &nbsp'.
		'<b style="color:gray;">"'.$con_num.'"</b></h3>'.
	    '</td>'.
	'</tr>'.
    '</table>'.
    '<table style="padding : 5px" width="485">'.
	'<tr>'.
	    '<td width=485 valign="top">'.
    '&nbsp&nbsp&nbsp'.
    '<select id="grp_select">'.
	$groups.
    '</select>'.
    '&nbsp&nbsp&nbsp'.
    '<input type="button" value="'.'НАЧАТЬ СЕЛЕКТОР'.
	'" onClick="addUserInviteGroup(); inviteGroup(); showUsers('.$con_num.');"><br>'. //!!!!!!!! MY EDIT
	    '<font color="gray">'.
		'&nbsp&nbsp '.$l18n['addagf'].
	    '</font>'.
	    '</td>'.
	    '<td width=267 align="right">'.
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

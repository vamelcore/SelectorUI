<?php
//---FUNCTION html_send_susers_form()--------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: none
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_send_susers_form()
{
    GLOBAL $l18n, $auth_info;
    $users = array();
    
    $html = '<table style="padding: 1px 10px;">'.
		'<tr>'.
		    '<td>'.
			'<h3>'.
			    $l18n['chpass'].':'.
			'</h3>'.
		    '</td>'.
		'</tr>'.
	    '</table>';
    if( $auth_info['username'] == 'admin' )
    {
	$html = $html.
		'<table style="padding: 1px 10px;">'.
		    '<tr>'.
			'<td width="200">'.
			    $l18n['edchpass'].':'.
			'</td>'.
			'<td>'.
			    '<input type="password" id="passed">'.
			    '&nbsp&nbsp'.
			'</td>'.
			'<td>'.			    
			'</td>'.
		    '</tr>'.
		    '<tr>'.
			'<td>'.
			    $l18n['edconf'].': '.
			'</td>'.
			'<td>'.
			    '<input type="password" id="confed" '.
			    'onKeyUp="edConfirmKP();">'.
			    '&nbsp&nbsp'.
			'</td>'.
			'<td>'.
			    '<img src="images/icons/error.png" id="confpic">'.
			'</td>'.
		    '</tr>'.
		    '<tr>'.
			'<td colspan="2" align="right">'.
			    '<input type="button" value="'.$l18n['change'].'" '.
			    ' onClick="chAdminPass();" id="chpass">'.
			    '&nbsp&nbsp'.
			'</td>'.
			'<td>'.
			    '<img src="images/icons/error.png" id="chpic">'.
			'</td>'.
		    '</tr>'.
		'</table>'.
		'<table style="padding: 1px 10px;">'.
		    '<tr>'.
			'<td colspan="2">'.
			    '<h3>'.
				$l18n['susers'].':'.
			    '</h3>'.
		    '</tr>';
		$users = file( 'include/passwd' );
		foreach( $users as $usr )
		{
		    $usr_info = explode( ":", $usr );
		    if( $usr_info[0] != 'admin' )
		    {
			$html = $html.
			'<tr>'.
			    '<td align="right" width="30">'.
				'<img src="images/icons/Person.png">'.    
			    '</td>'.
			    '<td align="left" width=100>'.
				'<font color="black" id="'.$usr_info[0].'">'.
				    $usr_info[0].
				'</font>'.
			    '</td>'.
			    '<td>'.
				'<font color="green">md5:</font> '.
				$usr_info[2].
			    '</td>'.
			    '<td width="50" align="right">'.
				'<a href="#" onClick="rmSUser(\''.
				    $usr_info[0].'\')">'.
				    '<img src="images/icons/Erase.png">'.
				'</a>'.
			    '</td>'.
			'</tr>';
		    }
		}		
		$html=$html.'</table>'.
		'<table style="padding: 10px 10px;">'.
		    '<tr>'.
			'<td colspan="4">'.
			    '<h3>'.
				$l18n['addsuser'].':'.
			    '</h3>'.
			'</td>'.
		    '</tr>'.
		    '<tr>'.
			'<td width="200">'.
			    $l18n['suname'].':'.
			'</td>'.
			'<td>'.
			    '<input type="text" id="username" '.
			    'maxlength="15">'.
			'</td>'.
		    '</tr>'.
		    '<tr>'.
			'<td>'.
			    $l18n['supass'].':'.
			'</td>'.
			'<td>'.
			    '<input type="text" id="password" '.
			    'maxlength="15">'.
			'</td>'.
		    '</tr>'.
		    '<tr>'.
			'<td colspan="3" align="right">'.
			    '<input type="button" value="'.$l18n['add'].
			    '" id="addsuser"'.
			    ' onClick="addSUser();">'.
			'</td>'.
			'<td>'.
			    '<img src="images/icons/blank.png" '.
			    'id="addupic">'.
			'</td>'.
		    '</tr>'.
		'</table>';
		
		
    }
    else
    {
	$html = $html.'&nbsp&nbsp&nbsp&nbsp'.
		'<font color="red">'.
		    $auth_info['username'].
		    ', you must login as "admin"!'.
		'</font>';
    }
    return $html;
}
?>
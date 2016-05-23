<?php
//---FUNCTION html_get_groups()--------------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: none
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_get_groups( $aid )
{
    GLOBAL $auth_info;
    $html = "";
    if( $auth_info['username'] != 'admin' )
	$owner = ' WHERE grp_owner = \''.$auth_info['username'].'\'';
    else
	$owner = '';
    $result = mysql_query('SELECT DISTINCT grp_n, grp_name, grp_owner '.
			  'FROM invite '.$owner.';');
    if ( !$result )
    {
	echo "ERROR: ".mysql_error();
	return false;
    }
    switch ( $aid )
    {
	case 1:
	    $count = mysql_num_rows( $result );
	    for( $i = 0; $i < $count; $i++ )
	    {
		$grp = mysql_fetch_assoc( $result );
		$html = $html.'<option value="'.$grp['grp_n'].'">'.
		$grp['grp_name'].'</option>';
	    }
	break;
	case 2:
	    $html = '<table border="1" width="460">';
	    $count = mysql_num_rows( $result );
	    for( $i = 0; $i < $count; $i++ )
	    {
		$grp = mysql_fetch_assoc( $result );
		$editgrp_pic = '';
		if( $grp['grp_owner'] == $auth_info['username'] )
		    $editgrp_pic = '<img onClick="editGroup(\''.
			    $grp['grp_n'].'\', \''.$grp['grp_name'].'\');" '.
			    'src="images/icons/file_edit.png" '.
			    'style="cursor: pointer;"';
		else
		    $editgrp_pic = '<img src="images/icons/View.png">';
		    
		$html = $html.
		    '<tr>'.
			'<td width="50" align="center" valign="middle">'.
			    '<img src="images/icons/Usergroup.png">'.
			    '<b>'.
			    html_get_users_invite_table($grp['grp_n'] ,3).'</b>'.
			'</td>'.
			'<td width="20" align="center" valign="middle">'.
				$editgrp_pic.
			'</td>'.
			'<td id="nm'.$grp['grp_n'].'">'.
			    $grp['grp_name'].
			'</td>'.
			'<td width="100">'.
			    $grp['grp_owner'].
			'</td>'.
			'<td width="20" align="center" valign="middle">'.
			    '<a onClick="deleteGroup(\''.$grp['grp_n'].'\');" '.
			    'href="#">'.
				'<img src="images/icons/file_delete.png">'.
			    '</a>'.
			'</td>'.
		    '</tr>';
	    }
	    $html = $html.'</table>';
	break;
    }
    
    return $html;
}
?>
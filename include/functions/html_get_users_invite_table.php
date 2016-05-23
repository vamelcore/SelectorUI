<?php
//---FUNCTION html_get_users_invite_table()--------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: $grp_n	     - group index
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_get_users_invite_table( $grp_n, $edit )
{
    $html = "";
    $edit_pic = "";
    $phone = "";
		    
    $result = mysql_query('SELECT * FROM invite WHERE grp_n=\''.$grp_n.'\';');
    $count = mysql_num_rows( $result );
    if( $edit == 3 )
	return $count;
    for( $i = 0; $i < $count; $i++ )
    {
    	$usr = mysql_fetch_assoc( $result );
	if( $edit == 1 )
	    $edit_pic = '<td align="center" valign="center" width="20">'.
			    '<a href="#" onMouseDown="deleteUser(\''.
				    $usr['usr_n'].'\','.
				    '\''.$usr['grp_n'].'\', '.
				    '\''.$usr['grp_name'].'\');">'.
				'<img src="images/icons/user_delete.png">'.
			    '</a>'.
			'</td>';
	if ($edit == 2)
	    $edit_pic = '<td align="center" valign="center" width=20>'.
			    '<img src="images/icons/ok.gif">'.
			'</td>';
	$html = $html.
		    '<tr>'.
		      '<td width="25" id="'.$usr['usr_n'].'" align="center">'.
		          ''.($i + 1).
		      '</td>'.
		      '<td id="un'.$usr['usr_n'].'">'.
		        '&nbsp '.$usr['usr_name'].
		      '</td>'.
		      '<td id="phn'.$usr['usr_n'].'">'.
		    '&nbsp '.$usr['phn'].
		      '</td>'.
		      '<td id="em'.$usr['usr_n'].'">'.
		        '&nbsp '.$usr['email'].
		      '</td>'.
		      $edit_pic.
		    '</tr>';
    }
    return $html;
}
?>
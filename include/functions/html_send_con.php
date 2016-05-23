<?php
//---FUNCTION html_send_con()----------------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: $conferences - array of all confs---
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_send_con( $conferences )
{
    GLOBAL $conferences, $l18n;
    $locked = '';
    $aid = 'conLock';
    $startTime = '';
    $endTime = '';
    $rec_img = '';
    $html = '<table border="0" id="conheader">'.
	    '<tr>'.
		'<td width="390">'.
		    '<h3>&nbsp&nbsp&nbsp '.$l18n['confer'].':</h3>'.
		'</td>'.
		'<td>'.
		    '<a href="#" onMouseDown="showAddConForm();">'.
		    '<img src="images/icons/file_add.png">&nbsp'.
		    '<b>'.$l18n['addnew'].'</b></a><br><br>'.
		'</td>'.
	    '</tr>'.
	 '</table>';
	 
    foreach ( $conferences as $con )
    {
	if ( !is_locked( $con['roomNo'] ))
	{
	    $locked = '_open';
	    $lock_title=$l18n['lock'];
	    $aid = 'conLock';
	}
	else
	{
	    $locked = '';
	    $lock_title=$l18n['unlock'];
	    $aid = 'conUnlock';
	}
	if( $con['rec'] )
	    $rec_img = 'Rec <img src="images/icons/Record.png">';
	else
	    $rec_img = '';
	       
	$startTime = date( 'd/n G:i', strtotime( $con['startTime'] ));
	$endTime = date( 'd/n G:i', strtotime( $con['endTime'] ));
	
	$html = $html.'<div class="title" id="'.$con['roomNo'].'">'.
	        '<table border="0">'.
	    	    '<tr>'.
	    		'<td id="open" align="center" width="30">'.
	    		    '<img src="images/icons/arrow_right.png" '.
	    		    'style="cursor: pointer;" '.
			    'title="'.$l18n['enter'].'"'.
	    		    'onClick="showUsers('.$con['roomNo'].')">'.
	    		'</td>'.
	    		'<td id="info" width="205">'.
	    		    '<b>'.$con['roomNo'].'</b>: &nbsp '.
	    		    $l18n['nabon'].': <b>'.
	    		    count( get_con_users( $con['roomNo'] )).
	    		    '/'.$con['maxUser'].'</b>'.
	    		    '&nbsp&nbsp '.$rec_img.
	    		    '<br>'.
	    		    '"'.$con['confDesc'].'"'.
	    		'</td>'.
	    		'<td width="100">'.
	    		    '<b>'.$l18n['start'].':&nbsp </b>'.$startTime.'<br>'.
	    		    $con['confOwner'].
	    		'</td>'.
	    		'<td id="useradd" width="25">'.
	    		    '<img src="images/icons/user_add.png" '.
	    		    'title="'.$l18n['inv'].'"'.
			    'style="cursor: pointer;" '.
	    		    'onClick="inviteUsersForm(\''.$con['roomNo'].'\');">'.
	    		'</td>'.
	    		'<td id="lock" width="25">'.
	    		    '<img src="images/icons/lock'.$locked.'.png" '.
			    'title="'.$lock_title.'"'.
	    		    'style="cursor : pointer;" '.
	    		    'onMouseDown="'.$aid.'(\''.$con['roomNo'].'\')">'.
	    		'</td>'.
	    		'<td id="kickall" width="25">'.
	    		    '<img src="images/icons/user_delete.png" '.
			    'title="'.$l18n['kickall'].'"'.
	    		    'style="cursor : pointer;" '.
	    		    'onMouseDown="conKickall(\''.$con['roomNo'].'\')">'.
	    		'</td>'.
	    		'<td id="remove" width="25">'.
	    		    '<img src="images/icons/file_delete.png" '.
			    'title="'.$l18n['delete'].'"'.
	    		    'style="cursor : pointer;" '.
	    		    'onMouseDown="conRemove(\''.$con['roomNo'].'\')">'.
	    		'</td>'.
	    	    '</tr>'.
	    	'</table>'.
	     '</div>'; 
    }
    return $html;
}
?>
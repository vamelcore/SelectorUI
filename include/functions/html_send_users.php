<?php
//---FUNCTION html_send_users()--------------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: $con_num     - conference number
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_send_users( $con_num )
{
    GLOBAL $l18n;
    $users = get_con_users( $con_num );
    $js_act = '';
    $speak_pic = '';
    $rec_img = '';
    $muted = 's_off';
    $pin = new Conference( $con_num );
    
    if ( $pin->params['rec'] )
	$rec_img = '<img src="images/icons/Record.png">';
    
    $html = '<table>'.
	    '<tr>'.
		'<td width="200">'.
		    '<h3>&nbsp&nbsp&nbsp '.$l18n['conya'].' #: &nbsp'.
		    '<b style="color:gray;">"'.$con_num.'"</b></h3>'.
		'</td>'.
                        '<td id="kickall" width="100">'.
'<input type="button" title="'.$l18n['kickall'].'" value="ЗАКОНЧИТЬ" onClick="conKickall(\''.$con_num.'\');" >'
                        .'</td>'.

		'<td width="150" align="right">'.
		    '<b>'.$pin->params['silPass'].'</b>&nbsp : aPIN '.
		    '<img src="images/icons/key.png"><br>'.
		    '<b>'.$pin->params['roomPass'].'</b>&nbsp : uPIN '.
		    '<img src="images/icons/key.png">'.
		'</td>'.
		'<td width="20" align="center" valign="center">'.
		    $rec_img.
		'</td>'.
	   '</tr>'.
	'</table>';
    foreach ( $users as $usr )
    {
	if ( $usr["muted"] )
	{
	    $muted = 's_off';
	    $js_act = 'usrUnmute('.$con_num.', '.$usr['n'].')';
	    $mute_title = $l18n['unmute'];
	}
	else
	{
	    $muted = 's_on';
	    $js_act = 'usrMute('.$con_num.', '.$usr['n'].')';
	    $mute_title = $l18n['mute'];
	}	    
	if( $usr['speak'] )
	    $speak_pic = '<img src="images/icons/Sound.png">';
	else
	    $speak_pic = '';
	
	$username = get_username( $usr['channel'], $usr['user_id'] );
	if( $username == '' )
	    $userpic = '<img src="images/icons/Alien.png">';
	else
	    $userpic = '<img src="images/icons/user.png">';
	
	$html = $html.
		'<table>'.
		    '<tr id=>'.
			'<td width="390" height="34">'.
			    '&nbsp&nbsp'.
			    $userpic.
			    '&nbsp&nbsp'.
			    '<b>'.
			       $username.
			    '</b>'.
			    '&nbsp "'.$usr['user_id'].'"'.
			    '&nbsp кан:'.$usr['channel'].''.
			'</td>'.
			'<td width="35">'.
			    '<a href="#" onMouseDown="'.$js_act.'" title="'.$mute_title.'">'.
			      '<img src="images/icons/'.$muted.'.png">'.
			    '</a>'.
			'</td>'.
			'<td width=25>'.
			    '<img src="images/icons/user_delete.png" '.
			    'onMouseDown="usrKick('.$con_num.', '.$usr['n'].')" '.
			    'style="cursor: pointer;">'.
			'</td>'.
			'<td width="25" align="center">'.
			    $speak_pic.
			'</td>'.
		    '</tr>'.
		'</table>'; 
    }
    $html = $html.'&nbsp&nbsp&nbsp<img src="images/icons/Sum.png">'.
		' '.$pin->users_count;
    return $html;
}
?>

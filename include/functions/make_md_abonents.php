<?php
//---FUNCTION get_valid_roomno()-------------------- 
//---SYNOPSYS---------------------------------------
//---Get-valid-room-number-))-----------------------
//---arguments: none
//---return: 	$num - valid room number
//cut----------------------------------------------- 
function make_md_abonents( $f )
{
	$str = explode( " ", $f );
    	$result = mysql_query('SELECT usr_name FROM invite WHERE '.
		'phn = \''.$str[0].'\' LIMIT 1;');
	$name = mysql_fetch_assoc( $result );
	$ret = '<tr>'.
		'<td>'.
		'<img src="images/icons/user.png">&nbsp '.
		'<b>'.$name['usr_name'].'</b></td>'.
		'<td>'.$str[0].
		'</td>';
	if( $str[1] == "1\n" )
		$ret = $ret.'<td><img src="images/icons/ok.gif"></td></tr>';
	else
		$ret = $ret.'<td><img src="images/icons/error.png"></td></tr>';
	return $ret;
}
?>
<?php
//---FUNCTION get_username( $phn )------------------ 
//---SYNOPSYS---------------------------------------
//---Get-username-by-phone-number-------------------
//---arguments: $phn - phone number
//---return: 	$username['usr_name'] 
//cut----------------------------------------------- 
function get_username( $channel, $number )
{
    $channel = substr( $channel, 0, strlen( $channel ) - 9 );
    $ch = explode( '/', $channel );
    if( $ch[1] == $number )
	$phn = $channel;
    else
	$phn = $channel.'/'.$number;
	
    $query = 'SELECT usr_name FROM invite WHERE phn = \''.
	      $phn.'\' LIMIT 1;';
    
    $result = mysql_query( $query );
    if( !$result )
    {
	echo 'ERROR: '.mysql_error();
	return '';
    }
    $username = mysql_fetch_assoc( $result );
    
    return $username['usr_name'];
}
?>
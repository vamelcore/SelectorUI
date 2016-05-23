<?php
//---FUNCTION get_conferences()--------------------- 
//---SYNOPSYS---------------------------------------
//---Get-all-conferences-from-'booking'-table-------
//---arguments: none
//---return: 	$conferences - array of conference
//			       params(see 'booking')
//cut----------------------------------------------- 
function get_conferences()
{
    GLOBAL $auth_info;

    $result 	 = 0;
    $query	 = "";
    $num_rows    = 0;
    $options	 = "";
    $conferences = array();
    
    if( $auth_info['username'] == 'admin' )    
	$owner = '';
    else
	$owner = 'WHERE confOwner = \''.$auth_info['username'].'\'';
    $query = 'SELECT * FROM booking '.$owner.';';

    $result = mysql_query( $query );
    if ( !$result )
    {
	echo "ERROR: ".mysql_errno()." ".mysql_error();
	exit;
    }
    $count = mysql_num_rows( $result );
    for ( $i = 0; $i < $count; $i++ )
    {
	$conferences[$i] = mysql_fetch_assoc( $result );	
	$conferences[$i]['locked'] = is_locked( $conferences[$i]['roomNo'] );
	if ( strstr( $conferences[$i]['aFlags'], 'r' ) == false )
	    $conferenses[$i]['rec'] = false;
	else 
	    $conferences[$i]['rec'] = true;
    }    
    return $conferences;
}
?>